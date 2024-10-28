<?php
    require_once('db_connection.php');
    function subCategoryPage(){
        $db_connect = db_connect();
        $category = mysqli_real_escape_string($db_connect,$_POST['blogCategory']);
        $categoryId = mysqli_real_escape_string($db_connect,$_POST['categoryId']);
        $mainTitle = mysqli_real_escape_string($db_connect,$_POST['mainTitle']);
        $mainParagraph = mysqli_real_escape_string($db_connect,$_POST['mainParagraph']);
        $mainTitle2 = mysqli_real_escape_string($db_connect,$_POST['mainTitle2']);
		$img_name = $_FILES['image']['name'];
		$img_size = $_FILES['image']['size'];
		$img_tmp = $_FILES['image']['tmp_name'];


        $error = [];
        if(empty($category)){
            $error['blogCategory'] = 'Blog Category is Required';
        }
        if(empty($mainTitle)){
            $error['mainTitle'] = 'Main Title is Required';
        }
        if(empty($mainParagraph)){
            $error['mainParagraph'] = 'Paragraph is Required';
        }
        if(empty($mainTitle2)){
            $error['mainTitle2'] = 'Main Title 2 is Required';
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
		$location = 'images/subcategorypage';
        if(!file_exists('../'.$location)){
            mkdir('../'.$location,  permissions: 0777, recursive: true);
        }
        if($img_tmp){
            $path = $location . '/' . $img_name;
            move_uploaded_file($img_tmp, '../' . $path);
        }

        $sql_insert = "INSERT INTO subcategorypages(category,categoryId,mainTitle,image,mainParagraph,mainTitle2) VALUES ('$category','$categoryId','$mainTitle','$path','$mainParagraph','$mainTitle2')";
        $result =  mysqli_query ($db_connect,$sql_insert);
        
        if(mysqli_error($db_connect)){
            die('Table Error:'.mysqli_error($db_connect));
        }
        return [
            'status' => 'success',
            'message' => 'Sub Category  Pages Information added successfully',
        ];
    }
    function subCategoryPageView() {
        $db_connect = db_connect();
        $sql_view = "SELECT * FROM subcategorypages ";
        $category_view_results = mysqli_query($db_connect, $sql_view);
        return $category_view_results;
    }
    function subCategoryMainPageView() {
        $db_connect = db_connect();
        $sql_view = "SELECT * FROM subcategorypages ";
        $category_view_results = mysqli_query($db_connect, $sql_view);
        return $category_view_results;
    }

	function updatesubcategoryPage() {
		$db_connect = db_connect();
		$update_id = $_POST['update_id'];
		$updateCategory = mysqli_real_escape_string($db_connect, $_POST['updateBlogCategory']);
		$updateCategoryId = mysqli_real_escape_string($db_connect, $_POST['updateCategoryId']);
		$updateMainTitle = mysqli_real_escape_string($db_connect, $_POST['updateMainTitle']);
		$updateMainParagraph = mysqli_real_escape_string($db_connect, $_POST['updateMainParagraph']);
		$updateMainTitle2 = mysqli_real_escape_string($db_connect, $_POST['updateMainTitle2']);
	
		$error = [];
	
		// Validate inputs
		if (empty($updateCategory)) {
			$error['updateBlogCategory'] = 'Category is Required';
		}
		if (empty($updateMainTitle)) {
			$error['updateMainTitle'] = 'Main Title is Required';
		}
		if (empty($updateMainParagraph)) {
			$error['updateMainParagraph'] = 'Main Paragraph is Required';
		}
		if (empty($updateMainTitle2)) {
			$error['updateMainTitle2'] = 'Second Main Title is Required';
		}
	
		// Directory for images
		$location = 'images/subcategorypage';
		if (!file_exists('../' . $location)) {
			mkdir('../' . $location, 0777, true); // Use true for recursive
		}
	
		// Check if an image is uploaded
		if (isset($_FILES['updateImage']) && $_FILES['updateImage']['error'] === UPLOAD_ERR_OK) {
			$img_tmp = $_FILES['updateImage']['tmp_name'];
			$img_name = basename($_FILES['updateImage']['name']);
			$path = $location . '/' . $img_name;
	
			// Validate the file type
			$allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
			$fileType = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
	
			if (in_array($fileType, $allowedTypes)) {
				// Move the uploaded file
				if (move_uploaded_file($img_tmp, '../' . $path)) {
					// File upload successful, update the database with the new image path
					$sql_update = "UPDATE subcategorypages SET 
						category='$updateCategory',
						categoryId='$updateCategoryId',
						mainTitle='$updateMainTitle',
						mainParagraph='$updateMainParagraph',
						mainTitle2='$updateMainTitle2',
						image='$path'  -- Store the relative path to the image
						WHERE id='$update_id'";
				} else {
					return [
						'status' => 'error',
						'message' => 'Image upload failed. Unable to move the uploaded file.',
					];
				}
			} else {
				return [
					'status' => 'error',
					'message' => 'Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.',
				];
			}
		} else {
			// No new image uploaded; just update other fields
			$sql_update = "UPDATE subcategorypages SET 
				category='$updateCategory',
				categoryId='$updateCategoryId',
				mainTitle='$updateMainTitle',
				mainParagraph='$updateMainParagraph',
				mainTitle2='$updateMainTitle2'
				WHERE id='$update_id'";
		}
	
		$result = mysqli_query($db_connect, $sql_update);
	
		if (!$result) {
			return [
				'status' => 'error',
				'message' => 'Database error: ' . mysqli_error($db_connect),
			];
		}
	
		return [
			'status' => 'success',
			'message' => 'Category successfully updated',
		];
	}
	
	
    function subCategoryPagesDelete(){
		$db_connect = db_connect();
		$id = $_POST['delete_id'];
		
		$error=[];
		$sql_view = "SELECT * FROM subcategorypages WHERE id='$id'";
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
		$sql_delete = "DELETE FROM subcategorypages WHERE id='$id'";
		$result = mysqli_query($db_connect, $sql_delete);
			
			if(mysqli_error($db_connect)){
				die('Table Error:'.mysqli_error($db_connect));
			}
			
			return [
				'status' => 'success',
				'message' => 'Category Deleted Successfull.',
			];
		
	}
    