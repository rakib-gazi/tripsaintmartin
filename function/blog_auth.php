<?php
    require_once('db_connection.php');


	// function blogPost() {
	// 	$db_connect = db_connect();
	
	// 	// Mandatory fields
	// 	$blogCategory = mysqli_real_escape_string($db_connect, $_POST['blogCategory']);
	// 	$categoryImage = mysqli_real_escape_string($db_connect, $_POST['categoryImage']);
	// 	$blogSubCategory = mysqli_real_escape_string($db_connect, $_POST['blogSubCategory']);
	// 	$subCategoryImage = mysqli_real_escape_string($db_connect, $_POST['subCategoryImage']);
	// 	$mainTitle = mysqli_real_escape_string($db_connect, $_POST['mainTitle']);
	// 	$paragraph = mysqli_real_escape_string($db_connect, $_POST['mainParagraph']);
	
	// 	// Handle main image (first image in the array)
	// 	$img_name = is_array($_FILES['image']['name']) ? $_FILES['image']['name'][0] : $_FILES['image']['name'];
	
	// 	// Dynamic blog sections (subtitles, paragraphs, and images)
	// 	$sections = [];
	// 	for ($i = 1; $i <= 10; $i++) { // Loop for up to 10 sections
	// 		if (!empty($_POST["subTitle"][$i - 1])) {
	// 			$sections[$i] = [
	// 				'subTitle' => mysqli_real_escape_string($db_connect, $_POST["subTitle"][$i - 1]),
	// 				'paragraph' => mysqli_real_escape_string($db_connect, $_POST["paragraph"][$i - 1]),
	// 				'subImage' => isset($_FILES["image"]['name'][$i]) ? $_FILES["image"]['name'][$i] : null
	// 			];
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
	// 	if (empty($paragraph)) {
	// 		$error['paragraph'] = 'Main paragraph is required';
	// 	}
	
	// 	if (count($error) > 0) {
	// 		return [
	// 			'status' => 'error',
	// 			'message' => $error,
	// 		];
	// 	}

	// 	// Move uploaded images to the desired folder
	// 	$uploadDir = '../images/blogImage/';
	// 	if (!file_exists($uploadDir)) {
	// 		mkdir($uploadDir, 0755, true);
	// 	}
	
	// 	// Move main image if it exists
	// 	if (!empty($img_name)) {
	// 		move_uploaded_file($_FILES['image']['tmp_name'][0], $uploadDir . basename($img_name));
	// 	}
	
	// 	// Move sub images if they exist
	// 	foreach ($sections as $index => $section) {
	// 		if (!empty($section['subImage'])) {
	// 			$subImageName = $_FILES["image"]['name'][$index];
	// 			if (!empty($subImageName)) {
	// 				move_uploaded_file($_FILES["image"]['tmp_name'][$index], $uploadDir . basename($subImageName));
	// 			}
	// 		}
	// 	}
	
	// 	// Prepare SQL query for insertion
	// 	$sql_insert = "INSERT INTO blogs (mainTitle, blogCategory, categoryImage, blogSubCategory, subCategoryImage, paragraph";
	// 	$sql_values = "VALUES ('$mainTitle', '$blogCategory', '$categoryImage', '$blogSubCategory', '$subCategoryImage', '$paragraph'";
	
	// 	// Add main image field if it exists
	// 	if (!empty($img_name)) {
	// 		$sql_insert .= ", image";
	// 		$sql_values .= ", '$img_name'";
	// 	}
	
	// 	// Add dynamic sections (subtitles, paragraphs, images) to SQL query
	// 	foreach ($sections as $index => $section) {
	// 		$sql_insert .= ", subTitle_$index, paragraph_$index";
	// 		$sql_values .= ", '{$section['subTitle']}', '{$section['paragraph']}'";
	
	// 		// Add sub image field if it exists
	// 		if (!empty($section['subImage'])) {
	// 			$sql_insert .= ", subImage_$index";
	// 			$sql_values .= ", '{$section['subImage']}'";
	// 		}
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
	
		
	
	// 	return [
	// 		'status' => 'success',
	// 		'message' => 'Blog Post added successfully',
	// 	];
	// }
	function blogPost() {
		$db_connect = db_connect();
	
		// Mandatory fields
		$blogCategory = mysqli_real_escape_string($db_connect, $_POST['blogCategory']);
		$categoryImage = !empty($_POST['categoryImage']) ? mysqli_real_escape_string($db_connect, $_POST['categoryImage']) : null;
		$blogSubCategory = !empty($_POST['blogSubCategory']) ? mysqli_real_escape_string($db_connect, $_POST['blogSubCategory']) : null;
		$subCategoryImage = !empty($_POST['subCategoryImage']) ? mysqli_real_escape_string($db_connect, $_POST['subCategoryImage']) : null;
		$mainTitle = mysqli_real_escape_string($db_connect, $_POST['mainTitle']);
		$mainParagraph = mysqli_real_escape_string($db_connect, $_POST['mainParagraph']);
		$mainImg = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : null;
	
		// Optional fields
		$subTitles = [];
		$paragraphs = [];
		$images = [];
		for ($i = 1; $i <= 10; $i++) {
			$subTitles[$i] = !empty($_POST["subTitle_$i"]) ? mysqli_real_escape_string($db_connect, $_POST["subTitle_$i"]) : null;
			$paragraphs[$i] = !empty($_POST["paragraph_$i"]) ? mysqli_real_escape_string($db_connect, $_POST["paragraph_$i"]) : null;
			$images[$i] = !empty($_FILES["image_$i"]['name']) ? $_FILES["image_$i"]['name'] : null;
		}
	
		// Error handling for mandatory fields
		$error = [];
		if (empty($mainTitle)) {
			$error['mainTitle'] = 'Main Title is required';
		}
		if (empty($blogCategory)) {
			$error['blogCategory'] = 'Blog Category is required';
		}
		if (empty($mainParagraph)) {
			$error['mainParagraph'] = 'Main paragraph is required';
		}
	
		if (count($error) > 0) {
			return [
				'status' => 'error',
				'message' => $error,
			];
		}
	
		// Move uploaded images to the desired folder
		$uploadDir = '../images/blogImage/';
		if (!file_exists($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}
	
		// Move main image if it exists
		if (!empty($mainImg)) {
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . basename($mainImg));
		}
	
		// Move sub images if they exist
		foreach ($images as $index => $subImageName) {
			if (!empty($subImageName)) {
				$filePath = $uploadDir . basename($subImageName);
	
				// Ensure unique file name if there's a chance of overwriting
				if (file_exists($filePath)) {
					$filePath = $uploadDir . uniqid() . "_" . basename($subImageName);
				}
	
				move_uploaded_file($_FILES["image_$index"]['tmp_name'], $filePath);
			}
		}
	
		// Prepare SQL query for insertion
		$sql_insert = "INSERT INTO blogs (mainTitle, blogCategory, categoryImage, blogSubCategory, subCategoryImage, paragraph";
		$sql_values = "VALUES ('$mainTitle', '$blogCategory', '$categoryImage', '$blogSubCategory', '$subCategoryImage', '$mainParagraph'";
	
		// Add main image field if it exists
		if (!empty($mainImg)) {
			$sql_insert .= ", image";
			$sql_values .= ", '$mainImg'";
		}
	
		// Add dynamic sections (subtitles, paragraphs, images) to SQL query
		for ($i = 0; $i < 10; $i++) {  // Start loop from 0, or ensure arrays are 1-indexed
			if (!empty($subTitles[$i])) {
				$sql_insert .= ", subTitle_$i";
				$sql_values .= ", '{$subTitles[$i]}'";
			}
			if (!empty($paragraphs[$i])) {
				$sql_insert .= ", paragraph_$i";
				$sql_values .= ", '{$paragraphs[$i]}'";
			}
			if (!empty($images[$i])) {
				$sql_insert .= ", subImage_$i";
				$sql_values .= ", '{$images[$i]}'";
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
	// function updateblog(){
	// 	$db_connect = db_connect();
	// 	$update_id = $_POST['update_id'];
	// 	$updateBlog = mysqli_real_escape_string($db_connect, $_POST['updateBlog']);
	// 	$updateBlogCategory = mysqli_real_escape_string($db_connect, $_POST['updateBlogCategory']);
	// 	$updateBlogSubCategory = mysqli_real_escape_string($db_connect, $_POST['updateBlogSubCategory']);
		
		
	// 	$error=[];
	// 	if(empty($updateBlog) ){
	// 		  $error['updateBlog'] = 'Posts Required';
	// 	}
	// 	if(empty($updateBlogCategory)){
    //         $error['updateBlogCategory'] = 'Blog Category is empty';
    //     }
    //     if(empty($updateBlogSubCategory)){
    //         $error['updateBlogSubCategory'] = 'Blog Sub Category is empty';
    //     }
	// 	if(count($error)> 0){
    //         return [
	// 			'status' => 'error',
	// 			'message' => $error,
	// 		 ];
    //     }
			
	// 		$sql_update = "UPDATE blogs set blogCategory='$updateBlogCategory'";
	// 		if (isset($updateBlogSubCategory)) {
	// 			$sql_update .= ", blogSubCategory='$updateBlogSubCategory'";
	// 		}
	// 		if (isset($updateBlog)) {
	// 			$sql_update .= ", blogPost='$updateBlog'";
	// 		}
		
	// 		$sql_update .= " WHERE id='$update_id'";
	// 		$result =  mysqli_query ($db_connect,$sql_update);
			
	// 		if(mysqli_error($db_connect)){
	// 			die('Table Error:'.mysqli_error($db_connect));
	// 		}
	// 		return[
	// 			'status' => 'update_success',
	// 			'message' => 'Blog post successfully Updated',
	// 		];
	// }
	function updateblog() {
		$db_connect = db_connect();
	
		// Mandatory fields
		$update_id = mysqli_real_escape_string($db_connect, $_POST['update_id']);
		$updateBlogCategory = mysqli_real_escape_string($db_connect, $_POST['updateBlogCategory']);
		$updateBlogSubCategory = mysqli_real_escape_string($db_connect, $_POST['updateBlogSubCategory']);
		$updateMainTitle = mysqli_real_escape_string($db_connect, $_POST['updateMainTitle']);
		$updateMainParagraph = mysqli_real_escape_string($db_connect, $_POST['updateMainParagraph']);
		$mainImage = !empty($_FILES['updateImage']['name']) ? $_FILES['updateImage']['name'] : null;
		$existingImage = $_POST['existing_image'] ?? null;
	
		// Optional fields
		$subTitles = [];
		$paragraphs = [];
		$images = [];
	
		for ($i = 1; $i <= 10; $i++) {
			$subTitles[$i] = !empty($_POST["updateSubTitle_$i"]) ? mysqli_real_escape_string($db_connect, $_POST["updateSubTitle_$i"]) : null;
			$paragraphs[$i] = !empty($_POST["updateParagraph_$i"]) ? mysqli_real_escape_string($db_connect, $_POST["updateParagraph_$i"]) : null;
			$images[$i] = !empty($_FILES["updateImage_$i"]['name']) ? $_FILES["updateImage_$i"]['name'] : null;
		}
	
		// Error handling for mandatory fields
		$error = [];
		if (empty($updateMainTitle)) {
			$error['updateMainTitle'] = 'Main Title is required';
		}
		if (empty($updateBlogCategory)) {
			$error['updateBlogCategory'] = 'Blog Category is required';
		}
		if (empty($updateMainParagraph)) {
			$error['updateMainParagraph'] = 'Main paragraph is required';
		}
	
		if (count($error) > 0) {
			return [
				'status' => 'error',
				'message' => $error,
			];
		}
	
		// Move uploaded images to the desired folder
		$uploadDir = '../images/blogImage/';
		if (!file_exists($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}
	
		// Move main image if it exists
		if (!empty($mainImage)) {
			move_uploaded_file($_FILES['updateImage']['tmp_name'], $uploadDir . basename($mainImage));
		} else {
			// If no new image, retain the old one
			$mainImage = $existingImage;
		}
	
		// Move sub images if they exist
		foreach ($images as $index => $subImageName) {
			if (!empty($subImageName)) {
				$filePath = $uploadDir . basename($subImageName);
	
				// Ensure unique file name if there's a chance of overwriting
				if (file_exists($filePath)) {
					$filePath = $uploadDir . uniqid() . "_" . basename($subImageName);
				}
	
				move_uploaded_file($_FILES["updateImage_$index"]['tmp_name'], $filePath);
			}
		}
	
		// Prepare SQL query for updating
		$sql_update = "UPDATE blogs SET 
			blogCategory = '$updateBlogCategory',
			blogSubCategory = '$updateBlogSubCategory',
			mainTitle = '$updateMainTitle',
			paragraph = '$updateMainParagraph'";
	
		// Add main image if it exists
		if (!empty($mainImage)) {
			$sql_update .= ", image = '$mainImage'";
		}
	
		// Add dynamic sections (subtitles, paragraphs, images) to SQL query
		for ($i = 1; $i <= 10; $i++) {
			if (!empty($subTitles[$i])) {
				$sql_update .= ", subTitle_$i = '{$subTitles[$i]}'";
			}
			if (!empty($paragraphs[$i])) {
				$sql_update .= ", paragraph_$i = '{$paragraphs[$i]}'";
			}
			if (!empty($images[$i])) {
				$sql_update .= ", subImage_$i = '{$images[$i]}'";
			}
		}
	
		$sql_update .= " WHERE id = '$update_id'";
	
		// Execute SQL query
		$result = mysqli_query($db_connect, $sql_update);
	
		if (mysqli_error($db_connect)) {
			die('Table Error: ' . mysqli_error($db_connect));
		}
	
		return [
			'status' => 'success',
			'message' => 'Blog Post updated successfully',
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