<?php
    include "function/blog_auth.php";
    $categoryData = blog_view();
    $categories = [];
    if(mysqli_num_rows($categoryData)>0){
        while($row = mysqli_fetch_assoc($categoryData)){
            $categories[]  =[
                'id' => $row['id'],
                'category' => $row['blogCategory'],
                'pic' => $row['categoryImage'],
                'subCategory' => $row['blogSubCategory'],
                
                
            ];
        }
       
    }
?>
<section class="py-12">
        <div class="container font-siliguri text-center">
          <h1 class="text-2xl md:text-4xl font-bold text-center mb-10 text-gray-800">আপনি কি সেন্টমার্টিনে যাওয়ার পরিকল্পনা করছেন, তাহলে নিচের বিষয়গুলো আপনার জন্য</h1>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 trip-grid">
              <!-- Card 1: Getting Inspired -->
              <a href="blogDetails.php" class="relative overflow-hidden group">
                  <img src="images/Saintmartin.jpeg" alt="Getting Inspired" class="w-full h-full object-cover rounded-lg  transform transition-transform duration-500 group-hover:scale-110">
                  <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
                      <h2 class="text-white text-2xl font-semibold px-4">সেন্টমার্টিন দ্বীপের ইতিহাস</h2>
                  </div>
              </a>
              <?php
                    foreach($categories as $data){?>
                        <a href="<?php echo $data['subCategory'] ? 'blogSubCategory.php' : 'blogDetails.php'; ?>?id=<?php echo $data['id']; ?>"  class="relative overflow-hidden group">
                            <img src="<?php echo $data['pic'];?>" alt="How to Save For a Trip" class="w-full h-full object-cover rounded-lg  transform transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
                                <h2 class="text-white text-2xl font-semibold px-4"><?php echo $data['category'];?></h2>
                            </div>
                        </a>

                <?php    }
              ?>
          </div>
      </div>
</section>