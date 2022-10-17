        
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
        include('../csv_util.php');
        $author_file = '../csv/authors.csv';
        $quote_file = '../csv/quotes.csv';
        $authors_array = csvReturnArray($author_file);
        $quote_array = csvReturnArray($quote_file);
    ?>  
    <?php 
    //print the value of the index matching $_GET['index] in the aurthors array
    foreach($authors_array as $key => $author) {
            if ($key == $quote_array[$_GET['index']][0]) { ?>
                <h2><?php echo $quote_array[$_GET['index']][1] . " - " . $author[0] . " " . $author[1] ?></h2>
                <?php } ?>
    <?php }  
    if (isset($_SESSION['logged'])) { ?>
        <a href="delete.php?index=<?= $_GET['index'] ?>"><input type="submit" name="delete" class="button" value="Delete" />
        <a href="modify.php?index=<?= $_GET['index'] ?>"><input type="submit" name="modify" class="button" value="Modify" />           
    <?php } ?>
</html>