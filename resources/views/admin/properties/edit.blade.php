@extends('admin.layouts.app')

@section('title', 'Edit ' . $property->title)
@section('header-title', 'Edit Property')
@section('header-description', 'Update property information and images')

@section('content')
<div class="max-w-5xl mx-auto">
    <form method="POST" action="{{ route('admin.update.property', $property) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('Post')
        
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
                    <input type="text" name="title" id="title" value="{{ old('title', $property->title) }}" required
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="6" required
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition">{{ old('description', $property->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Two Columns -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="type_of_house" class="block text-sm font-medium text-gray-700 mb-2">Property Type <span class="text-red-500">*</span></label>
                        <select name="type_of_house" id="type_of_house" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">Select type</option>
                            <option value="apartment" {{ old('type_of_house', $property->type_of_house) == 'apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="house" {{ old('type_of_house', $property->type_of_house) == 'house' ? 'selected' : '' }}>House</option>
                            <option value="villa" {{ old('type_of_house', $property->type_of_house) == 'villa' ? 'selected' : '' }}>Villa</option>
                            <option value="condo" {{ old('type_of_house', $property->type_of_house) == 'condo' ? 'selected' : '' }}>Condo</option>
                            <option value="studio" {{ old('type_of_house', $property->type_of_house) == 'studio' ? 'selected' : '' }}>Studio</option>
                        </select>
                        @error('type_of_house')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="is_available" class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <select name="is_available" id="is_available" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="true" {{ old('is_available', $property->is_available) == 'true' ? 'selected' : '' }}>Active</option>
                            <option value="false" {{ old('is_available', $property->is_available) == 'false' ? 'selected' : '' }}>Inactive</option>
                            
                        </select>
                        @error('is_available')
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
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address <span class="text-red-500">*</span></label>
                        <input type="text" name="address" id="address" value="{{ old('address', $property->address) }}" required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City <span class="text-red-500">*</span></label>
                        <input type="text" name="city" id="city" value="{{ old('city', $property->city) }}" required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                        @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country <span class="text-red-500">*</span></label>
                        <select name="country" id="country" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">Select country</option>
                            <option value="Nigeria" {{ old('country', $property->country) == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                            <option value="USA" {{ old('country', $property->country) == 'USA' ? 'selected' : '' }}>United States</option>
                            <option value="Canada" {{ old('country', $property->country) == 'Canada' ? 'selected' : '' }}>Canada</option>
                            <option value="UK" {{ old('country', $property->country) == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                            <option value="Germany" {{ old('country', $property->country) == 'Germany' ? 'selected' : '' }}>Germany</option>
                            <option value="France" {{ old('country', $property->country) == 'France' ? 'selected' : '' }}>France</option>
                            <option value="Spain" {{ old('country', $property->country) == 'Spain' ? 'selected' : '' }}>Spain</option>
                            <option value="Italy" {{ old('country', $property->country) == 'Italy' ? 'selected' : '' }}>Italy</option>
                            <option value="Australia" {{ old('country', $property->country) == 'Australia' ? 'selected' : '' }}>Australia</option>
                        </select>
                        @error('country')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-2">Zip / Postal Code</label>
                    <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', $property->zip_code) }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                    @error('zip_code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>




           <!-- Location Details -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-800">Preferences</h3>
                <p class="text-sm text-gray-500 mt-1"></p>
            </div>
            
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-2 md:grid-cols-2 gap-5">
                    <div class="">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Furnished <span class="text-red-500">*</span></label>
                        <select name="is_furnished" id="is_furnished" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="true" {{ old('status', $property->is_furnished) == 'true' ? 'selected' : '' }}>Furnished</option>
                            <option value="false" {{ old('status', $property->is_furnished) == 'false' ? 'selected' : '' }}>Not Furnished</option>
                            
                        </select>
                        @error('is_furnished')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                   
                    </div>
                    
                    <div class=""">
                        
            

                        <label for="roommate_preferences" class="block text-sm font-medium text-gray-700 mb-2">Roommate Preference<span class="text-red-500">*</span></label>
                        <select name="roommate_preferences" id="roommate_preferences" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="true" {{ old('roommate_preferences', $property->roommate_preferences) == 'true' ? 'selected' : '' }}>Available for Roommate </option>
                            <option value="false" {{ old('roommate_preferences', $property->roommate_preferences) == 'false' ? 'selected' : '' }}>Not Available for Roommate</option>
                            
                        </select>
                        @error('roommate_preferences')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                
             
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
                    <div>
                        <label for="rent_fee" class="block text-sm font-medium text-gray-700 mb-2">Rent Fee (₦)<span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></span>
                            <input type="number" name="rent_fee" id="rent_fee" value="{{ old('rent_fee', $property->rent_fee) }}" required step="0.01"
                                   class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                        </div>
                        @error('rent_fee')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="agency_fee" class="block text-sm font-medium text-gray-700 mb-2">Agency Fee (₦)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></span>
                            <input type="number" name="agency_fee" id="agency_fee" value="{{ old('agency_fee', $property->agency_fee) }}" step="0.01"
                                   class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                        </div>
                        @error('agency_fee')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                   
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-2">Bedrooms <span class="text-red-500">*</span></label>
                        <input type="number" name="number_of_bedrooms" id="bedrooms" value="{{ old('number_of_bedrooms', $property->number_of_bedrooms) }}" required min="1"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                        @error('bedrooms')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-2">Bathrooms <span class="text-red-500">*</span></label>
                        <input type="number" name="number_of_bathrooms" id="bathrooms" value="{{ old('number_of_bathrooms', $property->number_of_bathrooms) }}" required step="0.5" min="1"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                        @error('bathrooms')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
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
                        $amenitiesList = [
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
                        $propertyAmenities = $property->meta_data;
                    @endphp
                    
                    @foreach($amenitiesList as $key => $label)
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="meta_data[]" value="{{ $key }}" 
                               class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded focus:ring-[#2D6A4F]"
                               {{ in_array($key, old('meta_data', $propertyAmenities)) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
                @error('amenities')
                    <p class="text-red-500 text-xs mt-3">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Image Management Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-800">Property Images</h3>
                <p class="text-sm text-gray-500 mt-1">Manage existing images or upload new ones (Max 10 images total)</p>
            </div>
            
            <div class="p-6">
                <!-- Existing Images -->
                @if($property->images && count($property->images) > 0)
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Current Images</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" id="existingImagesGrid">
                        @foreach($property->images as $index => $image)
                        <div class="relative group rounded-lg overflow-hidden border border-gray-200 shadow-sm" data-image-index="{{ $index }}">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-32 object-cover">
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center space-x-2">
                                <button type="button" onclick="markForDeletion(this, '{{ $image }}')" 
                                        class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600 transition">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                                @if($index === 0)
                                <span class="absolute top-2 left-2 bg-[#2D6A4F] text-white text-xs px-2 py-1 rounded-full">Main</span>
                                @endif
                            </div>
                            <div class="deletion-overlay absolute inset-0 bg-red-500/50 flex items-center justify-center hidden">
                                <i class="fas fa-trash text-white text-xl"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-500 mt-3">Click the trash icon to remove images. Main image will be automatically reassigned.</p>
                </div>
                @endif
                
                <!-- Hidden inputs for deleted images -->
                <div id="deletedImagesContainer"></div>
                
                <!-- Add New Images -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Add New Images</label>
                    <div id="dropzone" class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-[#2D6A4F] transition cursor-pointer">
                        <input type="file" name="images[]" id="imageInput" accept="image/*" multiple class="hidden">
                        <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-3"></i>
                        <p class="text-gray-600 mb-2">Drag & drop new images here or click to select</p>
                        <p class="text-gray-400 text-sm">You can upload up to {{ max(0, 10 - count($property->images ?? [])) }} more images</p>
                    </div>
                    
                    <!-- New Image Preview Grid -->
                    <div id="newImagePreviewGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-6"></div>
                </div>
                
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
            <a href="{{ route('admin.show.property', $property->id) }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] hover:from-[#0D2A3A] hover:to-[#0A1928] text-white rounded-lg font-medium transition shadow-md">
                <i class="fas fa-save mr-2"></i> Save Changes
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Image Deletion Tracking
    let deletedImages = [];
    
    function markForDeletion(button, imagePath) {
        const card = button.closest('.relative');
        
        if (!deletedImages.includes(imagePath)) {
            deletedImages.push(imagePath);
            card.classList.add('opacity-50');
            card.style.opacity = '0.5';
            
            // Add hidden input for deleted image
            const container = document.getElementById('deletedImagesContainer');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'deleted_images[]';
            input.value = imagePath;
            input.className = 'deleted-image-input';
            container.appendChild(input);
            
            // Show overlay
            card.querySelector('.deletion-overlay').classList.remove('hidden');
            
            // Disable button
            button.disabled = true;
            button.style.opacity = '0.5';
        }
    }
    
    // New Image Upload
    const imageInput = document.getElementById('imageInput');
    const dropzone = document.getElementById('dropzone');
    const newPreviewGrid = document.getElementById('newImagePreviewGrid');
    let newSelectedFiles = [];
    const maxExistingImages = {{ count($property->images ?? []) }};
    const maxTotal = 10;
    let remainingSlots = maxTotal - maxExistingImages;
    
    dropzone.addEventListener('click', () => imageInput.click());
    
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
        addNewFiles(files);
    });
    
    imageInput.addEventListener('change', (e) => {
        const files = Array.from(e.target.files);
        addNewFiles(files);
    });
    
    function addNewFiles(files) {
        const availableSlots = remainingSlots - newSelectedFiles.length;
        const filesToAdd = files.slice(0, availableSlots);
        
        filesToAdd.forEach(file => {
            if (file.type.startsWith('image/')) {
                newSelectedFiles.push(file);
            }
        });
        
        updateNewPreview();
        updateFileInput();
    }
    
    function updateNewPreview() {
        newPreviewGrid.innerHTML = '';
        newSelectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const previewCard = document.createElement('div');
                previewCard.className = 'relative group rounded-lg overflow-hidden border border-gray-200 shadow-sm';
                previewCard.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-32 object-cover">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <button type="button" onclick="removeNewImage(${index})" class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600 transition">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </div>
                    <div class="absolute top-2 left-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-full">New</div>
                `;
                newPreviewGrid.appendChild(previewCard);
            };
            reader.readAsDataURL(file);
        });
        
        const remainingAfterNew = remainingSlots - newSelectedFiles.length;
        if (remainingAfterNew <= 0) {
            dropzone.style.display = 'none';
        } else {
            dropzone.style.display = 'block';
            const hintText = dropzone.querySelector('p:last-child');
            if (hintText) {
                hintText.textContent = `You can upload ${remainingAfterNew} more image${remainingAfterNew !== 1 ? 's' : ''}`;
            }
        }
    }
    
    window.removeNewImage = (index) => {
        newSelectedFiles.splice(index, 1);
        updateNewPreview();
        updateFileInput();
        
        const remainingAfterNew = remainingSlots - newSelectedFiles.length;
        if (remainingAfterNew > 0) {
            dropzone.style.display = 'block';
        }
    };
    
    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        newSelectedFiles.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files;
    }
</script>
@endpush
@endsection