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
        include('../csv_util.php');
        $author_file = '../csv/authors.csv';
        $quote_file = '../csv/quotes.csv';
        $authors_array = csvReturnArray($author_file);
        $quote_array = csvReturnArray($quote_file);
        $record;
        $quote;
        $author;
    ?>
    <?php 
    if (!$_POST) { 
        foreach($quote_array as $quote_key => $csvquote) {
            if ($quote_key == $_GET['index']) {
                $quote = $csvquote[1];
                foreach($authors_array as $key => $csvauthor) {
                    if ($key == $csvquote[0]) {
                        $author = $csvauthor[0]  . " " . $csvauthor[1];
                    }
                }
            }
        } ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <label for="fname">Quote:</label>
            <input type="text" name="quote" value="<?php print($quote) ?>"><br><br>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <select name="authors">
                <?php foreach($authors_array as $key => $name) {
                    $author_name = $name[0] . " " . $name[1];?>
                    <?php if ($author_name == $author) {?>
                        <option name="author" value="<?php echo $key; ?>" selected><?php echo $author_name ?></option>
                    <?php } else { ?>
                    <option name="author" value="<?php echo $key; ?>"><?php echo $author_name ?></option>
                    <?php } 
                } ?>
            </select>
            <br><br>
            <input type="hidden" name="index" value="<?php echo $_GET['index']?>">
            <input type="submit" value="Submit">
        </form>
    <?php } 
    else {
        $record = $_POST['quote'];
        modifyFile($quote_file, $record, $_POST['index'], $_POST['authors']);
        print_r($_POST);
    }?>
</body>
