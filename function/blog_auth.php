<?php
    require_once('db_connection.php');
    function blogPost(){
        $db_connect = db_connect();
        $blogPost = mysqli_real_escape_string($db_connect,$_POST['blogPost']);
        $blogCategory = mysqli_real_escape_string($db_connect,$_POST['blogCategory']);
        $categoryImage = mysqli_real_escape_string($db_connect,$_POST['categoryImage']);
        $blogSubCategory = mysqli_real_escape_string($db_connect,$_POST['blogSubCategory']);
		$subCategoryImage = mysqli_real_escape_string($db_connect,$_POST['subCategoryImage']);

        $error = [];
        if(empty($blogPost)){
            $error['blogPost'] = 'Blog is empty';
        }
        if(empty($blogCategory)){
            $error['blogCategory'] = 'Blog Category is empty';
        }
        if(empty($blogSubCategory)){
            $error['blogSubCategory'] = 'Blog Sub Category is empty';
        }
        
        if(count($error)> 0){
            return [
				'status' => 'error',
				'message' => $error,
			 ];
        }

        $sql_insert = "INSERT INTO blogs(blogPost, blogCategory, categoryImage, blogSubCategory, subCategoryImage) VALUES ('$blogPost','$blogCategory','$categoryImage','$blogSubCategory','$subCategoryImage')";
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
		$updateBlog = mysqli_real_escape_string($db_connect, $_POST['updateBlog']);
		$updateBlogCategory = mysqli_real_escape_string($db_connect, $_POST['updateBlogCategory']);
		$updateBlogSubCategory = mysqli_real_escape_string($db_connect, $_POST['updateBlogSubCategory']);
		
		
		$error=[];
		if(empty($updateBlog) ){
			  $error['updateBlog'] = 'Posts Required';
		}
		if(empty($updateBlogCategory)){
            $error['updateBlogCategory'] = 'Blog Category is empty';
        }
        if(empty($updateBlogSubCategory)){
            $error['updateBlogSubCategory'] = 'Blog Sub Category is empty';
        }
		if(count($error)> 0){
            return [
				'status' => 'error',
				'message' => $error,
			 ];
        }
			
			$sql_update = "UPDATE blogs set blogCategory='$updateBlogCategory'";
			if (isset($updateBlogSubCategory)) {
				$sql_update .= ", blogSubCategory='$updateBlogSubCategory'";
			}
			if (isset($updateBlog)) {
				$sql_update .= ", blogPost='$updateBlog'";
			}
		
			$sql_update .= " WHERE id='$update_id'";
			$result =  mysqli_query ($db_connect,$sql_update);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			return[
				'status' => 'update_success',
				'message' => 'Blog post successfully Updated',
			];
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
	
	function blogSubCategoryview($id) {
		$db_connect = db_connect();
		$sql_view = "SELECT * FROM blogs WHERE id = '$id'";
		$result = mysqli_query($db_connect, $sql_view);
		if (!$result) {
			die('Query failed: ' . mysqli_error($db_connect));
		}
		if(mysqli_num_rows($result) > 0) {
			return $result;
		} else {
			die('No data found for the provided ID.');
		}
	}