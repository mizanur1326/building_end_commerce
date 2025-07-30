<header>
        <!-- Top Discount Bar -->
        <div class="">
            <p class="text-white bg-black flex items-center justify-center p-2 text-sm satisfy">
                Sign up and get 20% off to your first order. Sign Up Now
            </p>
        </div>
        <!-- Nav Bar -->
        <div>
            <div class="navbar bg-base-100 px-8 lg:px-20">
                <div class="navbar-start">
                    <div class="dropdown">
                        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a href="{{ route( 'home') }}">Home</a></li>
                            <li><a href="/category.html">Category</a></li>
                            <li><a href="/productDetails.html">Product Details</a></li>
                            <li><a href="/cart.html">Cart</a></li>
                        </ul>
                    </div>
                    <a href="{{ route( 'home') }}" class="text-2xl lg:text-3xl">ShopUp</a>
                </div>

                <div class="navbar-center hidden lg:flex">
                    <ul class="menu menu-horizontal px-1 lg:text-sm">
                        <li><a href="/index.html">Home</a></li>
                        <li><a href="/category.html">Category</a></li>
                        <li><a href="/productDetails.html">Product Details</a></li>
                        <li><a href="/cart.html">Cart</a></li>
                    </ul>
                </div>

                <div class="navbar-end">
                    <!-- <div class="relative flex items-center hidden lg:block">
             <i class="fa fa-search absolute ml-3" aria-hidden="true"></i>
            <input type="search" name="search" placeholder="Search Products" class="bg-gray-500 text-white pl-10 rounded-2xl border-none" id=""> 
           </div> -->

                    <div class="lg:relative flex items-center">
                        <i class="fa fa-search lg:absolute ml-3 inset-y-0 left-0 flex items-center justify-center"
                            aria-hidden="true"></i>
                        <input type="search" name="search" placeholder="Search Products"
                            class="bg-slate-200 text-white pl-10 lg:pl-12 pr-4 py-2 rounded-2xl border-none hidden lg:block" id="">
                    </div>

                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="badge badge-sm indicator-item">8</span>
                            </div>
                        </div>
                        <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
                            <div class="card-body">
                                <span class="font-bold text-lg">8 Items</span>
                                <span class="text-info">Subtotal: $999</span>
                                <div class="card-actions">
                                    <button class="btn btn-primary btn-block">View cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-ghost btn-circle">
                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="badge badge-xs badge-primary indicator-item"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </header>