@extends('admin.layouts.app')

@section('title', 'Add New Property')
@section('header-title', 'Add New Property')
@section('header-description', 'List your property on the platform')

@section('content')
<div class="max-w-4xl mx-auto">
    <form method="POST" action="{{ route('admin.properties.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Basic Information -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-800">Basic Information</h3>
                <p class="text-sm text-gray-500 mt-1">General details about your property</p>
            </div>
            
            <div class="p-6 space-y-5">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Property Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                           placeholder="e.g., Luxury Beachfront Villa">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="5" required
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                              placeholder="Describe your property...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Two Columns -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Property Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Property Type <span class="text-red-500">*</span></label>
                        <select name="type_of_house" id="type" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">Select type</option>
                            <option value="apartment" {{ old('type_of_house') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="house" {{ old('type_of_house') == 'house' ? 'selected' : '' }}>House</option>
                            <option value="villa" {{ old('type_of_house') == 'villa' ? 'selected' : '' }}>Villa</option>
                            <option value="condo" {{ old('type_of_house') == 'condo' ? 'selected' : '' }}>Condo</option>
                            <option value="studio" {{ old('type_of_house') == 'studio' ? 'selected' : '' }}>Studio</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <select name="status" id="status" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="true" {{ old('status') == 'true' ? 'selected' : '' }}>Available</option>
                            <option value="false" {{ old('status') == 'false' ? 'selected' : '' }}>Not Available</option>
                           
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                     <!-- Roommate Preferences -->
                    <div>
                        <label for="roommate_preferences" class="block text-sm font-medium text-gray-700 mb-2">Roommate Preferences</label>
                        <select name="roommate_preferences" id="roommate_preferences"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">Need Roommate</option>
                            <option value="false" {{ old('roommate_preferences') == 'false' ? 'selected' : '' }}>No Preference</option>
                            <option value="true" {{ old('roommate_preferences') == 'true' ? 'selected' : '' }}>Yes Preference</option>
                    </div>

                </div>
            </div>
                          
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        
        <!-- Location Details -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-800">Location Details</h3>
                <p class="text-sm text-gray-500 mt-1">Where is your property located?</p>
            </div>
            
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address <span class="text-red-500">*</span></label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}" required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent"
                               placeholder="Street address">
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- City -->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City <span class="text-red-500">*</span></label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent"
                               placeholder="New York">
                        @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country <span class="text-red-500">*</span></label>
                        <select name="country" id="country" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">Select country</option>
                            <option value="Nigeria" {{ old('country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                           
                        
                        </select>
                        @error('country')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Zip Code -->
                <div>
                    <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-2">Zip / Postal Code</label>
                    <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code') }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent"
                           placeholder="10001">
                    @error('zip_code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Pricing & Details -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-800">Pricing & Details</h3>
                <p class="text-sm text-gray-500 mt-1">Set your rates and property specifications</p>
            </div>
            
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Price per night -->
                    <div>
                        <label for="rent_fee" class="block text-sm font-medium text-gray-700 mb-2">Rent Fee (₦)<span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></span>
                            <input type="number" name="rent_fee" id="rent_fee" value="{{ old('rent_fee') }}" required step="0.01"
                                   class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent"
                                   placeholder="0.00">
                        </div>
                        @error('rent_fee')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Cleaning Fee -->
                    <div>
                        <label for="agency_fee" class="block text-sm font-medium text-gray-700 mb-2">Agency Fee (₦)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></span>
                            <input type="number" name="agency_fee" id="agency_fee" value="{{ old('agency_fee') }}" step="0.01"
                                   class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent"
                                   placeholder="0.00">
                        </div>
                        @error('agency_fee')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Security Deposit -->
                    
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <!-- Bedrooms -->
                    <div>
                        <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-2">Bedrooms <span class="text-red-500">*</span></label>
                        <input type="number" name="number_of_bedrooms" id="number_of_bedrooms" value="{{ old('number_of_bedrooms') }}" required min="1"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                        @error('number_of_bedrooms')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Bathrooms -->
                    <div>
                        <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-2">Bathrooms <span class="text-red-500">*</span></label>
                        <input type="number" name="number_of_bathrooms" id="number_of_bathrooms" value="{{ old('number_of_bathrooms') }}" required step="0.5" min="1"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                        @error('bathrooms')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Max Guests -->
                    <div>
                        <label for="max_guests" class="block text-sm font-medium text-gray-700 mb-2">Furnished <span class="text-red-500">*</span></label>
                        <!-- Country -->
                    <div>
                        
                        
                        <select name="is_furnished" id="is_furnished" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">Select furnished status</option>
                            <option value="false" {{ old('is_furnished') == 'false' ? 'selected' : '' }}>No</option>
                            <option value="true" {{ old('is_furnished') == 'true' ? 'selected' : '' }}>Yes</option>
                        
                        </select>
                        @error('is_furnished')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Amenities -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-800">Amenities</h3>
                <p class="text-sm text-gray-500 mt-1">What does your property offer?</p>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    @php
                        $amenities = [
                            'wifi' => 'Wi-Fi',
                            'parking' => 'Free Parking',
                            'kitchen' => 'Full Kitchen',
                            'ac' => 'Air Conditioning',
                            'heating' => 'Heating',
                            'washer' => 'Washer/Dryer',
                            'tv' => 'Smart TV',
                            'pool' => 'Swimming Pool',
                            'gym' => 'Gym',
                            'pet_friendly' => 'Pet Friendly',
                            'breakfast' => 'Breakfast Included',
                            'backyard' => 'Private Backyard',
                        ];
                    @endphp
                    
                    @foreach($amenities as $key => $label)
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="amenities[]" value="{{ $key }}" 
                               class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]"
                               {{ in_array($key, old('amenities', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
                @error('amenities')
                    <p class="text-red-500 text-xs mt-3">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Image Upload Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-800">Property Images</h3>
                <p class="text-sm text-gray-500 mt-1">Upload up to 10 images (JPEG, PNG, WebP)</p>
            </div>
            
            <div class="p-6">
                <!-- Dropzone Area -->
                <div id="dropzone" class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-[#2D6A4F] transition cursor-pointer">
                    <input type="file" name="images[]" id="imageInput" accept="image/*" multiple class="hidden">
                    <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-3"></i>
                    <p class="text-gray-600 mb-2">Drag & drop images here or click to select</p>
                    <p class="text-gray-400 text-sm">You can select multiple images at once</p>
                </div>
                
                <!-- Image Preview Grid -->
                <div id="imagePreviewGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-6"></div>
                
                <!-- Hidden input for image order -->
                <input type="hidden" name="image_order" id="imageOrder">
                
                @error('images')
                    <p class="text-red-500 text-xs mt-3">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 pb-10">
            <a href="{{ route('admin.properties.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] hover:from-[#0D2A3A] hover:to-[#0A1928] text-white rounded-lg font-medium transition shadow-md">
                <i class="fas fa-save mr-2"></i> Publish Property
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Image Preview and Upload Functionality
    const imageInput = document.getElementById('imageInput');
    const dropzone = document.getElementById('dropzone');
    const previewGrid = document.getElementById('imagePreviewGrid');
    let selectedFiles = [];

    // Click to select files
    dropzone.addEventListener('click', () => imageInput.click());
    
    // Drag and drop
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-[#2D6A4F]', 'bg-[#2D6A4F]/5');
    });
    
    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('border-[#2D6A4F]', 'bg-[#2D6A4F]/5');
    });
    
    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-[#2D6A4F]', 'bg-[#2D6A4F]/5');
        const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
        addFiles(files);
    });
    
    // File selection
    imageInput.addEventListener('change', (e) => {
        const files = Array.from(e.target.files);
        addFiles(files);
    });
    
    function addFiles(files) {
        files.forEach(file => {
            if (file.type.startsWith('image/')) {
                selectedFiles.push(file);
            }
        });
        updatePreview();
        updateFileInput();
    }
    
    function updatePreview() {
        previewGrid.innerHTML = '';
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const previewCard = document.createElement('div');
                previewCard.className = 'relative group rounded-lg overflow-hidden border border-gray-200 shadow-sm';
                previewCard.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-32 object-cover">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center space-x-2">
                        <button type="button" onclick="removeImage(${index})" class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600 transition">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </div>
                    <div class="absolute top-2 left-2 ${index === 0 ? 'bg-[#2D6A4F]' : 'bg-gray-700'} text-white text-xs px-2 py-1 rounded-full">
                        ${index === 0 ? 'Main' : `#${index + 1}`}
                    </div>
                `;
                previewGrid.appendChild(previewCard);
            };
            reader.readAsDataURL(file);
        });
        
        // Set main image hint
        if (selectedFiles.length === 0) {
            dropzone.classList.remove('border-[#2D6A4F]');
        }
    }
    
    window.removeImage = (index) => {
        selectedFiles.splice(index, 1);
        updatePreview();
        updateFileInput();
    };
    
    function updateFileInput() {
        // Create new FileList-like object
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files;
        
        // Update hidden order field
        document.getElementById('imageOrder').value = selectedFiles.map((_, i) => i).join(',');
        
        // Show/hide dropzone hint
        if (selectedFiles.length >= 10) {
            dropzone.style.display = 'none';
        } else {
            dropzone.style.display = 'block';
        }
    }
</script>
@endpush
@endsection