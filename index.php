<!DOCTYPE html>
<html lang="en" data-bs-theme ='light'>
    <?php include 'head.php'?>
  <body class="relative">
    
    <nav id="top" >
      <div id="header" class="px-6 xl:px-0 fixed top-0 z-30  bg-transparent w-full">
          <div id="text-color" class="container flex justify-between items-center py-4 text-white">
            <div class=" text-lg">
              <a href="#" class="font-bold  text-xl lg:text-3xl font-nunito">Trip Saint Martin</a>
            </div>
            <div >
              <div class="hidden md:flex space-x-4 text-xl  font-semibold">
                <a href="#" class="font-siliguri">সেন্টমার্টিন দ্বীপ</a>
                <a href="#" class="font-siliguri">ব্লগ</a>
                <a href="#" class="font-siliguri">ট্রিপ প্লান</a>
                <a href="#" class="font-siliguri">বুকিং রিসোর্স</a>
                <a href="#" class="font-siliguri">ছবি গ্যালারি</a>
              </div>
              <button id="nav-open" class="block md:hidden"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                  </svg>
                </button>
            </div>
          </div>
      </div>
    </nav>
    <div id="phn-nav" class=" bg-white fixed min-h-screen top-0 right-0 w-2/3  z-50  hidden">
      <div class="flex justify-end items-center">
        <button id="cross-btn">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6  text-black me-4 mt-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
       </button>  
      </div>
      <div class="pt-6 flex flex-col  text-black  text-lg px-4 gap-y-2">
        <a href="#" class="font-siliguri">সেন্টমার্টিন দ্বীপ</a>
        <hr class="border border-gray-300">
        <a href="#" class="font-siliguri">ব্লগ</a>
        <hr class="border border-gray-300">
        <a href="#" class="font-siliguri">ট্রিপ প্লান</a>
        <hr class="border border-gray-300">
        <a href="#" class="font-siliguri">বুকিং রিসোর্স</a>
        <hr class="border border-gray-300">
        <a href="#" class="font-siliguri">ছবি গ্যালারি</a>
        <hr class="border border-gray-300">
      </div>
    </div>
    <header class="bg-hero bg-no-repeat bg-center bg-cover ">
        <section class=" bg-gradient-to-b from-black/50 via-blue-950/20 to-black/80 ">
          <div class="  container hero min-h-screen">
            <div class="hero-content text-center ">
              <div class="">
                <h1 class="text-xl lg:text-5xl font-bold font-siliguri text-white mt-16 lg:mt-0">সেন্টমার্টিন বাংলাদেশের একমাত্র প্রবাল দ্বীপ, চলুন ঘুরে আসি।</h1>
                <p class="py-6 font-bangla text-white text-base lg:text-xl ">
                  হিজবুল্লাহ একের পর এক ধাক্কা খেয়েছে, খাচ্ছে। সংগঠনের কমান্ড কাঠামো ছেঁটে ফেলা হয়েছে। হিজবুল্লাহর ডজনের বেশি শীর্ষ কমান্ডারকে হত্যা করা হয়েছে। পেজার আর ওয়াকিটকির বিস্ফোরণের মাধ্যমে হিজবুল্লাহর যোগাযোগব্যবস্থা ধ্বংস করা হয়েছে। একের পর এক বিমান হামলায় চালিয়ে সংগঠনটির অনেক অস্ত্র ধ্বংস করা হয়েছে।

  যুক্তরাষ্ট্রভিত্তিক মধ্যপ্রাচ্যবিষয়ক নিরাপত্তা বিশ্লেষক মোহাম্মদ আল-বাশা বলেন, ‘হাসান নাসরুল্লাহর নিহতের ঘটনা গুরুত্বপূর্ণ প্রভাব ফেলবে। হিজবুল্লাহকে অস্থিতিশীল করে তুলতে পারে। এর ফলে হিজবুল্লাহর রাজনৈতিক ও সামরিক কৌশলে স্বল্পমেয়াদে পরিবর্তন আসতে পারে।’

  তবে কট্টর ইসরায়েলবিরোধী এই সংগঠন হঠাৎ করে হাল ছেড়ে দেবে, ইসরায়েলের আহ্বানে সাড়া দিয়ে শান্তির পথে ধাবিত হবে—আপাতত এমন কোনো আশা করা হয়তো ভুল হবে।</p>
              </div>
            </div>
          </div>
        </section>
    </header>
    <main class="px-4 xl:px-0 bg-white">
    <?php include 'mainCategory.php'?>
    <?php include 'popularPosts.php'?>
    </main>
    <?php include 'popularPosts.php'?>
    <a href="#top" class="flex justify-center items-center rounded-full shadow-xl border  bg-white md:p-4 p-2 fixed bottom-8 md:right-6 right-2 z-50">
      <img src="images/top.gif" alt="" class="h-7">              
    </a>
    <?php include 'footer.php'?>
    <script src="js/index.js"></script>
  </body>
</html>