@extends('frontend.layouts.app')

@section('title', 'ShopUp | Home Page')

@section('home')
<!-- banner section -->
<div class="banner-container imageBg lg:flex justify-between px-8 lg:px-20 pt-10 lg:h-[450px]">
   <div class="banner-text lg:w-7/12 h-auto">
      <h1 class="font-bold text-3xl lg:text-6xl mb-2 lg:mb-6">FIND CLOTHES THAT MATCHES YOUR STYLE</h1>
      <p class="mb-2 lg:mb-6 font-normal">Browse through our diverse range of meticulously crafted garments, designed
         to bring out your individuality and cater to your sense of style.</p>
      <button class="btn rounded-full w-52 text-white bg-black mb-6 hover:text-black">Shop Now</button>

      <div class="grid grid-cols-2 lg:grid-cols-3 lg:divide-x-[3px]  divide-gray-400">
         <div class="text-center ">
            <h1 class="text-4xl mb-2 font-extrabold text-black">200+</h1>
            <p class="text-sm">International Brands</p>
         </div>

         <div class="text-center">
            <h1 class="text-4xl mb-2 font-extrabold text-black">2,000+</h1>
            <p class="text-sm">High Quality Products</p>
         </div>

         <div class="col-span-2 text-center mt-4 lg:mt-0 lg:col-span-1">
            <h1 class="text-4xl mb-2 font-extrabold text-black">30,000+</h1>
            <p class="text-sm">Happy Customers</p>
         </div>
      </div>
   </div>
   <div class="lg:w-5/12">
      <img src="{{asset('assets/frontend/assets/images/home/banner.png')}}" class="h-[250px] lg:h-[410px] m-auto w-[70%]" alt="">
   </div>
</div>
<!-- brand section -->
<!-- <div class="h-20 bg-black grid grid-cols-3 text-center px-8  lg:flex justify-around items-center lg:px-20">
      <img src="assets/images/home/brand-name/versace.png" class="w-36 h-[50%]" alt="">
      <img src="assets/images/home/brand-name/zara.png" class="w-36 h-[50%]" alt="">
      <img src="assets/images/home/brand-name/gucci.png" class="w-36 h-[50%]" alt="">
      <img src="assets/images/home/brand-name/prada.png" class="w-36 h-[50%]" alt="">
      <img src="assets/images/home/brand-name/calvin-klein.png" class="w-36 h-[50%]" alt="">
    </div> -->

<div class="lg:hidden bg-black p-8">
   <div class="flex justify-between items-center  mb-4">
      <img src="{{asset('assets/frontend/assets/images/home/brand-name/versace.png')}}" class="w-24 h-[50%]" alt="">
      <img src="{{asset('assets/frontend/assets/images/home/brand-name/zara.png')}}" class="w-24 h-[50%]" alt="">
      <img src="{{asset('assets/frontend/assets/images/home/brand-name/gucci.png')}}" class="w-24 h-[50%]" alt="">
   </div>
   <div class="flex justify-around items-center">
      <img src="{{asset('assets/frontend/assets/images/home/brand-name/prada.png')}}" class="w-24 h-[50%]" alt="">
      <img src="{{asset('assets/frontend/assets/images/home/brand-name/calvin-klein.png')}}" class="w-24 h-[50%]" alt="">
   </div>
</div>
<div class="h-20 hidden  bg-black grid grid-cols-3 text-center px-8  lg:flex justify-around items-center lg:px-20">
   <img src="{{asset('assets/frontend/assets/images/home/brand-name/versace.png')}}" class="w-36 h-[50%]" alt="">
   <img src="{{asset('assets/frontend/assets/images/home/brand-name/zara.png')}}" class="w-36 h-[50%]" alt="">
   <img src="{{asset('assets/frontend/assets/images/home/brand-name/gucci.png')}}" class="w-36 h-[50%]" alt="">
   <img src="{{asset('assets/frontend/assets/images/home/brand-name/prada.png')}}" class="w-36 h-[50%]" alt="">
   <img src="{{asset('assets/frontend/assets/images/home/brand-name/calvin-klein.png')}}" class="w-36 h-[50%]" alt="">
</div>



