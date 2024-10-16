<?php 
include ('dashboard-header.php');
 include ('../function/photos_auth.php');

if (isset($_POST['photoSubmit'])) {
    $old = $_POST;
    $result = photo();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=photos.php');
    }
}
if(isset($_POST['updatePhotoSubmit'])){
    $old=$_POST;
    $result = updatePhoto();
    if($result['status'] == 'error'){
        $error = $result['message'];
    }else{
        $success = $result['message'];
        
        header('Refresh: 1; URL=photos.php');
    }
}

if (isset($_POST['PhotoDelete'])) {
    $result = PhotoDelete();
    if ($result['status'] == 'error') {
        $errors = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=photos.php');
    }
}

// Fetch data for the current page
$Photoview = Photoview();
?>
<div class="flex">  
    <?php include('dashboard-sidebar.php'); ?>
    <!-- Main Content -->
    <div class="w-4/5 overflow-auto p-4">
        <div class="container mx-auto pt-24">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold font-serif capitalize ps-12 ">All Photos</h1>
                <a href="settings.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                </a>
            </div>
            <hr class="border border-black">    
            <form method="post" class="ps-12 w-full" enctype="multipart/form-data">
                <h5 class="text-xl font-semibold font-mono text-black py-2">
                    <?php echo $success ?? ''; ?>
                </h5>
                <label for="photo" class="flex justify-center items-center ">
                    <img src="../<?php echo ('images/image.png'); ?>" 
                        alt="" class="rounded-3xl border border-2 border-light object-fit-cover mb-4" style="height:250px; width:250px; ">
                </label>
                <div class="w-full outline outline-1 outline-black rounded my-4">
                    <input type="file" name="photo" 
                        class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full" id="photo">
                </div>
                <h5 class="text-white font-mono text-xl"><?php echo $error['photo'] ?? ''; ?></h5>
                <div class="flex justify-center items-center">
                    <button type="submit" name="photoSubmit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
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
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Photo</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Photo View</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-cyan-950 ">
                                        
                                            <?php 
                                                if (mysqli_num_rows($Photoview) > 0) {
                                                    $i =  1;
                                                    while ($row = mysqli_fetch_assoc($Photoview)) {
                                            ?>
                                            <tr class="border border-cyan-950">
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row["photo"];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black">
                                                    <img src="../<?php echo $row["photo"];?>" alt="" class="h-40 w-40">
                                                </td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-end text-sm font-medium inline-flex gap-x-2">
                                                    <button class="" onclick="document.getElementById('category-<?php echo $row['id']; ?>').showModal()">
                                                        <i class="fa-regular fa-pen-to-square text-blue-600 "></i>
                                                    </button>
                                                    <dialog id="category-<?php echo $row['id']; ?>" class="modal">
                                                        <div class="modal-box w-11/12 max-w-5xl text-start">
                                                            <form method="post" class="w-full" enctype="multipart/form-data">
                                                                <input type="hidden" value="<?php echo $row['id']; ?>" name="update_id">
                                                                <label for="updatePhoto" class="flex justify-center items-center ">
                                                                <img src="../<?php echo $row['photo'] ?  $row['photo'] : 'images/image.png'; ?>
" 
                                                                    alt="" class="rounded-3xl border border-2 border-light object-fit-cover mb-4" style="height:250px; width:250px; ">
                                                            </label>
                                                            <div class="w-full outline outline-1 outline-black rounded my-4">
                                                                <input type="file" name="updatePhoto" 
                                                                    class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full" id="updatePhoto">
                                                            </div>
                                                            <h5 class="text-black font-mono text-xl"><?php echo $error['updatePhoto'] ?? ''; ?></h5>
                                                                <div class="modal-action flex justify-center items-center">
                                                                    <button type="submit" name="updatePhotoSubmit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
                                                                      <form method="dialog ">
                                                                            <button class="btn px-12 bg-cyan-950 text-white text-xl hover:bg-red-600">Close</button>
                                                                    </form>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </dialog>
                                                    <form action="" method="post" onsubmit="return confirm('Do you want to delete?')">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                                        <button type="submit" name="PhotoDelete" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 ">
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
