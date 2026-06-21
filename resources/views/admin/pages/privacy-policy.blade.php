@extends('admin.layouts.app')

@section('title', 'Privacy Policy')
@section('header-title', 'Privacy Policy')
@section('header-description', 'Manage the privacy policy of your platform')

@push('styles')
<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    .note-editor {
        border-radius: 0.5rem !important;
        border-color: #d1d5db !important;
        box-shadow: none !important;
    }
    .note-editor:focus-within {
        border-color: #2D6A4F !important;
        box-shadow: 0 0 0 2px rgba(45, 106, 79, 0.2) !important;
    }
    .note-editor .note-toolbar {
        background: #f9fafb !important;
        border-bottom: 1px solid #e5e7eb !important;
        border-radius: 0.5rem 0.5rem 0 0 !important;
        padding: 8px 12px !important;
    }
    .note-editor .note-toolbar .note-btn-group .note-btn {
        background: transparent !important;
        border: 1px solid transparent !important;
        border-radius: 4px !important;
        padding: 4px 8px !important;
    }
    .note-editor .note-toolbar .note-btn-group .note-btn:hover {
        background: #e5e7eb !important;
        border-color: #d1d5db !important;
    }
    .note-editor .note-toolbar .note-btn-group .note-btn.active {
        background: #2D6A4F !important;
        color: white !important;
    }
    .note-editor .note-editable {
        min-height: 400px !important;
        padding: 20px !important;
        font-size: 16px !important;
        line-height: 1.7 !important;
    }
    .note-editor .note-editable:focus {
        outline: none !important;
    }
    .note-editor .note-statusbar {
        background: #f9fafb !important;
        border-top: 1px solid #e5e7eb !important;
        border-radius: 0 0 0.5rem 0.5rem !important;
    }
    .prose h1 { font-size: 2em; margin-top: 1.5em; margin-bottom: 0.5em; }
    .prose h2 { font-size: 1.5em; margin-top: 1.25em; margin-bottom: 0.5em; }
    .prose h3 { font-size: 1.25em; margin-top: 1em; margin-bottom: 0.5em; }
    .prose p { margin-bottom: 1em; line-height: 1.7; }
    .prose ul, .prose ol { margin: 1em 0; padding-left: 1.5em; }
    .prose li { margin-bottom: 0.5em; }
</style>
@endpush

@section('content')
<div class="max-w-5xl mx-auto">
    
    <!-- Info Banner -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
            <div>
                <p class="text-sm text-blue-800">
                    <strong>Note:</strong> These Privacy Policy apply to all users of the platform. 
                    Changes will take effect immediately after saving.
                </p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-[#2D6A4F]/10 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-file-contract text-[#2D6A4F] text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Privacy Policy</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Last updated: <span id="lastUpdated">{{ $settings->updated_at->format('F d, Y H:i A') ?? 'Never' }}</span></p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-xs text-gray-500">Status:</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                        Published
                    </span>
                </div>
            </div>
        </div>
        
        <form method="POST" action="{{ route('admin.settings.update') }}" class="p-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="tab" value="privacy">
            <!-- Version -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Version <span class="text-red-500">*</span>
                </label>
                <input type="text" name="version" value="{{ old('version', $settings->version ?? '1.0') }}"
                       class="w-full md:w-64 px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                       placeholder="e.g., 1.0, 2.1">
                @error('version')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Title -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Page Title <span class="text-red-500">*</span>
                </label>
                <input type="text"  value="{{ ('Privacy Policy') }}"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Content -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Content <span class="text-red-500">*</span>
                </label>
                <textarea name="privacy" id="termsEditor" rows="20"
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">{{ old('terms', $settings->privacy ?? '') }}</textarea>
                @error('privacy')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="previewContent()" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                    <i class="fas fa-eye mr-2"></i>Preview
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] hover:from-[#0D2A3A] hover:to-[#0A1928] text-white rounded-lg font-medium transition shadow-md">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Preview</h3>
            <button onclick="closePreview()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="previewContent" class="p-6 overflow-y-auto max-h-[70vh] prose prose-sm max-w-none">
            <!-- Preview content will be injected here -->
        </div>
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end">
            <button onclick="closePreview()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Close
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<script>
$(document).ready(function() {
    $('#termsEditor').summernote({
        height: 300
    });
});
</script>


@endpush
@endsection