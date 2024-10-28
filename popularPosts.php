<?php
    require_once("function/blog_auth.php") ;
    $categoryData = blog_view();
    $categories = [];
    if(mysqli_num_rows($categoryData)>0){
        while($row = mysqli_fetch_assoc($categoryData)){
            $categories[]  =[
                'id' => $row['id'],
                'category' => $row['blogCategory'],
                'pic' => $row['categoryImage'],
                'subCategory' => $row['blogSubCategory'],
                'paragraph' => $row['paragraph'],
                
            ];
        }
       
    }
?>
<section class="py-12">
        <div class="container font-siliguri text-center">
          <h1 class="text-2xl md:text-4xl font-bold text-center mb-10 text-gray-800">জনপ্রিয় পোস্ট সমূহ</h1>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 trip-grid">
            <?php foreach($categories as $data){?>
              <div class=" rounded overflow-hidden shadow-lg bg-white m-4">
                <img class="w-full h-48 object-cover" src="images/Saintmartin.jpeg" alt="Travel Destination">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2 text-black"><?php echo $data['category'];?></div>
                    <p class="text-gray-700 text-base font-bangla">
                      <?php 
                        $words = explode(' ', $data['paragraph']);
                        $shortPost = implode(' ', array_slice($words, 0, 20));
                        echo $shortPost . '...'; 
                    ?>
                    </p>
                </div>
                <hr class="border border-gray-500">
                <div class="px-6 py-4">
                    <a href="<?php echo $data['subCategory'] ? 'blogSubCategory.php' : 'blogDetails.php'; ?>?id=<?php echo $data['id']; ?>" class="text-orange-500 hover:text-blue-700 font-semibold flex justify-center items-center gap-6">আরো দেখুন
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                      </svg>
                    </a>
                </div>
              </div>
            <?php } ?>
            
          </div>
        </div>
      </section>