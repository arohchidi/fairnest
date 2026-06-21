@extends('layouts.app')

@section('title', 'Booking Confirmed')
@section('description', 'Your booking has been successfully confirmed')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- ============================================ -->
        <!-- SUCCESS ANIMATION & HEADER -->
        <!-- ============================================ -->
        <div class="text-center mb-8" data-aos="fade-up">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full mb-6 relative">
                <div class="absolute inset-0 rounded-full bg-green-400/20 animate-ping"></div>
                <i class="fas fa-check-circle text-green-500 text-5xl relative z-10"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Booking Confirmed! 🎉</h1>
            <p class="text-gray-500 text-lg">Your booking has been successfully processed and confirmed.</p>
        </div>
        
        <!-- ============================================ -->
        <!-- BOOKING DETAILS CARD -->
        <!-- ============================================ -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6" data-aos="fade-up" data-aos-delay="100">
            <div class="bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-white font-semibold text-lg">Booking Details</h2>
                        <p class="text-gray-300 text-sm">Your reservation information</p>
                    </div>
                    <span class="bg-[#2D6A4F] text-white text-xs px-4 py-1.5 rounded-full font-medium">
                        <i class="fas fa-check-circle mr-1"></i> Confirmed
                    </span>
                </div>
            </div>
            
            <div class="p-6 md:p-8">
                
                <!-- Booking Reference -->
                <div class="text-center pb-4 mb-4 border-b border-gray-200">
                    <p class="text-sm text-gray-500 uppercase tracking-wide">Booking Reference</p>
                    <p class="text-2xl font-bold text-[#2D6A4F] font-mono tracking-wider">
                        #{{ $booking->reference ?? strtoupper(Str::random(8)) }}
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Property Info -->
                    <div class="flex items-start space-x-4 pb-4 md:pb-0 md:border-r md:border-gray-200 md:pr-6">
                        <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                            @if($property->images[0] ?? false)
                                <img src="{{ asset('storage/' . $property['images'][0]) }}" 
                                     alt="{{ $property->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-building text-2xl text-gray-400"></i>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Property</p>
                            <p class="font-semibold text-gray-800">{{ $property->title ?? 'Property Name' }}</p>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>
                                {{ $property->city ?? 'City' }}, {{ $property->country ?? 'Country' }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Guest Info -->
                    <div>
                        <p class="text-sm text-gray-500">Guest Information</p>
                        <p class="font-semibold text-gray-800">{{ $booking['username'] ?? $booking->user->name ?? 'Guest' }}</p>
                        <p class="text-sm text-gray-500">{{ $booking['email'] ?? $booking->user->email ?? 'N/A' }}</p>
                        @if($booking['phone'] ?? false)
                            <p class="text-sm text-gray-500">{{ $booking['phone'] }}</p>
                        @endif
                    </div>
                </div>
                
                <!-- Travel Dates -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 pt-4 border-t border-gray-200">
                    <div>
                        <p class="text-sm text-gray-500">Insepction Date</p>
                        <div class="flex items-center mt-1">
                            <i class="fas fa-calendar-alt text-[#2D6A4F] mr-2 text-sm"></i>
                            <span class="font-medium text-gray-800">{{$booking['booking_date']}}</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1"></p>
                    </div>
                    
                    
                    
               
               
                </div>
                
                <!-- Roommate Info -->
                @if($booking['needs_roommate'] == 1)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500">Roommate Information</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                        <div>
                            <p class="text-sm text-gray-600">Gender</p>
                            <p class="font-medium text-gray-800">{{ $booking['roommate_gender'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Age</p>
                            <p class="font-medium text-gray-800">{{ $booking['roommate_age'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">State</p>
                            <p class="font-medium text-gray-800">{{ $booking['state_of_origin'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Religion</p>
                            <p class="font-medium text-gray-800">{{ $booking['religion'] ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Level</p>
                            <p class="font-medium text-gray-800">{{ $booking['roommate_level'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Notes</p>
                            <p class="font-medium text-gray-800">{{ $booking['roommate_note'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Price Breakdown -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-3">Payment Summary</p>
                   
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Rent</span>
                            <span class="text-gray-800"> {{App\Helper::formatNaira(number_format($property->rent_fee,0)) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Service charge</span>
                            <span class="text-gray-800"> {{App\Helper::formatNaira(number_format($property->mgt_fee,0)) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Legal fee</span>
                            <span class="text-gray-800"> {{App\Helper::formatNaira(number_format($property->legal_fee,0)) }}</span>
                        </div>
<div class="flex justify-between text-sm">
                            <span class="text-gray-600">Caution fee</span>
                            <span class="text-gray-800">  {{App\Helper::formatNaira(number_format($property->caution_fee,0)) }}</span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Agency fee</span>
                            <span class="text-gray-800"> {{App\Helper::formatNaira(number_format($property->agency_fee,0)) }}</span>
                        </div>

                        <div class="flex justify-between pt-2 border-t border-gray-200">
                            <span class="font-bold text-gray-800">Total cost</span>
                            <span class="text-2xl font-bold text-[#2D6A4F]">{{ App\Helper::formatNaira(number_format($property->agency_fee + $property->caution_fee + $property->mgt_fee + $property->legal_fee + $property->rent_fee)) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ============================================ -->
        <!-- WHAT HAPPENS NEXT -->
        <!-- ============================================ -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-6" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-clock text-[#2D6A4F] mr-2"></i>
                What Happens Next?
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-[#2D6A4F] text-xs font-bold">1</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Confirmation Email</p>
                        <p class="text-sm text-gray-500">You'll receive a confirmation email with your booking details and receipt.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-[#2D6A4F] text-xs font-bold">2</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Host Notification</p>
                        <p class="text-sm text-gray-500">The property owner will be notified of your booking request and will prepare for your arrival.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-[#2D6A4F] text-xs font-bold">3</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Check-in Instructions</p>
                        <p class="text-sm text-gray-500">You'll receive check-in instructions 48 hours before your arrival.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ============================================ -->
        <!-- CANCELLATION POLICY -->
        <!-- ============================================ -->
        <div class="bg-gray-50 rounded-2xl border border-gray-200 p-6 mb-6" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-start space-x-3">
                <i class="fas fa-calendar-times text-[#2D6A4F] text-lg mt-0.5"></i>
                <div>
                    <h4 class="font-semibold text-gray-800">Cancellation Policy</h4>
                    <p class="text-sm text-gray-500 mt-1">
                        You can cancel your booking up to 7 days before check-in for a full refund. 
                        Cancellations made within 7 days of check-in will receive a 50% refund.
                    </p>
                    <a href="#" class="text-sm text-[#2D6A4F] font-medium hover:underline mt-2 inline-block">
                        Read full cancellation policy →
                    </a>
                </div>
            </div>
        </div>
        
        <!-- ============================================ -->
        <!-- ACTION BUTTONS -->
        <!-- ============================================ -->
        <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('property.details', $booking['property_id']) }}" 
               class="px-6 py-3 bg-[#2D6A4F] text-white rounded-xl font-medium hover:bg-[#1B4D3E] transition text-center">
                <i class="fas fa-building mr-2"></i> View Property
            </a>
            <a href="{{ route('property.listings') }}" 
               class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-medium hover:bg-gray-300 transition text-center">
                <i class="fas fa-search mr-2"></i> Browse More Properties
            </a>
            <a href="{{ route('contact') }}" 
               class="px-6 py-3 border border-gray-300 text-gray-600 rounded-xl font-medium hover:bg-gray-50 transition text-center">
                <i class="fas fa-headset mr-2"></i> Need Help?
            </a>
        </div>
        
        <!-- ============================================ -->
        <!-- SHARE SECTION -->
        <!-- ============================================ -->
        <div class="text-center mt-8" data-aos="fade-up" data-aos-delay="500">
            <p class="text-sm text-gray-500 mb-3">Share your booking with friends</p>
            <div class="flex justify-center space-x-3">
                <button onclick="shareBooking('facebook')" class="w-10 h-10 bg-[#1877F2] text-white rounded-full hover:opacity-80 transition flex items-center justify-center">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button onclick="shareBooking('twitter')" class="w-10 h-10 bg-[#1DA1F2] text-white rounded-full hover:opacity-80 transition flex items-center justify-center">
                    <i class="fab fa-twitter"></i>
                </button>
                <button onclick="shareBooking('whatsapp')" class="w-10 h-10 bg-[#25D366] text-white rounded-full hover:opacity-80 transition flex items-center justify-center">
                    <i class="fab fa-whatsapp"></i>
                </button>
                <button onclick="copyBookingLink()" class="w-10 h-10 bg-gray-600 text-white rounded-full hover:bg-gray-700 transition flex items-center justify-center">
                    <i class="fas fa-link"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Share functions
    function shareBooking(platform) {
        const url = window.location.href;
        const text = "I just booked a property on {{ config('app.name') }}! Check it out: ";
        
        let shareUrl = '';
        switch(platform) {
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                break;
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
                break;
            case 'whatsapp':
                shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(text + ' ' + url)}`;
                break;
        }
        
        if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400');
        }
    }
    
    function copyBookingLink() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('Booking link copied to clipboard!');
        }).catch(() => {
            // Fallback
            const textarea = document.createElement('textarea');
            textarea.value = url;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Booking link copied to clipboard!');
        });
    }
</script>
@endpush
@endsection