@extends('layouts.app')

@section('title', 'Report Property - ' . $property->title)
@section('description', 'Report an issue with this property')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- ============================================ -->
        <!-- PAGE HEADER -->
        <!-- ============================================ -->
        <div class="mb-8" data-aos="fade-up">
            <nav class="flex items-center text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-[#2D6A4F] transition">Home</a>
                <i class="fas fa-chevron-right mx-3 text-gray-300 text-xs"></i>
                <a href="{{ route('property.listings') }}" class="hover:text-[#2D6A4F] transition">Properties</a>
                <i class="fas fa-chevron-right mx-3 text-gray-300 text-xs"></i>
                <a href="{{ route('property.details', $property) }}" class="hover:text-[#2D6A4F] transition">{{ $property->title }}</a>
                <i class="fas fa-chevron-right mx-3 text-gray-300 text-xs"></i>
                <span class="text-red-500 font-semibold">Report Property</span>
            </nav>
            
            <div class="flex items-start space-x-4">
                <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-flag text-2xl text-red-500"></i>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                        Report <span class="text-red-500">Property</span>
                    </h1>
                    <p class="text-gray-500 mt-1">Help us maintain quality by reporting any issues with this property</p>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- ============================================ -->
            <!-- LEFT COLUMN - FORM -->
            <!-- ============================================ -->
            <div class="lg:col-span-2" data-aos="fade-right">
                <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                    
                    <!-- Property Preview -->
                    <div class="flex items-center space-x-4 pb-6 mb-6 border-b border-gray-200">
                        <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="{{ $property->images[0] ? asset('storage/' . $property->images[0]) : asset('images/no-image.jpg') }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $property->title }}</h3>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>
                                {{ $property->address }}, {{ $property->city }}, {{ $property->country }}
                            </p>
                            <div class="flex items-center space-x-3 mt-1 text-sm text-gray-600">
                                <span><i class="fas fa-bed text-[#2D6A4F] mr-1"></i> {{ $property->number_of_bedrooms ?? 'N/A' }}</span>
                                <span><i class="fas fa-bath text-[#2D6A4F] mr-1"></i> {{ $property->number_of_bathrooms ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Report Form -->
                    <form method="POST" action="{{ route('property.report.submit', $property) }}" class="space-y-5" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Report Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Report Category <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @php
                                    $categories = [
                                        'inaccurate_description' => ['icon' => 'fa-file-alt', 'label' => 'Inaccurate Description'],
                                        'wrong_price' => ['icon' => 'fa-naira-sign', 'label' => 'Wrong Price'],
                                        'incorrect_location' => ['icon' => 'fa-map-pin', 'label' => 'Incorrect Location'],
                                        'misleading_photos' => ['icon' => 'fa-camera', 'label' => 'Misleading Photos'],
                                        'fraudulent_listing' => ['icon' => 'fa-exclamation-triangle', 'label' => 'Fraudulent Listing'],
                                        'property_unavailable' => ['icon' => 'fa-times-circle', 'label' => 'Property Unavailable'],
                                        'scam_suspected' => ['icon' => 'fa-shield-alt', 'label' => 'Scam Suspected'],
                                        'duplicate_listing' => ['icon' => 'fa-copy', 'label' => 'Duplicate Listing'],
                                        'other' => ['icon' => 'fa-ellipsis-h', 'label' => 'Other Issue'],
                                    ];
                                @endphp
                                
                                @foreach($categories as $value => $category)
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="category" value="{{ $value }}" 
                                               class="hidden peer" {{ old('category') == $value ? 'checked' : '' }}>
                                        <div class="p-3 border-2 rounded-xl transition-all peer-checked:border-red-500 peer-checked:bg-red-50 hover:border-gray-300 border-gray-200">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas {{ $category['icon'] }} text-red-500 text-sm"></i>
                                                </div>
                                                <span class="text-sm text-gray-700">{{ $category['label'] }}</span>
                                            </div>
                                            <div class="absolute top-2 right-2 text-red-500 opacity-0 peer-checked:opacity-100 transition">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('category')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Report Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Report Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                                   placeholder="Brief title for your report">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Detailed Description <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" rows="5" required
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                                      placeholder="Please provide detailed information about the issue...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Additional Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Your Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                                       placeholder="Your full name">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Your Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                                       placeholder="your@email.com">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Evidence Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Evidence (Optional)
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-red-500 transition cursor-pointer" onclick="document.getElementById('photo').click()">
                                <input type="file" name="photo[]" id="photo" accept="image/*" multiple class="hidden" onchange="handleFileUpload(this)">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                <p class="text-gray-600 text-sm">Click or drag to upload screenshots or photo</p>
                                <p class="text-gray-400 text-xs mt-1">Max 5 files, 5MB each (JPG, PNG, PDF)</p>
                            </div>
                            <div id="filePreview" class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-3"></div>
                            @error('photo.*')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Anonymous Reporting -->
                        <div class="flex items-center">
                            <input type="checkbox" name="anonymous" id="anonymous" value="1" {{ old('anonymous') ? 'checked' : '' }}
                                   class="w-4 h-4 text-red-500 border-gray-300 rounded focus:ring-red-500">
                            <label for="anonymous" class="ml-2 text-sm text-gray-600">
                                Submit report anonymously (your identity will be hidden)
                            </label>
                        </div>
                        
                        <!-- Terms -->
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex items-start">
                                <input type="checkbox" name="terms" id="terms" required
                                       class="mt-1 w-4 h-4 text-red-500 border-gray-300 rounded focus:ring-red-500">
                                <label for="terms" class="ml-2 text-sm text-gray-600">
                                    I confirm that the information provided is accurate and I understand that false reports may result in action.
                                    <span class="text-red-500">*</span>
                                </label>
                            </div>
                            @error('terms')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Submit Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-2">
                            <a href="{{ route('property.details', $property) }}" 
                               class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition text-center">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-red-500 text-white rounded-xl font-semibold hover:bg-red-600 transition hover:shadow-lg flex items-center justify-center space-x-2">
                                <i class="fas fa-flag"></i>
                                <span>Submit Report</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- ============================================ -->
            <!-- RIGHT COLUMN - SIDEBAR -->
            <!-- ============================================ -->
         <div class="lg:col-span-1 self-start">
    <div class="sticky top-24">
        <div class="space-y-6">
                <!-- What Happens Next -->
               <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-[#2D6A4F] mr-2"></i>
                        What Happens Next?
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-600 text-xs font-bold">1</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Review</p>
                                <p class="text-xs text-gray-500">Our team reviews your report within 24-48 hours.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-yellow-600 text-xs font-bold">2</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Investigation</p>
                                <p class="text-xs text-gray-500">We investigate the issue and may reach out for more details.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-green-600 text-xs font-bold">3</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Action</p>
                                <p class="text-xs text-gray-500">Appropriate action is taken to resolve the issue.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-purple-600 text-xs font-bold">4</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 text-sm">Notification</p>
                                <p class="text-xs text-gray-500">You'll receive a notification about the outcome.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Why Report -->
                <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-2xl p-6 border border-red-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-shield-alt text-red-500 mr-2"></i>
                        Why Report?
                    </h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                            <span>Protect other users from scams</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                            <span>Maintain quality listings</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                            <span>Keep the platform trustworthy</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                            <span>Help us improve</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact Support -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-headset text-[#2D6A4F] mr-2"></i>
                        Need Help?
                    </h3>
                    <p class="text-gray-500 text-sm mb-4">If you're unsure or need assistance, contact our support team.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-4 py-2.5 bg-[#2D6A4F] text-white rounded-xl hover:bg-[#1B4D3E] transition text-sm font-medium">
                        <i class="fas fa-envelope mr-2"></i> Contact Support
                    </a>
                </div>
            </div>
           </div>
           
            </div>
        </div>
    </div>
</div>
@include('components.footer')
@push('scripts')

<script>
    let selectedFiles = [];

    function handleFileUpload(input) {
        const preview = document.getElementById('filePreview');

        selectedFiles = [...selectedFiles, ...Array.from(input.files)];

        if (selectedFiles.length > 5) {
            alert('Maximum 5 files allowed');
            selectedFiles = selectedFiles.slice(0, 5);
        }

        // update the actual input files
        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;

        preview.innerHTML = '';

        selectedFiles.forEach((file, index) => {

            const reader = new FileReader();

            reader.onload = function(e) {
                const div = document.createElement('div');

                div.className = 'relative rounded-lg overflow-hidden border border-gray-200 h-24';

                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">

                    <button type="button"
                        onclick="removeFile(${index})"
                        class="absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full">
                        ×
                    </button>

                    <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-xs px-2">
                        ${file.name}
                    </div>
                `;

                preview.appendChild(div);
            };

            reader.readAsDataURL(file);
        });
    }


    function removeFile(index) {

        selectedFiles.splice(index, 1);

        const input = document.getElementById('photo');

        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;

        handleFileUpload(input);
    }
</script>

<style>
    /* Sticky sidebar */
    .sticky {
    position: sticky;
    top: 96px;

    }
    
    .lg\:col-span-1 {
        display: flex;
        flex-direction: column;
    }
</style>
@endpush
@endsection