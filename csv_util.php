<?php
    function csvReturnArray(&$file) {
        $csv = array_map('str_getcsv', file($file));
        return $csv;
    }

    function csvReturnElement(&$file, &$element) {
        $csvArray = array();
        $searchElement;
        $f = fopen($file, "r");
        while ($record = fgetcsv($f)) {
            foreach($record as $field) {
                array_push($csvArray, $field);
            }
        }
        foreach($csvArray as $csvElement) {
            if ($csvElement[$element]) {
                $searchElement = $csvElement;
            }
        }
        fclose($f);
        return $searchElement;
    }

    function addRecord(&$file, &$record) {
        $file_add = $file;
        $file_open = fopen($file_add, "a+");
        fwrite($file_open, $record);
        fclose($file_open);
    }

    function addAuthor(&$file, &$record) {
        $file_add = $file;
        $file_open = fopen($file_add, "a+");
        $record = "\n" . $record;
        fwrite($file_open, $record);
        fclose($file_open);
    }

    function modifyAuth(&$file, &$record, &$line) {
        $file_modify = $file;
        $file_open = fopen($file_modify, "r+" );
        $file_array = csvReturnArray($file);
        $write_array = array();
        $record_array = explode(" ", $record, 2);
        foreach($file_array as $key => $array_record) {
            if ($key == $line) {
                array_push($write_array, array($record_array[0], $record_array[1]));
            } else {
                array_push($write_array, array($array_record[0], $array_record[1]));
            }
        }
        foreach($write_array as $field) {
            fputcsv($file_open, $field);
        }
        fclose($file_open);
    }

    function modifyFile(&$file, &$record, &$line) {
        $file_modify = $file;
        $file_open = fopen($file_modify, "r+" );
        $file_array = csvReturnArray($file);
        $write_array = array();
        foreach($file_array as $array_record) {
            if ($array_record[0] == $line) {
                array_push($write_array, array($line, $record));
            } else {
                array_push($write_array, $array_record);
            }
        }
        foreach($write_array as $field) {
            fputcsv($file_open, $field);
        }
        fclose($file_open);
    }

    function emptyRecord(&$file, &$line) {
        $file_empty = $file;
        $file_open = fopen( $file_empty, "w" );
        while(!feof($file_open)) {
            if (fgets($file_open, $line)) {
                fwrite($file_open, "\n");
                fclose($file_open);
                break;
            }
        }
    }
    
    function deleteAuthor(&$file, &$line, &$quote_file) {
        $file_delete = $file;
        $file_open = fopen($file_delete, "r+" );
        $file_array = csvReturnArray($file);
        $write_array = array();
        foreach($file_array as $key => $array_record) {
            if ($key == $line) {
                array_push($write_array, array("", ""));
                deleteRecord($quote_file, $line);
                //continue;
            } else {
                array_push($write_array, $array_record);
            }
        }
        foreach($write_array as $field) {
            fputcsv($file_open, $field);
        }
        fclose($file_open);
    }

    function deleteRecord(&$file, &$line) {
        $file_delete = $file;
        $authors_file = "authors.csv";
        $file_open = fopen($file_delete, "r+" );
        $file_array = csvReturnArray($file);
        $write_array = array();
        foreach($file_array as $array_record) {
            if ($array_record[0] == $line) {
                //deleteAuthor($authors_file, $line);
                array_push($write_array, array("", ""));
                //continue;
            } else {
                array_push($write_array, $array_record);
            }
        }
        foreach($write_array as $field) {
            fputcsv($file_open, $field);
        }
        fclose($file_open);
    }
?>