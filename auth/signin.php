<?php
include("auth.php");
session_start();
$file_banned = "../data/banned.csv.php";
$file_users = "../data/users.csv.php";
// if the user is alreay signed in, redirect them to the members_page.php page
if (is_logged()) {
	header("Location: members_page.php");
}
// use the following guidelines to create the function in auth.php
//instead of using "die", return a message that can be printed in the HTML page
if(count($_POST)>0){
	// 1. check if email and password have been submitted
	if(!isset($_POST['email'])) 
		echo 'please enter your email<br>';
	else if(!isset($_POST['password'])) 
		echo 'please enter your password<br>';
	// 2. check if the email is well formatted
	else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
		echo 'Your email is invalid<br>';
	// 3. check if the password is well formatted
	else if(strlen($_POST['password'])<8) 
		echo 'Please enter a password >=8 characters<br>';
	else if(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST['password'])) {
		if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST['password'])) {
			echo 'Password is not formatted correctly<br>';
		}
	}	
	else if (!is_file($file_banned)) {
		// 4. check if the file containing banned users exist
		echo 'Banned users file does not exist<br>';
	}
	// 6. check if the file containing users exists
	else if (!is_file($file_users)) {
		echo 'Users file does not exist<br>';
	} else {
		// 5. check if the email has been banned
		$file_array = file($file_banned);
		foreach($file_array as $array_record) {
			if ($array_record == $_POST['email']) {
				echo 'This email has been banned. Please try another.<br>';
				break;
			} 
		} 
		//call signin method with values of form fields
		signin($_POST['email'], $_POST['password']);
	}
}


?>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<input type="email" name="email" />
	<input type="password" name="password" />
	
	<input type="submit" value="submit" />
</form>
