@extends('layouts.app')

@section('title', $property->title)
@section('description', $property->description ?? 'View this amazing property')

@section('content')
<div class="bg-gray-50 min-h-screen pt-16">
    
    <!-- ============================================ -->
    <!-- BREADCRUMB -->
    <!-- ============================================ -->
    <div class="bg-white border-b border-gray-200 py-4 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center text-sm">
                <a href="{{ url('/') }}" class="text-gray-500 hover:text-[#2D6A4F] transition">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                <i class="fas fa-chevron-right mx-3 text-gray-300 text-xs"></i>
                <a href="{{ url('properties.index') }}" class="text-gray-500 hover:text-[#2D6A4F] transition">
                    Properties
                </a>
                <i class="fas fa-chevron-right mx-3 text-gray-300 text-xs"></i>
                <span class="text-[#2D6A4F] font-semibold truncate">{{ $property->title }}</span>
            </nav>
        </div>
    </div>
     
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
        </div>
    </div>
    
    <!-- ============================================ -->
    <!-- IMAGE GALLERY -->
    <!-- ============================================ -->
    <section class="bg-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @php
                $allImages = collect($property->images ?? [])
                    ->filter()
                    ->values()
                    ->toArray();
            @endphp

            <div class="relative h-[450px] md:h-[600px] rounded-2xl overflow-hidden shadow-lg">

                <img
                    id="mainImage"
                    src="{{ count($allImages) ? asset('storage/' . $allImages[0]) : asset('images/no-image.jpg') }}"
                    alt="{{ $property->title }}"
                    class="w-full h-full object-cover transition-opacity duration-300"
                >

                @if(count($allImages) > 1)

                    <button
                        type="button"
                        onclick="prevImage()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-black/40 hover:bg-black/60 text-white w-12 h-12 rounded-full flex items-center justify-center"
                    >
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <button
                        type="button"
                        onclick="nextImage()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-black/40 hover:bg-black/60 text-white w-12 h-12 rounded-full flex items-center justify-center"
                    >
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/60 text-white px-4 py-2 rounded-full text-sm">
                        <span id="imageCounter">1</span> /
                        {{ count($allImages) }}
                    </div>

                @endif

            </div>

            @if(count($allImages) > 1)

                <div
                    id="thumbnailContainer"
                    class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-3 mt-4"
                >

                    @foreach($allImages as $index => $image)

                        <div
                            onclick="goToImage({{ $index }})"
                            class="cursor-pointer border-2 rounded-xl overflow-hidden h-24 thumbnail-item {{ $index === 0 ? 'border-[#2D6A4F]' : 'border-transparent' }}"
                        >
                            <img
                                src="{{ asset('storage/' . $image) }}"
                                class="w-full h-full object-cover"
                                alt=""
                            >
                        </div>

                    @endforeach

                </div>

            @endif

        </div>
    </section>
    
    <!-- ============================================ -->
    <!-- MAIN CONTENT -->
    <!-- ============================================ -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- ============================================ -->
            <!-- LEFT COLUMN (8/12) -->
            <!-- ============================================ -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Property Header -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                @if($property->is_available == 'true')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i> Available
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">
                                        <i class="fas fa-times-circle mr-1"></i> Not Available
                                    </span>
                                @endif
                                
                                @if($property->is_featured ?? false)
                                    <span class="px-3 py-1 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white text-xs font-medium rounded-full">
                                        <i class="fas fa-crown mr-1"></i> Featured
                                    </span>
                                @endif
                                
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full capitalize">
                                    <i class="fas fa-tag mr-1"></i> {{ $property->type_of_house ?? 'Property' }}
                                </span>
                            </div>
                            
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">{{ $property->title }}</h1>
                            <div class="flex flex-wrap items-center gap-4 mt-2">
                                <p class="text-gray-500">
                                    <i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>
                                    {{ $property->address }}, {{ $property->city }}, {{ $property->country }}
                                </p>
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="font-semibold text-gray-800">{{ number_format($property->avg_rating ?? 0, 1) }}</span>
                                    <span class="text-gray-400 text-sm">({{ $property->reviews_count ?? 0 }} reviews)</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-bold text-[#2D6A4F]">{{ App\Helper::formatNaira(number_format($property->rent_fee, 2)) }}</p>
                            <p class="text-sm text-gray-500">rent</p>
                        </div>
                        
                    </div>
                    <a 
    href="{{route('book.inspection', $property)}}"
    class="inline-flex items-center px-6 py-3 bg-[#2D6A4F] text-white rounded-xl font-semibold">
    <i class="fas fa-check mr-2"></i>
    Book
</a>
                </div>
                
                <!-- Description -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-align-left text-[#2D6A4F] mr-2"></i> About This Property
                    </h3>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $property->description ?? 'No description available.' }}</p>
                </div>



                <!-- ============================================ -->
