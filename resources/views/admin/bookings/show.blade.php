@extends('admin.layouts.app')

@section('title', 'Booking Details')
@section('header-title', 'Booking Details')
@section('header-description', 'View complete booking information')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <!-- Navigation & Actions -->
    <div class="mb-6 flex flex-wrap justify-between items-center gap-3">
        <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center space-x-2 text-gray-500 hover:text-[#2D6A4F] transition group">
            <i class="fas fa-arrow-left text-sm group-hover:-translate-x-1 transition"></i>
            <span>Back to Bookings</span>
        </a>
        <div class="flex space-x-3">
            
            <button type="button" onclick="confirmDelete({{ $booking->id }})" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition flex items-center space-x-2">
                <i class="fas fa-trash"></i>
                <span>Delete</span>
            </button>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- ========== LEFT COLUMN - Main Details ========== -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Booking Header Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-300 text-sm">Booking Reference</p>
                            <p class="text-2xl font-bold font-mono">#{{ $booking->id }}{{ Str::upper(Str::random(4)) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-300 text-sm">Status</p>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-500',
                                    'confirmed' => 'bg-green-500',
                                    'completed' => 'bg-blue-500',
                                    'cancelled' => 'bg-red-500',
                                ];
                                $statusColor = $statusColors[$booking->status] ?? 'bg-gray-500';
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }} text-white">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Created</p>
                            <p class="text-sm font-medium text-gray-800">{{ $booking->created_at->format('M d, Y H:i A') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Last Updated</p>
                            <p class="text-sm font-medium text-gray-800">{{ $booking->updated_at->format('M d, Y H:i A') }}</p>
                        </div>

<div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Inspection Date</p>
                            <p class="text-sm font-bold text-[#2D6A4F]">{{$booking->booking_date}}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Total Guests</p>
                            <p class="text-sm font-medium text-gray-800">{{ $booking->guests ?? 1 }} guest(s)</p>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <!-- Guest Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-user-circle text-[#2D6A4F] mr-2"></i>
                        Guest Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-md">
                            {{ strtoupper(substr($booking->username  ?? 'G', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-xl font-semibold text-gray-800">{{ $booking->username ?? $booking->name ?? 'Guest' }}</p>
                            <p class="text-sm text-gray-500"><i class="fas fa-envelope mr-1 text-[#2D6A4F]"></i> {{ $booking->email ?? 'No email provided' }}</p>
                            @if($booking->phone)
                                <p class="text-sm text-gray-500"><i class="fas fa-phone mr-1 text-[#2D6A4F]"></i> {{ $booking->phone }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide"></p>
                            <p class="text-sm font-medium text-gray-800"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide"></p>
                            <p class="text-sm font-medium text-gray-800 capitalize"></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Property Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-building text-[#2D6A4F] mr-2"></i>
                        Property Information
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-24 h-24 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                            @if($booking->property->image)
                                <img src="{{ asset('storage/' . $booking->property->image[0]) }}" alt="" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-home text-3xl text-gray-400"></i>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="text-lg font-semibold text-gray-800">{{ $booking->property->title ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>
                                {{ $booking->property->address ?? '' }}, {{ $booking->property->city ?? '' }}, {{ $booking->property->country ?? '' }}
                            </p>
                            <div class="flex flex-wrap gap-4 mt-2">
                                <span class="text-sm text-gray-600"><i class="fas fa-bed text-[#2D6A4F] mr-1"></i> {{ $booking->property->bedrooms ?? 'N/A' }} beds</span>
                                <span class="text-sm text-gray-600"><i class="fas fa-bath text-[#2D6A4F] mr-1"></i> {{ $booking->property->bathrooms ?? 'N/A' }} baths</span>
                                <span class="text-sm text-gray-600"><i class="fas fa-dollar-sign text-[#2D6A4F] mr-1"></i> ${{ number_format($booking->property->price_per_night ?? 0, 2) }}/night</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Special Requests -->
            @if($booking->special_requests)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-clipboard-list text-[#2D6A4F] mr-2"></i>
                        Special Requests
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 whitespace-pre-line">{{ $booking->special_requests }}</p>
                </div>
            </div>
            @endif
        </div>
        
        <!-- ========== RIGHT COLUMN - Sidebar ========== -->
        <div class="space-y-6">
            
            <!-- Roommate Status Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-user-friends text-[#2D6A4F] mr-2"></i>
                        Roommate Status
                    </h3>
                </div>
                <div class="p-6">
                    @if($booking->needs_roommate)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Roommate Required</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                                <i class="fas fa-check-circle mr-1"></i> Yes
                            </span>
                        </div>
                    @else
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Roommate Required</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                <i class="fas fa-times-circle mr-1"></i> No
                            </span>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Roommate Details Card (shown only if roommate is required) -->
            @if($booking->needs_roommate)
            <div class="bg-white rounded-2xl shadow-sm border border-[#2D6A4F] overflow-hidden">
                <div class="px-6 py-4 border-b border-[#2D6A4F] bg-[#2D6A4F]/5">
                    <h3 class="text-lg font-semibold text-[#2D6A4F] flex items-center">
                        <i class="fas fa-user-plus text-[#2D6A4F] mr-2"></i>
                        Roommate Details
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Roommate Name -->
                    <div class="flex items-start space-x-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-mars text-gray-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Gender</p>
                            <p class="text-gray-800 font-medium">{{ ucfirst($booking->roommate_gender) ?? 'Not provided' }}</p>
                        </div>
                    </div>
                    
                    <!-- Roommate Email -->
                    <div class="flex items-start space-x-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-calendar text-gray-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Age</p>
                            <p class="text-gray-800 font-medium">{{ $booking->roommate_age ?? 'Not provided' }}</p>
                        </div>
                    </div>
                    
                    <!-- Roommate Phone -->
                    <div class="flex items-start space-x-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map text-gray-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">State of origin</p>
                            <p class="text-gray-800 font-medium">{{ $booking->state_of_origin ?? 'Not provided' }}</p>
                        </div>
                    </div>
                    

                    <!-- Roommate Phone -->
                    <div class="flex items-start space-x-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-place-of-worship text-gray-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Religion</p>
                            <p class="text-gray-800 font-medium">{{ ucfirst($booking->religion) ?? 'Not provided' }}</p>
                        </div>
                    </div>


                    <!-- Roommate Age -->
                    <div class="flex items-start space-x-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-calendar-alt text-gray-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Age</p>
                            <p class="text-gray-800 font-medium">{{ $booking->roommate_age ?? 'Not provided' }}</p>
                        </div>
                    </div>
                    
                    <!-- Roommate Notes -->
                    @if($booking->roommate_note)
                    <div class="flex items-start space-x-3 pt-2">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-sticky-note text-gray-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Additional Notes</p>
                            <p class="text-gray-700 text-sm mt-1">{{ $booking->roommate_note }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            
            <!-- Price Summary Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                      ₦
                        Price Summary
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Property</span>
                        <span class="text-gray-800 font-medium">{{ $booking->property->title ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Rent Fee</span>
                        <span class="text-gray-800 font-medium">{{ App\Helper::formatNaira(number_format($booking->property->rent_fee, 2)) }}</span>
                    </div>
                     <div class="flex justify-between">
                        <span class="text-gray-600">Legal Fee</span>
                        <span class="text-gray-800 font-medium">{{  App\Helper::formatNaira(number_format($booking->property->legal_fee, 2))}}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Service Fee</span>
                        <span class="text-gray-800 font-medium">{{  App\Helper::formatNaira(number_format($booking->property->mgt_fee, 2))}}</span>
                    </div>
                     <div class="flex justify-between">
                        <span class="text-gray-600">Caution Fee</span>
                        <span class="text-gray-800 font-medium">{{  App\Helper::formatNaira(number_format($booking->property->caution_fee, 2))}}</span>
                    </div>
                     <div class="flex justify-between">
                        <span class="text-gray-600">Agency Fee</span>
                        <span class="text-gray-800 font-medium">{{  App\Helper::formatNaira(number_format($booking->property->agency_fee, 2))}}</span>
                    </div>
                    @if($booking->needs_roommate)
                   <!-- <div class="flex justify-between text-sm text-gray-500">
                        <span>Roommate Fee</span>
                        <span>0.00</span>
                    </div>-->
                    @endif
                    <div class="pt-3 mt-2 border-t border-gray-200">
                        <div class="flex justify-between">
                            <span class="font-bold text-gray-800">Total</span>
                            <span class="text-xl font-bold text-[#2D6A4F]">{{App\Helper::formatNaira(number_format($booking->property->rent_fee + $booking->property->agency_fee + $booking->property->legal_fee  + $booking->property->caution_fee + $booking->property->mgt_fee))}}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-bolt text-[#2D6A4F] mr-2"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="p-4 space-y-2">
                    <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="w-full px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg transition flex items-center justify-center space-x-2">
                            <i class="fas fa-check-circle"></i>
                            <span>Confirm Booking</span>
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="w-full px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition flex items-center justify-center space-x-2">
                            <i class="fas fa-times-circle"></i>
                            <span>Cancel Booking</span>
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form-{{ $booking->id }}" action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete Booking</h3>
            <p class="text-gray-500 text-center text-sm">Are you sure you want to delete this booking? This action cannot be undone.</p>
            <div class="flex space-x-3 mt-6">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button id="confirmDeleteBtn" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let deleteId = null;
    
    function confirmDelete(id) {
        deleteId = id;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
        deleteId = null;
    }
    
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteId) {
            document.getElementById(`delete-form-${deleteId}`).submit();
        }
    });
    
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endpush
@endsection