<!-- New Arrival Section -->
<div class="new-arrival-parent">
   <div class="my-10">
      <h2 class="text-5xl text-center">New Arrival</h2>
   </div>

   <!-- New Arrival Card -->
   <div class="row grid grid-cols-2 px-20 lg:grid-cols-4 gap-10 lg:px-20 my-4">

      <div class="card-container">
         <div class="card bg-[#F0EEED] shadow-xl h-40 lg:h-80 flex items-center justify-center">
            <img src="{{asset('assets/frontend/assets/images/home/products/new-arrivals/Tshirt.png')}}" alt="Shoes" class="rounded-xl h-72" />
         </div>
         <div class="my-6">
            <a href="#" class="font-normal text-lg text-gray-500 hover:text-black lg:font-bold mb-2">T-SHIRT WITH TAPE DETAILS!</a>
            <div class="grid grid-cols-2 gap-3">
               <div class="rating mb-2">
                  <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" checked />
                  <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
               </div>
               <div>
                  <p>2/5</p>
               </div>
            </div>
            <p class="font-bold">$120</p>
         </div>
      </div>

      <div class="card-container">
         <div class="card bg-[#F0EEED] shadow-xl h-40 lg:h-80  flex items-center justify-center">
            <img src="{{asset('assets/frontend/assets/images/home/products/new-arrivals/Pant.png')}}" alt="Shoes" class="rounded-xl h-72" />
         </div>
         <div class="my-6">
            <a href="#" class="font-normal text-lg text-gray-500 hover:text-black lg:font-bold mb-2">SKINNY FIT JEANS</a>
            <div class="grid grid-cols-2 gap-3">
               <div class="rating mb-2">
                  <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" checked />
                  <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
               </div>
               <div>
                  <p>3/5</p>
               </div>
            </div>
            <p class="font-bold">$240 <del class="text-gray-600 ml-3">$190</del></p>
         </div>
      </div>


      <div class="card-container">
         <div class="card bg-[#F0EEED] shadow-xl h-40 lg:h-80 flex items-center justify-center">
            <img src="{{asset('assets/frontend/assets/images/home/products/new-arrivals/Shirt.png')}}" alt="Shoes" class="rounded-xl h-72" />
         </div>
         <div class="my-6">
            <a href="#" class="font-normal text-lg text-gray-500 hover:text-black lg:font-bold mb-2">CHECKERED SHIRT</a>
            <div class="grid grid-cols-2 gap-3">
               <div class="rating mb-2">
                  <input type="radio" name="rating-3" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-3" class="mask mask-star-2 bg-orange-400" checked />
                  <input type="radio" name="rating-3" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-3" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-3" class="mask mask-star-2 bg-orange-400" />
               </div>
               <div>
                  <p>2/5</p>
               </div>
            </div>
            <p class="font-bold">$180</p>
         </div>
      </div>

      <div class="card-container">
         <div class="card bg-[#F0EEED] shadow-xl h-40 lg:h-80  flex items-center justify-center">
            <img src="{{asset('assets/frontend/assets/images/home/products/new-arrivals/Tshirt1.png')}}" alt="Shoes" class="rounded-xl h-72" />
         </div>
         <div class="my-6">
            <a href="#" class="font-normal text-lg text-gray-500 hover:text-black lg:font-bold mb-2">SLEEVE STRIPED T-SHIRT</a>
            <div class="grid grid-cols-2 gap-3">
               <div class="rating mb-2">
                  <input type="radio" name="rating-4" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-4" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-4" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-4" class="mask mask-star-2 bg-orange-400" checked />
                  <input type="radio" name="rating-4" class="mask mask-star-2 bg-orange-400" />
               </div>
               <div>
                  <p>4/5</p>
               </div>
            </div>
            <p class="font-bold">$130 <del class="text-gray-600 ml-3">$110</del></p>
         </div>
      </div>
   </div>

   <div class="my-2 text-center">
      <button class="btn rounded-xl w-40">View All</button>
   </div>
</div>


<hr class="border border-[#F0EEED] lg:px-20 w-10/12 mx-auto my-10">

