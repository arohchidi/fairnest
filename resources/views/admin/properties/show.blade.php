@extends('admin.layouts.app')

@section('title', $property->title)
@section('header-title', 'Property Details')
@section('header-description', 'View and manage property information')

@section('content')
<div class="space-y-6">
    
    <!-- Action Buttons -->
    <div class="flex justify-between items-center">
        <a href="{{ route('admin.properties.index') }}" class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-800 transition">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Properties</span>
        </a>
        <div class="flex space-x-3">
            <a href="{{ route('admin.edit.property', $property->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition flex items-center space-x-2">
                <i class="fas fa-edit"></i>
                <span>Edit Property</span>
            </a>
            <button type="button" onclick="confirmDelete()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition flex items-center space-x-2">
                <i class="fas fa-trash"></i>
                <span>Delete Property</span>
            </button>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="delete-form" action="#destroy" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Column - Images & Basic Info -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Image Gallery -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Property Gallery</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ count($property->images ?? []) }} images available</p>
                </div>
                <div class="p-6">
                    @if($property->images && count($property->images) > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($property->images as $index => $image)
                            <div class="relative group rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ asset('storage/' . $image) }}" 
                                     alt="{{ $property->title }} - Image {{ $index + 1 }}"
                                     class="w-full h-40 object-cover">
                                @if($index === 0)
                                    <span class="absolute top-2 left-2 bg-[#2D6A4F] text-white text-xs px-2 py-1 rounded-full">
                                        Main
                                    </span>
                                @endif
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                    <a href="{{ asset('storage/' . $image) }}" target="_blank" class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-gray-700 hover:bg-gray-100 transition">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-image text-5xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500">No images uploaded for this property</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Description -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Description</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed">{{ $property->description }}</p>
                </div>
            </div>
            
            <!-- Amenities -->
            @if($property->meta_data && count($property->meta_data) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Amenities</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($property->meta_data as $amenity)
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-[#2D6A4F] text-sm"></i>
                            <span class="text-gray-700 capitalize">{{ str_replace('_', ' ', $amenity) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Recent Bookings -->
            @if($property->bookings && count($property->bookings) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Recent Bookings</h3>
                    <p class="text-sm text-gray-500 mt-1">Latest guest activity</p>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($property->bookings->take(5) as $booking)
                    <div class="px-6 py-4 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-800">{{ $booking->user->name ?? 'Guest' }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $booking->check_in->format('M d, Y') }} - {{ $booking->check_out->format('M d, Y') }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">{{ $booking->check_in->diffInDays($booking->check_out) }} nights</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-[#2D6A4F]">${{ number_format($booking->total_price, 2) }}</p>
                                <span class="inline-block px-2 py-1 text-xs rounded-full 
                                    {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        
        <!-- Right Column - Details & Stats -->
        <div class="space-y-6">
            
            <!-- Property Status Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Property Status</h3>
                </div>
                <div class="p-6">
                    @php
                        $statusColors = [
                            'true' => 'green',
                            
                            'false' => 'red',
                        ];
                        $color = $statusColors[$property->is_available] ?? 'gray';
                    @endphp
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-gray-600">Current Status</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $color }}-100 text-{{ $color }}-700">
                            <span class="w-2 h-2 rounded-full bg-{{ $color }}-500 mr-2"></span>
                            @if($property->is_available === true)
                            {{ ucfirst("Available") }}
                            @else
                                {{ ucfirst("Rented Out") }}
                            @endif
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-gray-600">Listing Date</span>
                        <span class="text-gray-800">{{ $property->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Last Updated</span>
                        <span class="text-gray-800">{{ $property->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Location Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Location</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-start space-x-3 mb-3">
                        <i class="fas fa-map-marker-alt text-[#2D6A4F] mt-1"></i>
                        <div>
                            <p class="text-gray-800">{{ $property->address }}</p>
                            <p class="text-gray-600 mt-1">{{ $property->city }}, {{ $property->country }}</p>
                            @if($property->zip_code)
                                <p class="text-gray-500 text-sm mt-1">Zip: {{ $property->zip_code }}</p>
                            @endif
                        </div>
                    </div>
                    @if($property->latitude && $property->longitude)
                    <div class="mt-4">
                        <div class="bg-gray-100 rounded-lg h-48 flex items-center justify-center">
                            <p class="text-gray-500 text-sm">Map View Available</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Pricing Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Pricing</h3>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                        <span class="text-gray-600">Rent</span>
                        <span class="text-2xl font-bold text-[#2D6A4F]">{{ App\Helper::formatNaira(number_format($property->rent_fee, 2)) }}</span>
                    </div>
                    @if($property->cleaning_fee)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Cleaning Fee</span>
                        <span class="text-gray-800">App\Helper::formatNaira(number_format($property->agency_fee, 2)) }}</span>
                    </div>
                    @endif
                    @if($property->security_deposit)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Security Deposit</span>
                        <span class="text-gray-800">${{ number_format($property->security_deposit, 2) }}</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Specifications Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Specifications</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-bed text-[#2D6A4F] text-xl mb-2"></i>
                            <p class="text-2xl font-bold text-gray-800">{{ $property->number_of_bedrooms }}</p>
                            <p class="text-xs text-gray-500">Bedrooms</p>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-bath text-[#2D6A4F] text-xl mb-2"></i>
                            <p class="text-2xl font-bold text-gray-800">{{ $property->number_of_bathrooms }}</p>
                            <p class="text-xs text-gray-500">Bathrooms</p>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-users text-[#2D6A4F] text-xl mb-2"></i>
                            <p class="text-2xl font-bold text-gray-800">{{ $property->max_guests }}</p>
                            <p class="text-xs text-gray-500">Max Guests</p>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-expand-arrows-alt text-[#2D6A4F] text-xl mb-2"></i>
                            <p class="text-2xl font-bold text-gray-800">{{ $property->sqft ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-500">Sq Ft</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Reviews Summary Card -->
            @if($property->reviews && count($property->reviews) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Reviews</h3>
                </div>
                <div class="p-6">
                    <div class="text-center mb-4">
                        <div class="flex justify-center text-yellow-400 text-2xl mb-2">
                            @php
                                $fullStars = floor($property->rating);
                                $halfStar = ($property->rating - $fullStars) >= 0.5;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    <i class="fas fa-star"></i>
                                @elseif($i == $fullStars + 1 && $halfStar)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($property->rating, 1) }}</p>
                        <p class="text-sm text-gray-500">Based on {{ count($property->reviews) }} reviews</p>
                    </div>
                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @foreach($property->reviews->take(3) as $review)
                        <div class="border-t border-gray-100 pt-3">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-medium text-gray-800">{{ $review->user->name ?? 'Anonymous' }}</span>
                                <div class="flex text-yellow-400 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-sm text-gray-600">{{ Str::limit($review->comment, 100) }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $review->created_at->format('M d, Y') }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete Property</h3>
            <p class="text-gray-500 text-center text-sm">
                Are you sure you want to delete <strong>"{{ $property->title }}"</strong>? 
                This action cannot be undone and will remove all associated data including images, bookings, and reviews.
            </p>
            <div class="flex space-x-3 mt-6">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button onclick="submitDelete()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete Permanently
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete() {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
    
    function submitDelete() {
        document.getElementById('delete-form').submit();
    }
    
    // Close modal on click outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endpush
@endsection