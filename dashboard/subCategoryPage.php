<?php 
include ('dashboard-header.php');
include_once ('../function/categories_auth.php');
include ('../function/pages_auth.php');

if (isset($_POST['subCategorypageSubmit'])) {
    $old = $_POST;
    $result = subCategoryPage();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=subCategoryPage.php');
    }
}
if (isset($_POST['updatesubcategoryPage'])) {
    $old = $_POST;
    $result = updatesubcategoryPage();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=subCategoryPage.php');
        exit; // Ensure no further code is executed after redirection
    }
}
if (isset($_POST['subCategoryPageDelete'])) {
    $old = $_POST;
    $result = subCategoryPagesDelete();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=subCategoryPage.php');
    }
}

$category_form_view = category_form_view();
$category_names = []; 
if (mysqli_num_rows($category_form_view) > 0) {
    while ($row = mysqli_fetch_assoc($category_form_view)) { 
        $category_names[] = [
            'category' => $row['category'],
            'id' => $row['id'],
        ];
    }
}

$subCategoryPageViewData = subCategoryPageView();
?>
<div class="flex">  
    <?php include('dashboard-sidebar.php'); ?>
    <!-- Main Content -->
    <div class="w-4/5 overflow-auto p-4">
        <div class="container mx-auto pt-24">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold font-serif capitalize ps-12 ">Sub Category Page</h1>
                <a href="blog.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                </a>
            </div>
            <hr class="border border-black">    
            <form method="post" class="ps-12 w-full" enctype="multipart/form-data">
                <h5 class="text-xl font-semibold font-mono text-black py-2">
                    <?php echo $success ?? ''; ?>
                </h5>
                <div>
                    <div class="flex justify-start items-center outline outline-1 outline-black rounded">
                        <label for="blogCategory" class="text-black w-auto ps-4 font-serif">Category: </label>
                        <select name="blogCategory" id="blogCategory" class="py-px bg-transparent w-full ps-2 focus:outline-none" onchange="updateCategoryId(this)">
                            <option disabled selected>Select Category Name</option>
                            <?php 
                                if (!empty($category_names)) {
                                    foreach ($category_names as $category) {
                            ?>
                                <option value="<?php echo htmlspecialchars($category['category']); ?>" 
                                    <?php 
                                        echo (isset($old['blogCategory']) && $old['blogCategory'] == $category['category']) ? 'selected' : 
                                            (isset($row['category']) && $row['category'] == $category['category'] ? 'selected' : ''); 
                                    ?>
                                    class="bg-cyan-950 text-white">
                                    <?php echo htmlspecialchars($category['category']); ?>
                                </option>    
                            <?php
                                    }
                                } else {
                                    echo '<option disabled>No categories available</option>';
                                }
                            ?>
                        </select>
                        <!-- Hidden input for category ID -->
                        <input type="hidden" name="categoryId" id="categoryId" value="<?php echo htmlspecialchars($old['blogCategoryId'] ?? ''); ?>">
                    </div>

                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['blogCategory'] ?? ''; ?></h5>
                </div>
                <div class="mt-3">
                    <div class="flex justify-start items-center outline outline-1 ouline-black rounded">
                        <label for="mainTitle" class="text-black w-40 ps-4 font-serif">Main Title : </label>
                        <input type="text" name="mainTitle" value="<?php echo $old['mainTitle'] ?? ''; ?>" placeholder=" Enter main title" 
                        class="py-px bg-transparent w-full ps-2 focus:outline-none">
                    </div>
                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['mainTitle'] ?? ''; ?></h5>
                </div>
                <div class="w-full outline outline-1 outline-black rounded my-4">
                    <input type="file" name="image" class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full">
                </div>
                <div class="flex justify-start items-center outline outline-1 ouline-black rounded">
                    <textarea name="mainParagraph" class="py-px bg-transparent w-full h-32 ps-2 focus:outline-none" placeholder="Enter Description"><?php echo $old['mainParagraph'] ?? ''; ?></textarea>
                </div>
                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['mainParagraph'] ?? ''; ?></h5>
                <div class="mt-3">
                    <div class="flex justify-start items-center outline outline-1 ouline-black rounded">
                        <label for="mainTitle2" class="text-black w-40 ps-4 font-serif">2nd Main Title : </label>
                        <input type="text" name="mainTitle2" value="<?php echo $old['mainTitle2'] ?? ''; ?>" placeholder=" Enter 2nd  main title" 
                        class="py-px bg-transparent w-full ps-2 focus:outline-none">
                    </div>
                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['mainTitle2'] ?? ''; ?></h5>
                </div>
                <div class="mt-6 gap-x-4 flex justify-center items-center gap-6">
                    <button type="submit" name="subCategorypageSubmit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
                </div>
            </form>

            <hr class="border border-black mt-4"> 
            <div class="flex flex-col mt-4">
                    <div class="-m-1.5 ">
                        <div class="p-1.5 w-full ps-12 inline-block align-middle">
                            <div class="border border-cyan-950 rounded-lg overflow-hidden">
                                <table class="w-full ">
                                    <thead class="bg-cyan-950">
                                        <tr>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">SL</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Categories</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Main Title</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Photo</th>
                                            <th scope="col" class="px-2 py-1.5 text-start text-sm font-medium text-white uppercase ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-cyan-950 ">
                                        
                                            <?php 
                                                if (mysqli_num_rows($subCategoryPageViewData) > 0) {
                                                    $i =  1;
                                                    while ($rowd = mysqli_fetch_assoc($subCategoryPageViewData)) {

                                            ?>
                                            <tr class="border border-cyan-950">
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo $i++;?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo  $rowd['category'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black"><?php echo  $rowd['mainTitle'];?></td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-sm font-medium text-black">
                                                        <img src="../<?php echo  $rowd['image'];?>" alt="" class="h-16 w-16">
                                                </td>
                                                <td class="px-2 py-1.5 whitespace-nowrap text-end text-sm font-medium inline-flex gap-x-2">
                                                    <button class="" onclick="document.getElementById('subCategoryPage-<?php echo $rowd['id']; ?>').showModal()">
                                                        <i class="fa-regular fa-pen-to-square text-blue-600 "></i>
                                                    </button>
                                                    <dialog id="subCategoryPage-<?php echo $rowd['id']; ?>" class="modal">
                                                        <div class="modal-box w-11/12 max-w-5xl text-start">
                                                            <form method="post" class="w-full" enctype="multipart/form-data">
                                                                <div>
                                                                    <div class="flex justify-start items-center outline outline-1 outline-black rounded">
                                                                        <label for="updateBlogCategory" class="text-black w-60 ps-4 font-serif">Update Category: </label>
                                                                        <select name="updateBlogCategory" id="updateBlogCategory" class="py-px bg-transparent w-full ps-2 focus:outline-none" onchange="updateCategoryIdForUpdate(this)">
                                                                            <option disabled selected>Select Category Name</option>
                                                                            <?php 
                                                                                foreach ($category_names as $category_name) {
                                                                                    echo '<option value="' . htmlspecialchars($category_name['category']) . '" ' .
                                                                                        ($rowd['category'] == $category_name['category'] ? 'selected' : '') . '>' .
                                                                                        htmlspecialchars($category_name['category']) . 
                                                                                        '</option>';    
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                        <!-- Hidden input for category ID -->
                                                                        <input type="hidden" name="updateCategoryId" id="updateCategoryId" value="<?php echo htmlspecialchars($rowd['categoryId'] ?? ''); ?>">
                                                                    </div>
                                                                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['updateBlogCategory'] ?? ''; ?></h5>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <div class="flex justify-start items-center outline outline-1 ouline-black rounded">
                                                                        <label for="updateMainTitle" class="text-black w-40 ps-4 font-serif">Update Main Title : </label>
                                                                        <input type="text" name="updateMainTitle" value="<?php echo $old['updateMainTitle'] ?? $rowd['mainTitle'] ?? ''; ?>" placeholder=" Update main title" 
                                                                        class="py-px bg-transparent w-full ps-2 focus:outline-none">
                                                                    </div>
                                                                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['updateMainTitle'] ?? ''; ?></h5>
                                                                </div>
                                                                <input type="hidden" value="<?php echo $rowd['id']; ?>" name="update_id">
                                                                <div class="w-full outline outline-1 outline-black rounded my-4">
                                                                    <input type="file" name="updateImage" class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full">
                                                                </div>
                                                                <div class="flex justify-start items-center outline outline-1 ouline-black rounded">
                                                                    <textarea name="updateMainParagraph" class="py-px bg-transparent w-full h-32 ps-2 focus:outline-none" placeholder="Update Description"><?php echo $old['mainParagraph'] ??  $rowd['mainParagraph']?? ''; ?></textarea>
                                                                </div>
                                                                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['updateMainParagraph'] ?? ''; ?></h5>
                                                                <div class="mt-3">
                                                                    <div class="flex justify-start items-center outline outline-1 ouline-black rounded">
                                                                        <label for="updateMainTitle2" class="text-black w-40 ps-4 font-serif">2nd Main Title : </label>
                                                                        <input type="text" name="updateMainTitle2" value="<?php echo $old['updateMainTitle2'] ?? $rowd['mainTitle2']?? ''; ?>" placeholder=" Enter 2nd  main title" 
                                                                        class="py-px bg-transparent w-full ps-2 focus:outline-none">
                                                                    </div>
                                                                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['updateMainTitle2'] ?? ''; ?></h5>
                                                                </div>
                                                                <div class="modal-action flex justify-center items-center">
                                                                    <button type="submit" name="updatesubcategoryPage" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Update</button>
                                                                      <form method="dialog ">
                                                                            <button class="btn px-12 bg-cyan-950 text-white text-xl hover:bg-red-600">Close</button>
                                                                    </form>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </dialog>
                                                    <form action="" method="post" onsubmit="return confirm('Do you want to delete?')">
                                                        <input type="hidden" name="delete_id" value="<?php echo $rowd['id'];?>">
                                                        <button type="submit" name="subCategoryPageDelete" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 ">
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
<script>
    function updateCategoryIdForUpdate(selectElement) {
    const selectedCategory = selectElement.value;
    const categoryNames = <?php echo json_encode($category_names); ?>;

    const selectedCategoryObject = categoryNames.find(category => category.category === selectedCategory);

    if (selectedCategoryObject) {
        document.getElementById('updateCategoryId').value = selectedCategoryObject.id;
        console.log("Selected Category ID:", selectedCategoryObject.id); // Debugging
    } else {
        document.getElementById('updateCategoryId').value = '';
    }
}

// Set the initial value of the hidden input on page load
document.addEventListener("DOMContentLoaded", function() {
    const initialSelectedCategory = document.getElementById('updateBlogCategory').value;
    updateCategoryIdForUpdate(document.getElementById('updateBlogCategory'));
});
</script>
<?php include('dashboard-footer.php'); ?>