<!-- Top Selling Section -->
<div class="top-selling-parent">
   <div class="my-10">
      <h2 class="text-5xl text-center">TOP SELLING</h2>
   </div>

   <!-- Top Selling Card -->
   <div class="row grid grid-cols-2 px-20 lg:grid-cols-4 gap-10 lg:px-20 my-4">

      <div class="card-container">
         <div class="card bg-[#F0EEED] shadow-xl h-40 lg:h-80 flex items-center justify-center">
            <img src="{{asset('assets/frontend/assets/images/home/products/top-selling/Shirt.png')}}" alt="Shoes" class="rounded-xl h-72" />
         </div>
         <div class="my-6">
            <a href="#" class="font-normal text-lg text-gray-500 hover:text-black lg:font-bold mb-2">VERTICAL STRIPED SHIRT</a>
            <div class="grid grid-cols-2 gap-3">
               <div class="rating mb-2">
                  <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" checked />
                  <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
               </div>
               <div>
                  <p>2/5</p>
               </div>
            </div>
            <p class="font-bold">$212</p>
         </div>
      </div>

      <div class="card-container">
         <div class="card bg-[#F0EEED] shadow-xl h-40 lg:h-80 flex items-center justify-center">
            <img src="{{asset('assets/frontend/assets/images/home/products/top-selling/Tshirt.png')}}" alt="Shoes" class="rounded-xl h-72" />
         </div>
         <div class="my-6">
            <a href="#" class="font-normal text-lg text-gray-500 hover:text-black lg:font-bold mb-2">COURAGE GRAPHIC T-SHIRT</a>
            <div class="grid grid-cols-2 gap-3">
               <div class="rating mb-2">
                  <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" checked />
                  <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
               </div>
               <div>
                  <p>3/5</p>
               </div>
            </div>
            <p class="font-bold">$140 <del class="text-gray-600 ml-3">$190</del></p>
         </div>
      </div>


      <div class="card-container">
         <div class="card bg-[#F0EEED] shadow-xl h-40 lg:h-80 flex items-center justify-center">
            <img src="{{asset('assets/frontend/assets/images/home/products/top-selling/Half-pant.png')}}" alt="Shoes" class="rounded-xl h-72" />
         </div>
         <div class="my-6">
            <a href="#" class="font-normal text-lg text-gray-500 hover:text-black lg:font-bold mb-2">LOOSE FIT BERMUDA SHORTS</a>
            <div class="grid grid-cols-2 gap-3">
               <div class="rating mb-2">
                  <input type="radio" name="rating-3" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-3" class="mask mask-star-2 bg-orange-400" checked />
                  <input type="radio" name="rating-3" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-3" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-3" class="mask mask-star-2 bg-orange-400" />
               </div>
               <div>
                  <p>2/5</p>
               </div>
            </div>
            <p class="font-bold">$180</p>
         </div>
      </div>

      <div class="card-container">
         <div class="card bg-[#F0EEED] shadow-xl h-40 lg:h-80 flex items-center justify-center">
            <img src="{{asset('assets/frontend/assets/images/home/products/top-selling/Pant.png')}}" alt="Shoes" class="rounded-xl h-72" />
         </div>
         <div class="my-6">
            <a href="#" class="font-normal text-lg text-gray-500 hover:text-black lg:font-bold mb-2">FADED SKINNY JEANS</a>
            <div class="grid grid-cols-2 gap-3">
               <div class="rating mb-2">
                  <input type="radio" name="rating-4" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-4" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-4" class="mask mask-star-2 bg-orange-400" />
                  <input type="radio" name="rating-4" class="mask mask-star-2 bg-orange-400" checked />
                  <input type="radio" name="rating-4" class="mask mask-star-2 bg-orange-400" />
               </div>
               <div>
                  <p>4/5</p>
               </div>
            </div>
            <p class="font-bold">$130 <del class="text-gray-600 ml-3">$110</del></p>
         </div>
      </div>
   </div>

   <div class="my-2 text-center">
      <button class="btn rounded-xl w-40">View All</button>
   </div>
</div>

<!-- Browse by Dress Style -->
<div class="dress-style mt-8 lg:px-20 lg:py-8 bg-[#F0EEED] rounded-xl mx-auto w-11/12 ">
   <div class="">
      <h2 class="text-5xl font-extrabold text-center p-6">BROWSE BY DRESS STYLE</h2>
   </div>
   <div class="grid lg:grid-cols-12 h-80 lg:h-72 gap-4 overflow-hidden  p-3">
      <!-- <div class="casual lg:col-span-5 bg-white bg-no-repeat bg-right rounded-xl"
                    style="background-image: url('{{asset("assets/frontend/assets/images/home/dress-style/CasualCrop.png")}}')">
                    <p class="text-2xl p-8 font-bold">Casual</p>
                </div> -->
      <div class="casual lg:col-span-5 bg-white bg-no-repeat bg-right rounded-xl bg-[url('{{ asset('assets/frontend/assets/images/home/dress-style/CasualCrop.png') }}')]">
         <p class="text-2xl p-8 font-bold">Casual</p>
      </div>
      <div class="formal lg:col-span-7 bg-white bg-right bg-no-repeat rounded-xl bg-[url('{{ asset('assets/frontend/assets/images/home/dress-style/FormalCrop.png') }}')]">
         <p class="text-2xl p-8 font-bold">Formal</p>
      </div>
   </div>
   <div class="grid lg:grid-cols-12 h-80 lg:h-72 gap-4 overflow-hidden p-3">
      <div class="casual lg:col-span-7 bg-white bg-no-repeat bg-left rounded-xl bg-[url('{{ asset('assets/frontend/assets/images/home/dress-style/party.png') }}')]">
         <p class="text-2xl p-8 font-bold">Party</p>
      </div>
      <div class="formal lg:col-span-5 bg-white bg-left bg-no-repeat rounded-xl bg-[url('{{ asset('assets/frontend/assets/images/home/dress-style/gym.png') }}')]">
         <p class="text-2xl p-8 font-bold">Gym</p>
      </div>
   </div>
</div>

<!-- Our Happy Customer -->
<div class="happy-customer  lg:my-10 my-8  lg:px-14 px-8 lg:mb-60  ">
   <h2 class="text-3xl font-bold my-4">OUR HAPPY CUSTOMERS</h2>
   <div class="card w-96 bg-green-50 shadow-xl">
      <div class="card-body">
         <div class="grid grid-cols-2 gap-3">
            <div class="rating mb-2">
               <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
               <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
               <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
               <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
               <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
               <input type="radio" name="rating-1" class="mask mask-star-2 bg-orange-400" />
            </div>
         </div>
         <h2 class="card-title">John Doe</h2>
         <p>"This footer design showcases a sleek and organized layout, featuring a visually appealing combination of elements and responsive design for an optimal user experience."</p>
      </div>
   </div>
</div>
@endsection