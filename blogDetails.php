<?php 
     include "function/blog_auth.php";
      if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $blogData = blogSubCategoryview($id);
      }
      $blogposts = [];
      if(mysqli_num_rows($blogData) > 0) {
          while($row = mysqli_fetch_assoc($blogData)) {
              $blogposts[] = [
                  'mainTitle'         => $row['mainTitle'],
                  'paragraph'         => $row['paragraph'],
                  'image'             => $row['image'],

                  'subTitle_1'        => $row['subTitle_1'],
                  'paragraph_1'       => $row['paragraph_1'],
                  'subImage_1'        => $row['subImage_1'],
                  'subTitle_2'        => $row['subTitle_2'],
                  'paragraph_2'       => $row['paragraph_2'],
                  'subImage_2'        => $row['subImage_2'],
                  'subTitle_3'        => $row['subTitle_3'],
                  'paragraph_3'       => $row['paragraph_3'],
                  'subImage_3'        => $row['subImage_3'],
                  'subTitle_4'        => $row['subTitle_4'],
                  'paragraph_4'       => $row['paragraph_4'],
                  'subImage_4'        => $row['subImage_4'],
                  'subTitle_5'        => $row['subTitle_5'],
                  'paragraph_5'       => $row['paragraph_5'],
                  'subImage_5'        => $row['subImage_5'],
                  'subTitle_6'        => $row['subTitle_6'],
                  'paragraph_6'       => $row['paragraph_6'],
                  'subImage_6'        => $row['subImage_6'],
                  'subTitle_7'        => $row['subTitle_7'],
                  'paragraph_7'       => $row['paragraph_7'],
                  'subImage_7'        => $row['subImage_7'],
                  'subTitle_8'        => $row['subTitle_8'],
                  'paragraph_8'       => $row['paragraph_8'],
                  'subImage_8'        => $row['subImage_8'],
                  'subTitle_9'        => $row['subTitle_9'],
                  'paragraph_9'       => $row['paragraph_9'],
                  'subImage_9'        => $row['subImage_9'],
                  'subTitle_10'       => $row['subTitle_10'],
                  'paragraph_10'      => $row['paragraph_10'],
                  'subImage_10'       => $row['subImage_10'],
              ];
          }
      }

 ?>

