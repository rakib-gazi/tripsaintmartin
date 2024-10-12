<?php
	require_once('db_connection.php');
	
	function login(){
		$db_connect = db_connect();
		$email_username = $_POST['email_username'];
		$password = $_POST['password'];
		$remember = $_POST['remember']??null;
		$error = [];
		$sql_view = "SELECT * FROM users WHERE (email = '$email_username' OR username = '$email_username') && password = '$password' " ;
		$result = mysqli_query($db_connect,$sql_view);
		if(mysqli_num_rows($result) == 0){
			$error['email_username'] = 'Invalid email/username or password';
			return[
				'status' => 'error',
				'message' => $error,
			];
		}else{
			$success = 'Login Successfull';
			$_SESSION['auth'] = mysqli_fetch_assoc($result);
				if($remember){
					setcookie('email_username', $email_username, (60+time()),'/');
					setcookie('password', $password, (60+time()),'/');
				}else{
					
					setcookie('email_username', '', (60+time()),'/');
					setcookie('password', '', (60+time()),'/');
				}
		}
	}
	function logout(){
		session_destroy();
		session_unset();
		header('Location:../login.php');
	}
	function registration(){
		$db_connect = db_connect();
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$position = $_POST['position'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];
		
		$error=[];
		if(empty($name) || strlen($name) <3 ||strlen($name) >50){
			  $error['name'] = 'Name will be 3 to 50 charachters';
		}
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			 $error['email'] = 'Invalid Email';
		}else{
			$sql_view = "SELECT * FROM users WHERE email = '$email' " ;
			$results = mysqli_query($db_connect, $sql_view);
				if(mysqli_num_rows($results) == 1){
					$error['email'] = 'Already Exists';
				}
		}
		if(empty($phone) || strlen($phone) <11 ||strlen($phone) >11){
			 $error['phone'] = 'Invalid Phone';
		}
		if(empty($position)){
			 $error['position'] = 'users Job position is required';
		}

		if(empty($password) || strlen($password) <4 ){
			 $error['password'] = 'Password must be minimum 4 charachters';
		}
		if($password != $confirm_password){
			 $error['password'] = 'password & confirm password  match';
		}
		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		}
		$sql_insert = "INSERT INTO users(name, email, phone, position,password) VALUES ('$name','$email','$phone','$position','$password')";
		$result =  mysqli_query ($db_connect,$sql_insert);
		if(mysqli_error($db_connect)){
			die('Table Error:'.mysqli_error());
		}
		return [
			'status' => 'success',
			'message' => 'Data Save Success',
		];
	}
	function profile_update(){
		$db_connect = db_connect();
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$position = $_POST['position'];
		$password = $_POST['password'];
		$success = 'Data Save Success';
		$profile_img_name = $_FILES['profile_image']['name'];
		$profile_img_size = $_FILES['profile_image']['size'];
		$profile_img_tmp = $_FILES['profile_image']['tmp_name'];
		
		$error=[];
		if(empty($name) || strlen($name) <3 ||strlen($name) >50){
			  $error['name'] = 'Name will be 3 to 50 characters';
		}
		if(empty($username) || empty($email)){
			 $error['username']['email'] = 'Username or Email cannot is required';
		}
		if(empty($phone) || strlen($phone) <11 ||strlen($phone) >11){
			 $error['phone'] = 'Invalid Phone';
		}
		if(empty($position) ){
			 $error['position'] = 'Job position is required';
		}
		if(empty($password) || strlen($password) <3 ||strlen($password) >50 ){
			 $error['password'] = 'Password will be 3 to 50 characters';
		}
		if($profile_img_tmp){
			if( $profile_img_size >1049576 ){
			$error['profile_image'] = 'Max Size 1 MB';
			}
			$targeted_extensions = array('jpg','jpeg','png','gif','webp');
			$getExtension = strtolower (pathinfo($profile_img_name, PATHINFO_EXTENSION));
			if(!in_array($getExtension,$targeted_extensions)){
				$error['profile_image'] = 'jpg/jpeg/png/gig/webp File Required';
			}
		}
		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		 } 
			$location='images/profile';
			if(!file_exists('../'.$location)){
				mkdir('../'.$location);
			}
			$path= $_SESSION['auth']['image']??null;
			if($profile_img_tmp){
				if($path){
					unlink ('../'.$path);
				}
				$path=$location.'/'.$profile_img_name;
				move_uploaded_file($profile_img_tmp,'../'.$path);
				
			}
			$user_id = $_SESSION['auth']['id'];
			$sql_update = "UPDATE users set name='$name', username='$username', email='$email', phone='$phone', position='$position', password='$password', image='$path' WHERE id= '$user_id'";
			
			$result =  mysqli_query ($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error());
			}
			$sql_view = "SELECT * FROM users WHERE id = '$user_id' " ;
			$results = mysqli_query($db_connect, $sql_view);
			$_SESSION['auth']= mysqli_fetch_assoc($results);
			
			return[
				'status' => 'success',
				'message' => 'Data save successfully',
			];
	}
	function user_view(){
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM users";
		$users_results = mysqli_query($db_connect, $sql_view);
		return $users_results;
	}
	function user_delete(){
		$db_connect = db_connect();
		$id = $_POST['delete_id'];
		
		$errors=[];
		$sql_view = "SELECT * FROM users WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_view);
		if(mysqli_num_rows($result) == 0){
			$errors['data_delete'] = 'Unknown ID';
		}
		
		if(count($errors) > 0){
			return [
				'status' => 'error',
				'message' => $errors,
			 ];
		}
		
		$sql_delete = "DELETE FROM users WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_delete);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			
			return [
				'status' => 'success',
				'message' => 'Data Delete Success',
			];
		
	}

?>