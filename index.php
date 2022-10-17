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
        session_start();
        include('csv_util.php');
        $author_file = 'csv/authors.csv';
        $quote_file = 'csv/quotes.csv';
        $authors_array = csvReturnArray($author_file);
        $quote_array = csvReturnArray($quote_file);
    ?>

    <?php 
    foreach($quote_array as $quote_key => $quote) { ?>
        <?php foreach($authors_array as $key => $author) {
            if ($key == $quote[0]) {?>
                <a href="quotes/detail.php?index=<?= $quote_key ?>"><p><?php echo $quote[1] . " - " . $author[0] . " " . $author[1] . "\n"; ?></p></a>
            <?php } ?>
        <?php } ?>  
    <?php } ?> 
    <?php 
    if (isset($_SESSION['logged'])) { ?>
        <a href="quotes/create.php"><button type="button" >Create</button></a>
        <a href="authors/index.php"><button type="button" >Authors Index</button></a>
        <a href="auth/signout.php"><button type="button" >Sign Out</button></a>
    <?php } ?>
</html>