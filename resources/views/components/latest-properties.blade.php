<!-- ============================================ -->
<!-- LATEST PROPERTIES SECTION -->
<!-- ============================================ -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-10" data-aos="fade-up">
            <div>
                <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-[#2D6A4F]/10 px-4 py-1 rounded-full mb-3">
                    Latest Listings
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                    Newest <span class="text-[#2D6A4F]">Properties</span>
                </h2>
                <p class="text-gray-500 mt-2">Check out our newest property listings</p>
            </div>
            <a href="{{ route('property.listings') }}" class="hidden md:inline-flex items-center text-[#2D6A4F] font-medium hover:underline">
                View All <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        <!-- Properties Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($latestProperties as $property)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    
                    <!-- Image -->
                    <div class="relative h-52 overflow-hidden">
                        <img src="{{ $property->images[0] ? asset('storage/' . $property->images[0]) : 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&h=300&fit=crop' }}" 
                             alt="{{ $property->title }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <!-- Badges -->
                        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                            @if($property->is_available == 1)
                                <span class="px-2.5 py-1 bg-green-500 text-white text-xs font-medium rounded-full">
                                    Available
                                </span>
                            @endif
                            @if($property->featured == 1)
                                <span class="px-2.5 py-1 bg-yellow-500 text-white text-xs font-medium rounded-full">
                                    <i class="fas fa-star mr-1"></i> Featured
                                </span>
                            @endif
                            @if($property->created_at->diffInDays(now()) <= 3)
                                <span class="px-2.5 py-1 bg-blue-500 text-white text-xs font-medium rounded-full">
                                    New
                                </span>
                            @endif
                        </div>
                        
                        <!-- Price -->
                        <div class="absolute bottom-3 left-3">
                            <p class="text-white text-bold " >{{ App\Helper::formatNaira(number_format($property->rent_fee, 0)) }}</p>
                            <p class="text-gray-300 text-xs"></p>
                        </div>
                        <br/>
                        <!-- Rating -->
                        <div class="absolute bottom-3 right-3 text-yellow-400 backdrop-blur-sm rounded-full px-2.5 py-1 flex items-center space-x-1">
                            @php
    $avg_rating = $property->reviews_avg_ratings ?? 0;
@endphp
                                @for ($i = 1; $i <= 5; $i++)
    @if ($i <= floor($avg_rating))
        <i class="fas fa-star"></i>
    @elseif ($i - 0.5 <= $avg_rating)
        <i class="fas fa-star-half-alt"></i>
    @else
        <i class="far fa-star"></i>
    @endif
@endfor
                            <span class="text-white text-xs font-medium"> {{ number_format($property->reviews_avg_ratings ?? 0, 1) }}</span>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 group-hover:text-[#2D6A4F] transition line-clamp-1">
                            {{ $property->title }}
                        </h3>
                        
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>
                           {{ $property->address }}, {{ $property->city }}, {{ $property->country }}
                        </p>
                        
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                            <div class="flex items-center space-x-3 text-sm text-gray-500">
                                <span><i class="fas fa-bed text-[#2D6A4F] mr-1"></i> {{ $property->number_of_bedrooms ?? 'N/A' }}</span>
                                <span><i class="fas fa-bath text-[#2D6A4F] mr-1"></i> {{ $property->number_of_bathrooms ?? 'N/A' }}</span>
                            </div>
                            <span class="text-xs text-gray-400">{{ $property->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <a href="{{ route('property.details', $property) }}" 
                           class="mt-3 w-full block text-center px-4 py-2 bg-[#2D6A4F]/10 text-[#2D6A4F] rounded-xl font-medium hover:bg-[#2D6A4F] hover:text-white transition text-sm">
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-gray-100">
                    <i class="fas fa-home text-5xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">No properties available</p>
                    <p class="text-gray-400 text-sm mt-1">Check back later for new listings.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Mobile View All -->
        <div class="text-center mt-8 md:hidden" data-aos="fade-up">
            <a href="{{ route('property.listings') }}" class="inline-flex items-center px-6 py-3 bg-[#2D6A4F] text-white rounded-xl font-medium hover:bg-[#1B4D3E] transition hover:shadow-lg">
                View All Properties <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>