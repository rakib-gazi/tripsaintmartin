<?php 
include ('dashboard-header.php');
 include ('../function/nav_auth.php');

if (isset($_POST['navSubmit'])) {
    $old = $_POST;
    $result = navbar();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=navbar.php');
    }
}
if(isset($_POST['updateNavbar'])){
    $old=$_POST;
    $result = updateNavbar();
    if($result['status'] == 'error'){
        $error = $result['message'];
    }else{
        $success = $result['message'];
        
        header('Refresh: 1; URL=navbar.php');
    }
}

if (isset($_POST['navbarDelete'])) {
    $result = navbarDelete();
    if ($result['status'] == 'error') {
        $errors = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=navbar.php');
    }
}

// Fetch data for the current page
$navbarView = navbarView();
?>
<div class="flex">  
    <?php include('dashboard-sidebar.php'); ?>
    <!-- Main Content -->
    <div class="w-4/5 overflow-auto p-4">
        <div class="container mx-auto pt-24">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold font-serif capitalize ps-12 ">Navbar</h1>
                <a href="settings.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                </a>
            </div>
            <hr class="border border-black">    
            <form method="post" class="ps-12 w-full" enctype="multipart/form-data">
                <h5 class="text-xl font-semibold font-mono text-black py-2">
                    <?php echo $success ?? ''; ?>
                </h5>
                <div class="mt-6 ">
                        <div class="flex justify-start items-center outline outline-1 outline-black rounded w-full">
                            <label for="navItem" class="text-black text-xl w-40 ps-4 font-serif">Item Name: </label>
                            <input type="text" name="navItem" value="<?php echo $old['navItem'] ?? ''; ?>" placeholder="Enter Navbar Item Name" 
                            class="py-2 bg-transparent w-full px-4 focus:outline-none">
                        </div>
                </div>
                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['navItem'] ?? ''; ?></h5>
                <div class="mt-6 ">
                        <div class="flex justify-start items-center outline outline-1 outline-black rounded w-full">
                            <label for="navlink" class="text-black text-xl w-40 ps-4 font-serif">Item Link: </label>
                            <input type="text" name="navlink" value="<?php echo $old['navlink'] ?? ''; ?>" placeholder="Enter Navbar Item Link" 
                            class="py-2 bg-transparent w-full px-4 focus:outline-none">
                        </div>
                </div>
                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['navlink'] ?? ''; ?></h5>
                <div class="flex justify-center items-center">
                    <button type="submit" name="navSubmit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
                </div>
            </form>
            <div class="flex flex-col mt-4">
                    <div class="-m-1.5 ">
                        <div class="p-1.5 w-full ps-12 inline-block align-middle">
                            <div class="border border-cyan-950 rounded-lg overflow-hidden">
                                <table class="w-full ">
                                    <thead class="bg-cyan-950">
                                        <tr>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">SL</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Navbar Item</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Item LInk</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-cyan-950 ">
                                        
                                            <?php 
                                                if (mysqli_num_rows($navbarView) > 0) {
                                                    $i =  1;
                                                    while ($row = mysqli_fetch_assoc($navbarView)) {
                                            ?>
                                            <tr class="border border-cyan-950">
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row["navItem"];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row["navlink"];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-end text-sm font-medium inline-flex gap-x-2">
                                                    <button class="" onclick="document.getElementById('navbar-<?php echo $row['id']; ?>').showModal()">
                                                        <i class="fa-regular fa-pen-to-square text-blue-600 "></i>
                                                    </button>
                                                    <dialog id="navbar-<?php echo $row['id']; ?>" class="modal">
                                                        <div class="modal-box w-11/12 max-w-5xl text-start">
                                                            <form method="post" class="w-full" enctype="multipart/form-data">
                                                                <input type="hidden" value="<?php echo $row['id']; ?>" name="update_id">
                                                                <div class="mt-6 gap-x-4 flex justify-start items-center">
                                                                        <div class="flex justify-start items-center outline outline-1 outline-black rounded w-full">
                                                                            <label for="updateNavItem" class="text-black text-xl w-40 ps-4 font-serif">Update Navitem: </label>
                                                                            <input type="text" name="updateNavItem" value="<?php echo isset($old['updateNavItem']) ? $old['updateNavItem'] : (isset($row['navItem']) ? $row['navItem'] : ''); ?>"
                                                                            placeholder="Update Navbar Item" 
                                                                            class="py-2 bg-transparent w-full px-4 focus:outline-none">
                                                                        </div>
                                                                </div>  
                                                                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['updateNavItem'] ?? ''; ?></h5>
                                                                <div class="mt-6 gap-x-4 flex justify-start items-center">
                                                                        <div class="flex justify-start items-center outline outline-1 outline-black rounded w-full">
                                                                            <label for="updateNavLink" class="text-black text-xl w-40 ps-4 font-serif">Update Navlink: </label>
                                                                            <input type="text" name="updateNavLink" value="<?php echo isset($old['updateNavLink']) ? $old['updateNavLink'] : (isset($row['navlink']) ? $row['navlink'] : ''); ?>"
                                                                            placeholder="Update Navbar Link" 
                                                                            class="py-2 bg-transparent w-full px-4 focus:outline-none">
                                                                        </div>
                                                                </div>  
                                                                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['updateNavLink'] ?? ''; ?></h5>
                                                                <div class="modal-action flex justify-center items-center">
                                                                    <button type="submit" name="updateNavbar" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
                                                                      <form method="dialog ">
                                                                            <button class="btn px-12 bg-cyan-950 text-white text-xl hover:bg-red-600">Close</button>
                                                                    </form>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </dialog>
                                                    <form action="" method="post" onsubmit="return confirm('Do you want to delete?')">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                                        <button type="submit" name="navbarDelete" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 ">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                                    }
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
