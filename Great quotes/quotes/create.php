<!doctype html>
<html lang="en">
<head>
    <!-- https://www.bootdey.com/snippets/view/single-advisor-profile#html -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <title>ASE 230 - class of Fall 2022</title>
</head>
<body>
    <?php
        //import and include resources needed for functions and file manipulation
        include('../csv_util.php');
        $author_file = '../csv/authors.csv';
        $quote_file = '../csv/quotes.csv';
        //create arrays of quote and author information
        $authors_array = csvReturnArray($author_file);
        $quote_array = csvReturnArray($quote_file);
        $record_add;
    ?>
    <?php 
    //if form has not been submitted, display form fields 
    if (!$_POST) { ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fname">Quote:</label>
            <input type="text" name="quote"><br><br>
            <select name="authors">
                <?php foreach($authors_array as $name) {
                    $author_name = $name[0] . " " . $name[1];?>
                    <option><?php echo $author_name ?></option>
                <?php } ?>
            </select>
            <br><br>
            <input type="submit" value="Submit">
        </form>
    <?php } 
    //if form has been submitted, add relavant data with information from form fields to the quote file.
    else {
        $author_key = 0;
        foreach($authors_array as $key => $author) {
            $fullname = $author[0] . " " . $author[1];
            if ($fullname == $_POST['authors']) {
                $author_key = $key;
            }
        }
        $record_add = ("\n" . $author_key . "," . "\"" . $_POST['quote'] . "\"");
        addRecord($quote_file, $record_add);
        echo "Record created <br><a href=\"../index.php\">Index Page</a>";
    }?>
</html>