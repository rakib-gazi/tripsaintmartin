<?php 
include ('dashboard-header.php');
include ('../function/users_authentication.php');
if(isset($_POST['add_user'])){
    $old=$_POST;
    $result = registration();
    if($result['status'] == 'error'){
        $error = $result['message'];
    }else{
        $success = $result['message'];
        header('Refresh: 1; URL=add_user.php');
    } 
}
if (isset($_POST['user_delete'])) {
    $result = user_delete();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=add_user.php');
    }
}

$user_data = user_view();

?>
<div class="flex">  
    <?php include('dashboard-sidebar.php'); ?>
    <!-- Main Content -->
    <div class="w-4/5 overflow-auto p-4">
        <div class="container mx-auto pt-24">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold font-serif capitalize">Users</h1>
                <a href="settings.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fas fa-long-arrow-alt-left me-4"></i>Go Back
                </a>
            </div>
            <hr class="border border-black">  
            <form  method="post" class="">
                <h5 class=" text-xl font-semibold font-mono  py-2 "><?php echo $success?? '';	 ?>
                </h5>
                <div class="grid grid-cols-3 gap-4">
                    <div class="w-full outline outline-1 ouline-black rounded">
                        <label for="name" class="text-black text-xl  ps-4 font-serif">Name: </label>
                        <input type="text" name="name" value="<?php echo $old['name'] ?? ''; ?>" placeholder=" User Full Name" 
                        class=" py-2 bg-transparent w-auto px-4 focus:outline-none">
                        <h5 class="text-red-600 font-mono font-xl"><?php echo $error['name'] ?? ''; ?></h5>
                    </div>
                    <div class="w-full outline outline-1 ouline-black rounded">
                        <label for="email" class="text-black text-xl  ps-4 font-serif ">Email: </label>
                        <input type="email" name="email" value="<?php echo $old['email'] ?? ''; ?>" placeholder="Users Email Address " 
                        class=" py-2 bg-transparent w-2/3 px-4 focus:outline-none" autocomplete="off">
                        <h5 class="text-red-600 font-mono font-xl"><?php echo $error['email'] ?? ''; ?></h5>
                    </div>
                    <div class="w-full outline outline-1 ouline-black rounded">
                        <label for="phone" class="text-black text-xl  ps-4 font-serif">Phone: </label>
                        <input type="phone" name="phone" value="<?php echo $old['phone'] ?? ''; ?>" placeholder="Users Phone Number" 
                        class=" py-2 bg-transparent w-auto px-4 focus:outline-none ">
                        <h5 class="text-red-600 font-mono font-xl"><?php echo $error['phone'] ?? ''; ?></h5>
                    </div>
                    <div class="w-full outline outline-1 ouline-black rounded">
                        <label for="position" class="text-black text-xl  ps-4 font-serif">Job Position: </label>
                        <input type="text" name="position" value="<?php echo $old['position'] ??  ''; ?>" placeholder="Users Job Position " 
                        class=" py-2 bg-transparent w-auto px-4 focus:outline-none">
                        <h5 class="text-red-600 font-mono font-xl"><?php echo $error['position'] ?? ''; ?></h5>
                    </div>
                    <div class="w-full outline outline-1 ouline-black rounded relative">
                        <label for="password" class="text-black text-xl  ps-4 font-serif">Password: </label>
                        <input type="password" name="password" id="user_password" value="<?php echo $old['password'] ?? ''; ?>" placeholder="Users Password " 
                        class=" py-2 bg-transparent w-auto px-4 focus:outline-none" autocomplete="off">
                        <button type="button" onclick="userPassword()" class="absolute inset-y-0 right-0 me-4 text-xl text-teal-950"><i class="fa-regular fa-eye"></i></button>
                        <h5 class=" text-red-600 font-mono font-xl"><?php echo $error['password'] ?? ''; ?></h5>
                    </div>
                    <div class="w-full outline outline-1 ouline-black rounded relative">
                        <label for="confirm_password" class="text-black text-xl  ps-4 font-serif">Confirm Password: </label>
                        <input type="password" name="confirm_password" id="user_confirm_password" value="<?php echo $old['password'] ?? ''; ?>" placeholder="Users confirm Password " 
                        class=" py-2 bg-transparent w-auto px-4 focus:outline-none">
                        <button type="button" onclick="userConfirmPassword()" class="absolute inset-y-0 right-0 me-4 text-xl text-teal-950"><i class="fa-regular fa-eye"></i></button>
                        <h5 class=" text-red-600 font-mono font-xl"><?php echo $error['confirm_password'] ?? ''; ?></h5>
                    </div>
                </div>
                <div class="mb-12 py-4 flex justify-center items-center">
                    <button type="submit" name="add_user" class="bg-cyan-950 text-white font-mono text-xl  px-8 py-2 rounded">Add User</button>
                </div>
            </form>
            <div class="flex flex-col mt-2">
                <div class="-m-1.5 ">
                    <div class="p-1.5 w-full inline-block align-middle">
                        <div class="border border-cyan-950 rounded-lg overflow-hidden">
                        <table class="w-full ">
                            <thead class="bg-cyan-950">
                                <tr>
                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">SL</th>
                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Name</th>
                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Username</th>
                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Email</th>
                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Position</th>
                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Phone</th>
                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Password</th>
                                    <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-cyan-950 ">
                                    <?php 
                                        if(mysqli_num_rows($user_data)>0){
                                            $i=1;
                                            while($row = mysqli_fetch_assoc($user_data)){
                                    ?>
                                    <tr class="border border-cyan-950">
                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['name'];?></td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['username'];?></td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['email'];?></td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['position'];?></td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['phone'];?></td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row['password'];?></td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-end text-sm font-medium inline-flex gap-x-2">
                                            <form action="" method="post" onsubmit="return confirm('Do you want to delete?')">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                                <button type="submit" name="user_delete" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 ">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        }else {
                                            echo '<tr>';
                                            echo '<td colspan="5" class="text-center py-4"><h5 class="font-serif text-black">No Data Available</h5></td>';
                                            echo '</tr>';
                                        }
                                    ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('dashboard-footer.php'); ?>