<!-- PROPERTY DETAILS SECTION -->
<!-- ============================================ -->
<div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
    <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-info-circle text-[#2D6A4F] mr-2"></i> 
        Property Details
    </h3>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        
        <!-- Property Type -->
        <div class="bg-gray-50 rounded-xl p-4 text-center hover:bg-[#2D6A4F]/5 transition group">
            <div class="w-12 h-12 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#2D6A4F] transition">
                <i class="fas fa-tag text-[#2D6A4F] text-lg group-hover:text-white transition"></i>
            </div>
            <p class="text-sm text-gray-500">Property Type</p>
            <p class="font-semibold text-gray-800 capitalize">{{ $property->type_of_house ?? 'N/A' }}</p>
        </div>
        
        <!-- Bedrooms -->
        <div class="bg-gray-50 rounded-xl p-4 text-center hover:bg-[#2D6A4F]/5 transition group">
            <div class="w-12 h-12 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#2D6A4F] transition">
                <i class="fas fa-bed text-[#2D6A4F] text-lg group-hover:text-white transition"></i>
            </div>
            <p class="text-sm text-gray-500">Bedrooms</p>
            <p class="font-semibold text-gray-800">{{ $property->number_of_bedrooms ?? 'N/A' }}</p>
        </div>
        
        <!-- Bathrooms -->
        <div class="bg-gray-50 rounded-xl p-4 text-center hover:bg-[#2D6A4F]/5 transition group">
            <div class="w-12 h-12 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#2D6A4F] transition">
                <i class="fas fa-bath text-[#2D6A4F] text-lg group-hover:text-white transition"></i>
            </div>
            <p class="text-sm text-gray-500">Bathrooms</p>
            <p class="font-semibold text-gray-800">{{ $property->number_of_bathrooms ?? 'N/A' }}</p>
        </div>
        
        <!-- Max Guests -->
        <div class="bg-gray-50 rounded-xl p-4 text-center hover:bg-[#2D6A4F]/5 transition group">
            <div class="w-12 h-12 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#2D6A4F] transition">
                <i class="fas fa-users text-[#2D6A4F] text-lg group-hover:text-white transition"></i>
            </div>
            <p class="text-sm text-gray-500">Max Guests</p>
            <p class="font-semibold text-gray-800">{{ $property->max_guests ?? 'N/A' }}</p>
        </div>
        
        <!-- Size -->
        <div class="bg-gray-50 rounded-xl p-4 text-center hover:bg-[#2D6A4F]/5 transition group">
            <div class="w-12 h-12 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#2D6A4F] transition">
                <i class="fas fa-expand-arrows-alt text-[#2D6A4F] text-lg group-hover:text-white transition"></i>
            </div>
            <p class="text-sm text-gray-500">Size</p>
            <p class="font-semibold text-gray-800">{{ $property->sqft ?? 'N/A' }} <span class="text-xs text-gray-400">sq ft</span></p>
        </div>
        
        <!-- Year Built (Optional) -->
        @if($property->year_built)
        <div class="bg-gray-50 rounded-xl p-4 text-center hover:bg-[#2D6A4F]/5 transition group">
            <div class="w-12 h-12 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#2D6A4F] transition">
                <i class="fas fa-calendar-alt text-[#2D6A4F] text-lg group-hover:text-white transition"></i>
            </div>
            <p class="text-sm text-gray-500">Year Built</p>
            <p class="font-semibold text-gray-800">{{ $property->year_built }}</p>
        </div>
        @endif
        
        <!-- Parking -->
        @if($property->parking)
        <div class="bg-gray-50 rounded-xl p-4 text-center hover:bg-[#2D6A4F]/5 transition group">
            <div class="w-12 h-12 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#2D6A4F] transition">
                <i class="fas fa-parking text-[#2D6A4F] text-lg group-hover:text-white transition"></i>
            </div>
            <p class="text-sm text-gray-500">Parking</p>
            <p class="font-semibold text-gray-800">{{ $property->number_of_parking_space }}</p>
        </div>
        @endif
        
        <!-- Pets Allowed -->
        @if($property->pets_allowed)
        <div class="bg-gray-50 rounded-xl p-4 text-center hover:bg-[#2D6A4F]/5 transition group">
            <div class="w-12 h-12 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#2D6A4F] transition">
                <i class="fas fa-paw text-[#2D6A4F] text-lg group-hover:text-white transition"></i>
            </div>
            <p class="text-sm text-gray-500">Pets Allowed</p>
            <p class="font-semibold text-gray-800">Yes</p>
        </div>
        @endif
        
        <!-- Furnished -->
        @if($property->is_furnished)
        <div class="bg-gray-50 rounded-xl p-4 text-center hover:bg-[#2D6A4F]/5 transition group">
            <div class="w-12 h-12 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#2D6A4F] transition">
                <i class="fas fa-couch text-[#2D6A4F] text-lg group-hover:text-white transition"></i>
            </div>
            <p class="text-sm text-gray-500">Furnished</p>
            <p class="font-semibold text-gray-800">@if($property->is_furnished == "true") Yes @else No @endif</p>
        </div>
        @endif
        
        <!-- Property ID -->
        <div class="bg-gray-50 rounded-xl p-4 text-center hover:bg-[#2D6A4F]/5 transition group">
            <div class="w-12 h-12 mx-auto bg-[#2D6A4F]/10 rounded-full flex items-center justify-center mb-2 group-hover:bg-[#2D6A4F] transition">
                <i class="fas fa-hashtag text-[#2D6A4F] text-lg group-hover:text-white transition"></i>
            </div>
            <p class="text-sm text-gray-500">Property ID</p>
            <p class="font-semibold text-gray-800">#{{ $property->id }}</p>
        </div>
    </div>
</div>
                
                <!-- Amenities -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-concierge-bell text-[#2D6A4F] mr-2"></i> Amenities & Features
                    </h3>
                    @if($property->meta_data && count($property->meta_data) > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach($property->meta_data as $amenity)
                                <div class="flex items-center space-x-2 p-3 bg-gray-50 rounded-xl hover:bg-[#2D6A4F]/5 transition">
                                    <i class="fas fa-check-circle text-[#2D6A4F] text-sm"></i>
                                    <span class="text-sm text-gray-700">{{ ucfirst(str_replace('_', ' ', $amenity)) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No amenities listed.</p>
                    @endif
                </div>
                
                <!-- Reviews -->
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8" id="reviews">
                    <div class="flex flex-wrap items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-star text-[#2D6A4F] mr-2"></i> 
                            Reviews & Ratings
                            <span class="ml-2 text-sm font-normal text-gray-400">({{ count($ratings) ?? 0 }})</span>
                        </h3>
                        <button onclick="document.getElementById('reviewForm').scrollIntoView({behavior: 'smooth'})" 
                                class="px-4 py-2 bg-[#2D6A4F] text-white rounded-xl hover:bg-[#1B4D3E] transition text-sm font-medium">
                            <i class="fas fa-pen mr-2"></i> Write a Review
                        </button>
                    </div>
                    
                    <!-- Rating Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-6 bg-gray-50 rounded-2xl">
                        <div class="text-center">
                            <p class="text-5xl font-bold text-[#2D6A4F]">{{
    $avg_rating =  number_format($ratings->avg(),1) ?? 0;
                            }}</p>
                            <div class="flex justify-center text-yellow-400 text-lg my-2">
                               @php
    $avg_rating = $ratings->avg() ?? 0;
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
                            </div>
                            <p class="text-sm text-gray-500">Based on {{ count($ratings) ?? 0 }} reviews</p>
                        </div>
                        <div class="space-y-2">
                        @php
    $totalReviews = $property->reviews->where('status','approved')->count();
@endphp
                            @for ($i = 5; $i >= 1; $i--)
    @php
        $count = $property->reviews->where('status','approved')->where('ratings', $i)->count();

        $percentage = $totalReviews
            ? round(($count / $totalReviews) * 100)
            : 0;
    @endphp

                                <div class="flex items-center space-x-3">
                                    <span class="text-sm text-gray-600 w-8">{{ $i }} <i class="fas fa-star text-yellow-400 text-xs"></i></span>
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-500 w-10">{{ $percentage }}%</span>
                                </div>
                            @endfor
                        </div>
                    </div>
                    
                    <!-- Reviews List -->
                    @if($reviews && count($reviews) > 0)
                        <div class="space-y-6">
                            @foreach($reviews as $review)
                                <div class="border-b border-gray-100 pb-6 last:border-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start space-x-4">
                                            <div class="w-12 h-12 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                                {{ strtoupper(substr($review->name ?? 'G', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $review->name ?? 'Guest' }}</p>
                                                <div class="flex items-center space-x-2 mt-1">
                                                    <div class="flex text-yellow-400 text-sm">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="{{ $i <= $review->ratings ? 'fas' : 'far' }} fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <span class="text-xs text-gray-400">{{ $review->created_at->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mt-2 leading-relaxed">{{ $review->comment ?? 'No comment provided.' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-comment-dots text-5xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg">No reviews yet</p>
                            <p class="text-gray-400 text-sm">Be the first to share your experience!</p>
                        </div>
                    @endif
                    
                    <!-- Write Review Form -->
                    <div id="reviewForm" class="mt-8 pt-8 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-pen text-[#2D6A4F] mr-2"></i> Write a Review
                        </h4>
                        
                       
                            <form method="POST" action="{{ route('property.review.store', $property) }}" class="space-y-4">
                                @csrf
                                
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-gray-700 mr-2">Your Rating:</span>
                                    <div class="flex flex-row-reverse justify-end space-x-1 star-rating">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" name="ratings" value="{{ $i }}" id="star{{ $i }}" class="hidden" required>
                                            <label for="star{{ $i }}" class="cursor-pointer text-gray-300 hover:text-yellow-400 transition text-2xl" onclick="highlightStars({{ $i }})">
                                                <i class="far fa-star"></i>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                                @error('rating')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror

                                <div>
                                 <label for="name" class="cursor-pointer text-gray-300 hover:text-yellow-400 transition text-2xl">
                                                <i class="far fa-user"></i>
                                            </label>
                                <input type="text" placeholder="Name" name="name" value="{{old('name')}}" id="name" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition" required>
                                           
                                </div>
                                
                                <div>
                                    <textarea name="comment" rows="4" 
                                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                              placeholder="Share your experience with this property..." required>{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="px-6 py-3 bg-[#2D6A4F] text-white rounded-xl hover:bg-[#1B4D3E] transition font-medium">
                                    <i class="fas fa-paper-plane mr-2"></i> Submit Review
                                </button>
                            </form>
                        
                    </div>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- RIGHT COLUMN (4/12) - SIDEBAR -->
            <!-- ============================================ -->
            <div class="lg:col-span-4">

                <div class="sticky top-24 space-y-6">

                    <!-- Booking Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">

                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-calendar-check text-[#2D6A4F] mr-2"></i> 
                         Cost Break Down
                        </h3>

                        <form method="POST" action="#" class="space-y-4">
                            @csrf

                            <input type="hidden" name="property_id" value="{{ $property->id }}">

                            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                                <span class="text-gray-600">
                                    Rent
                                </span>

                                <span class="text-2xl font-bold text-[#2D6A4F]">
                                    {{ App\Helper::formatNaira(number_format($property->rent_fee,0))}}
                                </span>
                            </div>

                            
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">
                                       Service charge
                                        <span id="nightCount"></span>
                                       
                                    </span>
                                    <span id="subtotal">
                                        {{ App\Helper::formatNaira(number_format($property->mgt_fee,0))}}
                                    </span>
                                </div>

                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Legal fee</span>
                                    <span> {{ App\Helper::formatNaira(number_format($property->legal_fee,0))}}</span>
                                </div>

                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Caution fee</span>
                                    <span>{{ App\Helper::formatNaira(number_format($property->caution_fee,0))}}</span>
                                </div>

                                 <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Agency fee</span>
                                    <span>{{ App\Helper::formatNaira(number_format($property->agency_fee,0))}}</span>
                                </div>

                                <div class="flex justify-between border-t pt-2">
                                    <span class="font-bold">Total</span>
                                    <span 
                                    id="totalPrice"
                                    class="text-xl font-bold text-[#2D6A4F]">
                                   {{ App\Helper::FormatNaira(number_format($property->rent_fee + $property->legal_fee + $property->mgt_fee + $property->caution_fee +  $property->agency_fee))}}
                                    </span>
                                </div>
                            </div>

                          <button  class="w-full py-3 bg-[#2D6A4F] text-white rounded-xl font-semibold">  <a href="{{route('book.inspection', $property)}}">
                                <i class="fas fa-check mr-2"></i>
                                Book Now
                            </a></button>

                            

                            <p class="text-xs text-center text-gray-400">
                                You won't be charged yet
                            </p>
                        </form>
                    </div>

                    <!-- Property Details -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        

                        <button  class="w-full py-3 bg-[#CF492D] text-white rounded-xl font-semibold"><a href="{{route('property.report', $property)}}">
                                <i class="fas fa-flag mr-2"></i>
                                Report
                            </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ============================================ -->
    <!-- SIMILAR PROPERTIES SECTION -->
    <!-- ============================================ -->
    @if($similarProperties && count($similarProperties) > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                        <i class="fas fa-building text-[#2D6A4F] mr-2"></i> 
                        Similar Properties
                    </h2>
                    <p class="text-gray-500 mt-1">Properties you might also like</p>
                </div>
                <a href="{{ route('property.listings') }}" class="text-[#2D6A4F] hover:underline font-medium text-sm">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($similarProperties as $similar)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $similar->images[0] ? asset('storage/' . $similar->images[0]) : asset('images/no-image.jpg') }}" 
                                 alt="{{ $similar->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            
                            <!-- Price Badge -->
                            <div class="absolute bottom-4 left-4">
                                <p class="text-white text-2xl font-bold">{{ App\Helper::formatNaira(number_format($similar->rent_fee, 2)) }}</p>
                                <p class="text-gray-300 text-sm">rent</p>
                            </div>
                            
                            <!-- Status Badge -->
                            @if($similar->is_available == 'true')
                                <div class="absolute top-4 right-4 px-3 py-1 bg-green-500 text-white text-xs font-medium rounded-full">
                                    Available
                                </div>
                            @endif
                            
                            <!-- Rating Badge -->
                            <div class="absolute top-4 left-4 flex items-center space-x-1 bg-black/50 backdrop-blur-sm px-3 py-1.5 rounded-full">
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <span class="text-white text-sm font-medium">{{ number_format($similar->avg_rating ?? 0, 1) }}</span>
                            </div>
                        </div>
                        
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-[#2D6A4F] transition line-clamp-1">
                                {{ $similar->title }}
                            </h3>
                            
                            <p class="text-gray-500 text-sm mt-1">
                                <i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>
                                {{ $similar->address }} {{ $similar->city }}, {{ $similar->country }}
                            </p>
                            
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span><i class="fas fa-bed text-[#2D6A4F] mr-1"></i> {{ $similar->number_of_bedrooms ?? 'N/A' }}</span>
                                    <span><i class="fas fa-bath text-[#2D6A4F] mr-1"></i> {{ $similar->number_of_bathrooms ?? 'N/A' }}</span>
                                    <span><i class="fas fa-users text-[#2D6A4F] mr-1"></i> {{ $similar->max_guests ?? 'N/A' }}</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('property.details', $similar) }}" class="mt-4 w-full block text-center px-4 py-2.5 bg-[#2D6A4F]/10 text-[#2D6A4F] rounded-xl font-medium hover:bg-[#2D6A4F] hover:text-white transition">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    
</div>
@include('components.footer')
@push('scripts')
<script>
    // ============================================ //
    // IMAGE SLIDER
    // ============================================ //
    document.addEventListener('DOMContentLoaded', function () {
        const images = @json($allImages);
        let currentIndex = 0;
        const mainImage = document.getElementById('mainImage');
        const imageCounter = document.getElementById('imageCounter');

        function updateImage(index) {
            if (!images.length) return;
            if (index < 0) index = images.length - 1;
            if (index >= images.length) index = 0;
            currentIndex = index;

            mainImage.style.opacity = 0;
            setTimeout(() => {
                mainImage.src = "{{ asset('storage') }}/" + images[index];
                mainImage.style.opacity = 1;
                if (imageCounter) imageCounter.innerText = index + 1;

                document.querySelectorAll('.thumbnail-item').forEach((item, i) => {
                    item.classList.remove('border-[#2D6A4F]');
                    item.classList.add('border-transparent');
                    if (i === index) {
                        item.classList.remove('border-transparent');
                        item.classList.add('border-[#2D6A4F]');
                    }
                });
            }, 200);
        }

        window.nextImage = function () { updateImage(currentIndex + 1); };
        window.prevImage = function () { updateImage(currentIndex - 1); };
        window.goToImage = function (index) { updateImage(index); };

        if (images.length > 1) {
            setInterval(function () { updateImage(currentIndex + 1); }, 5000);
        }
    });

    // ============================================ //
    // STAR RATING
    // ============================================ //
    function highlightStars(rating) {
        var labels = document.querySelectorAll('.star-rating label');
        labels.forEach(function(label) {
            var value = parseInt(label.getAttribute('for').replace('star', ''));
            var icon = label.querySelector('i');
            if (value <= rating) {
                icon.className = 'fas fa-star text-yellow-400';
            } else {
                icon.className = 'far fa-star text-gray-300';
            }
        });
    }
    
  
</script>

<style>
    /* Image transition */
    #mainImage {
        transition: opacity 0.3s ease;
    }
    
    /* Star rating hover */
    .star-rating label:hover i {
        color: #fbbf24 !important;
    }
    
    .sticky {
        position: sticky;
        top: 100px;
        align-self: flex-start;
    }
    
    /* Navbar fix */
    .pt-16 {
        padding-top: 4rem;
    }
    
    /* Line clamp */
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
@endsection