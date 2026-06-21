<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Find Your Perfect Property</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        .hero-slider {
            position: relative;
            height: 100vh;
            min-height: 700px;
            overflow: hidden;
        }
        
        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            background-size: cover;
            background-position: center;
        }
        
        .slide.active { opacity: 1; }
        
        .slide-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(10, 25, 40, 0.75) 0%, rgba(10, 25, 40, 0.4) 100%);
        }
        
        .slide-content {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            height: 100%;
        }
        
        .slider-dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            display: flex;
            gap: 12px;
        }
        
        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .slider-dot.active {
            background: #2D6A4F;
            border-color: #fff;
            transform: scale(1.2);
        }
        
        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 20;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .slider-arrow:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-50%) scale(1.1);
        }
        
        .slider-arrow.prev { left: 20px; }
        .slider-arrow.next { right: 20px; }
        
        .search-section { margin-top: -60px; position: relative; z-index: 30; }
        
        .search-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }
        
        .section-bg {
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .section-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(10, 25, 40, 0.75);
        }
        
        .section-content { position: relative; z-index: 10; }
        
        .property-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        
        .property-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }
        
        .property-card .property-img {
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .property-card:hover .property-img { transform: scale(1.08); }
        
        .gradient-text {
            background: linear-gradient(135deg, #2D6A4F, #1B4D3E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #2D6A4F, #1B4D3E);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(45, 106, 79, 0.4);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: #2D6A4F;
        }
        
        .advantage-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .advantage-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .testimonial-card {
            transition: all 0.4s ease;
        }
        
        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }
        
        .about-image {
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }
        
        @media (max-width: 768px) {
            .stat-number { font-size: 2rem; }
            .slider-arrow { display: none; }
        }
    </style>
</head>
<body>

    <!-- ============================================ -->
    <!-- NAVIGATION -->
    <!-- ============================================ -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md shadow-sm border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-building text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">{{ config('app.name') }}</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-[#2D6A4F] transition font-medium">Home</a>
                    <a href="#properties" class="text-gray-600 hover:text-[#2D6A4F] transition font-medium">Properties</a>
                    <a href="#about" class="text-gray-600 hover:text-[#2D6A4F] transition font-medium">About</a>
                    <a href="#contact" class="text-gray-600 hover:text-[#2D6A4F] transition font-medium">Contact</a>
                    <a href="{{ route('login') }}" class="text-[#2D6A4F] hover:bg-[#2D6A4F]/10 px-4 py-2 rounded-lg transition font-medium">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-primary px-6 py-2 text-white rounded-lg font-medium">List Property</a>
                </div>
                
                <button id="mobileMenuBtn" class="md:hidden text-gray-600 hover:text-[#2D6A4F] transition">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
        
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100 py-4 px-4 space-y-2">
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">Home</a>
            <a href="#properties" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">Properties</a>
            <a href="#about" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">About</a>
            <a href="#contact" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">Contact</a>
            <div class="pt-2 border-t border-gray-100 space-y-2">
                <a href="{{ route('login') }}" class="block px-4 py-2 text-center text-[#2D6A4F] font-medium">Sign In</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-center bg-[#2D6A4F] text-white rounded-lg font-medium">List Property</a>
            </div>
        </div>
    </nav>

    <!-- ============================================ -->
    <!-- HERO SLIDER -->
    <!-- ============================================ -->
    <section class="hero-slider" id="heroSlider">
        
        <!-- Slide 1 -->
        <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1600&h=900&fit=crop');">
            <div class="slide-overlay"></div>
            <div class="slide-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl text-white">
                    <span class="inline-block px-4 py-1 bg-[#2D6A4F] text-sm font-semibold rounded-full mb-6">Luxury Living</span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Find Your Dream <br><span class="text-[#2D6A4F]">Property</span> Today
                    </h1>
                    <p class="text-lg text-gray-200 mb-8 leading-relaxed">
                        Discover premium properties in the most desirable locations. From cozy apartments to luxury villas.
                    </p>
                    <a href="#properties" class="inline-flex items-center px-8 py-4 bg-[#2D6A4F] text-white rounded-xl font-semibold hover:bg-[#1B4D3E] transition">
                        Explore Properties <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Slide 2 -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=1600&h=900&fit=crop');">
            <div class="slide-overlay"></div>
            <div class="slide-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl text-white">
                    <span class="inline-block px-4 py-1 bg-yellow-500 text-sm font-semibold rounded-full mb-6">Beachfront</span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Wake Up To <br><span class="text-yellow-400">Ocean Views</span>
                    </h1>
                    <p class="text-lg text-gray-200 mb-8 leading-relaxed">
                        Experience the ultimate beachfront lifestyle with our handpicked selection of coastal properties.
                    </p>
                    <a href="#properties" class="inline-flex items-center px-8 py-4 bg-yellow-500 text-white rounded-xl font-semibold hover:bg-yellow-600 transition">
                        View Beach Houses <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Slide 3 -->
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=1600&h=900&fit=crop');">
            <div class="slide-overlay"></div>
            <div class="slide-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl text-white">
                    <span class="inline-block px-4 py-1 bg-blue-500 text-sm font-semibold rounded-full mb-6">Mountain Escape</span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Escape To <br><span class="text-blue-400">Nature</span>
                    </h1>
                    <p class="text-lg text-gray-200 mb-8 leading-relaxed">
                        Discover cozy cabins and mountain retreats surrounded by breathtaking natural beauty and fresh air.
                    </p>
                    <a href="#properties" class="inline-flex items-center px-8 py-4 bg-blue-500 text-white rounded-xl font-semibold hover:bg-blue-600 transition">
                        Explore Cabins <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="slider-dots" id="sliderDots">
            <span class="slider-dot active" data-slide="0"></span>
            <span class="slider-dot" data-slide="1"></span>
            <span class="slider-dot" data-slide="2"></span>
        </div>
        
        <button class="slider-arrow prev" id="prevSlide"><i class="fas fa-chevron-left text-xl"></i></button>
        <button class="slider-arrow next" id="nextSlide"><i class="fas fa-chevron-right text-xl"></i></button>
    </section>

    <!-- ============================================ -->
    <!-- SEARCH SECTION -->
    <!-- ============================================ -->
    <section class="search-section relative z-20 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <div class="search-box rounded-2xl p-6 md:p-8">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Search Properties</h3>
            <p class="text-gray-500 text-sm mb-6">Find your perfect home with our advanced search</p>
            
            <form class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" action="{{route('property.listings')}}" method="GET">
                @csrf
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input name="search" type="text" placeholder="Property name, Location" class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition">
                </div>
                <div class="relative">
                  <div class="relative">
                    <i class="fas fa-house absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <select name="type_of_house" class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] appearance-none bg-white">
                        <option value="">All Types</option>
                        <option value="apartment" {{ request('type_of_house') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="house" {{ request('type_of_house') == 'house' ? 'selected' : '' }}>House</option>
                        <option value="villa" {{ request('type_of_house') == 'villa' ? 'selected' : '' }}>Villa</option>
                        <option value="condo" {{ request('type_of_house') == 'condo' ? 'selected' : '' }}>Condo</option>
                        <option value="studio" {{ request('type_of_house') == 'studio' ? 'selected' : '' }}>Studio</option>
                    
                    </select>
                </div>
               
                </div>
                <div class="relative">
                    <i class="fas fa-naira-sign absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <select class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] appearance-none bg-white">
                        <option value="">Budget</option>
                           <option value="">Any Price</option>
                        <option value="100000,1000000" {{ request('rent_fee') == '1000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(100000))}} - {{App\Helper::formatNaira(number_format(1000000))}}</option>
                            <option value="2000000,5000000" {{ request('rent_fee') == '2000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(2000000))}} - {{App\Helper::formatNaira(number_format(5000000))}}</option>
                            <option value="6000000,10000000" {{ request('rent_fee') == '10000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(6000000))}} - {{App\Helper::formatNaira(number_format(10000000))}}</option>
                            <option value="11000000,49000000" {{ request('rent_fee') == '49000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(11000000))}} - {{App\Helper::formatNaira(number_format(49000000))}}</option>
                            <option value="50000000,100000000" {{ request('rent_fee') == '50000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(50000000))}}+</option>
                                 
                    </select>
                </div>
                <button type="submit" class="btn-primary text-white py-3 rounded-xl font-semibold flex items-center justify-center space-x-2">
                    <i class="fas fa-search"></i> <span>Search Now</span>
                </button>
            </form>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- STATS SECTION -->
    <!-- ============================================ -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div data-aos="fade-up" data-aos-delay="100">
                    <p class="stat-number text-4xl md:text-5xl font-bold text-[#2D6A4F]">10K+</p>
                    <p class="text-gray-500 text-sm mt-2">Happy Renters</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <p class="stat-number text-4xl md:text-5xl font-bold text-[#2D6A4F]">500+</p>
                    <p class="text-gray-500 text-sm mt-2">Properties Listed</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <p class="stat-number text-4xl md:text-5xl font-bold text-[#2D6A4F]">4.9★</p>
                    <p class="text-gray-500 text-sm mt-2">Average Rating</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="400">
                    <p class="stat-number text-4xl md:text-5xl font-bold text-[#2D6A4F]">98%</p>
                    <p class="text-gray-500 text-sm mt-2">Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- ABOUT US SECTION -->
    <!-- ============================================ -->
    <section id="about" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div data-aos="fade-right">
                    <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-[#2D6A4F]/10 px-4 py-1 rounded-full mb-4">About Us</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                        We Make Finding A Home <br>
                        <span class="gradient-text">Simple & Easy</span>
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ config('app.name') }} is a premium property rental platform designed to connect 
                        quality tenants with verified landlords. Our mission is to simplify the property 
                        search process and make renting a home a delightful experience.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Since our inception, we have helped thousands of individuals find their perfect 
                        homes across the globe. We pride ourselves on our transparent process, secure 
                        transactions, and exceptional customer service.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-[#2D6A4F]"></i>
                            <span class="text-sm text-gray-700">Verified Properties</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-[#2D6A4F]"></i>
                            <span class="text-sm text-gray-700">Secure Payments</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-[#2D6A4F]"></i>
                            <span class="text-sm text-gray-700">24/7 Support</span>
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center px-6 py-3 bg-[#2D6A4F] text-white rounded-xl font-semibold hover:bg-[#1B4D3E] transition mt-6">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-2 gap-4" data-aos="fade-left">
                    <div class="space-y-4">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&h=300&fit=crop" 
                             alt="Modern Apartment" class="rounded-2xl shadow-lg w-full h-48 object-cover">
                        <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=400&h=400&fit=crop" 
                             alt="Cozy Home" class="rounded-2xl shadow-lg w-full h-64 object-cover">
                    </div>
                    <div class="space-y-4 pt-8">
                        <img src="https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=400&h=400&fit=crop" 
                             alt="Luxury Villa" class="rounded-2xl shadow-lg w-full h-64 object-cover">
                        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=400&h=300&fit=crop" 
                             alt="Property" class="rounded-2xl shadow-lg w-full h-48 object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- ADVANTAGES SECTION -->
    <!-- ============================================ -->
    <section class="py-20 section-bg" style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1600&h=800&fit=crop');">
        <div class="section-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-white/90 backdrop-blur-sm px-4 py-1 rounded-full mb-4">
                    Why Choose Us
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    The Smartest Way To <br>
                    <span class="text-[#2D6A4F]">Find Your Home</span>
                </h2>
                <p class="text-gray-300 max-w-2xl mx-auto">
                    We make property rental simple, transparent, and hassle-free
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center advantage-card border border-white/10" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 mx-auto bg-[#2D6A4F]/20 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-search text-3xl text-[#2D6A4F]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Smart Search</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Our intelligent search algorithm helps you find the perfect property based on your preferences, budget, and lifestyle needs.
                    </p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center advantage-card border border-white/10" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 mx-auto bg-[#2D6A4F]/20 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-3xl text-[#2D6A4F]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Secure & Verified</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Every property and landlord is thoroughly verified. Your transactions are protected with industry-leading security.
                    </p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center advantage-card border border-white/10" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 mx-auto bg-[#2D6A4F]/20 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-headset text-3xl text-[#2D6A4F]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">24/7 Support</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Our dedicated support team is available around the clock to assist with any questions or concerns you may have.
                    </p>
                </div>
            </div>
        </div>
    </section>

   @include('components.featured-properties')
    <!-- ============================================ -->
    <!-- HOW WE WORK SECTION -->
    <!-- ============================================ -->
    <section class="py-20 section-bg" style="background-image: url('https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=1600&h=800&fit=crop');">
        <div class="section-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-white/90 backdrop-blur-sm px-4 py-1 rounded-full mb-4">
                    How We Work
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Rent In Just <span class="text-[#2D6A4F]">3 Steps</span>
                </h2>
                <p class="text-gray-300 max-w-2xl mx-auto">
                    We simplify the entire rental process from search to move-in
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                
                <div class="hidden md:block absolute top-24 left-0 right-0 h-0.5 bg-white/20"></div>
                
                <div class="text-center relative" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 mx-auto bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl flex items-center justify-center text-white text-3xl font-bold shadow-lg relative z-10">1</div>
                    <h3 class="text-xl font-bold text-white mt-6 mb-3">Search & Compare</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Browse through thousands of verified properties and compare options that match your criteria and budget. Use our advanced filters to narrow down your search.
                    </p>
                    <ul class="mt-4 text-left text-gray-300 text-sm space-y-2 max-w-xs mx-auto">
                        <li class="flex items-center space-x-2"><i class="fas fa-check-circle text-[#2D6A4F]"></i><span>Filter by location, price, type</span></li>
                        <li class="flex items-center space-x-2"><i class="fas fa-check-circle text-[#2D6A4F]"></i><span>View high-quality property images</span></li>
                        <li class="flex items-center space-x-2"><i class="fas fa-check-circle text-[#2D6A4F]"></i><span>Compare multiple properties</span></li>
                    </ul>
                </div>
                
                <div class="text-center relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 mx-auto bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl flex items-center justify-center text-white text-3xl font-bold shadow-lg relative z-10">2</div>
                    <h3 class="text-xl font-bold text-white mt-6 mb-3">Book & Secure</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Confirm your booking instantly with our secure payment system. Receive instant confirmation and connect with the property owner.
                    </p>
                    <ul class="mt-4 text-left text-gray-300 text-sm space-y-2 max-w-xs mx-auto">
                        <li class="flex items-center space-x-2"><i class="fas fa-check-circle text-[#2D6A4F]"></i><span>Secure payment processing</span></li>
                        <li class="flex items-center space-x-2"><i class="fas fa-check-circle text-[#2D6A4F]"></i><span>Instant booking confirmation</span></li>
                        <li class="flex items-center space-x-2"><i class="fas fa-check-circle text-[#2D6A4F]"></i><span>Direct owner communication</span></li>
                    </ul>
                </div>
                
                <div class="text-center relative" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 mx-auto bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl flex items-center justify-center text-white text-3xl font-bold shadow-lg relative z-10">3</div>
                    <h3 class="text-xl font-bold text-white mt-6 mb-3">Move In & Enjoy</h3>
                    <p class="text-gray-300 leading-relaxed">
                        Get ready to enjoy your new home. We handle all the details for a smooth and stress-free move-in experience.
                    </p>
                    <ul class="mt-4 text-left text-gray-300 text-sm space-y-2 max-w-xs mx-auto">
                        <li class="flex items-center space-x-2"><i class="fas fa-check-circle text-[#2D6A4F]"></i><span>Welcome guide & check-in details</span></li>
                        <li class="flex items-center space-x-2"><i class="fas fa-check-circle text-[#2D6A4F]"></i><span>24/7 emergency support</span></li>
                        <li class="flex items-center space-x-2"><i class="fas fa-check-circle text-[#2D6A4F]"></i><span>Review and rate your stay</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @include('components.latest-properties')

    <!-- ============================================ -->
    <!-- TESTIMONIALS SECTION -->
    <!-- ============================================ -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-[#2D6A4F]/10 px-4 py-1 rounded-full mb-4">
                    Testimonials
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    What Our <span class="gradient-text">Renters Say</span>
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto">
                    Real reviews from people who found their perfect home with us
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-gray-50 rounded-2xl p-8 testimonial-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        "I found the perfect apartment within days! The platform is incredibly easy to use and the support team is amazing. Highly recommended to anyone looking for a new home."
                    </p>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white font-bold">JD</div>
                        <div>
                            <p class="font-semibold text-gray-800">John Doe</p>
                            <p class="text-sm text-gray-500">New York, USA</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-2xl p-8 testimonial-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        "As a landlord, I've been able to find quality tenants quickly. The verification process gives me peace of mind. Excellent platform for property owners."
                    </p>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white font-bold">SM</div>
                        <div>
                            <p class="font-semibold text-gray-800">Sarah Miller</p>
                            <p class="text-sm text-gray-500">Los Angeles, USA</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-2xl p-8 testimonial-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        "I've used several rental platforms, but this one stands out for its user-friendly interface and high-quality property listings. Five stars all the way!"
                    </p>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white font-bold">JC</div>
                        <div>
                            <p class="font-semibold text-gray-800">James Carter</p>
                            <p class="text-sm text-gray-500">Miami, USA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- CTA SECTION -->
    <!-- ============================================ -->
    <section class="py-20 section-bg" style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1600&h=800&fit=crop');">
        <div class="section-content max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8" data-aos="zoom-in">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                Ready To Find Your <br>
                <span class="text-[#2D6A4F]">Dream Property?</span>
            </h2>
            <p class="text-lg text-gray-300 mb-10 max-w-2xl mx-auto">
                Join thousands of satisfied renters and landlords. Start your property journey today and discover the perfect place to call home.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#properties" class="px-10 py-4 bg-[#2D6A4F] text-white rounded-xl font-semibold hover:bg-[#1B4D3E] transition hover:scale-105">
                    <i class="fas fa-search mr-2"></i> Start Searching
                </a>
                <a href="#contact" class="px-10 py-4 bg-white/10 backdrop-blur-sm border border-white/20 text-white rounded-xl font-semibold hover:bg-white/20 transition hover:scale-105">
                    <i class="fas fa-phone mr-2"></i> Contact Support
                </a>
            </div>
        </div>
    </section>

   @include('components.footer')
   <!-- ============================================ -->
    <!-- SCRIPTS -->
    <!-- ============================================ -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 50 });
        
        // Mobile Menu
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
        
        // Hero Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        const totalSlides = slides.length;
        let slideInterval;
        
        function goToSlide(index) {
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            slides[index].classList.add('active');
            dots[index].classList.add('active');
            currentSlide = index;
        }
        
        function nextSlide() { goToSlide((currentSlide + 1) % totalSlides); }
        function prevSlide() { goToSlide((currentSlide - 1 + totalSlides) % totalSlides); }
        
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                clearInterval(slideInterval);
                goToSlide(index);
                startAutoSlide();
            });
        });
        
        document.getElementById('nextSlide').addEventListener('click', () => {
            clearInterval(slideInterval);
            nextSlide();
            startAutoSlide();
        });
        document.getElementById('prevSlide').addEventListener('click', () => {
            clearInterval(slideInterval);
            prevSlide();
            startAutoSlide();
        });
        
        function startAutoSlide() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 6000);
        }
        startAutoSlide();
        
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            nav.classList.toggle('shadow-md', window.scrollY > 50);
        });
    </script>


</body>
</html>