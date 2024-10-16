<?php
    require_once('db_connection.php');
    function blogPost(){
        $db_connect = db_connect();
        $blogPost = mysqli_real_escape_string($db_connect,$_POST['blogPost']);
        $blogCategory = mysqli_real_escape_string($db_connect,$_POST['blogCategory']);

        $error = [];
        if(empty($blogPost)){
            $error['blogPost'] = 'Blog is empty';
        }
        if(empty($blogCategory)){
            $error['blogCategory'] = 'Blog Category is empty';
        }
        
        if(count($error)> 0){
            return [
				'status' => 'error',
				'message' => $error,
			 ];
        }

        $sql_insert = "INSERT INTO blogs(blogPost, blogCategory) VALUES ('$blogPost','$blogCategory')";
        $result =  mysqli_query ($db_connect,$sql_insert);
        
        if(mysqli_error($db_connect)){
            die('Table Error:'.mysqli_error($db_connect));
        }
        return [
            'status' => 'success',
            'message' => 'Blog Post added successfully',
        ];
    }
    function blog_view() {
        $db_connect = db_connect();
        $sql_view = "SELECT * FROM blogs ";
        $blog_view_results = mysqli_query($db_connect, $sql_view);
        return $blog_view_results;
    }
	function updateblog(){
		$db_connect = db_connect();
		$update_id = $_POST['update_id'];
		$updateBlog = mysqli_real_escape_string($db_connect,$_POST['updateBlog']);
		
		
		$error=[];
		if(empty($updateBlog) ){
			  $error['updateBlog'] = 'Posts Required';
		}
		if(count($error)> 0){
            return [
				'status' => 'error',
				'message' => $error,
			 ];
        }
			
			$sql_update = "UPDATE blogs set blogPost='$updateBlog'  WHERE id= '$update_id'";
			$result =  mysqli_query ($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			return[
				'status' => 'update_success',
				'message' => 'Blog post successfully Updated',
			];
	}
     
	function hotel_name_form_view() {
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM hotel_name";
		$hotel_name_form_results = mysqli_query($db_connect, $sql_view);
		if (!$hotel_name_form_results) {
			die('Query failed: ' . mysqli_error($db_connect));
		}
		return $hotel_name_form_results;
	}
	
    function blog_delete(){
		$db_connect = db_connect();
		$id = $_POST['delete_id'];
		
		$error=[];
		$sql_view = "SELECT * FROM blogs WHERE id='$id'";
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
		$sql_delete = "DELETE FROM blogs WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_delete);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			
			return [
				'status' => 'success',
				'message' => 'Blog Delete Successfull.',
			];
		
	}