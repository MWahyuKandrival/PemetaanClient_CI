<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CSV Reader for CodeIgniter 3.x
 *
 * Library to read the CSV file. It helps to import a CSV file
 * and convert CSV data into an associative array.
 *
 * This library treats the first row of a CSV file
 * as a column header row.
 *
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      CodexWorld
 * @license     http://www.codexworld.com/license/
 * @link        http://www.codexworld.com
 * @version     3.0
 */
class CSVReader
{

    // Columns names after parsing
    private $fields;
    // Separator used to explode each line
    private $separator = ';';
    // Enclosure used to decorate each field
    private $enclosure = '"';
    // Maximum row size to be used for decoding
    private $max_row_size = 4096;

    /**
     * Parse a CSV file and returns as an array.
     *
     * @access    public
     * @param    filepath    string    Location of the CSV file
     *
     * @return mixed|boolean
     */
    function parse_csv($filepath, $tabel = "")
    {
        // If file doesn't exist, return false
        if (!file_exists($filepath)) {
            return FALSE;
        }

        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($filepath, 'r');

        //Get instance Codeigniter
        $CI = get_instance();
        
        // Get Fields and values
        $this->fields = fgetcsv($csvFile, $this->max_row_size, $this->separator, $this->enclosure);

        //Cek Header
        $keys = $this->fields;
        if ($tabel == "client") {
            $header = [
                0 => "id_client",
                1 => "nama_client",
                2 => "pic",
                3 => "alamat",
                4 => "negara",
                5 => "region",
                6 => "email",
                7 => "no_hp",
                8 => "domain",
                9 => "status_kerja_sama"
            ];
            if ($keys != $header) {
                $CI->session->set_userdata('error_msg', "Format Header Salah");
                return array("error" => "error");
            }
        } else if ($tabel == "project") {
            $header = [
                0 => "kode_projek",
                1 => "nama_projek",
                2 => "domain",
                3 => "package",
                4 => "id_client",
                5 => "latitude",
                6 => "longitude",
                7 => "start_date",
                8 => "end_date",
                9 => "status",
                10 => "ketua_projek"
            ];
            if ($keys != $header) {
                $CI->session->set_userdata('error_msg', "Format Header Salah");
                return array("error" => "error");
            }
        } else {
            $CI->session->set_userdata('error_msg', "Format Header Salah");
            return array("error" => "error");
        }

        // Store CSV data in an array
        $csvData = array();
        $i = 1;
        while (($row = fgetcsv($csvFile, $this->max_row_size, $this->separator, $this->enclosure)) !== FALSE) {
            // Skip empty lines
            if ($row != NULL) {
                if (count($keys) == count($row)) {
                    $arr        = array();
                    $new_values = array();
                    $new_values = $this->escape_string($row);
                    for ($j = 0; $j < count($keys); $j++) {
                        if ($keys[$j] != "") {
                            $arr[$keys[$j]] = $new_values[$j];
                        }
                    }
                    $csvData[$i] = $arr;
                    $i++;
                }
            }
        }
        // Close opened CSV file
        fclose($csvFile);
        return $csvData;
    }

    // function parse_csv($filepath, $tabel = "")
    // {
    //     $test = TRUE;
    //     $redirect = "";
    //     // If file doesn't exist, return false
    //     if (!file_exists($filepath)) {
    //         return FALSE;
    //     }

    //     // Open uploaded CSV file with read-only mode
    //     $csvFile = fopen($filepath, 'r');

    //     // Get Fields and values
    //     $this->fields = fgetcsv($csvFile, $this->max_row_size, $this->separator, $this->enclosure);

    //     //Cek Header
    //     $keys = $this->fields;
    //     // print_r($keys);die;
    //     if ($tabel == "client") {
    //         $header = [
    //             0 => "id_client",
    //             1 => "nama_client",
    //             2 => "pic",
    //             3 => "alamat",
    //             4 => "negara",
    //             5 => "region",
    //             6 => "email",
    //             7 => "no_hp",
    //             8 => "domain",
    //             9 => "status_kerja_sama"
    //         ];
    //         if ($keys == $header) {
    //             echo "sama";
    //         } else {
    //             $test = FALSE;
    //             $redirect = "<script>alert('Format Header untuk Client tidak sama'); window.location.href = '" . base_url('client') . "';</script>";
    //         }
    //     } else if ($tabel == "project") {
    //         $header = [
    //             0 => "kode_projek",
    //             1 => "nama_projek",
    //             2 => "domain",
    //             3 => "package",
    //             4 => "id_client",
    //             5 => "latitude",
    //             6 => "longitude",
    //             7 => "start_date",
    //             8 => "end_date",
    //             9 => "status",
    //             10 => "ketua_projek"
    //         ];
    //         if ($keys == $header) {
    //             echo "sama";
    //         } else {
    //             $test = FALSE;
    //             $redirect = "<script>alert('Format Header untuk Client tidak sama'); window.location.href = '" . base_url('client') . "';</script>";
    //         }
    //     } else {
    //         $test = FALSE;
    //         $redirect = "<script>alert('Format Header Salah'); window.location.href = '" . base_url('dashboard') . "';</script>";
    //     }

    //     // Store CSV data in an array
    //     $csvData = array();
    //     $i = 1;
    //     while (($row = fgetcsv($csvFile, $this->max_row_size, $this->separator, $this->enclosure)) !== FALSE) {
    //         // Skip empty lines
    //         if ($row != NULL) {
    //             if (count($keys) == count($row)) {
    //                 $arr        = array();
    //                 $new_values = array();
    //                 $new_values = $this->escape_string($row);
    //                 for ($j = 0; $j < count($keys); $j++) {
    //                     if ($keys[$j] != "") {
    //                         $arr[$keys[$j]] = $new_values[$j];
    //                     }
    //                 }
    //                 $csvData[$i] = $arr;
    //                 $i++;
    //             }
    //         }
    //     }
    //     // Close opened CSV file
    //     fclose($csvFile);
    //     // echo $redirect;die;
    //     if ($test == TRUE) {
    //         return $csvData;
    //     } else {
    //         return array('redirect' => $redirect);
    //     }
    // }

    function escape_string($data)
    {
        $result = array();
        foreach ($data as $row) {
            $result[] = str_replace('"', '', $row);
        }
        return $result;
    }
}
