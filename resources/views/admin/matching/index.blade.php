@extends('admin.layouts.app')

@section('title', 'Roommate Matching')
@section('header-title', 'Roommate Matching')
@section('header-description', 'Intelligent roommate matching based on booking preferences')

@section('content')
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-[#2D6A4F]">
            <p class="text-gray-500 text-xs">Total Roommate Requests</p>
            <p class="text-2xl font-bold text-gray-800">{{ $statistics['total_requests'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
            <p class="text-gray-500 text-xs">Potential Matches</p>
            <p class="text-2xl font-bold text-blue-600">{{ $statistics['potential_matches'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
            <p class="text-gray-500 text-xs">Pending Connections</p>
            <p class="text-2xl font-bold text-green-600">{{ $statistics['pending_connections'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
            <p class="text-gray-500 text-xs">Match Rate</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $statistics['match_rate'] ?? '0%' }}</p>
        </div>
    </div>
    
    <!-- Matching Results -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse($matches as $match)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
            
            <!-- Match Header -->
            <div class="bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] px-6 py-3 text-white flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-heart text-[#2D6A4F] text-lg"></i>
                    <span class="font-medium">Roommate Match</span>
                </div>
                <span class="inline-flex items-center px-3 py-1 bg-[#2D6A4F] text-white text-xs font-medium rounded-full">
                    {{ $match['match_score'] }}% Match
                </span>
            </div>
            
            <!-- Match Content -->
            <div class="p-6">
                <div class="grid grid-cols-2 gap-6">
                    <!-- Person 1 -->
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                            {{ strtoupper(substr($match['person1']['name'], 0, 1)) }}
                        </div>
                        <h4 class="font-semibold text-gray-800 mt-2">{{ $match['person1']['name'] }}</h4>
                        <div class="flex flex-wrap justify-center gap-1 mt-1">
                            <span class="text-xs text-gray-500">{{ $match['person1']['age'] ?? 'N/A' }} yrs</span>
                            <span class="text-xs text-gray-300">•</span>
                            <span class="text-xs text-gray-500 capitalize">{{ $match['person1']['gender'] ?? 'N/A' }}</span>
                        </div>
                        <div class="mt-2 flex flex-wrap justify-center gap-1">
                            @if($match['person1']['needs_roommate'])
                                <span class="inline-block px-2 py-0.5 bg-green-100 text-green-600 text-xs rounded-full">
                                    <i class="fas fa-check-circle mr-0.5"></i> Needs Roommate
                                </span>
                            @endif
                        </div>
                        <div class="mt-2">
                            <span class="text-xs text-gray-400">
                                <i class="fas fa-calendar-alt mr-1"></i> Booked: {{ $match['person1']['booking_date'] }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Match Center -->
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center">
                            <i class="fas fa-handshake text-2xl text-[#2D6A4F]"></i>
                        </div>
                        <div class="w-full mt-2">
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Similarity</span>
                                <span class="font-semibold text-[#2D6A4F]">{{ $match['match_score'] }}%</span>
                            </div>
                            <div class="w-full h-1.5 bg-gray-200 rounded-full overflow-hidden mt-1">
                                <div class="h-full bg-[#2D6A4F] rounded-full" style="width: {{ $match['match_score'] }}%"></div>
                            </div>
                        </div>
                        <div class="mt-3 flex flex-wrap justify-center gap-2">
                            @if($match['same_gender'])
                                <span class="inline-block px-2 py-0.5 bg-[#2D6A4F]/10 text-[#2D6A4F] text-xs rounded-full">
                                    <i class="fas fa-check-circle mr-0.5"></i> Same Gender
                                </span>
                            @endif
                            @if($match['age_difference'] <= 3)
                                <span class="inline-block px-2 py-0.5 bg-[#2D6A4F]/10 text-[#2D6A4F] text-xs rounded-full">
                                    <i class="fas fa-check-circle mr-0.5"></i> Similar Age
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Match Details -->
                <div class="mt-4 pt-4 border-t border-gray-100 grid grid-cols-3 gap-2 text-center text-xs">
                    <div>
                        <p class="text-gray-400">Age Difference</p>
                        <p class="font-semibold text-gray-700">{{ $match['age_difference'] }} years</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Same Gender</p>
                        <p class="font-semibold text-gray-700">{{ $match['same_gender'] ? '✅ Yes' : '❌ No' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Status</p>
                        <p class="font-semibold text-gray-700 capitalize">{{ $match['status'] }}</p>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="mt-4 flex space-x-3">
                    <button onclick="viewRoommateDetails({{ json_encode($match['person1']) }}, {{ json_encode($match['person2']) }})" 
                            class="flex-1 px-4 py-2 bg-[#2D6A4F]/10 text-[#2D6A4F] text-center rounded-lg font-medium hover:bg-[#2D6A4F] hover:text-white transition text-sm">
                        <i class="fas fa-eye mr-1"></i> View Details
                    </button>
                    <button onclick="connectRoommates({{ $match['person1']['booking_id'] }}, {{ $match['person2']['booking_id'] }})" 
                            class="flex-1 px-4 py-2 bg-[#2D6A4F] text-white rounded-lg font-medium hover:bg-[#1B4D3E] transition text-sm">
                        <i class="fas fa-handshake mr-1"></i> Connect
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-gray-100">
            <i class="fas fa-users-slash text-5xl text-gray-300 mb-3"></i>
            <p class="text-gray-500 text-lg">No roommate matches found</p>
            <p class="text-gray-400 text-sm mt-1">New matches will appear when users request roommates</p>
        </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($matches->hasPages())
    <div class="flex justify-center">
        {{ $matches->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<!-- ============================================ -->
<!-- VIEW DETAILS MODAL -->
<!-- ============================================ -->
<div id="viewModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-3xl w-full mx-4 max-h-[90vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-users text-[#2D6A4F] mr-2"></i>
                Roommate Details
            </h3>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div id="viewModalContent" class="p-6 overflow-y-auto max-h-[70vh]">
            <!-- Content loaded via JavaScript -->
        </div>
        
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end">
            <button onclick="closeViewModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Close
            </button>
        </div>
    </div>
</div>

<!-- ============================================ -->
<!-- CONNECT MODAL -->
<!-- ============================================ -->
<div id="connectModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-handshake text-[#2D6A4F] mr-2"></i>
                Connect Roommates
            </h3>
            <button onclick="closeConnectModal()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="p-6">
            <div class="text-center mb-4">
                <div class="w-16 h-16 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mx-auto">
                    <i class="fas fa-user-friends text-2xl text-[#2D6A4F]"></i>
                </div>
                <p class="text-gray-600 mt-3 text-sm">
                    Connect these two roommates. They will be notified and can discuss further.
                </p>
            </div>
            
            <form id="connectForm" method="POST" action="{{ route('admin.matching.connect') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="booking1_id" id="connectBooking1Id">
                <input type="hidden" name="booking2_id" id="connectBooking2Id">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message to Both</label>
                    <textarea name="message" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]" placeholder="Hi! We've found a potential roommate match for you based on your preferences. Feel free to connect and discuss further."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeConnectModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">
                        <i class="fas fa-paper-plane mr-2"></i> Send Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // View Roommate Details
    function viewRoommateDetails(person1, person2) {
        const content = document.getElementById('viewModalContent');
        
        content.innerHTML = `
            <div class="grid grid-cols-2 gap-6">
                <!-- Person 1 -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white text-xl font-bold">
                            ${person1.name ? person1.name.charAt(0).toUpperCase() : 'G'}
                        </div>
                        <h4 class="font-semibold text-gray-800 mt-2">${person1.name || 'Guest'}</h4>
                        <div class="flex flex-wrap justify-center gap-1 mt-1">
                            <span class="text-xs text-gray-500">${person1.age || 'N/A'} yrs</span>
                            <span class="text-xs text-gray-300">•</span>
                            <span class="text-xs text-gray-500 capitalize">${person1.gender || 'N/A'}</span>
                        </div>
                        ${person1.phone ? `<p class="text-xs text-gray-400 mt-1"><i class="fas fa-phone mr-1"></i> ${person1.phone}</p>` : ''}
                        ${person1.email ? `<p class="text-xs text-gray-400"><i class="fas fa-envelope mr-1"></i> ${person1.email}</p>` : ''}
                    </div>
                    <div class="mt-3 pt-3 border-t border-gray-200 text-xs">
                        <p><span class="text-gray-500">State:</span> <span class="font-medium">${person1.state || 'N/A'}</span></p>
                        <p><span class="text-gray-500">Religion:</span> <span class="font-medium">${person1.religion || 'N/A'}</span></p>
                        ${person1.notes ? `<p class="mt-1"><span class="text-gray-500">Notes:</span> <span class="text-gray-600">${person1.notes}</span></p>` : ''}
                    </div>
                </div>
                
                <!-- Person 2 -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white text-xl font-bold">
                            ${person2.name ? person2.name.charAt(0).toUpperCase() : 'G'}
                        </div>
                        <h4 class="font-semibold text-gray-800 mt-2">${person2.name || 'Guest'}</h4>
                        <div class="flex flex-wrap justify-center gap-1 mt-1">
                            <span class="text-xs text-gray-500">${person2.age || 'N/A'} yrs</span>
                            <span class="text-xs text-gray-300">•</span>
                            <span class="text-xs text-gray-500 capitalize">${person2.gender || 'N/A'}</span>
                        </div>
                        ${person2.phone ? `<p class="text-xs text-gray-400 mt-1"><i class="fas fa-phone mr-1"></i> ${person2.phone}</p>` : ''}
                        ${person2.email ? `<p class="text-xs text-gray-400"><i class="fas fa-envelope mr-1"></i> ${person2.email}</p>` : ''}
                    </div>
                    <div class="mt-3 pt-3 border-t border-gray-200 text-xs">
                        <p><span class="text-gray-500">State:</span> <span class="font-medium">${person2.state || 'N/A'}</span></p>
                        <p><span class="text-gray-500">Religion:</span> <span class="font-medium">${person2.religion || 'N/A'}</span></p>
                        ${person2.notes ? `<p class="mt-1"><span class="text-gray-500">Notes:</span> <span class="text-gray-600">${person2.notes}</span></p>` : ''}
                    </div>
                </div>
            </div>
            
            <div class="mt-4 p-4 bg-[#2D6A4F]/5 rounded-xl border border-[#2D6A4F]/20">
                <p class="text-sm text-gray-600 text-center">
                    <i class="fas fa-info-circle text-[#2D6A4F] mr-1"></i>
                    Both users requested a roommate during booking.
                </p>
            </div>
        `;
        
        document.getElementById('viewModal').classList.remove('hidden');
        document.getElementById('viewModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeViewModal() {
        document.getElementById('viewModal').classList.add('hidden');
        document.getElementById('viewModal').classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    // Connect Roommates
    function connectRoommates(booking1Id, booking2Id) {
        document.getElementById('connectBooking1Id').value = booking1Id;
        document.getElementById('connectBooking2Id').value = booking2Id;
        document.getElementById('connectModal').classList.remove('hidden');
        document.getElementById('connectModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeConnectModal() {
        document.getElementById('connectModal').classList.add('hidden');
        document.getElementById('connectModal').classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    // Close modals on outside click
    document.getElementById('viewModal').addEventListener('click', function(e) {
        if (e.target === this) closeViewModal();
    });
    document.getElementById('connectModal').addEventListener('click', function(e) {
        if (e.target === this) closeConnectModal();
    });
</script>
@endpush
@endsection