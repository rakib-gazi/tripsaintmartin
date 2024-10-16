<?php
    require_once('db_connection.php');
    function photo(){
        $db_connect = db_connect();
		$img_name = $_FILES['photo']['name'];
		$img_size = $_FILES['photo']['size'];
		$img_tmp = $_FILES['photo']['tmp_name'];


        $error = [];
		if($img_tmp){
			if( $img_size >5242880 ){
			$error['photo'] = 'Max Size 5 MB';
			}
			$targeted_extensions = ['jpg','jpeg','png','gif','webp'];
			$getExtension = strtolower (pathinfo($img_name, PATHINFO_EXTENSION));
			if(!in_array($getExtension,$targeted_extensions)){
				$error['photo'] = 'jpg/jpeg/png/gig/webp File Required';
			}
		}
        
        if(count($error)> 0){
            return [
				'status' => 'error',
				'message' => $error,
			 ];
        }
		$location = 'images/photos';
        if(!file_exists('../'.$location)){
            mkdir('../'.$location,  permissions: 0777, recursive: true);
        }
        if($img_tmp){
            $path = $location . '/' . $img_name;
            move_uploaded_file($img_tmp, '../' . $path);
        }

        $sql_insert = "INSERT INTO photos(photo) VALUES ('$path')";
        $result =  mysqli_query ($db_connect,$sql_insert);
        
        if(mysqli_error($db_connect)){
            die('Table Error:'.mysqli_error($db_connect));
        }
        return [
            'status' => 'success',
            'message' => 'Photo added successfully',
        ];
    }
    function Photoview() {
        $db_connect = db_connect();
        $sql_view = "SELECT * FROM photos ";
        $category_view_results = mysqli_query($db_connect, $sql_view);
        return $category_view_results;
    }
	function updatePhoto(){
		$db_connect = db_connect();
		$update_id = $_POST['update_id'];
		$UpdateProfile_img_name = $_FILES['updatePhoto']['name'];
		$UpdateProfile_img_size = $_FILES['updatePhoto']['size'];
		$UpdateProfile_img_tmp = $_FILES['updatePhoto']['tmp_name'];
		
		$error=[];
		if ($UpdateProfile_img_tmp) {
			if ($UpdateProfile_img_size > 5242880) {
				$error['updatePhoto'] = 'Max Size 5 MB';
			}
			$targeted_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
			$getExtension = strtolower(pathinfo($UpdateProfile_img_name, PATHINFO_EXTENSION));
			if (!in_array($getExtension, $targeted_extensions)) {
				$error['updatePhoto'] = 'jpg/jpeg/png/gif/webp File Required';
			}
		}
		if(count($error)> 0){
            return [
				'status' => 'error',
				'message' => $error,
			 ];
        }
		$location = 'images/photos';
        if(!file_exists('../'.$location)){
            mkdir('../'.$location,  permissions: 0777, recursive: true);
        }
		if ($UpdateProfile_img_tmp) {
			// Get the old image path from the database
			$sql_select = "SELECT photo FROM photos WHERE id = '$update_id'";
			$result_select = mysqli_query($db_connect, $sql_select);
			if ($result_select && mysqli_num_rows($result_select) > 0) {
				$row = mysqli_fetch_assoc($result_select);
				$old_image_path = '../' . $row['photo'];
	
				// Check if the old image exists, if so delete it
				if (file_exists($old_image_path)) {
					unlink($old_image_path); // Deletes the old image
				}
			}
	
			// Upload the new image
			$path = $location . '/' . $UpdateProfile_img_name;
			move_uploaded_file($UpdateProfile_img_tmp, '../' . $path);
		}
			
			$sql_update = "UPDATE photos set photo='$path' WHERE id='$update_id'";
			$result =  mysqli_query ($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			return[
				'status' => 'update_success',
				'message' => 'Photo successfully Updated',
			];
	}
     
	
    function PhotoDelete(){
		$db_connect = db_connect();
		$id = $_POST['delete_id'];
		
		$error=[];
		$sql_view = "SELECT * FROM photos WHERE id='$id'";
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
		$sql_delete = "DELETE FROM photos WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_delete);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			
			return [
				'status' => 'success',
				'message' => 'Photo Deleted Successfull.',
			];
		
	}