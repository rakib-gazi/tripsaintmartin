<?php
    require_once('db_connection.php');
    // function blogPost(){
    //     $db_connect = db_connect();
    //     // mandatory start
    //     $blogCategory = mysqli_real_escape_string($db_connect,$_POST['blogCategory']);
    //     $categoryImage = mysqli_real_escape_string($db_connect,$_POST['categoryImage']);
    //     $blogSubCategory = mysqli_real_escape_string($db_connect,$_POST['blogSubCategory']);
	// 	$subCategoryImage = mysqli_real_escape_string($db_connect,$_POST['subCategoryImage']);
	// 	$mainTitle = mysqli_real_escape_string($db_connect,$_POST['mainTitle']);
	// 	$paragraph = mysqli_real_escape_string($db_connect,$_POST['paragraph']);
	// 	$img_name = $_FILES['image']['name'];
	// 	$img_size = $_FILES['image']['size'];
	// 	$img_tmp = $_FILES['image']['tmp_name'];
	// 	$subTitle = mysqli_real_escape_string($db_connect,$_POST['subTitle']);
	// 	$subparagraph = mysqli_real_escape_string($db_connect,$_POST['subparagraph']);
	// 	$subImage_name = $_FILES['subImage']['name'];
	// 	$subImage_size = $_FILES['subImage']['size'];
	// 	$subImage_tmp = $_FILES['subImage']['tmp_name'];
	// 	// mandatory end
	// 	// loop is 1 to 10 , its not mandatory . if here any data inputed ther inserterd otherwise its value will ne null
	// 	$subTitle_1 = mysqli_real_escape_string($db_connect,$_POST['subTitle-1']);
	// 	$paragraph_1 = mysqli_real_escape_string($db_connect,$_POST['paragraph-1']);
	// 	$subImage_1_name = $_FILES['image-1']['name'];
	// 	$subImage_1_size = $_FILES['image-1']['size'];
	// 	$subImage_1_tmp = $_FILES['image-1']['tmp_name'];



    //     $error = [];
    //     if(empty($blogPost)){
    //         $error['blogPost'] = 'Blog is empty';
    //     }
    //     if(empty($blogCategory)){
    //         $error['blogCategory'] = 'Blog Category is empty';
    //     }
    //     if(empty($blogSubCategory)){
    //         $error['blogSubCategory'] = 'Blog Sub Category is empty';
    //     }
        
    //     if(count($error)> 0){
    //         return [
	// 			'status' => 'error',
	// 			'message' => $error,
	// 		 ];
    //     }

    //     $sql_insert = "INSERT INTO blogs(blogPost, blogCategory, categoryImage, blogSubCategory, subCategoryImage) VALUES ('$blogPost','$blogCategory','$categoryImage','$blogSubCategory','$subCategoryImage')";
    //     $result =  mysqli_query ($db_connect,$sql_insert);
        
    //     if(mysqli_error($db_connect)){
    //         die('Table Error:'.mysqli_error($db_connect));
    //     }
    //     return [
    //         'status' => 'success',
    //         'message' => 'Blog Post added successfully',
    //     ];
    // }

	// function blogPost(){
	// 	$db_connect = db_connect();
	
	// 	// Mandatory fields
	// 	$blogCategory = mysqli_real_escape_string($db_connect, $_POST['blogCategory']);
	// 	$categoryImage = mysqli_real_escape_string($db_connect, $_POST['categoryImage']);
	// 	$blogSubCategory = mysqli_real_escape_string($db_connect, $_POST['blogSubCategory']);
	// 	$subCategoryImage = mysqli_real_escape_string($db_connect, $_POST['subCategoryImage']);
	// 	$mainTitle = mysqli_real_escape_string($db_connect, $_POST['mainTitle']);
	// 	$paragraph = mysqli_real_escape_string($db_connect, $_POST['paragraph']);
	// 	$img_name = $_FILES['image']['name'];
	
	// 	// Dynamic blog sections
	// 	$sections = [];
	// 	for ($i = 1; $i <= 11; $i++) {
	// 		if (!empty($_POST["subTitle_$i"])) {
	// 			$sections["subTitle_$i"] = mysqli_real_escape_string($db_connect, $_POST["subTitle_$i"]);
	// 			$sections["paragraph_$i"] = mysqli_real_escape_string($db_connect, $_POST["paragraph_$i"]);
	// 			$sections["subImage_$i"] = $_FILES["subImage_$i"]['name'];
	// 		}
	// 	}
	
	// 	// Error handling for mandatory fields
	// 	$error = [];
	// 	if (empty($mainTitle)) {
	// 		$error['mainTitle'] = 'Main Title is required';
	// 	}
	// 	if (empty($blogCategory)) {
	// 		$error['blogCategory'] = 'Blog Category is required';
	// 	}
	// 	if (empty($blogSubCategory)) {
	// 		$error['blogSubCategory'] = 'Blog Sub Category is required';
	// 	}
	// 	if (empty($paragraph)) {
	// 		$error['paragraph'] = 'Main paragraph is required';
	// 	}
	
	// 	if (count($error) > 0) {
	// 		return [
	// 			'status' => 'error',
	// 			'message' => $error,
	// 		];
	// 	}
	
	// 	// Prepare SQL query for insertion
	// 	$sql_insert = "INSERT INTO blogs (mainTitle, blogCategory, categoryImage, blogSubCategory, subCategoryImage, paragraph";
	// 	$sql_values = "VALUES ('$mainTitle', '$blogCategory', '$categoryImage', '$blogSubCategory', '$subCategoryImage', '$paragraph'";
	
	// 	// Add image field if it exists
	// 	if (!empty($img_name)) {
	// 		$sql_insert .= ", image";
	// 		$sql_values .= ", '$img_name'";
	// 	}
	
	// 	// Add dynamic sections to SQL query
	// 	foreach ($sections as $key => $value) {
	// 		$sql_insert .= ", {$key}";  // Add column name
	// 		$sql_values .= ", '{$sections[$key]}'";  // Add value
	// 	}
	
	// 	// Finalize SQL query
	// 	$sql_insert .= ")";
	// 	$sql_values .= ")";
	
	// 	$sql_query = $sql_insert . " " . $sql_values;
	
	// 	// Execute SQL query
	// 	$result = mysqli_query($db_connect, $sql_query);
		
	// 	if (mysqli_error($db_connect)) {
	// 		die('Table Error: ' . mysqli_error($db_connect));
	// 	}
	
	// 	// Move uploaded images to the desired folder
	// 	$uploadDir = 'images/blogImage/';
	// 	if (!file_exists($uploadDir)) {
	// 		mkdir($uploadDir, 0755, true);
	// 	}
	
	// 	// Move main image if it exists
	// 	if (!empty($img_name)) {
	// 		move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . basename($img_name));
	// 	}
	
	// 	// Move sub images
	// 	foreach ($sections as $key => $value) {
	// 		$subImageName = $_FILES["subImage_$key"]['name'];
	// 		if (!empty($subImageName)) {
	// 			move_uploaded_file($_FILES["subImage_$key"]['tmp_name'], $uploadDir . basename($subImageName));
	// 		}
	// 	}
	
	// 	return [
	// 		'status' => 'success',
	// 		'message' => 'Blog Post added successfully',
	// 	];
	// }
	function blogPost(){
		$db_connect = db_connect();
	
		// Mandatory fields
		$blogCategory = mysqli_real_escape_string($db_connect, $_POST['blogCategory']);
		$categoryImage = mysqli_real_escape_string($db_connect, $_POST['categoryImage']);
		$blogSubCategory = mysqli_real_escape_string($db_connect, $_POST['blogSubCategory']);
		$subCategoryImage = mysqli_real_escape_string($db_connect, $_POST['subCategoryImage']);
		$mainTitle = mysqli_real_escape_string($db_connect, $_POST['mainTitle']);
		$paragraph = mysqli_real_escape_string($db_connect, $_POST['paragraph']);
		$img_name = $_FILES['image']['name'];
	
		// Dynamic blog sections
		$sections = [];
		for ($i = 1; $i <= 11; $i++) { // Changed to 10
			if (!empty($_POST["subTitle_$i"])) {
				$sections["subTitle_$i"] = mysqli_real_escape_string($db_connect, $_POST["subTitle_$i"]);
				$sections["paragraph_$i"] = mysqli_real_escape_string($db_connect, $_POST["paragraph_$i"]);
	
				// Check if the subImage exists in the $_FILES array
				if (isset($_FILES["subImage_$i"])) {
					$sections["subImage_$i"] = $_FILES["subImage_$i"]['name'];
				} else {
					$sections["subImage_$i"] = null; // Handle the case where subImage is not uploaded
				}
			}
		}
	
		// Error handling for mandatory fields
		$error = [];
		if (empty($mainTitle)) {
			$error['mainTitle'] = 'Main Title is required';
		}
		if (empty($blogCategory)) {
			$error['blogCategory'] = 'Blog Category is required';
		}
		if (empty($blogSubCategory)) {
			$error['blogSubCategory'] = 'Blog Sub Category is required';
		}
		if (empty($paragraph)) {
			$error['paragraph'] = 'Main paragraph is required';
		}
	
		if (count($error) > 0) {
			return [
				'status' => 'error',
				'message' => $error,
			];
		}
	
		// Prepare SQL query for insertion
		$sql_insert = "INSERT INTO blogs (mainTitle, blogCategory, categoryImage, blogSubCategory, subCategoryImage, paragraph";
		$sql_values = "VALUES ('$mainTitle', '$blogCategory', '$categoryImage', '$blogSubCategory', '$subCategoryImage', '$paragraph'";
	
		// Add image field if it exists
		if (!empty($img_name)) {
			$sql_insert .= ", image";
			$sql_values .= ", '$img_name'";
		}
	
		// Add dynamic sections to SQL query
		foreach ($sections as $key => $value) {
			if ($value !== null) { // Only add if value is not null
				$sql_insert .= ", {$key}";  // Add column name
				$sql_values .= ", '{$sections[$key]}'";  // Add value
			}
		}
	
		// Finalize SQL query
		$sql_insert .= ")";
		$sql_values .= ")";
	
		$sql_query = $sql_insert . " " . $sql_values;
	
		// Execute SQL query
		$result = mysqli_query($db_connect, $sql_query);
		
		if (mysqli_error($db_connect)) {
			die('Table Error: ' . mysqli_error($db_connect));
		}
	
		// Move uploaded images to the desired folder
		$uploadDir = 'images/blogImage/';
		if (!file_exists($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}
	
		// Move main image if it exists
		if (!empty($img_name)) {
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . basename($img_name));
		}
	
		// Move sub images
		foreach ($sections as $key => $value) {
			if (isset($_FILES["subImage_$key"]) && !empty($value)) {
				$subImageName = $_FILES["subImage_$key"]['name'];
				if (!empty($subImageName)) {
					move_uploaded_file($_FILES["subImage_$key"]['tmp_name'], $uploadDir . basename($subImageName));
				}
			}
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