<?php 
    include('../baseurl.php');
    ob_start();
    session_start();
	if(!$_SESSION['auth']){
		header('Location:../index.php');
	} 
	if(isset($_POST['logout'])){
		include ('../function/users_authentication.php');
		logout();
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php');?>
<body class="bg-gray-100">
    <header>
        <!-- Navbar -->
        <nav class="bg-cyan-950 px-4 py-3 text-white fixed top-0 left-0 right-0 z-50">
            <div class="mx-4 flex justify-between items-center">
                <a href="<?php echo $baseurl?>dashboard/dashboard.php" >
                    <img src="<?php echo $baseurl?>images/logo.png" alt="" class="h-12">
                </a>
                <img src="<?php echo $baseurl . (isset($_SESSION['auth']['image']) && !empty($_SESSION['auth']['image']) ? 
                $_SESSION['auth']['image'] : 'images/profile/default-profile.png'); ?>" alt="Profile" class="w-10 h-10 rounded-full outline  outline-white">
            </div>
        </nav>
    </header>

    