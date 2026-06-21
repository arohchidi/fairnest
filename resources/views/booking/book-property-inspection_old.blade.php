<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description', 'Find your perfect rental property')">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
    
    @stack('styles')
</head>
@extends('layouts.frontend')
@section('title', 'Complete Your Booking')
@section('description', 'Secure your perfect stay')

@section('content')

<body class="bg-gray-50">
    @include('components.header')
<div class="bg-white min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4">
        
        <!-- Progress Stepper -->
        <div class="mb-8">
            <div class="flex items-center justify-between max-w-2xl mx-auto">
                <div class="flex-1 text-center">
                    <div class="w-10 h-10 mx-auto bg-[#2D6A4F] text-white rounded-full flex items-center justify-center font-bold">1</div>
                    <p class="text-sm font-medium text-gray-700 mt-2">Select Property</p>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200"></div>
                <div class="flex-1 text-center">
                    <div class="w-10 h-10 mx-auto bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold">2</div>
                    <p class="text-sm font-medium text-gray-500 mt-2">Your Details</p>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200"></div>
                <!--<div class="flex-1 text-center">
                    <div class="w-10 h-10 mx-auto bg-gray-200 text-gray-500 rounded-full flex items-center justify-center font-bold">3</div>
                    <p class="text-sm font-medium text-gray-500 mt-2">Payment</p>
                </div>-->
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Main Form Column -->
            <div class="lg:col-span-2">
                <form method="POST" action="{{ route('store.booking') }}" class="space-y-6" id="bookingForm">
                    @csrf
                    
    <!-- Property Selection Card -->
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
        <div class="flex items-center">
            <i class="fas fa-building text-[#2D6A4F] mr-2"></i>
            <h3 class="font-semibold text-gray-800">Select Property</h3>
        </div>
    </div>
    <div class="p-6">
        <div class="space-y-3">
           
            <label class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer transition-all hover:border-gray-300 {{ old('property_id') == $property->id ? 'border-[#2D6A4F] bg-[#2D6A4F]/5' : 'border-gray-200' }}">
                <input type="radio" name="property_id" value="{{ $property->id }}" 
                       class="absolute opacity-0"
                       checked>
                <div class="flex-1 flex items-center justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $property->title }}</h4>
                         <p class="text-sm text-gray-500 mt-0.5">
                          <i class="fas fa-home text-[#2D6A4F] text-xs mr-1"></i>
                         {{$property->type_of_house}}
                         </p>
                        <p class="text-sm text-gray-500 mt-0.5">
                            <i class="fas fa-map-marker-alt text-[#2D6A4F] text-xs mr-1"></i>
                             {{ $property->address }},  {{ $property->city }}, {{ $property->country }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-[#2D6A4F]">{{App\Helper::formatNaira(number_format($property->rent_fee, 2))}}</p>
                        <p class="text-xs text-gray-400">Rent</p>
                    </div>
                </div>
                <div class="ml-4 w-5 h-5 rounded-full border-2 {{ old('property_id') == $property->id ? 'border-[#2D6A4F] bg-[#2D6A4F]' : 'border-gray-300' }} flex items-center justify-center">
                    @if(old('property_id') == $property->id)
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </div>
            </label>
            
        </div>
        @error('property_id')
            <p class="text-red-500 text-xs mt-3">{{ $message }}</p>
        @enderror
    </div>
</div>
                    <!-- Travel Dates & Guests Card -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt text-[#2D6A4F] mr-2"></i>
                                <h3 class="font-semibold text-gray-800">Inspection Date Details</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Book a Date <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-calendar-check text-gray-400"></i>
                                        </div>
                                       
                                   <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" required
       min="{{ date('Y-m-d') }}"
       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                                    </div>
                                    @error('booking_date')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                             
                            
                          
                            </div>
                         
                        
                        </div>
                    </div>
                    
                    <!-- Guest Information Card -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle text-[#2D6A4F] mr-2"></i>
                                <h3 class="font-semibold text-gray-800">Guest Information</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                           placeholder="John Doe">
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                           placeholder="john@example.com">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number <span class="text-red-500">*</span></label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                           placeholder="+1 234 567 8900">
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email_confirmation" value="{{ old('email_confirmation') }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                           placeholder="Confirm your email">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Roommate Section (Advanced) -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-user-friends text-[#2D6A4F] mr-2"></i>
                                    <h3 class="font-semibold text-gray-800">Roommate Information</h3>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="needs_roommate" id="needsRoommate" value="1" 
                                           class="sr-only peer" {{ old('needs_roommate') ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-[#2D6A4F] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-700" id="roommateToggleLabel">Add Roommate</span>
                                </label>
                            </div>
                        </div>
                        
                        <div id="roommateFields" class="p-6 space-y-5 {{ old('needs_roommate') ? '' : 'hidden' }}">
                            <div class="bg-blue-50 rounded-xl p-4 mb-2">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                                    <div>
                                        <p class="text-sm font-medium text-blue-800">Sharing this booking?</p>
                                        <p class="text-xs text-blue-700 mt-1">Adding a roommate helps us ensure both guests receive booking confirmations and updates.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                           
                                        </div>
                                        <select name="roommate_gender" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent appearance-none bg-white" >
                                        <option value="">Select Gender</option>
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                        
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                        </div>
                                        <input type="number" name="roommate_age" id="roommate_age" value="{{ old('roommate_age') }}"
                                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                               placeholder="21">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">School Level</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            
                                        </div>
                                         <select name="roommate_level" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent appearance-none bg-white" >
                                        <option value="">Select Schoo Level</option>
                                        <option value="100">100 Level</option>
                                        <option value="200">200 Level</option>
                                        <option value="300">300 Level</option>
                                        <option value="400">400 Level</option>
                                        <option value="500">500 Level</option>
                                        <option value="600">600 Level</option>
                                        
                                        </select>
                                    </div>


                                    
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Religion</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-calendar-alt text-gray-400 text-sm"></i>
                                        </div>
                                        <select name="religion" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent appearance-none bg-white" >
                                        <option value="">Choose Religion</option>
                                        <option value="christianity">Christianity</option>
                                        <option value="muslim">Muslim</option>
                                        <option value="tradintional african worshipper">Tradintional African Worshipper</option>
                                        <option value="any religion">Any religion</option>
                                      
                                        
                                        </select>
                                    </div>
                                </div>
                         
                              <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">State of Origin</label>
                                    <div class="relative">
                                        
                                        <select name="state_of_origin" id="state" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent appearance-none bg-white">
    <option value="">Select State</option>
   <option value="Any state works">Any state works</option>
    <option value="Abia">Abia</option>
    <option value="Adamawa">Adamawa</option>
    <option value="Akwa Ibom">Akwa Ibom</option>
    <option value="Anambra">Anambra</option>
    <option value="Bauchi">Bauchi</option>
    <option value="Bayelsa">Bayelsa</option>
    <option value="Benue">Benue</option>
    <option value="Borno">Borno</option>
    <option value="Cross River">Cross River</option>
    <option value="Delta">Delta</option>
    <option value="Ebonyi">Ebonyi</option>
    <option value="Edo">Edo</option>
    <option value="Ekiti">Ekiti</option>
    <option value="Enugu">Enugu</option>
    <option value="FCT">Federal Capital Territory (FCT)</option>
    <option value="Gombe">Gombe</option>
    <option value="Imo">Imo</option>
    <option value="Jigawa">Jigawa</option>
    <option value="Kaduna">Kaduna</option>
    <option value="Kano">Kano</option>
    <option value="Katsina">Katsina</option>
    <option value="Kebbi">Kebbi</option>
    <option value="Kogi">Kogi</option>
    <option value="Kwara">Kwara</option>
    <option value="Lagos">Lagos</option>
    <option value="Nasarawa">Nasarawa</option>
    <option value="Niger">Niger</option>
    <option value="Ogun">Ogun</option>
    <option value="Ondo">Ondo</option>
    <option value="Osun">Osun</option>
    <option value="Oyo">Oyo</option>
    <option value="Plateau">Plateau</option>
    <option value="Rivers">Rivers</option>
    <option value="Sokoto">Sokoto</option>
    <option value="Taraba">Taraba</option>
    <option value="Yobe">Yobe</option>
    <option value="Zamfara">Zamfara</option>
</select>

                                    </div>
                                </div>
                         
                         
                            </div>

                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes (Optional)</label>
                                <textarea name="roommate_note" id="roommate_note" rows="2"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                          placeholder="Any special requirements or information about the roommate...">{{ old('roommate_notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Special Requests Card -->
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                            <div class="flex items-center">
                                <i class="fas fa-clipboard-list text-[#2D6A4F] mr-2"></i>
                                <h3 class="font-semibold text-gray-800">Special Requests</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <textarea name="special_request" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                      placeholder="Dietary restrictions, accessibility needs, special occasions, or anything else we should know...">{{ old('special_requests') }}</textarea>
                      
                      
                        </div>
                   
                   
                    </div>
                </form>
            </div>
            
            <!-- Right Column - Price Summary Card -->
            <div class="lg:col-span-1">
                <div class="sticky top-8">
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A]">
                            <h3 class="text-white font-semibold text-lg">Booking Summary</h3>
                            <p class="text-gray-300 text-sm mt-1">Review your stay details</p>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <!-- Property Info -->
                            <div id="summaryProperty" class="pb-3 border-b border-gray-100">
                                <p class="text-xs text-gray-400 uppercase tracking-wide">Property</p>
                                <p class="font-medium text-gray-800 mt-1" id="summaryPropertyName">—</p>
                                <p class="text-sm text-gray-500" id="summaryPropertyLocation"></p>
                            </div>
                            
                            
                            
                           
                            
                            <!-- Price Breakdown -->
                            <div class="space-y-2 pb-3 border-b border-gray-100">
                                <p class="text-xs text-gray-400 uppercase tracking-wide">Price Breakdown</p>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600" id="pricePerNightLabel">Rent</span>
                                    <span class="text-sm text-gray-800" id="priceSubtotal">{{App\Helper::formatNaira(number_format($property->rent_fee, 2))}}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Caution fee</span>
                                    <span class="text-sm text-gray-800">{{App\Helper::formatNaira(number_format($property->caution_fee, 2))}}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Service fee</span>
                                    <span class="text-sm text-gray-800">{{App\Helper::formatNaira(number_format($property->mgt_fee, 2))}}</span>
                                </div>
                            </div>
                            
                            <!-- Total -->
                            <div class="pt-2">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-800">Total </span>
                                    <span class="text-2xl font-bold text-[#2D6A4F]" id="summaryTotal">0.00</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Includes all taxes & fees</p>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="p-6 border-t border-gray-100 bg-gray-50">
                            <button type="submit" form="bookingForm" class="w-full bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white py-3 rounded-xl font-semibold transition shadow-md flex items-center justify-center space-x-2">
                                <i class="fas fa-lock"></i>
                                <span>Book</span>
                            </button>
                            <p class="text-xs text-center text-gray-500 mt-3">You won't be charged yet</p>
                        </div>
                        
                        <!-- Secure Payment Info -->
                        <div class="px-6 pb-6">
                            <div class="flex items-center justify-center space-x-4 text-xs text-gray-400">
                                <span><i class="fas fa-credit-card mr-1"></i> Secure payment</span>
                                <span><i class="fas fa-shield-alt mr-1"></i> SSL encrypted</span>
                                <span><i class="fas fa-headset mr-1"></i> 24/7 support</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cancellation Policy Card -->
                    <div class="mt-4 bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-calendar-times text-gray-400 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Free cancellation</p>
                                <p class="text-xs text-gray-500 mt-1">Cancel up to 7 days before check-in for a full refund.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Terms & Conditions -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex items-start justify-between flex-wrap gap-4">
                <div class="flex items-center">
                    <input type="checkbox" name="terms" id="terms" form="bookingForm" required class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded">
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        I agree to the <a href="#" class="text-[#2D6A4F] hover:underline">Terms of Service</a>, 
                        <a href="#" class="text-[#2D6A4F] hover:underline">Cancellation Policy</a>, and 
                        <a href="#" class="text-[#2D6A4F] hover:underline">Privacy Policy</a>.
                    </label>
                </div>
                <a href="#" class="text-sm text-[#2D6A4F] hover:underline">Need help? Contact support</a>
            </div>
            @error('terms')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Hidden total price input -->
        <input type="hidden" name="total_price" id="total_price" form="bookingForm">
    </div>
</div>
 @include('components.footer')
<script>
    // Form elements
    const propertySelect = document.getElementById('property_id');
    const propertyPreview = document.getElementById('propertyPreview');
    const checkIn = document.getElementById('check_in');
    const checkOut = document.getElementById('check_out');
    const guests = document.getElementById('guests');
    const guestLimitHint = document.getElementById('guestLimitHint');
    const guestLimitDisplay = document.getElementById('guestLimitDisplay');
    const totalPriceInput = document.getElementById('total_price');
    
    // Summary elements
    const summaryPropertyName = document.getElementById('summaryPropertyName');
    const summaryPropertyLocation = document.getElementById('summaryPropertyLocation');
    const summaryCheckIn = document.getElementById('summaryCheckIn');
    const summaryCheckOut = document.getElementById('summaryCheckOut');
    const summaryNights = document.getElementById('summaryNights');
    const summaryGuests = document.getElementById('summaryGuests');
    const summaryRoommateRow = document.getElementById('summaryRoommateRow');
    const summaryRoommate = document.getElementById('summaryRoommate');
    const pricePerNightLabel = document.getElementById('pricePerNightLabel');
    const priceSubtotal = document.getElementById('priceSubtotal');
    const summaryTotal = document.getElementById('summaryTotal');
    
    // Roommate elements
    const needsRoommate = document.getElementById('needsRoommate');
    const roommateFields = document.getElementById('roommateFields');
    const roommateToggleLabel = document.getElementById('roommateToggleLabel');
    const roommateName = document.getElementById('roommate_name');
    
    // Property preview elements
    const previewTitle = document.getElementById('previewTitle');
    const previewLocation = document.getElementById('previewLocation');
    const previewRating = document.getElementById('previewRating');
    const previewMaxGuests = document.getElementById('previewMaxGuests');
    const previewPrice = document.getElementById('previewPrice');
    
    let currentPricePerNight = 0;
    let currentMaxGuests = 0;
    
    // Roommate toggle
    needsRoommate.addEventListener('change', function() {
        if (this.checked) {
            roommateFields.classList.remove('hidden');
            roommateToggleLabel.textContent = 'Remove Roommate';
            if (roommateName.value) {
                summaryRoommateRow.style.display = 'flex';
                summaryRoommate.textContent = roommateName.value;
            }
        } else {
            roommateFields.classList.add('hidden');
            roommateToggleLabel.textContent = 'Add Roommate';
            summaryRoommateRow.style.display = 'none';
        }
    });
    
    // Property selection
    propertySelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        if (this.value) {
            currentPricePerNight = parseFloat(selected.dataset.price);
            currentMaxGuests = parseInt(selected.dataset.maxGuests);
            
            // Show preview
            propertyPreview.classList.remove('hidden');
            previewTitle.textContent = selected.dataset.title;
            previewLocation.textContent = selected.dataset.location;
            previewRating.textContent = selected.dataset.rating;
            previewMaxGuests.textContent = selected.dataset.maxGuests;
            previewPrice.textContent = currentPricePerNight;
            
            // Update summary
            summaryPropertyName.textContent = selected.dataset.title;
            summaryPropertyLocation.textContent = selected.dataset.location;
            
            // Update guest limit
            guestLimitHint.textContent = `Maximum ${currentMaxGuests} guests allowed`;
            guestLimitDisplay.textContent = `(Max ${currentMaxGuests})`;
            
            if (parseInt(guests.value) > currentMaxGuests) {
                guests.value = currentMaxGuests;
                summaryGuests.textContent = currentMaxGuests;
            }
        } else {
            propertyPreview.classList.add('hidden');
            summaryPropertyName.textContent = '—';
            summaryPropertyLocation.textContent = '';
        }
        calculateTotal();
    });
    
    // Guest controls
    function decrementGuests() {
        let val = parseInt(guests.value);
        if (val > 1) {
            guests.value = val - 1;
            updateGuestSummary();
            calculateTotal();
        }
    }
    
    function incrementGuests() {
        let val = parseInt(guests.value);
        if (val < currentMaxGuests || currentMaxGuests === 0) {
            guests.value = val + 1;
            updateGuestSummary();
            calculateTotal();
        } else if (currentMaxGuests > 0) {
            alert(`Maximum ${currentMaxGuests} guests allowed for this property.`);
        }
    }
    
    function updateGuestSummary() {
        summaryGuests.textContent = guests.value;
    }
    
    guests.addEventListener('input', function() {
        if (currentMaxGuests > 0 && parseInt(this.value) > currentMaxGuests) {
            this.value = currentMaxGuests;
            alert(`Maximum ${currentMaxGuests} guests allowed.`);
        }
        if (parseInt(this.value) < 1) this.value = 1;
        updateGuestSummary();
        calculateTotal();
    });
    
    // Date handling
    const today = new Date().toISOString().split('T')[0];
    checkIn.min = today;
    checkOut.min = today;
    
    checkIn.addEventListener('change', function() {
        checkOut.min = this.value;
        if (checkOut.value && checkOut.value <= this.value) {
            checkOut.value = '';
        }
        updateDateSummary();
        calculateTotal();
    });
    
    checkOut.addEventListener('change', function() {
        updateDateSummary();
        calculateTotal();
    });
    
    function updateDateSummary() {
        summaryCheckIn.textContent = checkIn.value ? new Date(checkIn.value).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '—';
        summaryCheckOut.textContent = checkOut.value ? new Date(checkOut.value).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '—';
        
        if (checkIn.value && checkOut.value) {
            const nights = Math.ceil((new Date(checkOut.value) - new Date(checkIn.value)) / (1000 * 60 * 60 * 24));
            summaryNights.textContent = nights;
            return nights;
        }
        summaryNights.textContent = '0';
        return 0;
    }
    
    function calculateTotal() {
        if (propertySelect.value && checkIn.value && checkOut.value && currentPricePerNight > 0) {
            const nights = Math.ceil((new Date(checkOut.value) - new Date(checkIn.value)) / (1000 * 60 * 60 * 24));
            const subtotal = currentPricePerNight * nights;
            const serviceFee = subtotal * 0.1;
            const cleaningFee = 50;
            const total = subtotal + serviceFee + cleaningFee;
            
            pricePerNightLabel.textContent = `$${currentPricePerNight.toFixed(2)} x ${nights} nights`;
            priceSubtotal.textContent = `$${subtotal.toFixed(2)}`;
            summaryTotal.textContent = `$${total.toFixed(2)}`;
            totalPriceInput.value = total.toFixed(2);
            return total;
        } else {
            pricePerNightLabel.textContent = '$0.00 x 0 nights';
            priceSubtotal.textContent = '$0.00';
            summaryTotal.textContent = '$0.00';
            totalPriceInput.value = '0';
            return 0;
        }
    }
    
    // Roommate name sync
    roommateName.addEventListener('input', function() {
        if (this.value && needsRoommate.checked) {
            summaryRoommateRow.style.display = 'flex';
            summaryRoommate.textContent = this.value;
        } else if (!needsRoommate.checked) {
            summaryRoommateRow.style.display = 'none';
        } else {
            summaryRoommateRow.style.display = 'none';
        }
    });
    
    // Initial calls
    if (propertySelect.value) {
        propertySelect.dispatchEvent(new Event('change'));
    }
    if (checkIn.value || checkOut.value) {
        updateDateSummary();
        calculateTotal();
    }
    if ("{{ old('needs_roommate') }}") {
        needsRoommate.checked = true;
        roommateFields.classList.remove('hidden');
        roommateToggleLabel.textContent = 'Remove Roommate';
        if (roommateName.value) {
            summaryRoommateRow.style.display = 'flex';
            summaryRoommate.textContent = roommateName.value;
        }
    }
</script>
</body>
@endsection