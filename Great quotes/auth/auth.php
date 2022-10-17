<?php
// add parameters
function signup(&$file, &$user, &$password){
	//open the file for users data
	$file_add = $file;
	$file_open = fopen($file_add, "a+");
	//add formatted entry of the user/email and password to file
	$record = "\n" . $user . "," . $password;
	fwrite($file_open, $record);
	fclose($file_open);
}

// add parameters
function signin(&$email, &$password){
	$file_users = "../data/users.csv.php";
	$file_users_array = array_map('str_getcsv', file($file_users));
	//for each record in users array, if index 0's value equals the email submitted then check if index 1's value can be verified with the password submitted
	foreach($file_users_array as $array_record) {
		if ($array_record[0] == $email) {
			foreach($file_users_array as $array_record) {	
				//check if the password is correct
				if (password_verify($password, $array_record[1])) {
					//store session information
					$_SESSION['email'] = $email;
					$_SESSION['password'] = $password;
					if(true){
						$_SESSION['logged']=true;
						
					}else $_SESSION['logged']=false;
					//redirect the user to the members_page.php page
					header("Location: members_page.php");
				} 
			}
		} else {
			error_reporting(0);
		}
	}

	
}

function signout(){
	//reassign SESSION values to false and null so user is signed out
	$_SESSION['logged']=false;
	$_SESSION['email']=null;
	$_SESSION['password']=null;
	session_destroy();
	// redirect the user to the public page.
	header("Location: public.php");
}

function is_logged(){
	// check the value of $_SESSION['logged'] value to see if they are logged in
	if (isset($_SESSION['logged'])) {
		return true;
	} else {
		return false;
	}
}