<?php 
include ('dashboard-header.php');
 include ('../function/blog_auth.php');
 include ('../function/categories_auth.php');

if(isset($_POST['updateBlogSubmit'])){
    $old=$_POST;
    $result = updateblog();
    if($result['status'] == 'error'){
        $error = $result['message'];
    }else{
        $success = $result['message'];
        
        header('Refresh: 1; URL=AllPosts.php');
    }
}

if (isset($_POST['blog_delete'])) {
    $result = blog_delete();
    if ($result['status'] == 'error') {
        $errors = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=AllPosts.php');
    }
}

// Fetch data for the current page
$blog_view = blog_view();

$category_form_view = category_form_view();
if (mysqli_num_rows($category_form_view) > 0) {
    while ($category_name = mysqli_fetch_assoc($category_form_view)) {
        $category_names[] = $category_name['category'];
    }
}
$subCategoryFormView = subCategoryFormView();
if (mysqli_num_rows($subCategoryFormView) > 0) {
    while ($subCategoryName = mysqli_fetch_assoc($subCategoryFormView)) {
        $subCategoryNames[] = $subCategoryName['subCategory'];
    }
}
?>
<div class="flex">  
    <?php include('dashboard-sidebar.php'); ?>
    <!-- Main Content -->
    <div class="w-4/5 overflow-auto p-4">
        <div class="container mx-auto pt-24">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold font-serif capitalize ps-12 ">All Posts</h1>
                <a href="settings.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                </a>
            </div>
            <hr class="border border-black">  
            <h5 class="text-xl font-semibold font-mono text-black py-2">
                    <?php echo $success ?? ''; ?>
                </h5>
            <div class="flex flex-col mt-4">
                    <div class="-m-1.5 ">
                        <div class="p-1.5 w-full ps-12 inline-block align-middle">
                            <div class="border border-cyan-950 rounded-lg overflow-hidden">
                                <table class="w-full ">
                                    <thead class="bg-cyan-950">
                                        <tr>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">SL</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Posts Title</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Categories</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Sub Categories</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-cyan-950 ">
                                        
                                            <?php 
                                                if (mysqli_num_rows($blog_view) > 0) {
                                                    $i =  1;
                                                    while ($row = mysqli_fetch_assoc($blog_view)) {
                                                        $roomData = $row['mainTitle'];

                                                        // Split the text into an array of words
                                                        $words = explode(' ', $roomData);

                                                        // Keep the first 25 words (adjust the number of words as per your need)
                                                        $limitedText = implode(' ', array_slice($words, 0, 10)) . '...';

                                            ?>
                                            <tr class="border border-cyan-950">
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo  $limitedText;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo  $row['blogCategory'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo  $row['blogSubCategory'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-end text-sm font-medium inline-flex gap-x-2">
                                                    <button class="" onclick="document.getElementById('blog-<?php echo $row['id']; ?>').showModal()">
                                                        <i class="fa-regular fa-pen-to-square text-blue-600 "></i>
                                                    </button>
                                                    <dialog id="blog-<?php echo $row['id']; ?>" class="modal">
                                                        <div class="modal-box w-11/12 max-w-5xl text-start">
                                                            <form method="post" class="w-full" enctype="multipart/form-data">
                                                                <div>
                                                                    <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                                        <label for="updateBlogCategory" class="text-black w-60   ps-4  font-serif">Update Category: </label>
                                                                        <select name="updateBlogCategory"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                                                            <option disabled selected>Select Category Name</option>
                                                                            <?php 
                                                                                foreach ($category_names as $category_name) {
                                                                                    $selected = '';
                                                                                    if (isset($old['updateBlogCategory']) && $old['updateBlogCategory'] == $category_name) {
                                                                                        $selected = 'selected';
                                                                                    } elseif (isset($row['blogCategory']) && $row['blogCategory'] == $category_name) {
                                                                                        $selected = 'selected';
                                                                                    }
                                                                            ?>
                                                                                <option value="<?php echo htmlspecialchars($category_name); ?>" 
                                                                                    <?php echo $selected; ?> class="bg-cyan-950 text-white ">
                                                                                    <?php echo htmlspecialchars($category_name); ?>
                                                                                </option>    
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['updateBlogCategory'] ?? ''; ?></h5>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                                                        <label for="updateBlogSubCategory" class="text-black w-60   ps-4  font-serif">Update Sub Category: </label>
                                                                        <select name="updateBlogSubCategory"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                                                                            <option disabled selected>Select Sub Category Name</option>
                                                                            <?php 
                                                                                foreach ($subCategoryNames as $subCategoryName) {
                                                                                    $selected = '';
                                                                                    if (isset($old['updateBlogSubCategory']) && $old['updateBlogSubCategory'] == $subCategoryName) {
                                                                                        $selected = 'selected';
                                                                                    } elseif (isset($row['blogSubCategory']) && $row['blogSubCategory'] == $subCategoryName) {
                                                                                        $selected = 'selected';
                                                                                    }
                                                                            ?>
                                                                                <option value="<?php echo htmlspecialchars($subCategoryName); ?>" 
                                                                                    <?php echo $selected; ?> class="bg-cyan-950 text-white ">
                                                                                    <?php echo htmlspecialchars($subCategoryName); ?>
                                                                                </option>    
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['updateBlogSubCategory'] ?? ''; ?></h5>
                                                                </div>
                                                                <input type="hidden" value="<?php echo $row['id']; ?>" name="update_id">
                                                                <div class="mt-2 outline outline-1 ouline-black rounded p-4 flex flex-col gap-2">
                                                                    <div>
                                                                        <div class="flex justify-start items-center outline outline-1 ouline-black rounded">
                                                                            <label for="updateMainTitle" class="text-black w-40 ps-4 font-serif">Update Main Title : </label>
                                                                            <input type="text" name="updateMainTitle" value="<?php echo $old['updateMainTitle'] ?? $row['mainTitle']?? ''; ?>" placeholder=" Enter main title" 
                                                                            class="py-px bg-transparent w-full ps-2 focus:outline-none">
                                                                        </div>
                                                                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['updateMainTitle'] ?? ''; ?></h5>
                                                                    </div>
                                                                    <div class="outline outline-1 ouline-black rounded p-4 flex flex-col gap-2">
                                                                        <div class="flex justify-start items-center outline outline-1 outline-black rounded">
                                                                            <textarea name="updateMainParagraph" class="py-px bg-transparent w-full h-32 ps-2 focus:outline-none"><?php echo $old['updateMainParagraph'] ?? $row['paragraph'] ?? ''; ?></textarea>
                                                                        </div>

                                                                        <div class="w-full outline outline-1 outline-black rounded my-4">
                                                                            <!-- Image input field -->
                                                                            <input type="file" name="updateImage" class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full">
                                                                            <?php if (!empty($row['image'])): ?>
                                                                                <div class="mt-2">
                                                                                    <p class="text-xl p-2">Current Image:</p>
                                                                                    <img src="../images/blogImage/<?php echo $row['image']; ?>" alt="Current Image" class="h-32 w-32 object-cover p-2">
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                        for($i=1; $i<=10; $i++){?>
                                                                            <div  class="mt-2 outline outline-1 outline-black rounded p-4 flex flex-col gap-2 font-nunito">
                                                                                <div class="flex justify-start items-center outline outline-1 outline-black rounded">
                                                                                    <label for="updateSubTitle-<?php echo $i ;?>" class="text-black w-40 ps-4 "> Update Sub Title <?php echo $i ;?> : </label>
                                                                                    <input type="text" name="updateSubTitle_<?php echo $i ;?>" placeholder="Update sub title <?php echo $i ;?>" 
                                                                                    class="py-px bg-transparent w-full ps-2 focus:outline-none" value="<?php echo $old['updateSubTitle_' . $i] ?? $row['subitile_' . $i] ?? ''; ?>">
                                                                                </div>
                                                                                <div class="flex justify-start items-center outline outline-1 outline-black rounded">
                                                                                    <textarea name="updateParagraph_<?php echo $i; ?>" placeholder="Update paragraph <?php echo $i; ?>" class="py-px bg-transparent w-full h-32 ps-2 focus:outline-none"><?php echo $old['updateParagraph_' . $i] ?? $row['paragraph_' . $i] ?? ''; ?></textarea>
                                                                                </div>
                                                                                <div class="w-full outline outline-1 outline-black rounded my-4">
                                                                                    <!-- Image input field -->
                                                                                    <input type="file" name="updateImage_<?php echo $i ;?>" class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full">
                                                                                    <?php if (!empty($row['image_' . $i] )): ?>
                                                                                        <div class="mt-2">
                                                                                            <p class="text-xl p-2">Current Image <?php echo $i;?>:</p>
                                                                                            <img src="../images/blogImage/<?php echo $row['image_' . $i]; ?>" alt="Current Image" class="h-32 w-32 object-cover p-2">
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        <?php }
                                                                    ?>    
                                                                </div>
                                                                <div class="modal-action flex justify-center items-center">
                                                                    <button type="submit" name="updateBlogSubmit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
                                                                    <form method="dialog ">
                                                                            <button class="btn px-12 bg-cyan-950 text-white text-xl hover:bg-red-600">Close</button>
                                                                    </form>
                                                                </div>
                                                                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['updateBlog'] ?? ''; ?></h5>
                                                            </form>
                                                        </div>
                                                    </dialog>
                                                    <form action="" method="post" onsubmit="return confirm('Do you want to delete?')">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                                        <button type="submit" name="blog_delete" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 ">
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
