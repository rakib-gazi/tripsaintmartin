<?php
    require_once('db_connection.php');
    function navbar(){
        $db_connect = db_connect();
        $navItem = mysqli_real_escape_string($db_connect,$_POST['navItem']);
        $navlink = mysqli_real_escape_string($db_connect,$_POST['navlink']);
        $error = [];
        if(empty($navItem)){
            $error['navItem'] = 'Navbar Item Is Required';
        }
        if(empty($navlink)){
            $error['navlink'] = 'Navbar Link Is Required';
        }
		
        if(count($error)> 0){
            return [
				'status' => 'error',
				'message' => $error,
			 ];
        }

        $sql_insert = "INSERT INTO navbar(navItem,navlink) VALUES ('$navItem','$navlink')";
        $result =  mysqli_query ($db_connect,$sql_insert);
        
        if(mysqli_error($db_connect)){
            die('Table Error:'.mysqli_error($db_connect));
        }
        return [
            'status' => 'success',
            'message' => 'Navbar added successfully',
        ];
    }
    function navbarView() {
        $db_connect = db_connect();
        $sql_view = "SELECT * FROM navbar ";
        $category_view_results = mysqli_query($db_connect, $sql_view);
        return $category_view_results;
    }
	function updateNavbar(){
		$db_connect = db_connect();
		$update_id = $_POST['update_id'];
		$updateNavItem = mysqli_real_escape_string($db_connect,$_POST['updateNavItem']);
        $updateNavLink = mysqli_real_escape_string($db_connect,$_POST['updateNavLink']);
		
		$error=[];
		if(empty($updateNavItem)){
            $error['updateNavItem'] = 'Navbar Item Is Required';
        }
        if(empty($updateNavLink)){
            $error['updateNavLink'] = 'Navbar Link Is Required';
        }
		if(count($error)> 0){
            return [
				'status' => 'error',
				'message' => $error,
			 ];
        }
			$sql_update = "UPDATE navbar set navItem='$updateNavItem'";
			if (isset($updateNavLink)) {
				$sql_update .= ", navlink='$updateNavLink'";
			}
		
			$sql_update .= " WHERE id='$update_id'";
			$result =  mysqli_query ($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			return[
				'status' => 'update_success',
				'message' => 'Navbar successfully Updated',
			];
	}
    
    function navbarDelete(){
		$db_connect = db_connect();
		$id = $_POST['delete_id'];
		
		$error=[];
		$sql_view = "SELECT * FROM navbar WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_view);
		if(mysqli_num_rows($result) == 0){
			$error['data_delete'] = 'Unknown ID';
		}
		
		if(count($error) > 0){
			return [
				'status' => 'error',
				'message' => $error,
			 ];
		}
		$sql_delete = "DELETE FROM navbar WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_delete);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			
			return [
				'status' => 'success',
				'message' => 'Navbar Deleted Successfull.',
			];
	}