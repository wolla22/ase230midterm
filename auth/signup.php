<?php
include('auth.php');
session_start();
$file_users = "../data/users.csv.php";	
$file_banned = "../data/banned.csv.php";
// if the user is alreay signed in, redirect them to the members_page.php page
if (is_logged()) {
	header("Location: members_page.php");
}
// use the following guidelines to create the function in auth.php
// instead of using "die", return a message that can be printed in the HTML page
if(count($_POST)>0) {
	// check if the fields are empty
	if(!isset($_POST['email'])) 
		die('please enter your email');
		else if(!isset($_POST['password'])) 
		die('please enter your email');
	
	// check if the email is valid
	else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
		die('Your email is invalid');
	
	// check if password length is between 8 and 16 characters
	else if(strlen($_POST['password'])<8) 
		die('Please enter a password >=8 characters');
	
	// check if the password contains at least 2 special characters
	else if(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST['password'])) {
		if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST['password'])) {
			die('Please enter a password with 2 special characters');
		}
	}
	// check if the file containing banned users exists
	else if (!is_file($file_banned)) {
		die('Banned users file does not exist');
	}
	else if (is_file($file_banned)) {
		// check if the email has not been banned
		$file_array = array_map('str_getcsv', file($file_banned));
		foreach($file_array as $array_record) {
			if ($array_record[0]  == $_POST['email']) {
				echo 'This email has been banned. Please try another.<br>';
			} 
			
		} 
	}
		// check if the file containing users exists
	else if (!is_file($file_users)) {
		die('Users file does not exist');
	}
	else if (is_file($file_users)) {
		// check if the email is in the database already
		$file_users_array = array_map('str_getcsv', file($file_users));
		foreach($file_users_array as $key => $array_record) {
			if ($array_record[$key][0] == $_POST['email']) {
				die('This email has already been used. Please try another.');;
			} 
		}
	} else {
		// encrypt password
		$encryptedPass = password_hash($_POST['password'], PASSWORD_BCRYPT);
		// save the user in the database 
		signup($file_users, $_POST['email'], $encryptedPass);
		// show them a success message and redirect them to the sign in page
		echo "User information has been saved!";
		header("Location: signin.php");
	}
}

// improve the form
?>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<input type="email" name="email" />
	<input type="password" name="password" />
	
	<input type="submit" value="submit" />
</form>
