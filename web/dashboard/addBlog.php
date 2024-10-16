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
if (mysqli_num_rows($category_form_view) > 0) {
    while ($category_name = mysqli_fetch_assoc($category_form_view)) {
        $category_names[] = $category_name['category'];
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
                    <div class=" flex justify-start items-center outline outline-1 ouline-black rounded">
                        <label for="blogCategory" class="text-black w-auto   ps-4  font-serif">Category: </label>
                        <select name="blogCategory"  class=" py-px bg-transparent w-full ps-2 focus:outline-none">
                            <option disabled selected>Select Category Name</option>
                            <?php 
                                foreach ($category_names as $category_name) {
                                    $selected = '';
                                    if (isset($old['blogCategory']) && $old['blogCategory'] == $category_name) {
                                        $selected = 'selected';
                                    } elseif (isset($row['category']) && $row['category'] == $category_name) {
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
                    <h5 class="text-red-600 pt-1 font-mono font-xl"><?php echo $error['blogCategory'] ?? ''; ?></h5>
                </div>
                <div class="mt-6 gap-x-4 flex flex-col justify-center items-center gap-6">
                        <div class="flex justify-start items-center outline outline-1 outline-black rounded-md w-full">
                            <textarea type="text" name="blogPost"  placeholder="Enter blog post" class="w-full min-h-[600px] p-4 font-siliguri text-xl"><?php echo $old['blogPost'] ?? ''; ?></textarea>
                        </div>
                    <button type="submit" name="blogPost_submit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
                </div>
                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['blogPost'] ?? ''; ?></h5>
            </form>
    </div>
</div>
