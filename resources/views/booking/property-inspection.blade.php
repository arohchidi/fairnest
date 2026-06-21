@extends('layouts.app')

@section('title', 'Book Inspection - ' . $property->title)
@section('description', 'Schedule an inspection for ' . $property->title)

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- ============================================ -->
        <!-- PAGE HEADER -->
        <!-- ============================================ -->
        <div class="mb-8" data-aos="fade-up">
            <nav class="flex items-center text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-[#2D6A4F] transition">Home</a>
                <i class="fas fa-chevron-right mx-3 text-gray-300 text-xs"></i>
                <a href="{{ route('property.listings') }}" class="hover:text-[#2D6A4F] transition">Properties</a>
                <i class="fas fa-chevron-right mx-3 text-gray-300 text-xs"></i>
                <a href="{{ route('property.details', $property) }}" class="hover:text-[#2D6A4F] transition">{{ $property->title }}</a>
                <i class="fas fa-chevron-right mx-3 text-gray-300 text-xs"></i>
                <span class="text-[#2D6A4F] font-semibold">Book Inspection</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                Book an <span class="text-[#2D6A4F]">Inspection</span>
            </h1>
            <p class="text-gray-500 mt-2">Schedule a visit to view this property in person</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            
            <!-- ============================================ -->
            <!-- LEFT COLUMN (3/5) - FORM -->
            <!-- ============================================ -->
            <div class="lg:col-span-3" data-aos="fade-right">
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    
                    <!-- Property Preview -->
                    <div class="flex items-center space-x-4 pb-6 mb-6 border-b border-gray-200">
                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="{{ $property->images[0] ? asset('storage/' . $property->images[0]) : asset('images/no-image.jpg') }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $property->title }}</h3>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>
                                {{ $property->address }}, {{ $property->city }}
                            </p>
                            <div class="flex items-center space-x-3 mt-1 text-sm text-gray-600">
                                <span><i class="fas fa-bed text-[#2D6A4F] mr-1"></i> {{ $property->number_of_bedrooms ?? 'N/A' }}</span>
                                <span><i class="fas fa-bath text-[#2D6A4F] mr-1"></i> {{ $property->number_of_bathrooms ?? 'N/A' }}</span>
                                <span> {{ App\Helper::formatNaira(number_format($property->rent_fee, 2) )}}/rent</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Inspection Form -->
                    <form method="POST" action="{{ route('store.booking') }}" class="space-y-5" id="inspectionForm">
                        @csrf
                        <input type="text" name="property_id" value="{{ $property->id }}">
                        
                        <!-- ============================================ -->
                        <!-- PERSONAL INFORMATION -->
                        <!-- ============================================ -->
                        <h4 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-user text-[#2D6A4F] mr-2"></i>
                            Personal Information
                        </h4>
                        
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
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" required
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                       placeholder="+1 234 567 8900">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Preferred Inspection Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="booking_date" value="{{ old('booking_date') }}" required
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition" min="{{ date('Y-m-d') }}">
                                @error('booking_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Preferred Time <span class="text-red-500">*</span>
                            </label>
                            <select name="inspection_time" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition">
                                <option value="">Select a time slot</option>
                                <option value="morning" {{ old('inspection_time') == 'morning' ? 'selected' : '' }}>Morning (9:00 AM - 12:00 PM)</option>
                                <option value="afternoon" {{ old('inspection_time') == 'afternoon' ? 'selected' : '' }}>Afternoon (1:00 PM - 4:00 PM)</option>
                                <option value="evening" {{ old('inspection_time') == 'evening' ? 'selected' : '' }}>Evening (4:00 PM - 6:00 PM)</option>
                            </select>
                            @error('inspection_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Additional Notes
                            </label>
                            <textarea name="special_request" rows="3"
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                      placeholder="Any special requirements or questions...">{{ old('special_request') }}</textarea>
                        </div>
                        
                        <!-- ============================================ -->
                        <!-- ROOMMATE SECTION -->
                        <!-- ============================================ -->
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-user-friends text-[#2D6A4F] mr-2"></i>
                                        Roommate Information
                                    </h4>
                                    <p class="text-sm text-gray-500">Do you need a roommate?</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="needs_roommate" id="needsRoommate" value="1" 
                                           class="sr-only peer" {{ old('needs_roommate') ? 'checked' : '' }}
                                           onchange="toggleRoommateFields()">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-[#2D6A4F] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-700" id="roommateToggleLabel">No</span>
                                </label>
                            </div>
                            
                            <!-- Roommate Fields -->
                            <div id="roommateFields" class="mt-5 space-y-4 {{ old('needs_roommate') ? '' : 'hidden' }}">
                                <div class="bg-orange-50 border border-orange-200 rounded-xl p-4">
                                    <div class="flex items-start space-x-3">
                                        <i class="fas fa-info-circle text-orange-500 mt-0.5"></i>
                                        <p class="text-sm text-orange-800">Roommate information will be shared with the property owner for reference.</p>
                                    </div>
                                </div>
                                
                               
                              
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Roommate Gender <span class="text-red-500">*</span>
                                        </label>
                                        <select name="roommate_gender" id="roommate_gender"
                                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition">
                                            <option value="">Select gender</option>
                                            <option value="male" {{ old('roommate_gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('roommate_gender') == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="non-binary" {{ old('roommate_gender') == 'non-binary' ? 'selected' : '' }}>Non-Binary</option>
                                            <option value="prefer-not-to-say" {{ old('roommate_gender') == 'prefer-not-to-say' ? 'selected' : '' }}>Prefer Not To Say</option>
                                        </select>
                                        @error('roommate_gender')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                     
                                     
                                     
                                      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Roommate Age <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" name="roommate_age" id="roommate_age" value="{{ old('roommate_age') }}" min="18" max="100"
                                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                               placeholder="25">
                                        @error('roommate_age')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Level In School <span class="text-red-500">*</span>
                                        </label>
                                        <select name="roommate_level" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent appearance-none bg-white" >
                                        <option value="">Select School Level</option>
                                        <option value="100">100 Level</option>
                                        <option value="200">200 Level</option>
                                        <option value="300">300 Level</option>
                                        <option value="400">400 Level</option>
                                        <option value="500">500 Level</option>
                                        <option value="600">600 Level</option>
                                        
                                        </select>
                                        @error('roommate_level')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            State of Origin <span class="text-red-500">*</span>
                                        </label>
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
                                        @error('state_of_origin')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                               
                               
                               
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Religion <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="religion" id="religion" value="{{ old('religion') }}"
                                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                               placeholder="e.g., Christianity, Islam">
                                        @error('religion')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Additional Notes
                                        </label>
                                        <textarea name="roommate_note" id="roommate_note" rows="3"
                                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                                  placeholder="Any special requirements or information about the roommate...">{{ old('roommate_notes') }}</textarea>
                                    </div>
                                </div>
                            </div>
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
                        
                        <!-- Submit Button -->
                        <button type="submit" class="w-full py-3.5 bg-[#2D6A4F] text-white rounded-xl font-semibold hover:bg-[#1B4D3E] transition hover:shadow-lg flex items-center justify-center space-x-2">
                            <i class="fas fa-calendar-check"></i>
                            <span>Book Inspection</span>
                        </button>
                    </form>
                </div>
            </div>
            
          <!-- ============================================ -->
<!-- RIGHT COLUMN (2/5) - SIDEBAR -->
<!-- ============================================ -->
<div class="lg:col-span-2" data-aos="fade-left">

    <div class="sticky top-24 space-y-6">

        <!-- Property Summary -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-[#2D6A4F] mr-2"></i>
                Property Summary
            </h3>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-500">Title</span>
                    <span class="text-gray-800 font-medium truncate ml-4 max-w-[150px]">
                        {{ $property->title }}
                    </span>
                </div>

                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-500">Location</span>
                    <span class="text-gray-800 font-medium text-right">
                        {{ $property->address }} ,{{ $property->city }}, {{ $property->country }}
                    </span>
                </div>

                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-500">Type</span>
                    <span class="text-gray-800 font-medium capitalize">
                        {{ $property->type_of_house ?? 'N/A' }}
                    </span>
                </div>

                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-500">Bedrooms</span>
                    <span class="text-gray-800 font-medium">
                        {{ $property->number_of_bedrooms ?? 'N/A' }}
                    </span>
                </div>

                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-500">Bathrooms</span>
                    <span class="text-gray-800 font-medium">
                        {{ $property->number_of_bathrooms ?? 'N/A' }}
                    </span>
                </div>

                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-500">Rent</span>
                    <span class="text-[#2D6A4F] font-bold">
                        {{App\Helper::formatNaira(number_format($property->rent_fee,0)) }}
                    </span>
                </div>

                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-500">Service Charge</span>
                    <span class="text-[#2D6A4F] font-bold">
                        {{App\Helper::formatNaira(number_format($property->mgt_fee,0)) }}
                    </span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-500">Legal</span>
                    <span class="text-[#2D6A4F] font-bold">
                        {{App\Helper::formatNaira(number_format($property->legal_fee,0)) }}
                    </span>
                </div>

                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-500">Caution</span>
                    <span class="text-[#2D6A4F] font-bold">
                        {{App\Helper::formatNaira(number_format($property->caution_fee,0)) }}
                    </span>
                </div>

                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-500">Agency</span>
                    <span class="text-[#2D6A4F] font-bold">
                        {{App\Helper::formatNaira(number_format($property->agency_fee,0)) }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>

                    @if($property->is_available == 'true')
                        <span class="text-green-600 font-medium">
                            Available
                        </span>
                    @else
                        <span class="text-red-600 font-medium">
                            Not Available
                        </span>
                    @endif

                </div>

            </div>
        </div>


        <!-- What to Expect -->
        <div class="bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] rounded-2xl shadow-lg p-6 text-white">

            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-lightbulb text-yellow-400 mr-2"></i>
                What to Expect
            </h3>


            <ul class="space-y-3 text-sm text-gray-300">

                <li class="flex items-start gap-3">
                    <i class="fas fa-check-circle text-[#2D6A4F]"></i>
                    Professional property viewing
                </li>

                <li class="flex items-start gap-3">
                    <i class="fas fa-check-circle text-[#2D6A4F]"></i>
                    Ask questions about the property
                </li>

                <li class="flex items-start gap-3">
                    <i class="fas fa-check-circle text-[#2D6A4F]"></i>
                    Get detailed answers from host
                </li>

                <li class="flex items-start gap-3">
                    <i class="fas fa-check-circle text-[#2D6A4F]"></i>
                    Explore the neighborhood
                </li>

            </ul>

        </div>



        <!-- Contact Support -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">

            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                <i class="fas fa-headset text-[#2D6A4F] mr-2"></i>
                Need Help?
            </h3>


            <p class="text-gray-500 text-sm mb-4">
                Our team is ready to assist with any questions.
            </p>


            <a href="{{ url('contact') }}"
               class="inline-flex items-center px-4 py-2.5 bg-[#2D6A4F] text-white rounded-xl hover:bg-[#1B4D3E] transition text-sm font-medium">

                <i class="fas fa-envelope mr-2"></i>
                Contact Support

            </a>

        </div>


    </div>

</div>
            </div>
        </div>
    </div>
</div>
@include('components.footer')
@push('scripts')
<script>
    // Toggle roommate fields
    function toggleRoommateFields() {
        const checkbox = document.getElementById('needsRoommate');
        const fields = document.getElementById('roommateFields');
        const label = document.getElementById('roommateToggleLabel');
        const requiredFields = document.querySelectorAll('#roommateFields input, #roommateFields select');
        
        if (checkbox.checked) {
            fields.classList.remove('hidden');
            label.textContent = 'Yes';
            // Make roommate fields required
            requiredFields.forEach(field => {
                if (field.id !== 'roommate_notes') {
                    field.setAttribute('required', 'required');
                }
            });
        } else {
            fields.classList.add('hidden');
            label.textContent = 'No';
            // Remove required attribute
            requiredFields.forEach(field => {
                field.removeAttribute('required');
            });
        }
    }
    
    // Set min date to today
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.querySelector('input[name="inspection_date"]');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.min = today;
        }
        
        // Initialize roommate fields on page load
        toggleRoommateFields();
    });
</script>

<style>
    
    
    .lg\:col-span-2 {
        display: flex;
        flex-direction: column;
    }

    .sticky {
    position: sticky;
    top: 96px;
}
</style>
@endpush
@endsection