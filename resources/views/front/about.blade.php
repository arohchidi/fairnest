@extends('layouts.app')

@section('title', 'About Us')
@section('description', 'Learn about our mission, values, and the team behind our platform')

@section('content')
<div class="bg-white min-h-screen">
    
    <!-- ============================================ -->
    <!-- HERO SECTION -->
    <!-- ============================================ -->
    <section class="relative py-24 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-fixed" 
             style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1600&h=800&fit=crop');">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A1928]/90 via-[#0D2A3A]/80 to-[#1B4D3E]/70"></div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#2D6A4F]/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#1B4D3E]/20 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-white/10 backdrop-blur-sm px-4 py-1 rounded-full mb-4">
                About Us
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6" data-aos="fade-up">
                Your Trusted Partner in <br>
                <span class="text-[#2D6A4F]">Finding Home</span>
            </h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                We're on a mission to make finding your perfect home simple, transparent, and delightful.
            </p>
            <div class="flex flex-wrap justify-center gap-3 mt-6" data-aos="fade-up" data-aos-delay="200">
                <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/10">
                    <i class="fas fa-home mr-2 text-[#2D6A4F]"></i> 500+ Properties
                </span>
                <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/10">
                    <i class="fas fa-users mr-2 text-[#2D6A4F]"></i> 10K+ Happy Users
                </span>
                <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/10">
                    <i class="fas fa-star mr-2 text-[#2D6A4F]"></i> 4.9 Average Rating
                </span>
            </div>
        </div>
    </section>
    
    <!-- ============================================ -->
    <!-- OUR STORY SECTION -->
    <!-- ============================================ -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <div data-aos="fade-right">
                    <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-[#2D6A4F]/10 px-4 py-1 rounded-full mb-4">
                        Our Story
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                        Building Trust, One <br>
                        <span class="text-[#2D6A4F]">Property at a Time</span>
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        {{ config('app.name') }} was founded in 2020 with a simple vision: to make property rental 
                        as seamless and trustworthy as possible. We understand that finding a home is one of life's 
                        most important decisions.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        What started as a small team of passionate real estate enthusiasts has grown into a 
                        platform trusted by thousands of renters and landlords across the country.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Today, we continue to innovate and improve, always putting our users first and 
                        maintaining the highest standards of service and integrity.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 mt-6">
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
                            <span class="text-sm text-gray-700">Trusted Community</span>
                        </div>
                    </div>
                </div>
                
                <div class="relative" data-aos="fade-left">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&h=600&fit=crop" 
                             alt="Our Story" 
                             class="w-full h-[400px] object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1928]/30 to-transparent"></div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-[#2D6A4F] text-white p-4 rounded-2xl shadow-lg">
                        <p class="text-3xl font-bold">2020</p>
                        <p class="text-sm opacity-80">Founded</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ============================================ -->
    <!-- STATS SECTION WITH BACKGROUND -->
    <!-- ============================================ -->
    <section class="py-16 relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-fixed" 
             style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1600&h=800&fit=crop');">
            <div class="absolute inset-0 bg-[#0A1928]/85"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-4xl md:text-5xl font-bold text-[#2D6A4F]">500+</p>
                    <p class="text-gray-300 text-sm mt-2">Properties Listed</p>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-4xl md:text-5xl font-bold text-[#2D6A4F]">10K+</p>
                    <p class="text-gray-300 text-sm mt-2">Happy Renters</p>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <p class="text-4xl md:text-5xl font-bold text-[#2D6A4F]">4.9★</p>
                    <p class="text-gray-300 text-sm mt-2">Average Rating</p>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <p class="text-4xl md:text-5xl font-bold text-[#2D6A4F]">98%</p>
                    <p class="text-gray-300 text-sm mt-2">Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ============================================ -->
    <!-- MISSION & VALUES SECTION -->
    <!-- ============================================ -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-[#2D6A4F]/10 px-4 py-1 rounded-full mb-4">
                    Our Foundation
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    Mission, Vision & <span class="text-[#2D6A4F]">Values</span>
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto">
                    The principles that guide everything we do
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-2xl transition group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 mx-auto bg-[#2D6A4F]/10 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-[#2D6A4F] transition">
                        <i class="fas fa-bullseye text-3xl text-[#2D6A4F] group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Our Mission</h3>
                    <p class="text-gray-500 leading-relaxed">
                        To simplify the property rental experience by connecting quality tenants with verified landlords through a transparent and secure platform.
                    </p>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-2xl transition group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 mx-auto bg-[#2D6A4F]/10 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-[#2D6A4F] transition">
                        <i class="fas fa-eye text-3xl text-[#2D6A4F] group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Our Vision</h3>
                    <p class="text-gray-500 leading-relaxed">
                        To become the most trusted property rental platform globally, empowering people to find their perfect home with confidence and ease.
                    </p>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-2xl transition group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 mx-auto bg-[#2D6A4F]/10 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-[#2D6A4F] transition">
                        <i class="fas fa-heart text-3xl text-[#2D6A4F] group-hover:text-white transition"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Our Values</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Trust, transparency, innovation, and community. These core values guide everything we do and shape the experience we deliver.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ============================================ -->
    <!-- VALUES DETAILED SECTION WITH BACKGROUND -->
    <!-- ============================================ -->
    <section class="py-20 relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-fixed" 
             style="background-image: url('https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=1600&h=800&fit=crop');">
            <div class="absolute inset-0 bg-[#0A1928]/80"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-white/10 backdrop-blur-sm px-4 py-1 rounded-full mb-4">
                    What Makes Us Different
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Why Choose <span class="text-[#2D6A4F]">Us</span>
                </h2>
                <p class="text-gray-300 max-w-2xl mx-auto">
                    We go beyond just listings to create a complete and trustworthy rental experience
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/20 transition" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-[#2D6A4F]/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-shield-alt text-[#2D6A4F] text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Verified Properties</h4>
                            <p class="text-gray-300 text-sm">Every property is thoroughly verified to ensure accuracy and quality.</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/20 transition" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-[#2D6A4F]/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-lock text-[#2D6A4F] text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Secure Transactions</h4>
                            <p class="text-gray-300 text-sm">Your payments and personal information are protected with industry-leading security.</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/20 transition" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-[#2D6A4F]/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-headset text-[#2D6A4F] text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">24/7 Support</h4>
                            <p class="text-gray-300 text-sm">Our dedicated team is always available to help with any questions or concerns.</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/20 transition" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-[#2D6A4F]/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-users text-[#2D6A4F] text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Trusted Community</h4>
                            <p class="text-gray-300 text-sm">Join thousands of satisfied renters and landlords who trust our platform.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ============================================ -->
    <!-- TEAM SECTION -->
    <!-- ============================================ -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-[#2D6A4F]/10 px-4 py-1 rounded-full mb-4">
                    Our Team
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    The People Behind <span class="text-[#2D6A4F]">The Platform</span>
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto">
                    Passionate professionals dedicated to creating the best rental experience
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-gray-50 rounded-2xl overflow-hidden hover:shadow-xl transition group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=500&fit=crop" 
                             alt="Team Member" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1928]/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h4 class="text-xl font-bold text-white">John Smith</h4>
                            <p class="text-[#2D6A4F] text-sm font-medium">CEO & Founder</p>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <p class="text-sm text-gray-500">15+ years in real estate and technology</p>
                        <div class="flex justify-center space-x-3 mt-4">
                            <a href="#" class="text-gray-400 hover:text-[#2D6A4F] transition"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="text-gray-400 hover:text-[#2D6A4F] transition"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-2xl overflow-hidden hover:shadow-xl transition group" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=500&fit=crop" 
                             alt="Team Member" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1928]/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h4 class="text-xl font-bold text-white">Sarah Johnson</h4>
                            <p class="text-[#2D6A4F] text-sm font-medium">Head of Operations</p>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <p class="text-sm text-gray-500">Expert in property management and customer experience</p>
                        <div class="flex justify-center space-x-3 mt-4">
                            <a href="#" class="text-gray-400 hover:text-[#2D6A4F] transition"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="text-gray-400 hover:text-[#2D6A4F] transition"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-2xl overflow-hidden hover:shadow-xl transition group" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=500&fit=crop" 
                             alt="Team Member" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1928]/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h4 class="text-xl font-bold text-white">Michael Chen</h4>
                            <p class="text-[#2D6A4F] text-sm font-medium">Lead Developer</p>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <p class="text-sm text-gray-500">Building innovative solutions for the rental market</p>
                        <div class="flex justify-center space-x-3 mt-4">
                            <a href="#" class="text-gray-400 hover:text-[#2D6A4F] transition"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="text-gray-400 hover:text-[#2D6A4F] transition"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ============================================ -->
    <!-- TESTIMONIALS SECTION -->
    <!-- ============================================ -->
    <section class="py-20 relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-fixed" 
             style="background-image: url('https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=1600&h=800&fit=crop');">
            <div class="absolute inset-0 bg-[#0A1928]/85"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-white/10 backdrop-blur-sm px-4 py-1 rounded-full mb-4">
                    Testimonials
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    What Our <span class="text-[#2D6A4F]">Community Says</span>
                </h2>
                <p class="text-gray-300 max-w-2xl mx-auto">
                    Real stories from real people who found their home with us
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/20 transition" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex text-yellow-400 mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-200 text-sm leading-relaxed mb-4">
                        "I found the perfect apartment within days! The platform is incredibly easy to use and the support team is amazing. Highly recommended!"
                    </p>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-[#2D6A4F] rounded-full flex items-center justify-center text-white font-bold">
                            JD
                        </div>
                        <div>
                            <p class="font-semibold text-white">John Doe</p>
                            <p class="text-sm text-gray-400">New York, USA</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/20 transition" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex text-yellow-400 mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-200 text-sm leading-relaxed mb-4">
                        "As a landlord, I've been able to find quality tenants quickly. The verification process gives me peace of mind. Excellent platform!"
                    </p>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-[#2D6A4F] rounded-full flex items-center justify-center text-white font-bold">
                            SM
                        </div>
                        <div>
                            <p class="font-semibold text-white">Sarah Miller</p>
                            <p class="text-sm text-gray-400">Los Angeles, USA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ============================================ -->
    <!-- CTA SECTION -->
    <!-- ============================================ -->
    <section class="py-16 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">Ready to Find Your Dream Home?</h2>
            <p class="text-gray-500 mb-6">Join thousands of happy renters and start your property search today.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('property.listings') }}" class="px-6 py-3 bg-[#2D6A4F] text-white rounded-xl font-semibold hover:bg-[#1B4D3E] transition hover:shadow-lg">
                    <i class="fas fa-search mr-2"></i> Browse Properties
                </a>
                <a href="{{ route('register') }}" class="px-6 py-3 border border-[#2D6A4F] text-[#2D6A4F] rounded-xl font-semibold hover:bg-[#2D6A4F] hover:text-white transition">
                    <i class="fas fa-user-plus mr-2"></i> Get Started
                </a>
            </div>
        </div>
    </section>
</div>
@include('components.footer')
@push('styles')
<style>
    /* Smooth transitions */
    .group {
        transition: all 0.3s ease;
    }
    
    .group-hover\:scale-110 {
        transition: transform 0.5s ease;
    }
    
    /* Fixed background images */
    .bg-fixed {
        background-attachment: fixed;
    }
    
    /* Glass morphism */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }
</style>
@endpush
@endsection