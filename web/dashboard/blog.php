<?php 
	include ('dashboard-header.php');
    $note_icons = ['fa-solid  fa-user','fa-solid  fa-hotel'];
    $heading = ['Add post','All Posts'];
    $nlinks = ['addBlog.php','AllPosts.php']
?>
    <div class="flex">  
        <?php include('dashboard-sidebar.php');?>
        <!-- Main Content -->
        <div class="w-4/5 p-4">
            <div class="container mx-auto pt-24">
                <h1 class="text-3xl font-bold mb-4 font-serif capitalize">Settings</h1>
                <hr class="border border-black">	
                <div class="grid grid-cols-4 gap-4 mt-12 ps-12">
                <?php
                    foreach ($note_icons as $index => $note_icon) {
                        $hline = $heading[$index];
                        $nlink = $nlinks[$index];
                    ?> 
                    <a href="<?php echo $nlink; ?>" class="rounded overflow-hidden shadow-xl bg-white group hover:bg-cyan-950 transition duration-700 ease-in-out">
                        <div class="flex flex-col justify-center items-center  py-12 gap-y-2 group-hover:text-white">
                            <i class="<?php echo $note_icon; ?> text-4xl text-amber-700 group-hover:text-white"></i>
                            <h2 class="font-bold text-xl  group-hover:text-white"><?php echo $hline; ?></h2>
                        </div>
                    </a>
                <?php
                    }
                ?>

                </div>
            </div>
        </div>
    </div>
