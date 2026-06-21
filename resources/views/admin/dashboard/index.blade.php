@extends('admin.layouts.app')

@section('title', 'Analytics Dashboard')
@section('header-title', 'Analytics Dashboard')
@section('header-description', 'Real-time insights and performance metrics')

@section('content')
<div class="space-y-6">
    
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] rounded-2xl shadow-lg p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->username }}!</h2>
                <p class="text-gray-300">Here's what's happening with your property business today.</p>
            </div>
            <div class="hidden md:block">
                <div class="bg-[#2D6A4F]/20 rounded-full px-4 py-2">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span class="text-sm">{{ now()->format('l, F j, Y') }}</span>
                </div>
            </div>
        </div>
    </div>


   
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Total Users -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Users</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($statistics['total_users']) }}</p>
                    <p class="text-xs text-gray-400 mt-2">Registered members</p>
                </div>
                <div class="w-12 h-12 bg-[#2D6A4F]/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-2xl text-[#2D6A4F]"></i>
                </div>
            </div>
        </div>

         <!-- Total Users -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Active Users</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($statistics['active_users']) }}</p>
                    <p class="text-xs text-gray-400 mt-2">Active members</p>
                </div>
                <div class="w-12 h-12 bg-[#2D6A4F]/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-2xl text-[#2D6A4F]"></i>
                </div>
            </div>
        </div>

         <!-- Total Users -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Inactive Users</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($statistics['in_active_users']) }}</p>
                    <p class="text-xs text-gray-400 mt-2">Banned members</p>
                </div>
                <div class="w-12 h-12 bg-[#2D6A4F]/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-2xl text-[#2D6A4F]"></i>
                </div>
            </div>
        </div>
    
        <!-- Total Properties -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Properties</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($statistics['total_properties']) }}</p>
                    <p class="text-xs text-gray-400 mt-2">All listings</p>
                </div>
                <div class="w-12 h-12 bg-[#2D6A4F]/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-building text-2xl text-[#2D6A4F]"></i>
                </div>
            </div>
        </div>
        
        <!-- Active Bookings -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Active Bookings</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($statistics['active_bookings']) }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up mr-1"></i> 
                    </p>
                </div>
                <div class="w-12 h-12 bg-[#2D6A4F]/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-check text-2xl text-[#2D6A4F]"></i>
                </div>
            </div>
        </div>
        
       
        
        <!-- Revenue -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Revenue</p>
                    <p class="text-3xl font-bold text-gray-800">${{ number_format($statistics['total_revenue'], 2) }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-chart-line mr-1"></i> Lifetime earnings
                    </p>
                </div>
                <div class="w-12 h-12 bg-[#2D6A4F]/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-2xl text-[#2D6A4F]"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Additional Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pending Bookings</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ number_format($statistics['pending_bookings']) }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Cancelled Bookings</p>
                    <p class="text-2xl font-bold text-red-600">{{ number_format($statistics['cancelled_bookings']) }}</p>
                </div>
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Average Rating</p>
                    <p class="text-2xl font-bold text-[#2D6A4F]">{{ number_format($statistics['average_rating'], 1) }} / 5.0</p>
                </div>
                <div class="flex text-yellow-400">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Revenue Overview</h3>
                    <p class="text-sm text-gray-500 mt-1">Last 12 months performance</p>
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm bg-[#2D6A4F] text-white rounded-lg">Year</button>
                    <button class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">Month</button>
                </div>
            </div>
            <canvas id="revenueChart" height="250"></canvas>
        </div>
        
        <!-- Booking Trends Chart -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Booking Trends</h3>
                    <p class="text-sm text-gray-500 mt-1">Monthly booking statistics</p>
                </div>
                <select class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                    <option>This Year</option>
                    <option>Last Year</option>
                </select>
            </div>
            <canvas id="bookingChart" height="250"></canvas>
        </div>
    </div>
    
    <!-- Recent Bookings & Top Properties -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Bookings Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Recent Bookings</h3>
                    <p class="text-sm text-gray-500 mt-1">Latest customer activities</p>
                </div>
                <a href="#" class="text-[#2D6A4F] hover:text-[#1B4D3E] text-sm font-medium">View All <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
            
            <div class="divide-y divide-gray-100">
                @forelse($recentBookings as $booking)
                <div class="px-6 py-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center text-gray-600 font-semibold">
                                {{ strtoupper(substr($booking['guest_name'], 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $booking['guest_name'] }}</p>
                                <p class="text-sm text-gray-500">{{ $booking['property_title'] }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    <i class="far fa-calendar-alt mr-1"></i> {{ $booking['booking_date'] }}
                                    <span class="mx-1">•</span>
                                   
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 py-1 text-xs rounded-full bg-{{ $booking['status_color'] }}-100 text-{{ $booking['status_color'] }}-700">
                                {{ ucfirst($booking['status']) }}
                            </span>
                            
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center text-gray-500">No recent bookings</div>
                @endforelse
            </div>
        </div>
        
        <!-- Top Properties -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">Top Performing Properties</h3>
                <p class="text-sm text-gray-500 mt-1">Most booked listings</p>
            </div>
            
            <div class="divide-y divide-gray-100">
                @forelse($topProperties as $property)
                <div class="px-6 py-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden">
                                @if($property['image'])
                                    <img src="{{ $property['image'] }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-[#2D6A4F]/10">
                                        <i class="fas fa-building text-[#2D6A4F]"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ Str::limit($property['title'], 30) }}</p>
                                <p class="text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $property['location'] }}
                                </p>
                                <div class="flex items-center mt-1">
                                    <div class="flex text-yellow-400 text-xs">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($property['rating']))
                                                <i class="fas fa-star"></i>
                                            @elseif($i - 0.5 <= $property['rating'])
                                                <i class="fas fa-star-half-alt"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-500 ml-1">({{ $property['rating'] }})</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-[#2D6A4F]">{{ App\Helper::formatNaira(number_format($property['rent'], 2)) }}</p>
                            <p class="text-xs text-gray-500">/basic rent</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $property['total_bookings'] }} bookings</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center text-gray-500">No properties found</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueData['labels']) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($revenueData['data']) !!},
                borderColor: '#2D6A4F',
                backgroundColor: 'rgba(45, 106, 79, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#2D6A4F',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return '$' + context.raw.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
    
    // Booking Chart
    const bookingCtx = document.getElementById('bookingChart').getContext('2d');
    new Chart(bookingCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bookingTrends['labels']) !!},
            datasets: [{
                label: 'Bookings',
                data: {!! json_encode($bookingTrends['data']) !!},
                backgroundColor: '#2D6A4F',
                borderRadius: 8,
                barPercentage: 0.7,
                categoryPercentage: 0.8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { display: true },
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endpush
@endsection