@extends('layouts.app')

@section('title', 'Request an Apartment')
@section('description', 'Find your perfect student apartment')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="text-center mb-8" data-aos="fade-up">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                Request an <span class="text-[#2D6A4F]">Apartment</span>
            </h1>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Tell us what you're looking for and we'll help you find the perfect place
            </p>
        </div>
        
        <!-- Request Form -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8" data-aos="fade-up">
            <form method="POST" action="{{ route('apartments.request.submit') }}" class="space-y-6">
                @csrf
                
                <!-- Personal Information -->
                <h3 class="text-lg font-semibold text-gray-800 flex items-center border-b border-gray-100 pb-3">
                    <i class="fas fa-user text-[#2D6A4F] mr-2"></i>
                    Personal Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                               placeholder="John Doe">
                        @error('full_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number (WhatsApp) <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                               placeholder="080 1234 5678">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                           placeholder="john@example.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Location & Property Details -->
                <h3 class="text-lg font-semibold text-gray-800 flex items-center border-b border-gray-100 pb-3 mt-6">
                    <i class="fas fa-map-marker-alt text-[#2D6A4F] mr-2"></i>
                    Location & Property Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Preferred Location <span class="text-red-500">*</span>
                        </label>
                        <select name="preferred_location" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition appearance-none bg-white">
                            <option value="">Select Location</option>
                            <option value="independence_layout" {{ old('preferred_location') == 'independence_layout' ? 'selected' : '' }}>Independence Layout</option>
                            <option value="ama_brewery" {{ old('preferred_location') == 'ama_brewery' ? 'selected' : '' }}>Ama Brewery</option>
                            <option value="obollo_road" {{ old('preferred_location') == 'obollo_road' ? 'selected' : '' }}>Obollo Road</option>
                            <option value="agbani_road" {{ old('preferred_location') == 'agbani_road' ? 'selected' : '' }}>Agbani Road</option>
                            <option value="ede_oballa" {{ old('preferred_location') == 'ede_oballa' ? 'selected' : '' }}>Ede Oballa</option>
                            <option value="thinkers_corner" {{ old('preferred_location') == 'thinkers_corner' ? 'selected' : '' }}>Thinkers Corner</option>
                            <option value="uwani" {{ old('preferred_location') == 'uwani' ? 'selected' : '' }}>Uwani</option>
                            <option value="other" {{ old('preferred_location') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('preferred_location')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Apartment Type <span class="text-red-500">*</span>
                        </label>
                        <select name="apartment_type" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition appearance-none bg-white">
                            <option value="">Select Type</option>
                            <option value="self_contained" {{ old('apartment_type') == 'self_contained' ? 'selected' : '' }}>Self-Contained</option>
                            <option value="one_bedroom" {{ old('apartment_type') == 'one_bedroom' ? 'selected' : '' }}>1-Bedroom Flat</option>
                            <option value="two_bedroom" {{ old('apartment_type') == 'two_bedroom' ? 'selected' : '' }}>2-Bedroom Flat</option>
                            <option value="studio" {{ old('apartment_type') == 'studio' ? 'selected' : '' }}>Studio Apartment</option>
                            <option value="boys_quarters" {{ old('apartment_type') == 'boys_quarters' ? 'selected' : '' }}>Boys Quarters</option>
                            <option value="hostel" {{ old('apartment_type') == 'hostel' ? 'selected' : '' }}>Hostel</option>
                        </select>
                        @error('apartment_type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Budget (Monthly) <span class="text-red-500">*</span>
                        </label>
                        <select name="budget" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition appearance-none bg-white">
                            <option value="">Select Budget</option>
                            <option value="below_200k" {{ old('budget') == 'below_200k' ? 'selected' : '' }}>Below ₦200,000</option>
                            <option value="200k_400k" {{ old('budget') == '200k_400k' ? 'selected' : '' }}>₦200,000 - ₦400,000</option>
                            <option value="400k_600k" {{ old('budget') == '400k_600k' ? 'selected' : '' }}>₦400,000 - ₦600,000</option>
                            <option value="600k_800k" {{ old('budget') == '600k_800k' ? 'selected' : '' }}>₦600,000 - ₦800,000</option>
                            <option value="above_800k" {{ old('budget') == 'above_800k' ? 'selected' : '' }}>Above ₦800,000</option>
                        </select>
                        @error('budget')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Move-in Timeline <span class="text-red-500">*</span>
                        </label>
                        <select name="move_in_timeline" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition appearance-none bg-white">
                            <option value="">Select Timeline</option>
                            <option value="immediately" {{ old('move_in_timeline') == 'immediately' ? 'selected' : '' }}>Immediately</option>
                            <option value="within_1_month" {{ old('move_in_timeline') == 'within_1_month' ? 'selected' : '' }}>Within 1 Month</option>
                            <option value="within_3_months" {{ old('move_in_timeline') == 'within_3_months' ? 'selected' : '' }}>Within 3 Months</option>
                            <option value="within_6_months" {{ old('move_in_timeline') == 'within_6_months' ? 'selected' : '' }}>Within 6 Months</option>
                        </select>
                        @error('move_in_timeline')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Occupancy Type <span class="text-red-500">*</span>
                        </label>
                        <select name="occupancy_type" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition appearance-none bg-white">
                            <option value="">Select Type</option>
                            <option value="single" {{ old('occupancy_type') == 'single' ? 'selected' : '' }}>Single Occupancy</option>
                            <option value="couple" {{ old('occupancy_type') == 'couple' ? 'selected' : '' }}>Couple</option>
                            <option value="roommate" {{ old('occupancy_type') == 'roommate' ? 'selected' : '' }}>With Roommate(s)</option>
                            <option value="family" {{ old('occupancy_type') == 'family' ? 'selected' : '' }}>Family</option>
                        </select>
                        @error('occupancy_type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Roommate Needed? <span class="text-red-500">*</span>
                        </label>
                        <select name="roommate_needed" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition appearance-none bg-white">
                            <option value="">Select</option>
                            <option value="yes" {{ old('roommate_needed') == 'yes' ? 'selected' : '' }}>Yes, I need a roommate</option>
                            <option value="no" {{ old('roommate_needed') == 'no' ? 'selected' : '' }}>No, I prefer alone</option>
                            <option value="undecided" {{ old('roommate_needed') == 'undecided' ? 'selected' : '' }}>Undecided</option>
                        </select>
                        @error('roommate_needed')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Inspection Reference -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Inspection Reference <span class="text-red-500">*</span>
                    </label>
                    <select name="inspection_reference" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition appearance-none bg-white">
                        <option value="">Select Reference</option>
                        <option value="social_media" {{ old('inspection_reference') == 'social_media' ? 'selected' : '' }}>Social Media</option>
                        <option value="friend" {{ old('inspection_reference') == 'friend' ? 'selected' : '' }}>Friend Referral</option>
                        <option value="walk_in" {{ old('inspection_reference') == 'walk_in' ? 'selected' : '' }}>Walk-in</option>
                        <option value="online_ad" {{ old('inspection_reference') == 'online_ad' ? 'selected' : '' }}>Online Ad</option>
                        <option value="billboard" {{ old('inspection_reference') == 'billboard' ? 'selected' : '' }}>Billboard</option>
                        <option value="previous_customer" {{ old('inspection_reference') == 'previous_customer' ? 'selected' : '' }}>Previous Customer</option>
                        <option value="other" {{ old('inspection_reference') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('inspection_reference')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Checkboxes -->
                <div class="border-t border-gray-100 pt-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center mb-4">
                        <i class="fas fa-check-square text-[#2D6A4F] mr-2"></i>
                        Requirements
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="requirements[]" value="water_supply" 
                                   class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]">
                            <span class="text-sm text-gray-700">Water Supply</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="requirements[]" value="electricity" 
                                   class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]">
                            <span class="text-sm text-gray-700">Electricity</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="requirements[]" value="security" 
                                   class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]">
                            <span class="text-sm text-gray-700">Security</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="requirements[]" value="parking" 
                                   class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]">
                            <span class="text-sm text-gray-700">Parking Space</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="requirements[]" value="furnished" 
                                   class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]">
                            <span class="text-sm text-gray-700">Furnished</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="requirements[]" value="wifi" 
                                   class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]">
                            <span class="text-sm text-gray-700">WiFi</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="requirements[]" value="pet_friendly" 
                                   class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]">
                            <span class="text-sm text-gray-700">Pet Friendly</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="requirements[]" value="bathroom_attached" 
                                   class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]">
                            <span class="text-sm text-gray-700">Bathroom Attached</span>
                        </label>
                    </div>
                    @error('requirements')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Additional Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Additional Notes
                    </label>
                    <textarea name="notes" rows="3" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                              placeholder="Any additional information or special requests...">{{ old('notes') }}</textarea>
                </div>
                
                <!-- Terms -->
                <div class="pt-4 border-t border-gray-200">
                    <div class="flex items-start">
                        <input type="checkbox" name="terms" id="terms" required
                               class="mt-1 w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]">
                        <label for="terms" class="ml-2 text-sm text-gray-600">
                            I confirm that the information provided is accurate and I agree to the
                            <a href="#" class="text-[#2D6A4F] hover:underline">Terms of Service</a> and
                            <a href="#" class="text-[#2D6A4F] hover:underline">Privacy Policy</a>.
                            <span class="text-red-500">*</span>
                        </label>
                    </div>
                    @error('terms')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit -->
                <button type="submit" 
                        class="w-full py-3.5 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] hover:from-[#0D2A3A] hover:to-[#0A1928] text-white rounded-xl font-semibold transition shadow-md flex items-center justify-center space-x-2">
                    <i class="fas fa-paper-plane"></i>
                    <span>Submit Request</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection