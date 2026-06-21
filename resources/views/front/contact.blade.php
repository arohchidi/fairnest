@extends('layouts.app')

@section('title', 'Contact Us')
@section('description', 'Get in touch with our team for any questions or support')

@section('content')
<div class="bg-gray-50 min-h-screen">
    
    <!-- ============================================ -->
    <!-- HERO SECTION -->
    <!-- ============================================ -->
    <section class="relative bg-gradient-to-r from-[#0A1928] via-[#0D2A3A] to-[#1B4D3E] py-20 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#2D6A4F]/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#1B4D3E]/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/5 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">
                Get In <span class="text-[#2D6A4F]">Touch</span>
            </h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Have questions? We'd love to hear from you. Our team is here to help.
            </p>
            <div class="flex flex-wrap justify-center gap-3 mt-6" data-aos="fade-up" data-aos-delay="200">
                <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/10">
                    <i class="fas fa-headset mr-2 text-[#2D6A4F]"></i> 24/7 Support
                </span>
                <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/10">
                    <i class="fas fa-clock mr-2 text-[#2D6A4F]"></i> Quick Response
                </span>
                <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/10">
                    <i class="fas fa-shield-alt mr-2 text-[#2D6A4F]"></i> Secure Communication
                </span>
            </div>
        </div>
    </section>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        
        <!-- ============================================ -->
        <!-- CONTACT INFO CARDS -->
        <!-- ============================================ -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12" data-aos="fade-up">
            
            <!-- Phone Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition group">
                <div class="w-16 h-16 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#2D6A4F] transition">
                    <i class="fas fa-phone-alt text-2xl text-[#2D6A4F] group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Phone</h3>
                <p class="text-gray-500 text-sm">Mon-Fri 9am-6pm</p>
                <a href="tel:+1234567890" class="text-[#2D6A4F] font-medium hover:underline">{{$settings['phone'] ?? ''}}</a>
            </div>
            
            <!-- Email Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition group">
                <div class="w-16 h-16 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#2D6A4F] transition">
                    <i class="fas fa-envelope text-2xl text-[#2D6A4F] group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Email</h3>
                <p class="text-gray-500 text-sm">We'll respond within 24hrs</p>
                <a href="mailto:{{$settings['email'] ?? ''}}" class="text-[#2D6A4F] font-medium hover:underline">{{$settings['email'] ?? ''}}</a>
            </div>
            
            <!-- Address Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition group">
                <div class="w-16 h-16 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#2D6A4F] transition">
                    <i class="fas fa-map-marker-alt text-2xl text-[#2D6A4F] group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Address</h3>
                <p class="text-gray-500 text-sm">Visit our office</p>
                <p class="text-[#2D6A4F] font-medium">{{$settings['address'] ?? ''}}</p>
            </div>
        </div>
        
        <!-- ============================================ -->
        <!-- CONTACT FORM & MAP -->
        <!-- ============================================ -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8" data-aos="fade-right">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Send Us a Message</h2>
                <p class="text-gray-500 mb-6">Fill in the form below and we'll get back to you as soon as possible.</p>
                
                <form method="POST" action="{{route('store.feedback')}}" class="space-y-5">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                   placeholder="John Doe">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                   placeholder="john@example.com">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Subject <span class="text-red-500">*</span>
                        </label>
                        <select name="feedback_type" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition">
                            <option value="">Select a subject</option>
                            <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                            <option value="booking" {{ old('subject') == 'booking' ? 'selected' : '' }}>Booking Support</option>
                            <option value="property" {{ old('subject') == 'property' ? 'selected' : '' }}>Property Question</option>
                            <option value="payment" {{ old('subject') == 'payment' ? 'selected' : '' }}>Payment Issue</option>
                            <option value="technical" {{ old('subject') == 'technical' ? 'selected' : '' }}>Technical Support</option>
                            <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                            <option value="complain" {{ old('subject') == 'complain' ? 'selected' : '' }}>Complain</option>
                        </select>
                        @error('subject')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                     <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                   placeholder="Subject">
                            @error('subject')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Message <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" rows="5" required
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                  placeholder="Describe your question or concern in detail...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="w-full py-3 bg-[#2D6A4F] text-white rounded-xl font-semibold hover:bg-[#1B4D3E] transition hover:shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i> Send Message
                    </button>
                </form>
            </div>
            
            <!-- Map & Quick Info -->
            <div class="space-y-6" data-aos="fade-left">
                <!-- Map -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden h-[300px] md:h-[400px]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a316bb7fbb5%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1644262070686!5m2!1sen!2sus"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        title="Office Location">
                    </iframe>
                </div>
                
                <!-- Quick Contact Info -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Contact</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-[#2D6A4F]"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Working Hours</p>
                                <p class="text-sm font-medium text-gray-800">Mon-Fri: 9:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-globe text-[#2D6A4F]"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Website</p>
                                <a href="{{ route('home') }}" class="text-sm font-medium text-[#2D6A4F] hover:underline">{{ config('app.name') }}</a>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-shield-alt text-[#2D6A4F]"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Secure</p>
                                <p class="text-sm font-medium text-gray-800">SSL Encrypted</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ============================================ -->
        <!-- FAQ SECTION -->
        <!-- ============================================ -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-12" data-aos="fade-up">
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                    Frequently Asked <span class="text-[#2D6A4F]">Questions</span>
                </h2>
                <p class="text-gray-500">Quick answers to common questions</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="border border-gray-100 rounded-xl p-4 hover:border-[#2D6A4F] transition">
                        <h4 class="font-semibold text-gray-800 mb-1">How do I book a property?</h4>
                        <p class="text-sm text-gray-500">Simply browse our properties, select your dates, and click "Book Now". You'll receive confirmation instantly.</p>
                    </div>
                    <div class="border border-gray-100 rounded-xl p-4 hover:border-[#2D6A4F] transition">
                        <h4 class="font-semibold text-gray-800 mb-1">Is my payment secure?</h4>
                        <p class="text-sm text-gray-500">Yes! We use industry-standard SSL encryption and secure payment gateways to protect your information.</p>
                    </div>
                    <div class="border border-gray-100 rounded-xl p-4 hover:border-[#2D6A4F] transition">
                        <h4 class="font-semibold text-gray-800 mb-1">What is your cancellation policy?</h4>
                        <p class="text-sm text-gray-500">Cancellation policies vary by property. Please check the specific policy before booking.</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="border border-gray-100 rounded-xl p-4 hover:border-[#2D6A4F] transition">
                        <h4 class="font-semibold text-gray-800 mb-1">How do I contact the host?</h4>
                        <p class="text-sm text-gray-500">After booking, you'll be able to message the host directly through our platform.</p>
                    </div>
                    <div class="border border-gray-100 rounded-xl p-4 hover:border-[#2D6A4F] transition">
                        <h4 class="font-semibold text-gray-800 mb-1">Can I list my property?</h4>
                        <p class="text-sm text-gray-500">Yes! Register as a landlord and follow our simple listing process to showcase your property.</p>
                    </div>
                    <div class="border border-gray-100 rounded-xl p-4 hover:border-[#2D6A4F] transition">
                        <h4 class="font-semibold text-gray-800 mb-1">What if I need help?</h4>
                        <p class="text-sm text-gray-500">Our support team is available 24/7. Contact us via phone, email, or the contact form above.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-6">
                <a href="{{ url('faq') }}" class="text-[#2D6A4F] font-medium hover:underline">
                    View All FAQs <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <!-- ============================================ -->
        <!-- SOCIAL MEDIA SECTION -->
        <!-- ============================================ -->
        <div class="bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] rounded-2xl shadow-lg p-8 text-center text-white mb-12" data-aos="fade-up">
            <h3 class="text-2xl font-bold mb-3">Connect With Us</h3>
            <p class="text-gray-300 mb-6">Follow us on social media for updates and news</p>
            <div class="flex justify-center space-x-4">
                <a href="{{$settings['facebook_url'] ?? ''}}" class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/20 transition hover:scale-110">
                    <i class="fab fa-facebook-f text-xl"></i>
                </a>
                <a href="{{$settings['twitter_url'] ?? ''}}" class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/20 transition hover:scale-110">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="{{$settings['instagram_url'] ?? ''}}" class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/20 transition hover:scale-110">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="{{$settings['linkedin_url'] ?? ''}}" class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/20 transition hover:scale-110">
                    <i class="fab fa-linkedin-in text-xl"></i>
                </a>
                <a href="{{$settings['youtube_url'] ?? ''}}" class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/20 transition hover:scale-110">
                    <i class="fab fa-youtube text-xl"></i>
                </a>
            </div>
        </div>
        
        <!-- ============================================ -->
        <!-- CTA SECTION -->
        <!-- ============================================ -->
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center mb-12 border border-gray-100" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Start Your Journey Today</h3>
            <p class="text-gray-500 mb-6">Explore our properties and find your dream home</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('property.listings') }}" class="px-6 py-3 bg-[#2D6A4F] text-white rounded-xl font-semibold hover:bg-[#1B4D3E] transition hover:shadow-lg">
                    <i class="fas fa-search mr-2"></i> Browse Properties
                </a>
               
            </div>
        </div>
    </div>
</div>
@include('components.footer')
@push('styles')
<style>
    /* Smooth hover transitions */
    .group {
        transition: all 0.3s ease;
    }
    
    /* Form focus styles */
    input:focus, select:focus, textarea:focus {
        outline: none;
    }
    
    /* Map container */
    .map-container {
        position: relative;
        overflow: hidden;
    }
</style>
@endpush
@endsection