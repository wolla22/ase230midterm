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
        session_start();
        include('../csv_util.php');
        $author_file = '../csv/authors.csv';
        $quote_file = '../csv/quotes.csv';
        $authors_array = csvReturnArray($author_file);
        $quote_array = csvReturnArray($quote_file);
        //Buttons relavant to signed in users
    ?>
    <a href="../index.php"><button type="button" >Quotes Index</button></a>
    <a href="/Great%20quotes/authors/index.php"><button type="button" >Authors Index</button></a>
    <a href="signout.php"><button type="button" >Sign Out</button></a>
    </html>