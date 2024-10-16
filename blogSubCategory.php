<?php 
     include "baseurl.php";
     include "function/blog_auth.php";
      if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $blogSubCategoryData = blogSubCategoryview($id);
      } else {
          die('Reservation ID not provided.');
      }
      $subCategories = [];
      if(mysqli_num_rows($blogSubCategoryData)>0){
          while($row = mysqli_fetch_assoc($blogSubCategoryData)){
              $subCategories[]  =[
                  'id' => $row['id'],
                  'blogSubCategory' => $row['blogSubCategory'],
                  'subCategoryImage' => $row['subCategoryImage'],
              ];
          }
         
      }

?>

<!DOCTYPE html>
<html lang="en" data-theme ='light'>
    <?php include 'head.php' ?>
  <body class="relative">
    
  <?php include 'header.php' ?>

    <header class="">
        <section class=" ">
          <div class="  container pt-32 px-4">
            <div class="text-center ">
                <h1 class="text-xl md:text-3xl lg:text-4xl xl:text-5xl font-bold font-siliguri  lg:mt-0"> ঘুরে আসুন সেন্টমার্টিনে ট্রিপ সেন্টমার্টিনের সাথে</h1>
                <div>
                  <img src="images/martin.jpeg" alt="" class="w-full h-[200px] md:h-[350px] lg:h-[450px] xl:h-[550px] my-4 md:my-8 rounded-3xl shadow-lg">
                </div>
                <p class="py-6 font-bangla  text-base lg:text-xl ">
                  হিজবুল্লাহ একের পর এক ধাক্কা খেয়েছে, খাচ্ছে। সংগঠনের কমান্ড কাঠামো ছেঁটে ফেলা হয়েছে। হিজবুল্লাহর ডজনের বেশি শীর্ষ কমান্ডারকে হত্যা করা হয়েছে। পেজার আর ওয়াকিটকির বিস্ফোরণের মাধ্যমে হিজবুল্লাহর যোগাযোগব্যবস্থা ধ্বংস করা হয়েছে। একের পর এক বিমান হামলায় চালিয়ে সংগঠনটির অনেক অস্ত্র ধ্বংস করা হয়েছে।
                  যুক্তরাষ্ট্রভিত্তিক মধ্যপ্রাচ্যবিষয়ক নিরাপত্তা বিশ্লেষক মোহাম্মদ আল-বাশা বলেন, ‘হাসান নাসরুল্লাহর নিহতের ঘটনা গুরুত্বপূর্ণ প্রভাব ফেলবে। হিজবুল্লাহকে অস্থিতিশীল করে তুলতে পারে। এর ফলে হিজবুল্লাহর রাজনৈতিক ও সামরিক কৌশলে স্বল্পমেয়াদে পরিবর্তন আসতে পারে।’
                  তবে কট্টর ইসরায়েলবিরোধী এই সংগঠন হঠাৎ করে হাল ছেড়ে দেবে, ইসরায়েলের আহ্বানে সাড়া দিয়ে শান্তির পথে ধাবিত হবে—আপাতত এমন কোনো আশা করা হয়তো ভুল হবে।
                </p>
          </div>
        </section>
    </header>
    <main class="px-4 xl:px-0 bg-white">
       <!-- Section -->
    <section class="container py-12 font-siliguri">
        <h2 class="text-center text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold pb-12">সেন্টমার্টিনে খরচ বাচাতে নিছের টিপস গুলো আপনার উপকারে আসতে পারে</h2>

        <!-- Grid Layout for Articles -->
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
              <?php
                    foreach($subCategories as $data){?>
                        <a href="blogDetails.php?id=<?php echo $data['id']; ?>"  class="bg-white shadow-lg rounded-xl overflow-hidden">
                          <img src="<?php echo $data['subCategoryImage'];?>" alt="Article 1" class="w-full h-48 object-cover">
                          <h3 class="text-center text-xl font-semibold p-4"><?php echo $data['blogSubCategory'];?></h3>
                      </a>

                <?php    }
              ?>
        </div>
        <div class="flex justify-center items-center pt-8">
          <a href="#" class="flex justify-center items-center gap-6 bg-cyan-950 text-white px-4 py-2 shadow-lg rounded-xl text-xl font-semibold hover:bg-blue-600 ">
              আরো দেখুন
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
            </svg>  
          </a>        
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