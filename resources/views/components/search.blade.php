   <div class="search-area">
        <form action="{{route('property.listings')}}" method="GET">
        @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-10">
                        <div class="search-wrap">
                            <div class="row">
                              
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="buy" role="tabpanel"
                                        aria-labelledby="buy-tab">
                                        <div class="select-group-wrapper">
                                            <div class="form-group"><label for="property_type">Search</label>
                                                  <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Title, location"
                               class="form-select w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                  
                  
                                                
                                                </div>
                                            <div class="form-group"><label for="room_type">Status</label> <select
                                                    name="status" id="status" class="form-select nice-select">
                                                   
                                                   <option value="">All Status</option>
                            <option value="true" {{ request('status') == 'true' ? 'selected' : '' }}>Available</option>
                            <option value="false" {{ request('status') == 'false' ? 'selected' : '' }}>Rented Out</option>
                                                </select></div>
                                            <div class="form-group"><label for="mini_area">House Type</label>
                                                <select name="type_of_house" id="type_of_house" class="form-select nice-select">
                                                    
                                                    <option value="">All Types</option>
                            <option value="apartment" {{ request('type_of_house') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="house" {{ request('type_of_house') == 'house' ? 'selected' : '' }}>House</option>
                            <option value="villa" {{ request('type_of_house') == 'villa' ? 'selected' : '' }}>Villa</option>
                            <option value="condo" {{ request('type_of_house') == 'condo' ? 'selected' : '' }}>Condo</option>
                            <option value="studio" {{ request('type_of_house') == 'studio' ? 'selected' : '' }}>Studio</option>
                        </select>
                                                </select></div>
                                            <div class="form-group"><label for="rent_fee">Rent</label>
                                                <select name="rent_fee" id="max_area" class="form-select nice-select">
                                                    <option value="">Any Price</option>
                            <option value="100000,1000000" {{ request('rent_fee') == '1000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(100000))}} - {{App\Helper::formatNaira(number_format(1000000))}}</option>
                            <option value="2000000,5000000" {{ request('rent_fee') == '2000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(2000000))}} - {{App\Helper::formatNaira(number_format(5000000))}}</option>
                            <option value="6000000,10000000" {{ request('rent_fee') == '10000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(6000000))}} - {{App\Helper::formatNaira(number_format(10000000))}}</option>
                            <option value="11000000,49000000" {{ request('rent_fee') == '49000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(11000000))}} - {{App\Helper::formatNaira(number_format(49000000))}}</option>
                            <option value="50000000,100000000" {{ request('rent_fee') == '50000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(50000000))}}+</option>
                                                </select></div>
                                          
                                           
                                            <div class="advance-btn-wrapper">
                                                <div class="advance-search-btn">
                                                    <div class="search-btn-item"><button class="th-btn radius w-100" type="submit"><i
                                                                class="fa-regular fa-magnifying-glass me-2"></i> Apply Filters</button></div>
                                                </div>
                                            </div>

                                            <div class="advance-btn-wrapper">
                                                <div class="advance-search-btn">
                                                    <div class="search-btn-item"><button class="th-btn radius " type="reset"><i
                                                                class="fas fa-times me-2"></i> Clear Filters</button></div>
                                                </div>
                                            </div>
                                         

                                              
                                        </div>
                                    </div>
                                 
                             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
   
   