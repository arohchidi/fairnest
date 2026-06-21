 <!-- ============================================ -->
    <!-- FEATURED PROPERTIES SECTION -->
    <!-- ============================================ -->
    <section id="properties" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block text-sm font-semibold text-[#2D6A4F] uppercase tracking-wider bg-[#2D6A4F]/10 px-4 py-1 rounded-full mb-4">
                    Featured Listings
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    Handpicked Properties <br>
                    <span class="gradient-text">Just For You</span>
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto">
                    Explore our curated selection of premium properties in prime locations
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featured_properties as  $featured_property)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden property-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden h-64"><img
    src="{{ !empty($featured_property['images'][0]) 
        ? asset('storage/' . $featured_property['images'][0]) 
        : asset('images/no-image.jpg') }}"
    class="property-img w-full h-full object-cover"
>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-4 left-4"><span class="px-3 py-1 bg-[#2D6A4F] text-white text-xs font-medium rounded-full">Featured</span></div>
                        <div class="absolute bottom-4 left-4"><p class="text-white text-2xl font-bold">{{App\Helper::formatNaira($featured_property->rent_fee)}}</p><p class="text-gray-300 text-sm">rent</p></div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-800">{{ucfirst($featured_property->title)}}</h3>
<div class="flex items-center text-yellow-400">

@php
    $avg_rating = $featured_property->reviews_avg_ratings ?? 0;
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


<span class="ml-1 text-sm font-medium text-gray-700">
   
                            {{ number_format($featured_property->reviews_avg_ratings ?? 0, 1) }}</span></div>
                        </div>
                        <p class="text-gray-500 text-sm mb-3"><i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>New York, USA</p>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2"> {{substr($featured_property->description,0,100)}}</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-100 pt-3">
                            <span><i class="fas fa-bed mr-1"></i> {{number_format($featured_property->number_of_bedrooms)}} Beds</span>
                            <span><i class="fas fa-bath mr-1"></i>  {{number_format($featured_property->number_of_bathrooms)}} Baths</span>
                            <span><i class="fas fa-users mr-1"></i>@if($featured_property->roommate_preferences == true) Yes @else No @endif</span>
                        </div>
                        <a href="{{route('property.details', $featured_property->id)}}" class="mt-4 w-full block text-center px-4 py-2 bg-[#2D6A4F]/10 text-[#2D6A4F] rounded-lg font-medium hover:bg-[#2D6A4F] hover:text-white transition">View Details</a>
                    </div>
                </div>
                @endforeach
                
             <!---   <div class="bg-white rounded-2xl shadow-sm overflow-hidden property-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative overflow-hidden h-64">
                        <img src="https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=600&h=400&fit=crop" alt="Luxury Villa" class="property-img w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-4 left-4"><span class="px-3 py-1 bg-yellow-500 text-white text-xs font-medium rounded-full">Hot Deal</span></div>
                        <div class="absolute bottom-4 left-4"><p class="text-white text-2xl font-bold">$459</p><p class="text-gray-300 text-sm">per night</p></div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-800">Luxury Beachfront Villa</h3>
                            <div class="flex items-center text-yellow-400"><i class="fas fa-star text-sm"></i><span class="ml-1 text-sm font-medium text-gray-700">4.9</span></div>
                        </div>
                        <p class="text-gray-500 text-sm mb-3"><i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>Miami, USA</p>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">Wake up to breathtaking ocean views in this luxurious beachfront villa.</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-100 pt-3">
                            <span><i class="fas fa-bed mr-1"></i> 4 Beds</span>
                            <span><i class="fas fa-bath mr-1"></i> 3 Baths</span>
                            <span><i class="fas fa-users mr-1"></i> 8 Guests</span>
                        </div>
                        <a href="#" class="mt-4 w-full block text-center px-4 py-2 bg-[#2D6A4F]/10 text-[#2D6A4F] rounded-lg font-medium hover:bg-[#2D6A4F] hover:text-white transition">View Details</a>
                    </div>
                </div>-->
                
               <!--<div class="bg-white rounded-2xl shadow-sm overflow-hidden property-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative overflow-hidden h-64">
                        <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=600&h=400&fit=crop" alt="Cozy Cottage" class="property-img w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-4 left-4"><span class="px-3 py-1 bg-blue-500 text-white text-xs font-medium rounded-full">New</span></div>
                        <div class="absolute bottom-4 left-4"><p class="text-white text-2xl font-bold">$189</p><p class="text-gray-300 text-sm">per night</p></div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-800">Cozy Mountain Cottage</h3>
                            <div class="flex items-center text-yellow-400"><i class="fas fa-star text-sm"></i><span class="ml-1 text-sm font-medium text-gray-700">4.7</span></div>
                        </div>
                        <p class="text-gray-500 text-sm mb-3"><i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>Denver, USA</p>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">Escape to this cozy mountain cottage surrounded by nature and fresh air.</p>
                        <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-100 pt-3">
                            <span><i class="fas fa-bed mr-1"></i> 3 Beds</span>
                            <span><i class="fas fa-bath mr-1"></i> 2 Baths</span>
                            <span><i class="fas fa-users mr-1"></i> 6 Guests</span>
                        </div>
                        <a href="#" class="mt-4 w-full block text-center px-4 py-2 bg-[#2D6A4F]/10 text-[#2D6A4F] rounded-lg font-medium hover:bg-[#2D6A4F] hover:text-white transition">View Details</a>
                    </div>
                </div>
           
           --->
          
          
          
            </div>
            
            <div class="text-center mt-12" data-aos="fade-up">
                <a href="{{route('property.listings')}}" class="inline-flex items-center px-8 py-4 bg-[#0A1928] text-white rounded-xl font-semibold hover:shadow-2xl transition hover:scale-105">
                    <span>View All Properties</span>
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
        </div>
    </section>
