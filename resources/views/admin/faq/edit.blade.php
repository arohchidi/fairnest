@extends('admin.layouts.app')

@section('title', 'Edit FAQ')
@section('header-title', 'Edit FAQ')
@section('header-description', 'Update frequently asked question')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center mr-3">
                    <i class="fas fa-edit text-yellow-600 text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Edit FAQ</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Update the question and answer</p>
                </div>
            </div>
        </div>
        
        <form method="POST" action="{{ route('admin.faq.update', $faq) }}" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select name="category" id="category" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                        <option value="general" {{ old('category', $faq->category) == 'general' ? 'selected' : '' }}>General</option>
                        <option value="booking" {{ old('category', $faq->category) == 'booking' ? 'selected' : '' }}>Booking</option>
                        <option value="payment" {{ old('category', $faq->category) == 'payment' ? 'selected' : '' }}>Payment</option>
                        <option value="cancellation" {{ old('category', $faq->category) == 'cancellation' ? 'selected' : '' }}>Cancellation</option>
                        <option value="property" {{ old('category', $faq->category) == 'property' ? 'selected' : '' }}>Property</option>
                        <option value="account" {{ old('category', $faq->category) == 'account' ? 'selected' : '' }}>Account</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Sort Order -->
                <div>
                    <label for="sort_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Sort Order
                    </label>
                    <input type="number" name="sort_id" id="sort_id" value="{{ old('sort_id', $faq->sort_id) }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                    <p class="text-xs text-gray-500 mt-1">Lower numbers appear first</p>
                    @error('sort_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Question -->
            <div>
                <label for="question" class="block text-sm font-medium text-gray-700 mb-2">
                    Question <span class="text-red-500">*</span>
                </label>
                <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}" required
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                @error('question')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Answer -->
            <div>
                <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">
                    Answer <span class="text-red-500">*</span>
                </label>
                <textarea name="answer" id="answer" rows="6" required
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="is_active" value="1" {{ old('is_active', $faq->is_active) == '1' ? 'checked' : '' }} class="w-4 h-4 text-[#2D6A4F]">
                        <span class="ml-2 text-sm text-gray-700">Active (visible to users)</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="is_active" value="0" {{ old('is_active', $faq->is_active) == '0' ? 'checked' : '' }} class="w-4 h-4 text-gray-400">
                        <span class="ml-2 text-sm text-gray-700">Inactive (hidden from users)</span>
                    </label>
                </div>
                @error('is_active')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.faq.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] hover:from-[#0D2A3A] hover:to-[#0A1928] text-white rounded-lg font-medium transition shadow-md">
                    <i class="fas fa-save mr-2"></i> Update FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection