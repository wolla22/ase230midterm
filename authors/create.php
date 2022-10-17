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
    <?php //if form has not been submitted, display a form
    if (!$_POST) { ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="fname">Author:</label>
            <input type="text" name="author"><br><br>
            <br><br>
            <input type="submit" value="Submit">
        </form>
    <?php } 
    //if form has been submitted, take form information and add it to the author array
    else {
        $record_explode = explode(" ", $_POST['author'], 2);
        $record_add = implode(",", $record_explode);
        addAuthor($author_file, ($record_add));
        echo "Record created <br><a href=\"index.php\">Index Page</a>";
    }?>
</html>