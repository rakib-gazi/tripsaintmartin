<?php 
include ('dashboard-header.php');
 include ('../function/categories_auth.php');

if (isset($_POST['subCategorySubmit'])) {
    $old = $_POST;
    $result = subCategory();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=subcategories.php');
    }
}
if(isset($_POST['updateSubCategorySubmit'])){
    $old=$_POST;
    $result = updateSubCategory();
    if($result['status'] == 'error'){
        $error = $result['message'];
    }else{
        $success = $result['message'];
        
        header('Refresh: 1; URL=subcategories.php');
    }
}

if (isset($_POST['SubCategoryDelete'])) {
    $result = SubCategoryDelete();
    if ($result['status'] == 'error') {
        $errors = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=subcategories.php');
    }
}

// Fetch data for the current page
$subCategoryView = subCategoryView();
?>
<div class="flex">  
    <?php include('dashboard-sidebar.php'); ?>
    <!-- Main Content -->
    <div class="w-4/5 overflow-auto p-4">
        <div class="container mx-auto pt-24">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold font-serif capitalize ps-12 ">Sub Categories</h1>
                <a href="settings.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                </a>
            </div>
            <hr class="border border-black">    
            <form method="post" class="ps-12 w-full" enctype="multipart/form-data">
                <h5 class="text-xl font-semibold font-mono text-black py-2">
                    <?php echo $success ?? ''; ?>
                </h5>
                <label for="subImage" class="flex justify-center items-center ">
                    <img src="../<?php echo ('images/image.png'); ?>" 
                        alt="" class="rounded-3xl border border-2 border-light object-fit-cover mb-4" style="height:250px; width:250px; ">
                </label>
                <div class="w-full outline outline-1 outline-black rounded my-4">
                    <input type="file" name="subImage" 
                        class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full" id="subImage">
                </div>
                <h5 class="text-white font-mono text-xl"><?php echo $error['subImage'] ?? ''; ?></h5>
                <div class="mt-6 ">
                        <div class="flex justify-start items-center outline outline-1 outline-black rounded w-full">
                            <label for="subCategory" class="text-black text-xl w-60 ps-4 font-serif">Sub Category: </label>
                            <input type="text" name="subCategory" value="<?php echo $old['subCategory'] ?? ''; ?>" placeholder="Enter Sub Category Name" 
                            class="py-2 bg-transparent w-full px-4 focus:outline-none">
                        </div>
                </div>
                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['subCategory'] ?? ''; ?></h5>
                <div class="flex justify-center items-center">
                    <button type="submit" name="subCategorySubmit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
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
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Sub Category</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-cyan-950 ">
                                        
                                            <?php 
                                                if (mysqli_num_rows($subCategoryView) > 0) {
                                                    $i =  1;
                                                    while ($row = mysqli_fetch_assoc($subCategoryView)) {
                                            ?>
                                            <tr class="border border-cyan-950">
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $row["subCategory"];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-end text-sm font-medium inline-flex gap-x-2">
                                                    <button class="" onclick="document.getElementById('subCategory-<?php echo $row['id']; ?>').showModal()">
                                                        <i class="fa-regular fa-pen-to-square text-blue-600 "></i>
                                                    </button>
                                                    <dialog id="subCategory-<?php echo $row['id']; ?>" class="modal">
                                                        <div class="modal-box w-11/12 max-w-5xl text-start">
                                                            <form method="post" class="w-full" enctype="multipart/form-data">
                                                                <input type="hidden" value="<?php echo $row['id']; ?>" name="update_id">
                                                                <label for="updateSubImage" class="flex justify-center items-center ">
                                                                <img src="../<?php echo $row['subImage'] ?  $row['subImage'] : 'images/image.png'; ?>
" 
                                                                    alt="" class="rounded-3xl border border-2 border-light object-fit-cover mb-4" style="height:250px; width:250px; ">
                                                            </label>
                                                            <div class="w-full outline outline-1 outline-black rounded my-4">
                                                                <input type="file" name="updateSubImage" 
                                                                    class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full" id="updateSubImage">
                                                            </div>
                                                            <h5 class="text-black font-mono text-xl"><?php echo $error['updateSubImage'] ?? ''; ?></h5>
                                                                <div class="mt-6 gap-x-4 flex justify-start items-center">
                                                                        <div class="flex justify-start items-center outline outline-1 outline-black rounded w-full">
                                                                            <label for="updateSubCategory" class="text-black text-xl w-60 ps-4 font-serif">Update Category: </label>
                                                                            <input type="text" name="updateSubCategory" value="<?php echo isset($old['updateSubCategory']) ? $old['updateSubCategory'] : (isset($row['subCategory']) ? $row['subCategory'] : ''); ?>"
                                                                            placeholder="Update Sub Category Name" 
                                                                            class="py-2 bg-transparent w-full px-4 focus:outline-none">
                                                                        </div>
                                                                </div>  
                                                                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['updateSubCategory'] ?? ''; ?></h5>
                                                            
                                                                <div class="modal-action flex justify-center items-center">
                                                                    <button type="submit" name="updateSubCategorySubmit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
                                                                      <form method="dialog ">
                                                                            <button class="btn px-12 bg-cyan-950 text-white text-xl hover:bg-red-600">Close</button>
                                                                    </form>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </dialog>
                                                    <form action="" method="post" onsubmit="return confirm('Do you want to delete?')">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                                        <button type="submit" name="SubCategoryDelete" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 ">
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
