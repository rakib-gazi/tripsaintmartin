<?php
    require_once('db_connection.php');
    function category(){
        $db_connect = db_connect();
        $category = mysqli_real_escape_string($db_connect,$_POST['category']);
		$img_name = $_FILES['image']['name'];
		$img_size = $_FILES['image']['size'];
		$img_tmp = $_FILES['image']['tmp_name'];


        $error = [];
        if(empty($category)){
            $error['category'] = 'Hotel name is empty';
        }else{
            $sql_view = "SELECT * FROM categories WHERE category = '$category' " ;
			$results = mysqli_query($db_connect, $sql_view);
				if(mysqli_num_rows($results) == 1){
					$error['category'] = ' Category Already Exists';
				}
        }
		if($img_tmp){
			if( $img_size >5242880 ){
			$error['image'] = 'Max Size 5 MB';
			}
			$targeted_extensions = ['jpg','jpeg','png','gif','webp'];
			$getExtension = strtolower (pathinfo($img_name, PATHINFO_EXTENSION));
			if(!in_array($getExtension,$targeted_extensions)){
				$error['image'] = 'jpg/jpeg/png/gig/webp File Required';
			}
		}
        
        if(count($error)> 0){
            return [
				'status' => 'error',
				'message' => $error,
			 ];
        }
		$location = 'images/categories';
        if(!file_exists('../'.$location)){
            mkdir('../'.$location,  permissions: 0777, recursive: true);
        }
        if($img_tmp){
            $path = $location . '/' . $img_name;
            move_uploaded_file($img_tmp, '../' . $path);
        }

        $sql_insert = "INSERT INTO categories(image,category) VALUES ('$path','$category')";
        $result =  mysqli_query ($db_connect,$sql_insert);
        
        if(mysqli_error($db_connect)){
            die('Table Error:'.mysqli_error($db_connect));
        }
        return [
            'status' => 'success',
            'message' => 'Categories added successfully',
        ];
    }
    function category_view() {
        $db_connect = db_connect();
        $sql_view = "SELECT * FROM categories ";
        $category_view_results = mysqli_query($db_connect, $sql_view);
        return $category_view_results;
    }
	function updateategory(){
		$db_connect = db_connect();
		$update_id = $_POST['update_id'];
		$updateCategory = mysqli_real_escape_string($db_connect,$_POST['updateCategory']);
		$UpdateProfile_img_name = $_FILES['update-image']['name'];
		$UpdateProfile_img_size = $_FILES['update-image']['size'];
		$UpdateProfile_img_tmp = $_FILES['update-image']['tmp_name'];
		
		$error=[];
		if(empty($updateCategory) ){
			  $error['updateCategory'] = 'Reservation Number Required';
		}
		if ($UpdateProfile_img_tmp) {
			if ($UpdateProfile_img_size > 5242880) {
				$error['update-image'] = 'Max Size 5 MB';
			}
			$targeted_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
			$getExtension = strtolower(pathinfo($UpdateProfile_img_name, PATHINFO_EXTENSION));
			if (!in_array($getExtension, $targeted_extensions)) {
				$error['update-image'] = 'jpg/jpeg/png/gif/webp File Required';
			}
		}
		if(count($error)> 0){
            return [
				'status' => 'error',
				'message' => $error,
			 ];
        }
		$location = 'images/categories';
        if(!file_exists('../'.$location)){
            mkdir('../'.$location,  permissions: 0777, recursive: true);
        }
		if ($UpdateProfile_img_tmp) {
			// Get the old image path from the database
			$sql_select = "SELECT image FROM categories WHERE id = '$update_id'";
			$result_select = mysqli_query($db_connect, $sql_select);
			if ($result_select && mysqli_num_rows($result_select) > 0) {
				$row = mysqli_fetch_assoc($result_select);
				$old_image_path = '../' . $row['image'];
	
				// Check if the old image exists, if so delete it
				if (file_exists($old_image_path)) {
					unlink($old_image_path); // Deletes the old image
				}
			}
	
			// Upload the new image
			$path = $location . '/' . $UpdateProfile_img_name;
			move_uploaded_file($UpdateProfile_img_tmp, '../' . $path);
		}
			
			$sql_update = "UPDATE categories set category='$updateCategory'";
			if (isset($path)) {
				$sql_update .= ", image='$path'";
			}
		
			$sql_update .= " WHERE id='$update_id'";
			$result =  mysqli_query ($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			return[
				'status' => 'update_success',
				'message' => 'Category successfully Updated',
			];
	}
     
	function category_form_view() {
		$db_connect = db_connect();
        $sql_view = "SELECT * FROM categories ";
        $category_view_results = mysqli_query($db_connect, $sql_view);
        return $category_view_results;
	}
	
    function category_delete(){
		$db_connect = db_connect();
		$id = $_POST['delete_id'];
		
		$error=[];
		$sql_view = "SELECT * FROM categories WHERE id='$id'";
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
		$sql_delete = "DELETE FROM categories WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_delete);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			
			return [
				'status' => 'success',
				'message' => 'Category Deleted Successfull.',
			];
		
	}
