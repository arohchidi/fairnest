@extends('layouts.app')

@section('title', 'Properties for Rent')
@section('description', 'Browse our collection of premium properties')

@section('content')
<div class="bg-gray-50 min-h-screen">
    
    <!-- Hero Banner -->
    <div class="relative bg-gradient-to-r from-[#0A1928] via-[#0D2A3A] to-[#1B4D3E] py-20 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#2D6A4F]/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#1B4D3E]/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/5 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" data-aos="fade-up">
                Discover Your <span class="text-[#2D6A4F]">Dream Property</span>
            </h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Browse through our curated collection of premium properties in the most desirable locations
            </p>
            <div class="flex flex-wrap justify-center gap-3 mt-6" data-aos="fade-up" data-aos-delay="200">
                <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/10">
                    <i class="fas fa-home mr-2 text-[#2D6A4F]"></i> 500+ Properties
                </span>
                <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/10">
                    <i class="fas fa-users mr-2 text-[#2D6A4F]"></i> 10K+ Happy Renters
                </span>
                <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm border border-white/10">
                    <i class="fas fa-star mr-2 text-[#2D6A4F]"></i> 4.9 Average Rating
                </span>
            </div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        
      @include('components.advanced-filter')
        <!-- Property Grid / List View -->
        <div id="propertyContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($properties as $property)
                <div class="property-card group bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100" 
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    
                    <!-- Image Section -->
                    <div class="relative overflow-hidden h-64">
                        <img src="{{ $property->images[0] ? asset('storage/' . $property->images[0]) : 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600&h=400&fit=crop' }}" 
                             alt="{{ $property->title }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            @if($property->is_available == 'true')
                                <span class="px-3 py-1 bg-[#2D6A4F] text-white text-xs font-medium rounded-full animate-pulse">
                                    <i class="fas fa-check-circle mr-1"></i> Available
                                </span>
                            @elseif($property->is_available == 'false')
                                <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-medium rounded-full">
                                    <i class="fas fa-clock mr-1"></i> Pending
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gray-500 text-white text-xs font-medium rounded-full">
                                    <i class="fas fa-times-circle mr-1"></i> Rented
                                </span>
                            @endif
                            
                            @if($property->is_featured ?? false)
                                <span class="px-3 py-1 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white text-xs font-medium rounded-full">
                                    <i class="fas fa-star mr-1"></i> Featured
                                </span>
                            @endif
                        </div>
                        
                        <!-- Wishlist Button -->
                        <button class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/40 transition group-hover:scale-110">
                            <i class="far fa-heart text-white text-lg"></i>
                        </button>
                        
                        <!-- Price -->
                        <div class="absolute bottom-4 left-4">
                            <p class="text-white text-2xl font-bold">{{ App\Helper::formatNaira(number_format($property->rent_fee, 0)) }}</p>
                            <p class="text-gray-300 text-sm">rent</p>
                        </div>
                        
                        <!-- Rating -->
                        <div class="absolute bottom-4 right-4 bg-black/50 backdrop-blur-sm rounded-full px-3 py-1.5 flex items-center space-x-1">
                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                            <span class="text-white text-sm font-medium">{{ number_format($property->rating ?? 0, 1) }}</span>
                        </div>
                    </div>
                    
                    <!-- Content Section -->
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-[#2D6A4F] transition line-clamp-1">
                                {{ $property->title }}
                            </h3>
                        </div>
                        
                        <p class="text-gray-500 text-sm mb-3">
                            <i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>
                            {{ $property->address }}, {{ $property->city }}, {{ $property->country }}
                        </p>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($property->description ?? 'Beautiful property with amazing views and modern amenities.', 80) }}
                        </p>
                        
                        <!-- Features -->
                        <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-100 pt-3">
                            <div class="flex items-center space-x-3">
                                <span class="flex items-center space-x-1">
                                    <i class="fas fa-bed text-[#2D6A4F]"></i>
                                    <span>{{ $property->number_of_bedrooms ?? 'N/A' }}</span>
                                </span>
                                <span class="flex items-center space-x-1">
                                    <i class="fas fa-bath text-[#2D6A4F]"></i>
                                    <span>{{ $property->number_of_bathrooms ?? 'N/A' }}</span>
                                </span>
                                <span class="flex items-center space-x-1">
                                    <i class="fas fa-users text-[#2D6A4F]"></i>
                                    <span>@if($property->roommate_preferences == true) Yes @else No @endif</span>
                                </span>
                            </div>
                            <span class="text-xs text-gray-400">{{ $property->sqft ?? '' }} sq ft</span>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('property.details', $property) }}" 
                               class="flex-1 text-center px-4 py-2 bg-[#2D6A4F] text-white rounded-xl font-medium hover:bg-[#1B4D3E] transition hover:shadow-lg">
                                View Details
                            </a>
                            <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition">
                                <i class="fas fa-phone"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-gray-100">
                    <i class="fas fa-home text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600">No Properties Found</h3>
                    <p class="text-gray-400 mt-2">Try adjusting your search filters or browse all properties.</p>
                    <a href="{{ route('property-listings') }}" class="inline-block mt-4 px-6 py-2 bg-[#2D6A4F] text-white rounded-xl hover:bg-[#1B4D3E] transition">
                        Clear Filters
                    </a>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($properties->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="bg-white rounded-xl shadow-sm px-4 py-3 border border-gray-100">
                    {{ $properties->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@include('components.footer')
@push('scripts')
<script>
    // Grid/List View Toggle
    const gridViewBtn = document.getElementById('gridView');
    const listViewBtn = document.getElementById('listView');
    const container = document.getElementById('propertyContainer');
    
    gridViewBtn.addEventListener('click', function() {
        container.classList.remove('grid-cols-1', 'md:grid-cols-1');
        container.classList.add('grid-cols-1', 'md:grid-cols-2', 'lg:grid-cols-3');
        this.classList.add('bg-[#2D6A4F]', 'text-white');
        this.classList.remove('bg-gray-200', 'text-gray-600');
        listViewBtn.classList.remove('bg-[#2D6A4F]', 'text-white');
        listViewBtn.classList.add('bg-gray-200', 'text-gray-600');
        localStorage.setItem('propertyView', 'grid');
    });
    
    listViewBtn.addEventListener('click', function() {
        container.classList.remove('grid-cols-1', 'md:grid-cols-2', 'lg:grid-cols-3');
        container.classList.add('grid-cols-1', 'md:grid-cols-1', 'lg:grid-cols-1');
        this.classList.add('bg-[#2D6A4F]', 'text-white');
        this.classList.remove('bg-gray-200', 'text-gray-600');
        gridViewBtn.classList.remove('bg-[#2D6A4F]', 'text-white');
        gridViewBtn.classList.add('bg-gray-200', 'text-gray-600');
        localStorage.setItem('propertyView', 'list');
    });
    
    // Restore view preference
    const savedView = localStorage.getItem('propertyView');
    if (savedView === 'list') {
        listViewBtn.click();
    }
    
    // Auto-submit on filter change
    document.querySelectorAll('#filterForm select, #filterForm input[type="text"]').forEach(el => {
        el.addEventListener('change', function() {
            this.closest('form').submit();
        });
    });
    
    // Search with debounce
    let searchTimeout;
    document.querySelector('input[name="search"]').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            this.closest('form').submit();
        }, 500);
    });
    
    // Result count update
    const resultCount = document.getElementById('resultCount');
    const totalItems = {{ $properties->total() }};
    resultCount.textContent = `Showing ${totalItems} property${totalItems !== 1 ? 's' : ''}`;
</script>

<style>
    .property-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .property-card .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .property-card .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .property-card .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
    
    /* Pagination Styling */
    .pagination {
        display: flex;
        gap: 0.25rem;
    }
    
    .pagination .page-item {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .pagination .page-item.active {
        background: #2D6A4F;
        color: white;
    }
    
    .pagination .page-item:not(.active):not(.disabled) {
        color: #4a5568;
        background: transparent;
    }
    
    .pagination .page-item:not(.active):not(.disabled):hover {
        background: #f3f4f6;
    }
    
    .pagination .page-item.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .pagination .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        padding: 0 0.75rem;
    }
</style>
@endpush
@endsection