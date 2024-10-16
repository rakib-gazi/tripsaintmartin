<?php
     session_start();
	if(isset($_SESSION['auth'])){
		header('Location:dashboard/dashboard.php');
	}
	if(isset($_POST['login'])){
		include ('function/users_authentication.php');
		$old = $_POST;
		$result = login();
		if($result['status'] == 'error'){
			$error =$result['message'];
		}else{
			$success =$result['message'];
            header('Location:dashboard/dashboard.php');
		}
        
		
	}
?>
<section class="pt-28 flex justify-center items-center">
    <div class="container mx-auto ">
            <form  method="post" class="">
                <div class="flex flex-col justify-center items-center">
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded w-[400px]">
                            <input type="text" name="email_username" value="<?php echo $old['email_username'] ?? $_COOKIE['email_username'] ?? ''; ?>" placeholder=" Email or username" 
                            class=" py-2  w-full ps-2 focus:outline-none text-center">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['email_username'] ?? ''; ?></h5>
                    </div>
                    <div class="w-[400px] outline outline-1 ouline-black rounded my-2 relative">
                        <input type="password" name="password" id="password" value="<?php echo $_COOKIE['password'] ?? ''; ?>" placeholder=" your Password " 
                        class=" py-2 bg-transparent w-full px-4 focus:outline-none text-center">
                        <button type="button" onclick="passwordActions()" class="absolute inset-y-0 right-0 me-4 text-xl text-teal-950"><i class="fa-regular fa-eye"></i></button>
                        <h5 class="text-white font-mono font-xl"><?php echo $error['password'] ?? ''; ?></h5>
                    </div>
                    <div class="flex justify-start items-center gap-x-2 ">
                        <input type="Checkbox" name="remember" class="p-20  bg-amber-100 rounded my-2    border-none outline-none "  <?php echo (isset($_COOKIE ['email_username']) && $_COOKIE ['email_username']? 'checked':'' )?>> 
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="mb-12 py-4">
                        <button type="submit" name="login" class="bg-cyan-950 text-white text-xl  w-[400px] py-2 rounded">Login</button>
                    </div>
                </div>
            </form>
    </div>
    <script>
        function passwordActions(){
            var input = document.getElementById('password');
            var type = input.getAttribute('type');
            if (type== 'password'){
                input.setAttribute('type','text');
            }else{
                input.setAttribute('type','password');
            }
        }
    </script>
</section>
<?php
	ob_flush();
?>