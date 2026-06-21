@extends('admin.layouts.app')

@section('title', 'Manage Properties')
@section('header-title', 'Properties Management')
@section('header-description', 'Manage and monitor all property listings')

@section('content')
<div class="space-y-6">
    
    <!-- Filters Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">Filter Properties</h3>
            <p class="text-sm text-gray-500 mt-1">Search and filter through your property listings</p>
        </div>
        
        <div class="p-6">
            <form method="GET" action="{{ route('admin.properties.index') }}" id="filterForm">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Title, location, or ID..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                  
                  
                    </div>
                    
                    

                 <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">All Status</option>
                            <option value="true" {{ request('status') == 'true' ? 'selected' : '' }}>Available</option>
                            <option value="false" {{ request('status') == 'false' ? 'selected' : '' }}>Rented Out</option>
                          </select> 
                    </div>




                    
                    <!-- Property Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Property Type</label>
                        <select name="type_of_house" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">All Types</option>
                            <option value="apartment" {{ request('type_of_house') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="house" {{ request('type_of_house') == 'house' ? 'selected' : '' }}>House</option>
                            <option value="villa" {{ request('type_of_house') == 'villa' ? 'selected' : '' }}>Villa</option>
                            <option value="condo" {{ request('type_of_house') == 'condo' ? 'selected' : '' }}>Condo</option>
                            <option value="studio" {{ request('type_of_house') == 'studio' ? 'selected' : '' }}>Studio</option>
                        </select>
                    </div>
                    
                    <!-- Price Range -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rent Amount</label>
                        <select name="rent_fee" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">Any Price</option>
                            <option value="100000,1000000" {{ request('rent_fee') == '1000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(100000))}} - {{App\Helper::formatNaira(number_format(1000000))}}</option>
                            <option value="2000000,5000000" {{ request('rent_fee') == '2000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(2000000))}} - {{App\Helper::formatNaira(number_format(5000000))}}</option>
                            <option value="6000000,10000000" {{ request('rent_fee') == '10000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(6000000))}} - {{App\Helper::formatNaira(number_format(10000000))}}</option>
                            <option value="11000000,49000000" {{ request('rent_fee') == '49000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(11000000))}} - {{App\Helper::formatNaira(number_format(49000000))}}</option>
                            <option value="50000000,100000000" {{ request('rent_fee') == '50000000' ? 'selected' : '' }}>{{App\Helper::formatNaira(number_format(50000000))}}+</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-4">
                    <button type="submit" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition flex items-center space-x-2">
                        <i class="fas fa-search"></i>
                        <span>Apply Filters</span>
                    </button>
                    
                    @if(request()->anyFilled(['search', 'status', 'type_of_house', 'rent_fee']))
                        <a href="{{ route('admin.properties.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition flex items-center space-x-2">
                            <i class="fas fa-times"></i>
                            <span>Clear Filters</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    
    <!-- Properties Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center flex-wrap gap-3">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Property Listings</h3>
                <p class="text-sm text-gray-500 mt-1">Total properties found ({{ number_format($properties->total())}})</p>
            </div>
            <a href="{{ route('admin.properties.create') }}" class="px-4 py-2 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] text-white rounded-lg hover:shadow-lg transition flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add New Property</span>
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Image</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Title / Location</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Type</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Rent</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                        
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properties as $property)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <!-- Image -->
                        <td class="py-3 px-4">
                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100">

                              @if (!empty($property->images) && isset($property->images[0]))
    <img src="{{ Storage::url($property->images[0]) }}" alt="Property image" class="w-full h-full object-cover">

                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-[#2D6A4F]/10">
                                        <i class="fas fa-building text-[#2D6A4F]"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        
                        <!-- Title & Location -->
                        <td class="py-3 px-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ Str::limit($property->title, 30) }}</p>
                                <div class="flex items-center text-xs text-gray-500 mt-1">
                                    <i class="fas fa-map-marker-alt mr-1 text-[#2D6A4F]"></i>
                                    <span>{{ $property->city }}, {{ $property->country }}</span>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Type -->
                        <td class="py-3 px-4">
                            <span class="capitalize text-sm text-gray-600">{{ ucfirst($property->type_of_house) }}</span>
                        </td>
                        
                        <!-- Price -->
                        <td class="py-3 px-4">
                            <p class="font-semibold text-[#2D6A4F]">{{ App\Helper::formatNaira(number_format($property->rent_fee, 2) )}}</p>
                            <p class="text-xs text-gray-500">basic rent</p>
                        </td>
                        
                        <!-- Status Badge -->
                        <td class="py-3 px-4">
                            @php
                                $statusColors = [
                                    'true' => 'green',
                                    'false' => 'red',
                                    
                                ];
                                $color = $statusColors[$property->is_available] ?? 'gray';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-{{ $color }}-100 text-{{ $color }}-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500 mr-1"></span>

                                @if($property->is_available === true)
                                {{ ucfirst("Available") }}
                                @else
                                {{ ucfirst("Not Available") }}
                                @endif
                            </span>
                        </td>
                        
                      
                        <!-- Actions -->
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <!-- View -->
                                <a href="{{route('admin.show.property', $property)}}" 
                                   class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition flex items-center justify-center">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                
                                <!-- Edit -->
                                <a href="{{route('admin.edit.property', $property)}}" 
                                   class="w-8 h-8 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition flex items-center justify-center">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                
                                <!-- Delete -->
                                <button type="button" onclick="confirmDelete({{ $property->id }}, '{{ addslashes($property->title) }}')" 
                                        class="w-8 h-8 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition flex items-center justify-center">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                            
                            <!-- Delete Form -->
                            <form id="delete-form-{{ $property->id }}" 
                                  action="{{route('admin.delete.property', $property)}}" 
                                  method="GET" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-building text-5xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 text-lg">No properties found</p>
                                <p class="text-gray-400 text-sm mt-1">Get started by adding your first property</p>
                                <a href="{{ route('admin.properties.create') }}" class="mt-4 px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">
                                    <i class="fas fa-plus mr-2"></i>Add Property
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($properties->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $properties->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete Property</h3>
            <p class="text-gray-500 text-center text-sm" id="deleteMessage">Are you sure you want to delete this property? This action cannot be undone.</p>
            <div class="flex space-x-3 mt-6">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button id="confirmDeleteBtn" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let deleteId = null;
    
    function confirmDelete(id, title) {
        deleteId = id;
        document.getElementById('deleteMessage').innerHTML = `Are you sure you want to delete <strong>"${title}"</strong>? This action cannot be undone.`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
        deleteId = null;
    }
    
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteId) {
            document.getElementById(`delete-form-${deleteId}`).submit();
        }
    });
    
    // Close modal on click outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endpush
@endsection