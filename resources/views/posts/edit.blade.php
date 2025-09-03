@extends('layouts.app')
@section('dashboard')

    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-[#0d6a7c] mb-6">Edit Post</h2>

        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                    class="w-full border rounded px-3 py-2">
                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Content -->
            <div class="mb-4">
                <label class="block text-gray-700">Content</label>
                <textarea name="content" rows="5"
                    class="w-full border rounded px-3 py-2">{{ old('content', $post->content) }}</textarea>
                @error('content') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Current Image -->
            @if ($post->image)
                <div id="currentImageContainer">
                    <p class="text-gray-700 font-semibold mb-2">Current Image</p>
                    <div class="relative inline-block">
                        <img src="{{ asset('storage/' . $post->image) }}" class="h-32 w-auto rounded-lg shadow">
                    </div>
                </div>
            @endif

            <!-- New Image -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Change Image</label>
                <input type="file" name="image" id="imageInput"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">

                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Image Preview -->
                <div id="imagePreviewContainer" class="relative hidden mt-3 w-40">
                    <img id="imagePreview" class="rounded-lg shadow">
                    <button type="button" onclick="removeImagePreview()"
                        class="absolute top-1 right-1 bg-red-600 text-white rounded-full px-2 py-1 text-xs">
                        ✕
                    </button>

                </div>
                <div id="imagePreviewContainer" class=" mt-3 w-40">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                        Update Post
                    </button>
                </div>
            </div>

        </form>
    </div>


    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const currentImageContainer = document.getElementById('currentImageContainer');

        imageInput.addEventListener('change', (event) => {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    // Show preview
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.classList.remove('hidden');

                    // Hide current image
                    if (currentImageContainer) {
                        currentImageContainer.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        function removeImagePreview() {
            imagePreview.src = '';
            imagePreviewContainer.classList.add('hidden');
            imageInput.value = '';

            // Show back current image if exists
            if (currentImageContainer) {
                currentImageContainer.classList.remove('hidden');
            }
        }
    </script>


@endsection