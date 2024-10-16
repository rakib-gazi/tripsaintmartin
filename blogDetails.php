<?php 
     include "function/blog_auth.php";
      if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $blogData = blogSubCategoryview($id);
      } else {
          die('Reservation ID not provided.');
      }
      $blogposts = [];
      if(mysqli_num_rows($blogData)>0){
          while($row = mysqli_fetch_assoc($blogData)){
              $blogposts[]  =[
                  'blogPost' => $row['blogPost'],
              ];
          }
         
      }
// ?>

<!DOCTYPE html>
<html lang="en" data-theme ='light'>
<?php include 'head.php'?>
  <body class="relative">
  <?php include 'header.php'?>
    <main class="px-4 xl:px-0 bg-white pt-20">
       <!-- Section -->
    <section class="container py-12 font-bangla">
        <!-- Left Column (Main Article Content) -->
          <div class="">
          <?php
                    foreach($blogposts as $data){?>
                        
                          <?php echo $data['blogPost'];?>
                        
                <?php    }
              ?>
          </div>
          <!-- <div class="">
              <h1 class="text-3xl font-bold mb-4">সেন্ট মার্টিন: বাংলাদেশের একমাত্র প্রবাল দ্বীপে ভ্রমণের পূর্ণাঙ্গ গাইড</h1>
              <img src="images/martin.jpeg" alt="Library" class="w-full h-96 object-cover mb-4 rounded-md">
              <p class="text-black  text-xl ">
                ### সেন্ট মার্টিন দ্বীপ: বাংলাদেশের একমাত্র প্রবাল দ্বীপের সৌন্দর্য ও পর্যটন<br><br>

                সেন্ট মার্টিন বাংলাদেশের একমাত্র প্রবাল দ্বীপ, যা কক্সবাজার জেলার টেকনাফ উপকূলের কাছে অবস্থিত। এই দ্বীপটির অবস্থান বঙ্গোপসাগরের নীল জলরাশির বুকে, যা তার প্রাকৃতিক সৌন্দর্য, প্রবাল শিলাখণ্ড এবং ঝকঝকে সাদা বালুর জন্য বিখ্যাত। সেন্ট মার্টিন দ্বীপ দেশের অন্যতম জনপ্রিয় পর্যটন কেন্দ্র, যেখানে প্রতিবছর শীতকালে হাজারো পর্যটক ভ্রমণ করতে আসেন।<br><br>
                
                #### সেন্ট মার্টিনের ইতিহাস<br>
                সেন্ট মার্টিন দ্বীপের ইতিহাস বেশ প্রাচীন। এটি প্রথম আবিষ্কৃত হয়েছিল আরব বণিকদের মাধ্যমে, যারা এই দ্বীপে এসে আশ্রয় নিতেন। ১৭শ শতাব্দীতে এই দ্বীপটি উপনিবেশিত হয়েছিল ব্রিটিশদের মাধ্যমে এবং তারা এর নামকরণ করেন সেন্ট মার্টিন। স্থানীয় ভাষায় একে নারিকেল জিঞ্জিরা বলা হয়, কারণ এখানে প্রচুর নারিকেল গাছ রয়েছে। দ্বীপটি একসময় একটি মাছ ধরার গ্রাম ছিল, তবে সময়ের সঙ্গে সঙ্গে এটি দেশের অন্যতম জনপ্রিয় পর্যটন কেন্দ্র হিসেবে পরিচিতি লাভ করেছে।<br><br>
                
                #### সেন্ট মার্টিন ভ্রমণের উপযুক্ত সময়<br>
                সেন্ট মার্টিনে ভ্রমণের উপযুক্ত সময় হল অক্টোবর থেকে মার্চ মাস পর্যন্ত, কারণ এই সময়ে আবহাওয়া সুন্দর এবং সমুদ্রের ঢেউ শান্ত থাকে। শীতকালে এই দ্বীপের প্রাকৃতিক সৌন্দর্য আরও বাড়ে এবং পর্যটকদের জন্য এটি একটি আদর্শ সময় হয়ে ওঠে। তবে বর্ষাকালে এই দ্বীপে যাওয়া নিরাপদ নয়, কারণ সমুদ্র উত্তাল থাকে এবং জাহাজ চলাচলও বন্ধ থাকে।<br><br>
                <iframe src="https://obeorooms.com/hotel/coral-haze-beach-resort" class="w-full h-[600px] rounded-md shadow-lg border-none shadow-lg"></iframe><br><br><br>
                #### কীভাবে সেন্ট মার্টিন যাওয়ার জাহাজের টিকিট কিনবেন<br>
                সেন্ট মার্টিন যাওয়ার জন্য মূলত টেকনাফ থেকে জাহাজ বা লঞ্চের ব্যবস্থা রয়েছে। টেকনাফ থেকে সেন্ট মার্টিনে প্রতিদিন সকাল ও দুপুরে জাহাজ ছাড়ে। টিকিট কেনার জন্য আপনাকে সরাসরি টেকনাফের জেটি থেকে টিকিট সংগ্রহ করতে হবে বা অনলাইনে বিভিন্ন ওয়েবসাইটের মাধ্যমে টিকিট বুক করতে পারেন। টিকিটের মূল্য সাধারণত ৫০০ টাকা থেকে শুরু করে ২০০০ টাকা পর্যন্ত হয়, এটি নির্ভর করে জাহাজের ধরণ ও সেবার মানের উপর।<br><br>
                
                ##### অনলাইন টিকিট কেনার কিছু জনপ্রিয় ওয়েবসাইট:<br>
                - [shohoz.com](https://www.shohoz.com/)<br>
                - [gogoBD.com](https://www.gogobd.com/)<br>
                - [easy.com.bd](https://www.easy.com.bd/)<br><br><br>
                
                #### সেন্ট মার্টিনে হোটেল বুকিং কীভাবে করবেন<br>
                সেন্ট মার্টিন দ্বীপে বেশ কিছু রিসোর্ট ও হোটেল রয়েছে, যেখানে আপনি বুকিং করে থাকতে পারেন। ভ্রমণের আগে হোটেল বুকিং করে নেয়া সর্বোত্তম, কারণ পর্যটন মৌসুমে হোটেলের চাহিদা বেশি থাকে এবং রুম পাওয়া কঠিন হতে পারে। আপনি সরাসরি হোটেলে কল করে বুকিং করতে পারেন বা অনলাইন প্ল্যাটফর্ম ব্যবহার করতে পারেন।<br><br>
                
                ##### অনলাইন বুকিং প্ল্যাটফর্মসমূহ:<br>
                - [booking.com](https://www.booking.com/)<br>
                - [airbnb.com](https://www.airbnb.com/)<br>
                - [tripadvisor.com](https://www.tripadvisor.com/)<br><br>
                
                #### সেন্ট মার্টিনের শীর্ষ ১০টি ভিআইপি হোটেল ও তাদের সুযোগ-সুবিধা<br><br>
                
                ১. **ম্যারিন প্যারাডাইস হোটেল**<br>
                   - রুম টাইপ: স্যুট, ডিলাক্স রুম<br>
                   - সুযোগ-সুবিধা: সমুদ্রের দৃশ্য, প্রাইভেট বীচ, ফ্রি ব্রেকফাস্ট, ফ্রি ওয়াই-ফাই।<br><br>
                
                ২. **ব্লু মেরিন রিসোর্ট**<br>
                   - রুম টাইপ: স্যুট, সি-ভিউ রুম<br>
                   - সুযোগ-সুবিধা: সুইমিং পুল, স্পা সার্ভিস, রেস্তোরাঁ, কনফারেন্স রুম।<br><br>
                
                ৩. **দ্য অ্যালকাট্রাজ**<br>
                   - রুম টাইপ: ভিআইপি স্যুট, ডিলাক্স রুম<br>
                   - সুযোগ-সুবিধা: ফ্রি ওয়াই-ফাই, প্রাইভেট বীচ, কিডস জোন।<br><br>
                
                ৪. **সেন্ট মার্টিন রিসোর্ট**<br>
                   - রুম টাইপ: সি-ভিউ রুম, ফ্যামিলি স্যুট<br>
                   - সুযোগ-সুবিধা: ইকো-ফ্রেন্ডলি কটেজ, ইভেন্ট প্ল্যানিং সার্ভিস।<br><br>
                
                ৫. **প্রিন্স হেভেন রিসোর্ট**<br>
                   - রুম টাইপ: স্যুট, প্রাইভেট ভিলা<br>
                   - সুযোগ-সুবিধা: বিলাসবহুল কটেজ, জ্যাকুজি, স্পা।<br><br>
                
                ৬. **সি পার্ল বিচ রিসোর্ট**<br>
                   - রুম টাইপ: ডিলাক্স সি-ভিউ রুম<br>
                   - সুযোগ-সুবিধা: সুইমিং পুল, স্পোর্টস ফ্যাসিলিটি, রেস্টুরেন্ট সার্ভিস।<br><br>
                
                ৭. **গোল্ডেন বিচ রিসোর্ট**<br>
                   - রুম টাইপ: সি-ফ্রন্ট ভিলা, হানিমুন স্যুট<br>
                   - সুযোগ-সুবিধা: রুম সার্ভিস, সুইমিং পুল, ফ্রি ব্রেকফাস্ট।<br><br>
                
                ৮. **প্যারাডাইস লজ**<br>
                   - রুম টাইপ: ডিলাক্স রুম, সি-ভিউ কটেজ<br>
                   - সুযোগ-সুবিধা: বারবিকিউ ফ্যাসিলিটি, ফ্রি ওয়াই-ফাই।<br><br>
                
                ৯. **সী ভিউ রিসোর্ট**<br>
                   - রুম টাইপ: ডিলাক্স রুম, স্যুট<br>
                   - সুযোগ-সুবিধা: ফ্রি ওয়াই-ফাই, কনফারেন্স হল, রুম সার্ভিস।<br><br>
                
                ১০. **ওশান ড্রিম রিসোর্ট**<br>
                    - রুম টাইপ: বিলাসবহুল স্যুট, সি-ভিউ রুম<br>
                    - সুযোগ-সুবিধা: প্রাইভেট বীচ, ফ্রি ব্রেকফাস্ট, কিডস জোন।<br><br>
                
                #### সেন্ট মার্টিনের শীর্ষ ২০টি বাজেট হোটেল<br><br>
                
                ১. সেন্ট মার্টিন বিচ হোটেল<br>
                ২. সি ফ্লাওয়ার রিসোর্ট<br>
                ৩. কোরাল আইল্যান্ড গেস্ট হাউস<br>
                ৪. সি সান রিসোর্ট<br>
                ৫. ব্লু ওশান গেস্ট হাউস<br>
                ৬. মুনলাইট কটেজ<br>
                ৭. ইকো ট্যুরিস্ট ইন<br>
                ৮. সি ব্রিজ রিসোর্ট<br>
                ৯. সি ওয়েভ গেস্ট হাউস<br>
                ১০. গ্রীন হেভেন রিসোর্ট<br>
                ১১. সি স্কাই রিসোর্ট<br>
                ১২. স্টার কটেজ<br>
                ১৩. সি বার্ড ইন<br>
                ১৪. নারিকেল বীচ রিসোর্ট<br>
                ১৫. ব্লু হাভেন রিসোর্ট<br>
                ১৬. সি গার্ডেন হোটেল<br>
                ১৭. ট্রপিকাল সান হোটেল<br>
                ১৮. ব্লু প্যারাডাইস গেস্ট হাউস<br>
                ১৯. ড্রিম আইল্যান্ড রিসোর্ট<br>
                ২০. সেন্ট মার্টিন সি ইন<br><br>
                
                #### সেন্ট মার্টিন ভ্রমণের টিপস<br>
                ১. যাত্রার আগে আবহাওয়ার পূর্বাভাস দেখে নিন।<br>
                ২. পর্যাপ্ত ক্যাশ এবং প্রয়োজনীয় জিনিসপত্র সঙ্গে রাখুন।<br>
                ৩. স্থানীয় খাবার যেমন নারিকেল, শুঁটকি এবং সামুদ্রিক মাছের স্বাদ নিতে ভুলবেন না।<br>
                ৪. পরিবেশ সংরক্ষণ করতে দ্বীপে প্লাস্টিক ফেলা থেকে বিরত থাকুন।<br><br>
                 
                সেন্ট মার্টিন দ্বীপ প্রাকৃতিক সৌন্দর্য, শান্তিপূর্ণ পরিবেশ এবং পর্যটকদের জন্য উন্নত সুবিধার জন্য আদর্শ গন্তব্য।<br>
              </p>
          </div> -->
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