<!DOCTYPE html>
<html lang="en" data-theme ='light'>
<?php include 'head.php'?>
  <body class="relative">
  <?php include 'header.php'?>
    <main class="px-4 xl:px-0 bg-white pt-20">
       <!-- Section -->
    <section class="container py-12 font-bangla">
        <!-- Left Column (Main Article Content) -->
        <div>
            <?php foreach ($blogposts as $data) { ?>
                <div>
                    <h1 class="text-3xl font-bold mb-4"><?php echo $data['mainTitle']; ?></h1>
                    <img src="images/blogImage/<?php echo $data['image']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <p class="text-black text-xl"><?php echo $data['paragraph']; ?></p>

                    <?php if (!empty($data['subTitle_1'])): ?>
                        <h3 class="text-xl font-bold my-4"><?php echo $data['subTitle_1']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($data['subImage_1'])): ?>
                        <img src="images/blogImage/<?php echo $data['subImage_1']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <?php endif; ?>

                    <?php if (!empty($data['paragraph_1'])): ?>
                        <p class="text-black text-xl"><?php echo $data['paragraph_1']; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($data['subTitle_2'])): ?>
                        <h3 class="text-xl font-bold my-4"><?php echo $data['subTitle_2']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($data['subImage_2'])): ?>
                        <img src="images/blogImage/<?php echo $data['subImage_2']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <?php endif; ?>

                    <?php if (!empty($data['paragraph_2'])): ?>
                        <p class="text-black text-xl"><?php echo $data['paragraph_2']; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($data['subTitle_3'])): ?>
                        <h3 class="text-xl font-bold my-4"><?php echo $data['subTitle_3']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($data['subImage_3'])): ?>
                        <img src="images/blogImage/<?php echo $data['subImage_3']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <?php endif; ?>

                    <?php if (!empty($data['paragraph_3'])): ?>
                        <p class="text-black text-xl"><?php echo $data['paragraph_3']; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($data['subTitle_4'])): ?>
                        <h3 class="text-xl font-bold my-4"><?php echo $data['subTitle_4']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($data['subImage_4'])): ?>
                        <img src="images/blogImage/<?php echo $data['subImage_4']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <?php endif; ?>

                    <?php if (!empty($data['paragraph_4'])): ?>
                        <p class="text-black text-xl"><?php echo $data['paragraph_4']; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($data['subTitle_5'])): ?>
                        <h3 class="text-xl font-bold my-4"><?php echo $data['subTitle_5']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($data['subImage_5'])): ?>
                        <img src="images/blogImage/<?php echo $data['subImage_5']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <?php endif; ?>

                    <?php if (!empty($data['paragraph_5'])): ?>
                        <p class="text-black text-xl"><?php echo $data['paragraph_5']; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($data['subTitle_6'])): ?>
                        <h3 class="text-xl font-bold my-4"><?php echo $data['subTitle_6']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($data['subImage_6'])): ?>
                        <img src="images/blogImage/<?php echo $data['subImage_6']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <?php endif; ?>

                    <?php if (!empty($data['paragraph_6'])): ?>
                        <p class="text-black text-xl"><?php echo $data['paragraph_6']; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($data['subTitle_7'])): ?>
                        <h3 class="text-xl font-bold my-4"><?php echo $data['subTitle_7']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($data['subImage_7'])): ?>
                        <img src="images/blogImage/<?php echo $data['subImage_7']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <?php endif; ?>

                    <?php if (!empty($data['paragraph_7'])): ?>
                        <p class="text-black text-xl"><?php echo $data['paragraph_7']; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($data['subTitle_8'])): ?>
                        <h3 class="text-xl font-bold my-4"><?php echo $data['subTitle_8']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($data['subImage_8'])): ?>
                        <img src="images/blogImage/<?php echo $data['subImage_8']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <?php endif; ?>

                    <?php if (!empty($data['paragraph_8'])): ?>
                        <p class="text-black text-xl"><?php echo $data['paragraph_8']; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($data['subTitle_9'])): ?>
                        <h3 class="text-xl font-bold my-4"><?php echo $data['subTitle_9']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($data['subImage_9'])): ?>
                        <img src="images/blogImage/<?php echo $data['subImage_9']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <?php endif; ?>

                    <?php if (!empty($data['paragraph_9'])): ?>
                        <p class="text-black text-xl"><?php echo $data['paragraph_9']; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($data['subTitle_10'])): ?>
                        <h3 class="text-xl font-bold my-4"><?php echo $data['subTitle_10']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($data['subImage_10'])): ?>
                        <img src="images/blogImage/<?php echo $data['subImage_10']; ?>" alt="Library" class="w-full h-96 object-cover mb-4 rounded-3xl">
                    <?php endif; ?>

                    <?php if (!empty($data['paragraph_10'])): ?>
                        <p class="text-black text-xl"><?php echo $data['paragraph_10']; ?></p>
                    <?php endif; ?>

                </div>
            <?php } ?>
        </div>
          
    </section>
    <section class="flex justify-center items-center">
      <img src="images/divider.png" alt="section divider">
    </section>
    <!-- Section -->
    <section class="container py-12 font-siliguri">
      <h2 class="text-center text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold pb-6">আমার প্রিয় ভ্রমণ সম্পর্কিত ওয়েবসাইট</h2>
      <p class=" mb-4 text-base md:text-xl font-medium text-center ">নীচে আমার প্রিয় কিছু কোম্পানি রয়েছে যেগুলো আমি ভ্রমণের সময় ব্যবহার করি। ফ্লাইট, থাকার ব্যবস্থা, ভ্রমণ বা গাড়ি ভাড়া করার সময় এগুলো আমার প্রথম পছন্দ!</p>
  
      <ul class="list-disc  space-y-3  text-lg md:text-xl text-black px-4 md:px-6 lg:px-8">
          <li><a href="#" class="font-bold text-blue-600 font-nunito">Skyscanner</a> – Skyscanner আমার প্রিয় ফ্লাইট সার্চ ইঞ্জিন...</li>
          <li><a href="#" class="font-bold text-blue-600 font-nunito">Going.com</a> – অসাধারণ ফ্লাইট ডিল খুঁজে বের করে...</li>
          <li><a href="#" class="font-bold text-blue-600 font-nunito">Hostelworld</a> – সেরা হোস্টেল থাকার সাইট...</li>
          <li><a href="#" class="font-bold text-blue-600 font-nunito">Booking.com</a> – সবসময় সবচেয়ে সস্তা রেট প্রদান করে...</li>
          <li><a href="#" class="font-bold text-blue-600 font-nunito">Get Your Guide</a> – ট্যুর এবং ভ্রমণের জন্য বিশাল মার্কেটপ্লেস...</li>
          <li><a href="#" class="font-bold text-blue-600 font-nunito">SafetyWing</a> – ডিজিটাল নোমাডদের জন্য সাশ্রয়ী পরিকল্পনা...</li>
          <li><a href="#" class="font-bold text-blue-600 font-nunito">Discover Cars</a> – গাড়ি ভাড়া পাওয়ার সেরা ডিল খুঁজে বের করতে সহায়তা করে...</li>
          <li><a href="#" class="font-bold text-blue-600 font-nunito">Trusted Housesitters</a> – পোষা প্রাণী এবং বাড়ির সিটারের সাথে সংযোগ করে...</li>
          <li><a href="#" class="font-bold text-blue-600 font-nunito">Top Travel Credit Cards</a> – ট্রাভেল খরচ কমানোর জন্য পয়েন্ট সেরা উপায়...</li>
      </ul>
  </section>
  
    </main>

      <footer class="bg-cyan-950 text-white p-6 text-center font-nunito p-x4 xl:p-x0">
        <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <div class="mb-6 md:mb-0">
                <h2 class="text-lg font-bold mb-2">ABOUT US</h2>
                <ul>
                    <li><a href="#" class="hover:underline">About Trip Saint Martin</a></li>
                    <li><a href="#" class="hover:underline">Contact Us</a></li>
                    <li><a href="#" class="hover:underline">Copyright</a></li>
                    <li><a href="#" class="hover:underline">Privacy Policy</a></li>
                </ul>
                
            </div>
            <div class="mb-6 md:mb-0">
                <h2 class="text-lg font-bold mb-2">TRAVEL TIPS</h2>
                <ul>
                    <li><a href="#" class="hover:underline">Start Here Travel</a></li>
                    <li><a href="#" class="hover:underline">Blog Destination</a></li>
                    <li><a href="#" class="hover:underline">Guides Favorite</a></li>
                    <li><a href="#" class="hover:underline">Hostels</a></li>
                    <li><a href="#" class="hover:underline">Favorite Hotels</a></li>
                    <li><a href="#" class="hover:underline">Favorite Neighborhoods</a></li>
                    <li><a href="#" class="hover:underline">Favorite Walking Tours</a></li>
                </ul>
            </div>
            <div class="mb-6 md:mb-0">
                <h2 class="text-lg font-bold mb-2">BOOK YOUR TRIP</h2>
                <ul>
                    <li><a href="#" class="hover:underline">Get Accommodation</a></li>
                    <li><a href="#" class="hover:underline">Get Flights</a></li>
                    <li><a href="#" class="hover:underline">My Favorite Companies</a></li>
                </ul>
            </div>
        </div>
        <div class="container grid grid-cols-1 lg:grid-cols-2 mt-6">
            <div class="flex flex-col justify-center items-center">
              <p class="text-sm">Copyright &copy; 2024 Trip saint Martin</p>
            </div>
            <div class="flex justify-center items-center gap-6">
              <div class="flex space-x-4">
                  <a href="#" class="hover:underline">Facebook</a>
                  <a href="#" class="hover:underline">Instagram</a>
                  <a href="#" class="hover:underline">X</a>
                  <a href="#" class="hover:underline">TikTok</a>
              </div>
          </div>
        </div>
    </footer>
    <a href="#top" class="flex justify-center items-center rounded-full shadow-xl border  bg-white md:p-4 p-2 fixed bottom-8 md:right-6 right-2 z-50">
      <img src="images/top.gif" alt="" class="h-7">              
    </a>
    <script>
        document.getElementById('nav-open').addEventListener('click', function(){
          const navopen = document.getElementById('phn-nav');
          navopen.classList.remove('hidden');
        })
        document.getElementById('cross-btn').addEventListener('click', function(){
          const navclose = document.getElementById('phn-nav');
          navclose.classList.add('hidden');
        })
    </script>
  </body>
</html>