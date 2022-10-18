<?php
    //function to return an array of a file's contents
    function csvReturnArray(&$file) {
        $csv = array_map('str_getcsv', file($file));
        return $csv;
    }
    //function to return a specified element within a file
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
    //function to add a record to the end of a file's contents
    function addRecord(&$file, &$record) {
        $file_add = $file;
        $file_open = fopen($file_add, "a+");
        fwrite($file_open, $record);
        fclose($file_open);
    }
    //function to add an author to the end of a file's contents
    function addAuthor(&$file, &$record) {
        $file_add = $file;
        $file_open = fopen($file_add, "a+");
        $record = "\n" . $record;
        fwrite($file_open, $record);
        fclose($file_open);
    }
    //function to modify the information of an author at a specified line
    function modifyAuth(&$file, &$record, &$line) {
        $file_modify = $file;
        $file_open = fopen($file_modify, "r+" );
        //make an array of the file's contents
        $file_array = csvReturnArray($file);
        $write_array = array();
        //turn the data for the author which is to be modified into an array
        $record_array = explode(" ", $record, 2);
        //search an array of the file's contents to find the specified line
        foreach($file_array as $key => $array_record) {
            //if the array key and line values equal replace its contents with the modified author data
            if ($key == $line) {
                array_push($write_array, array($record_array[0], $record_array[1]));
            } 
            //for each other entry in the array of the file's contents input the original data
            else {
                array_push($write_array, array($array_record[0], $array_record[1]));
            }
        }
        //for each entry in the array with the modified data, write its contents into the file
        foreach($write_array as $field) {
            fputcsv($file_open, $field);
        }
        fclose($file_open);
    }

    function modifyFile(&$file, &$record, &$line, &$author_index) {
        $file_modify = $file;
        $file_open = fopen($file_modify, "r+" );
        $file_array = csvReturnArray($file);
        $write_array = array();
        //search an array of the file's contents to find the specified line
        foreach($file_array as $array_record) {
            //if the value of the first index in a line equals the specified line replace its contents with the modified data
            if ($array_record[0] == $line) {
                array_push($write_array, array($author_index, $record));
            } 
            //for each other entry in the array of the file's contents input the original data            
            else {
                array_push($write_array, $array_record);
            }
        }
        //for each entry in the array with the modified data, write its contents into the file
        foreach($write_array as $field) {
            fputcsv($file_open, $field);
        }
        fclose($file_open);
    }
    //empty the contents of a specific line in a file
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
    //delete the contents of author data at specified line
    function deleteAuthor(&$file, &$line, &$quote_file) {
        $file_delete = $file;
        $file_open = fopen($file_delete, "r+" );
        $file_array = csvReturnArray($file);
        $write_array = array();
        //for each entry in the array of file data 
        foreach($file_array as $key => $array_record) {
            //if the key of the entry equals the specified line, change the data to empty string values
            if ($key == $line) {
                array_push($write_array, array("", ""));
                //call the function for deleting quote records to delete each quote associated with the author
                deleteRecord($quote_file, $line);
            } 
            //for each other entry in the array of the file's contents input the original data     
            else {
                array_push($write_array, $array_record);
            }
        }
        foreach($write_array as $field) {
            fputcsv($file_open, $field);
        }
        fclose($file_open);
    }
    //function to delete a record in the quote file
    function deleteRecord(&$file, &$line) {
        $file_delete = $file;
        $authors_file = "authors.csv";
        $file_open = fopen($file_delete, "r+" );
        $file_array = csvReturnArray($file);
        $write_array = array();
        //for each entry in the array of file contents
        foreach($file_array as $array_record) {
            //if the value of index of the record equals the specified line, change the data to empty string values
            if ($array_record[0] == $line) {
                //deleteAuthor($authors_file, $line);
                array_push($write_array, array("", ""));
            
            } 
            //for each other entry in the array of the file's contents input the original data     
            else {
                array_push($write_array, $array_record);
            }
        }
        foreach($write_array as $field) {
            fputcsv($file_open, $field);
        }
        fclose($file_open);
    }
?>
