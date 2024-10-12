<?php 
include ('dashboard-header.php');
 include ('../function/categories_auth.php');

if (isset($_POST['category_submit'])) {
    $old = $_POST;
    $result = category();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=categories.php');
    }
}
if(isset($_POST['updateategorySubmit'])){
    $old=$_POST;
    $result = updateategory();
    if($result['status'] == 'error'){
        $error = $result['message'];
    }else{
        $success = $result['message'];
        
        header('Refresh: 1; URL=categories.php');
    }
}

if (isset($_POST['category_delete'])) {
    $result = category_delete();
    if ($result['status'] == 'error') {
        $errors = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=categories.php');
    }
}

// Fetch data for the current page
$category_view = category_view();
?>
<div class="flex">  
    <?php include('dashboard-sidebar.php'); ?>
    <!-- Main Content -->
    <div class="w-4/5 overflow-auto p-4">
        <div class="container mx-auto pt-24">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold font-serif capitalize ps-12 ">Categories</h1>
                <a href="settings.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                </a>
            </div>
            <hr class="border border-black">    
            <form method="post" class="ps-12 w-full" enctype="multipart/form-data">
                <h5 class="text-xl font-semibold font-mono text-black py-2">
                    <?php echo $success ?? ''; ?>
                </h5>
                <label for="image" class="flex justify-center items-center ">
                    <img src="../<?php echo ('images/image.png'); ?>" 
                        alt="" class="rounded-3xl border border-2 border-light object-fit-cover mb-4" style="height:250px; width:250px; ">
                </label>
                <div class="w-full outline outline-1 outline-black rounded my-4">
                    <input type="file" name="image" 
                        class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full" id="image">
                </div>
                <h5 class="text-white font-mono text-xl"><?php echo $error['profile_image'] ?? ''; ?></h5>
                <div class="mt-6 ">
                        <div class="flex justify-start items-center outline outline-1 outline-black rounded w-full">
                            <label for="category" class="text-black text-xl w-40 ps-4 font-serif">Category: </label>
                            <input type="text" name="category" value="<?php echo $old['category'] ?? ''; ?>" placeholder="Enter Category Name" 
                            class="py-2 bg-transparent w-full px-4 focus:outline-none">
                        </div>
                </div>
                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['category'] ?? ''; ?></h5>
                <div class="flex justify-center items-center">
                    <button type="submit" name="category_submit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
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
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Category</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-cyan-950 ">
                                        
                                            <?php 
                                                if (mysqli_num_rows($category_view) > 0) {
                                                    $i =  1;
                                                    while ($row = mysqli_fetch_assoc($category_view)) {
                                            ?>
                                            <tr class="border border-cyan-950">
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row["category"];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-end text-sm font-medium inline-flex gap-x-2">
                                                    <button class="" onclick="document.getElementById('category-<?php echo $row['id']; ?>').showModal()">
                                                        <i class="fa-regular fa-pen-to-square text-blue-600 "></i>
                                                    </button>
                                                    <dialog id="category-<?php echo $row['id']; ?>" class="modal">
                                                        <div class="modal-box w-11/12 max-w-5xl text-start">
                                                            <form method="post" class="w-full" enctype="multipart/form-data">
                                                                <input type="hidden" value="<?php echo $row['id']; ?>" name="update_id">
                                                                <label for="update-image" class="flex justify-center items-center ">
                                                                <img src="../<?php echo $row['image'] ?  $row['image'] : 'images/image.png'; ?>
" 
                                                                    alt="" class="rounded-3xl border border-2 border-light object-fit-cover mb-4" style="height:250px; width:250px; ">
                                                            </label>
                                                            <div class="w-full outline outline-1 outline-black rounded my-4">
                                                                <input type="file" name="update-image" 
                                                                    class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full" id="update-image">
                                                            </div>
                                                            <h5 class="text-black font-mono text-xl"><?php echo $error['update-image'] ?? ''; ?></h5>
                                                                <div class="mt-6 gap-x-4 flex justify-start items-center">
                                                                        <div class="flex justify-start items-center outline outline-1 outline-black rounded w-full">
                                                                            <label for="updateCategory" class="text-black text-xl w-40 ps-4 font-serif">Update Category: </label>
                                                                            <input type="text" name="updateCategory" value="<?php echo isset($old['updateCategory']) ? $old['updateCategory'] : (isset($row['category']) ? $row['category'] : ''); ?>"
                                                                            placeholder="Update Category Name" 
                                                                            class="py-2 bg-transparent w-full px-4 focus:outline-none">
                                                                        </div>
                                                                </div>  
                                                                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['updateCategory'] ?? ''; ?></h5>
                                                            
                                                                <div class="modal-action flex justify-center items-center">
                                                                    <button type="submit" name="updateategorySubmit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
                                                                      <form method="dialog ">
                                                                            <button class="btn px-12 bg-cyan-950 text-white text-xl hover:bg-red-600">Close</button>
                                                                    </form>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </dialog>
                                                    <form action="" method="post" onsubmit="return confirm('Do you want to delete?')">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                                        <button type="submit" name="category_delete" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 ">
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
