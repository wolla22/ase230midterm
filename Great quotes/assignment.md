Create a file named csv_util.php where you declare:

one function for reading the content of a CSV-formatted file into a PHP array (with all the records)
one function for reading the content of a CSV-formatted file into a PHP array and returning one element with index $element (i.e., only one record )
one function for adding a new record to a CSV-formatted file
one function for modifying the record on a specific line
one function for emptying the record on a specific line (delete the content of a line, but leave an empty line  in the file)
one function for deleting a line from the file (delete the line altogether)
Your tasks
Create a file named authors.csv that contains a list of all the authors of your quotes (First Name, Last name). You can add authors manually to the file, using the CSV format.

Create a file named quotes.csv that will contain all the quotes, with a reference to their authors (e.g., the index of the author).

Create a file named create.php as follows:

the file displays a form with a text field where users can type the quote and a select box that displays all the available authors
as the form gets submitted, a new quote is added to quotes.csv
Create a file named index.php as follows:

the file lists all the available quotes, together with their authors (e.g., "I try to dress classy and dance cheesy" - Psy)
the quote links to the  detail page described below
a "create" button enables you to go to the create page described above
Create a file named detail.php as follows:

the page shows a specific quote (selected by the user) written using a bigger font, with its author
a "delete" button enables you to delete the quote
a "modify" button enables you to go to the modify page described below
Create a file named modify.php as follows:

the page shows a form with the information about the quote (text, author)
as the form gets submitted, the quote is saved into quotes.csv (overwritten)
a message confirms that the quote has been modified and shows the link to the detail page
Create a file named delete.php as follows:

the page asks the user if they want to delete the quote (text, author)
as the user confirms, the quote is removed from quotes.csv (overwritten)
a message confirms that the quote has been deleted and shows the link to the detail page
Rubric
The code is submitted via GitHub, it's indented properly and there are no HTML or PHP errors: +1 point
The functions for reading and saving the CSV file works properly: +1 point
The functions in csv_util are defined and commented properly: +1 point
The index page works properly: +1 point
The detail page works properly: +1 point
The create page works properly: +1 point
The modify page works properly: +1 point
The delete page works properly: +1 point
Extra points

Use of a bootstrap-based template for the entire project (error messages...) and overall the site looks GOOD (please note: GOOD is uppercase and this text is underlined): +1 point
1 extra point:
create a page named authors/index.php that displays a list of all the authors
create a page named authors/detail.php that displays the quotes by a specific author
1 extra point:
if no information about the quote/author is provided in the query string:
in detail.php and authors/detail.php gets a random quote or author, respectively 
in delete.php and modify.php gets an error message
1 extra point:
create a page named authors/modify.php where you can modify an author's name
2 extra points:
create a page named authors/delete.php where you can delete an author (and all their quotes)