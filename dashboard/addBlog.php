<?php 
include ('dashboard-header.php');
 include ('../function/blog_auth.php');
 include ('../function/categories_auth.php');

if (isset($_POST['blogPost_submit'])) {
    $old = $_POST;
    $result = blogPost();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
         header('Refresh: 1; URL=addBlog.php');
    }
}
$category_form_view = category_form_view();
$category_names = []; 
if (mysqli_num_rows($category_form_view) > 0) {
    while ($row = mysqli_fetch_assoc($category_form_view)) { 
        $category_names[] = [
            'category' => $row['category'],
            'pic' => $row['image'],
        ];
    }
}
$subCategoryFormView = subCategoryFormView();
$subCategoryNames = []; 
if (mysqli_num_rows($subCategoryFormView) > 0) {
    while ($row = mysqli_fetch_assoc($subCategoryFormView)) { 
        $subCategoryNames[] = [
            'subCategory' => $row['subCategory'],
            'subPic' => $row['subImage'],
        ];
    }
}
?>
<div class="flex">  
    <?php include('dashboard-sidebar.php'); ?>
    <!-- Main Content -->
    <div class="w-4/5 overflow-auto p-4">
        <div class="container mx-auto pt-24">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold font-serif capitalize ps-12 ">Add Blog Post</h1>
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
                        <select name="blogCategory" id="blogCategory" class="py-px bg-transparent w-full ps-2 focus:outline-none" onchange="updateCategoryImage()">
                            <option disabled selected>Select Category Name</option>
                            <?php 
                                foreach ($category_names as $category) {
                                    $selected = '';
                                    if (isset($old['blogCategory']) && $old['blogCategory'] == $category['category']) {
                                        $selected = 'selected';
                                    } elseif (isset($row['category']) && $row['category'] == $category['category']) {
                                        $selected = 'selected';
                                    }
                            ?>
                                <option value="<?php echo htmlspecialchars($category['category']); ?>" 
                                    data-image="<?php echo htmlspecialchars($category['pic']); ?>" 
                                    <?php echo $selected; ?> class="bg-cyan-950 text-white">
                                    <?php echo htmlspecialchars($category['category']); ?>
                                </option>    
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="categoryImage" id="categoryImage" value=""> <!-- Hidden input for image -->
                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['blogCategory'] ?? ''; ?></h5>
                </div>
                <div class="mt-3">
                    <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                        <label for="blogSubCategory" class="text-black w-60   ps-4  font-serif">Sub Category: </label>
                        <select name="blogSubCategory" id="blogSubCategory"  class=" py-px bg-transparent w-full ps-2 focus:outline-none" onchange="updateSubCategoryImage()">
                            <option disabled selected>Select Sub Category Name</option>
                            <?php 
                                foreach ($subCategoryNames as $subCategory) {
                                    $selected = '';
                                    if (isset($old['blogSubCategory']) && $old['blogSubCategory'] == $subCategory['subCategory']) {
                                        $selected = 'selected';
                                    } elseif (isset($row['subCategory']) && $row['subCategory'] == $subCategory['subCategory']) {
                                        $selected = 'selected';
                                    }
                            ?>
                                <option value="<?php echo htmlspecialchars($subCategory['subCategory']); ?>" 
                                data-image="<?php echo htmlspecialchars($subCategory['subPic']); ?>"
                                    <?php echo $selected; ?> class="bg-cyan-950 text-white ">
                                    <?php echo htmlspecialchars($subCategory['subCategory']); ?>
                                </option>    
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="subCategoryImage" id="subCategoryImage" value="">
                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['blogSubCategory'] ?? ''; ?></h5>
                </div>
                <div class="mt-2 outline outline-1 ouline-black rounded p-4 flex flex-col gap-2" id='blogContainer'>
                    <div>
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <label for="mainTitle" class="text-black w-auto ps-4  font-serif">Main Title : </label>
                            <input type="text" name="mainTitle" value="<?php echo $old['mainTitle'] ?? ''; ?>" placeholder=" Enter main title" 
                            class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                        </div>
                        <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['mainTitle'] ?? ''; ?></h5>
                    </div>
                    <div class="outline outline-1 ouline-black rounded p-4 flex flex-col gap-2">
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                            <textarea name="paragraph"  class=" py-px bg-transparent w-full h-32 ps-2 focus:outline-none"><?php echo $old['paragraph'] ?? ''; ?></textarea>
                        </div>
                        <div class="w-full outline outline-1 outline-black rounded my-4">
                            <input type="file" name="image" 
                                class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full" >
                        </div>
                    </div>
                    <div class="mt-2 outline outline-1 ouline-black rounded p-4 flex flex-col gap-2">
                        <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                <label for="subTitle_1" class="text-black w-auto ps-4  font-serif">Sub Title : </label>
                                <input type="text" name="subTitle_1" value="<?php echo $old['subTitle_1'] ?? ''; ?>" placeholder=" Enter Sub title" 
                                class=" py-px bg-transparent w-auto ps-2 focus:outline-none">
                            </div>
                            <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                                <textarea name="paragraph_1"  class=" py-px bg-transparent w-full h-32 ps-2 focus:outline-none"><?php echo $old['paragraph_1'] ?? ''; ?></textarea>
                            </div>
                            <div class="w-full outline outline-1 outline-black rounded my-4">
                                <input type="file" name="subImage_1" 
                                    class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full" >
                            </div>
                        </div>
                </div>
                <div class="mt-6 gap-x-4 flex  justify-center items-center gap-6">
                    <button type="submit" name="blogPost_submit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
                    <button  id="addSection" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Add Section</button>
                    
                </div>
                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['blogPost'] ?? ''; ?></h5>
            </form>
    </div>
</div>
    <script>
        function updateCategoryImage() {
            var selectElement = document.getElementById("blogCategory");
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var selectedImage = selectedOption.getAttribute("data-image");

            // Update the hidden input with the selected image
            document.getElementById("categoryImage").value = selectedImage;
        }
        function updateSubCategoryImage() {
            var selectElement = document.getElementById("blogSubCategory");
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var selectedImage = selectedOption.getAttribute("data-image");

            // Update the hidden input with the selected image
            document.getElementById("subCategoryImage").value = selectedImage;
        }
    </script>
    <script>
        let paragraphCounter = 2;

        // PHP array passed to JavaScript
        const oldSubtitles = [
            <?php
                // Loop through PHP subtitles array (assuming $old['subtitle'] is an array with subtitles)
                for ($i = 2; $i <= 11; $i++) {
                    echo '"' . ($old["subtitle-$i"] ?? '') . '",';
                }
            ?>
        ];

        document.getElementById('addSection').addEventListener('click', (e) => {
            e.preventDefault();

            if (paragraphCounter <= 11) {
                const blogContainer = document.getElementById('blogContainer');
                const sectionDiv = document.createElement('div');
                sectionDiv.classList = "mt-2 outline outline-1 outline-black rounded p-4 flex flex-col gap-2";

                // Get the corresponding subtitle from the array
                let subtitleValue = oldSubtitles[paragraphCounter - 1] || ''; // Access the current subtitle

                // Create dynamic content for each section
                sectionDiv.innerHTML = `
                    <div class="flex justify-start items-center outline outline-1 outline-black rounded">
                        <label for="subTitle-${paragraphCounter}" class="text-black w-auto ps-4 font-serif">Sub Title:</label>
                        <input type="text" name="subTitle-${paragraphCounter}" value="${subtitleValue}" 
                            placeholder="Enter sub title ${paragraphCounter}" class="py-px bg-transparent w-auto ps-2 focus:outline-none">
                    </div>
                    <div class="flex justify-start items-center outline outline-1 outline-black rounded">
                        <textarea name="paragraph-${paragraphCounter}" class="text-black py-px bg-transparent w-full h-32 ps-2 focus:outline-none" placeholder="Enter paragraph ${paragraphCounter}">
                            ${subtitleValue}
                        </textarea>
                    </div>
                    <div class="w-full outline outline-1 outline-black rounded my-4">
                        <input type="file" name="image-${paragraphCounter}" 
                            class="py-2 bg-transparent w-92 px-4 focus:outline-none w-full">
                    </div>
                `;

                // Append the new section to the blog container
                blogContainer.appendChild(sectionDiv);

                // Increment the counter for the next click
                paragraphCounter++;
            }
        });
    </script>

    </body>
</html>
