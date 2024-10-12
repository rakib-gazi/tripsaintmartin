<?php 
	include ('dashboard-header.php');
	if(isset($_POST['Profile_update'])){
		$old=$_POST;
		include ('../function/users_authentication.php');
		$result = profile_update();
		if($result['status'] == 'error'){
			$error = $result['message'];
		}else{
			$success = $result['message'];
			
			header('Refresh: 1; url= profile.php');
		}
	}
?>
    <div class="flex">  
    <?php include('dashboard-sidebar.php');?>
        <!-- Main Content -->
        <div class="w-4/5 p-4">
            <div class="container mx-auto pt-24">
                <h1 class="text-3xl font-bold mb-4 font-serif capitalize">Profile</h1>
                <hr class="border border-black">	
                <form  method="post" class=" ps-12 w-full " enctype="multipart/form-data">
                    <h5 class=" text-xl font-semibold font-mono text-black py-2 ">
                        <?php 
                            echo $success ?? '';
                        ?>
                    </h5>
                    <div class=" mt-12">
                        <label for="profile_image">
                            <img src="../<?php echo ($_SESSION['auth']['image'] && !empty($_SESSION['auth']['image']) ? $_SESSION['auth']['image'] : 'images/rakib.png'); ?>" 
                                alt="" class="rounded-circle border border-2 border-light object-fit-cover mb-4" style="height:250px; width:250px;">
                        </label>
                        <div class="w-1/3 outline outline-1 outline-black rounded my-4">
                            <input type="file" name="profile_image" 
                                class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full" id="profile_image">
                        </div>
                        <h5 class="text-white font-mono text-xl"><?php echo $error['profile_image'] ?? ''; ?></h5>
                        <div class="w-1/3 outline outline-1 ouline-black rounded my-4">
                            <label for="name" class="text-black text-xl  ps-4 font-serif">Name: </label>
                            <input type="text" name="name" value="<?php echo $old['name'] ?? $_SESSION['auth']['name']?? ''; ?>" placeholder=" Write Your Full Name" 
                            class=" py-2 bg-transparent w-auto px-4 focus:outline-none">
                        </div>
                        <h5 class="text-white font-mono font-xl"><?php echo $error['name'] ?? ''; ?></h5>
                        <div class="w-1/3 outline outline-1 ouline-black rounded my-4">
                            <label for="username" class="text-black text-xl  ps-4 font-serif">Username: </label>
                            <input type="text" name="username" value="<?php echo $old['username'] ?? $_SESSION['auth']['username']?? ''; ?>" placeholder=" Write your username" 
                            class=" py-2 bg-transparent w-auto px-4 focus:outline-none">
                        </div>
                        <h5 class="text-white font-mono font-xl"><?php echo $error['username'] ?? ''; ?></h5>
                        <div class="w-1/3 outline outline-1 ouline-black rounded my-4">
                            <label for="email" class="text-black text-xl  ps-4 font-serif ">Email: </label>
                            <input type="email" name="email" value="<?php echo $old['email'] ?? $_SESSION['auth']['email']?? ''; ?>" placeholder="Write your email " 
                            class=" py-2 bg-transparent w-2/3 px-4 focus:outline-none">
                        </div>
                        <h5 class="text-white font-mono font-xl"><?php echo $error['email'] ?? ''; ?></h5>
                        <div class="w-1/3 outline outline-1 ouline-black rounded my-4">
                            <label for="phone" class="text-black text-xl  ps-4 font-serif">Phone: </label>
                            <input type="phone" name="phone" value="<?php echo $old['phone'] ?? $_SESSION['auth']['phone']?? ''; ?>" placeholder=" Write Your Phone Number" 
                            class=" py-2 bg-transparent w-auto px-4 focus:outline-none ">
                        </div>
                        <h5 class="text-white font-mono font-xl"><?php echo $error['phone'] ?? ''; ?></h5>
                        <div class="w-1/3 outline outline-1 ouline-black rounded my-4">
                            <label for="position" class="text-black text-xl  ps-4 font-serif">Job Position: </label>
                            <input type="position" name="position" value="<?php echo $old['position'] ?? $_SESSION['auth']['position']?? ''; ?>" placeholder="Write your Job Position " 
                            class=" py-2 bg-transparent w-auto px-4 focus:outline-none">
                        </div>
                        <h5 class="text-white font-mono font-xl"><?php echo $error['position'] ?? ''; ?></h5>
                        <div class="w-1/3 outline outline-1 ouline-black rounded my-4 relative">
                            <label for="password" class="text-black text-xl  ps-4 font-serif">Update Password: </label>
                            <input type="password" name="password" id="password" value="<?php echo $old['password'] ?? $_SESSION['auth']['password']?? ''; ?>" placeholder="Update your Password " 
                            class=" py-2 bg-transparent w-auto px-4 focus:outline-none">
                            <button type="button" onclick="updatePassword()" class="absolute inset-y-0 right-0 me-4 text-xl text-teal-950"><i class="fa-regular fa-eye"></i></button>
                        </div>
                        <h5 class="text-white font-mono font-xl"><?php echo $error['password'] ?? ''; ?></h5>
                    </div>
                    <button type="submit" name="Profile_update" class="bg-none hover:bg-black hover:text-white font-serif text-xl font-semibold px-8 py-2 my-2 rounded outline outline-1 outline-black">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script>
            function updatePassword(){
                var input = document.getElementById('password');
                var type = input.getAttribute('type');
                if (type== 'password'){
                    input.setAttribute('type','text');
                }else{
                    input.setAttribute('type','password');
                }
            }
    </script>