  <!-- Advanced Filter Section -->
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8" data-aos="fade-up">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-sliders-h text-[#2D6A4F] mr-2"></i> Advanced Filters
                </h3>
                <div class="flex items-center space-x-3">
                    <button id="gridView" class="px-3 py-1.5 bg-[#2D6A4F] text-white rounded-lg text-sm transition">
                        <i class="fas fa-th"></i>
                    </button>
                    <button id="listView" class="px-3 py-1.5 bg-gray-200 text-gray-600 rounded-lg text-sm transition">
                        <i class="fas fa-list"></i>
                    </button>
                    <span class="text-sm text-gray-500" id="resultCount">Showing 0 properties</span>
                </div>
            </div>
            
            <form method="GET" action="{{route('property.listings')}}" id="filterForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Search -->
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search properties..." 
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition text-sm">
                </div>
                
                <!-- Location -->
                <div class="relative">
                    
                    <select name="status" class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] appearance-none bg-white text-sm">
                        <option value="">Status</option>
                       <option value="">All Status</option>
                       <option value="true" {{ request('status') == 'true' ? 'selected' : '' }}>Available</option>
                            <option value="false" {{ request('status') == 'false' ? 'selected' : '' }}>Rented Out</option>    
                    </select>
                </div>
                
                <!-- Property Type -->
                <div class="relative">
                    <i class="fas fa-building absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <select name="type" class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] appearance-none bg-white text-sm">
                        <option value="">All Types</option>
                        <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>House</option>
                        <option value="villa" {{ request('type') == 'villa' ? 'selected' : '' }}>Villa</option>
                        <option value="condo" {{ request('type') == 'condo' ? 'selected' : '' }}>Condo</option>
                        <option value="studio" {{ request('type') == 'studio' ? 'selected' : '' }}>Studio</option>
                    
                    </select>
                </div>
                
                <!-- Price Range -->
                <div class="relative">
                    <i class="fas fa-naira-sign absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <select name="rent_fee" class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] appearance-none bg-white text-sm">
                        <option value="">Any Price</option>
                        <option value="100000,1000000" {{ request('rent_fee') == '1000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(100000))}} - {{App\Helper::formatNaira(number_format(1000000))}}</option>
                            <option value="2000000,5000000" {{ request('rent_fee') == '2000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(2000000))}} - {{App\Helper::formatNaira(number_format(5000000))}}</option>
                            <option value="6000000,10000000" {{ request('rent_fee') == '10000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(6000000))}} - {{App\Helper::formatNaira(number_format(10000000))}}</option>
                            <option value="11000000,49000000" {{ request('rent_fee') == '49000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(11000000))}} - {{App\Helper::formatNaira(number_format(49000000))}}</option>
                            <option value="50000000,100000000" {{ request('rent_fee') == '50000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(50000000))}}+</option>
                                                
                                                
                                                </select></div>
                                          
                   
                   
                </div>
               
                 <div class="relative">
               <button class="flex-1 text-center px-4 py-2 bg-[#2D6A4F] text-white rounded-xl font-medium hover:bg-[#1B4D3E] transition hover:shadow-lg" type="submit">
                               <i class="fa-solid fa-magnifying-glass"></i> Apply Filters
                            </button>
                            </div>
            
            </form>
            
            <!-- Active Filters -->
            <div class="flex flex-wrap gap-2 mt-4" id="activeFilters">
                @if(request('search'))
                    <span class="inline-flex items-center px-3 py-1 bg-[#2D6A4F]/10 text-[#2D6A4F] rounded-full text-sm">
                        Search: {{ request('search') }}
                        <a href="?{{ http_build_query(array_merge(request()->all(), ['search' => null])) }}" class="ml-2 hover:text-red-500">&times;</a>
                    </span>
                @endif
                @if(request('status'))
                    <span class="inline-flex items-center px-3 py-1 bg-[#2D6A4F]/10 text-[#2D6A4F] rounded-full text-sm">
                        Status: {{ request('status') }}
                        <a href="?{{ http_build_query(array_merge(request()->all(), ['status' => null])) }}" class="ml-2 hover:text-red-500">&times;</a>
                    </span>
                @endif
                @if(request('type_of_house'))
                    <span class="inline-flex items-center px-3 py-1 bg-[#2D6A4F]/10 text-[#2D6A4F] rounded-full text-sm">
                        Type: {{ ucfirst(request('type_of_house')) }}
                        <a href="?{{ http_build_query(array_merge(request()->all(), ['type_of_house' => null])) }}" class="ml-2 hover:text-red-500">&times;</a>
                    </span>
                @endif
                @if(request('rent_fee'))
                    <span class="inline-flex items-center px-3 py-1 bg-[#2D6A4F]/10 text-[#2D6A4F] rounded-full text-sm">
                        Price: ₦{{ str_replace('-', ' - ₦', request('rent_fee')) }}
                        <a href="?{{ http_build_query(array_merge(request()->all(), ['rent_fee' => null])) }}" class="ml-2 hover:text-red-500">&times;</a>
                    </span>
                @endif
                @if(request('bedrooms'))
                    <span class="inline-flex items-center px-3 py-1 bg-[#2D6A4F]/10 text-[#2D6A4F] rounded-full text-sm">
                        {{ request('bedrooms') }}+ Beds
                        <a href="?{{ http_build_query(array_merge(request()->all(), ['bedrooms' => null])) }}" class="ml-2 hover:text-red-500">&times;</a>
                    </span>
                @endif
                @if(request()->hasAny(['search', 'status', 'type_of_house', 'rent_fee', 'bedrooms']))
                    <a href="{{ route('property.listings') }}" class="text-sm text-red-500 hover:text-red-700 font-medium">Clear All</a>
                @endif
            </div>
        </div>
        