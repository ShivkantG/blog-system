@extends('layouts.app')
@section('dashboard')

    <div class="w-full flex flex-col gap-4 sm:gap-6">
        <!-- Blog Section -->
        <div class="bg-white shadow-md p-[18px] flex justify-center items-center">
            <h1 class="text-xl font-bold text-[#0d6a7c]">
                Edit Blog
            </h1>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div id="alert_2" class="!gap-5 border !px-5 !py-2 mb-6 bg-red-500 text-white relative">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="font-semibold text-color-2">{{ $error }}</li>
                    @endforeach
                </ul>
                <button onclick="document.getElementById('alert_2').remove()"
                    class="absolute top-1/2 right-3 transform -translate-y-1/2 text-xl font-bold text-white hover:text-gray-200">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div id="alert_1" class="!gap-5 border !px-2 !py-2 !mb-3 bg-green-500 text-white relative">
                <ul>
                    <li class="font-semibold text-color-2">{{ session('success') }}</li>
                </ul>
                <button onclick="document.getElementById('alert_1').remove()"
                    class="absolute top-1/2 right-3 transform -translate-y-1/2 text-xl font-bold text-white hover:text-gray-200">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <!-- Edit Post Form -->
        <div class="bg-white shadow-md p-6 md:p-10 flex flex-col transition-all duration-300">
            <div class="mb-8 bg-gray-50 p-4 shadow-inner">
                <h2 class="text-xl font-semibold text-[#0d6a7c] mb-4">Edit Post</h2>

                <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data"
                    class="flex flex-col gap-4">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <input type="text" name="title" placeholder="Post Title"
                        class="w-full px-4 py-2 border focus:ring-2 focus:ring-[#0d6a7c] outline-none"
                        value="{{ old('title', $post->title) }}" required>
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Content -->
                    <textarea name="content" placeholder="Write your post..."
                        class="w-full px-4 py-2 border h-32 focus:ring-2 focus:ring-[#0d6a7c] outline-none"
                        required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Current Image -->
                    @if ($post->image)
                        <div id="currentImageContainer">
                            <p class="text-gray-700 font-semibold mb-2">Current Image</p>
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/' . $post->image) }}" class="h-32 w-auto rounded-lg shadow border">
                            </div>
                        </div>
                    @endif

                    <!-- Upload New Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Change Image</label>
                        <input type="file" name="image" id="imageUpload" accept="image/*"
                            class="block w-full text-sm text-gray-900 border cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#0d6a7c]">
                        @error('image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Preview Box -->
                        <div id="imagePreviewContainer" class="relative mt-3 hidden">
                            <img id="imagePreview" src="" alt="Preview"
                                class="w-40 h-40 object-cover border shadow rounded">
                            <button type="button" id="removeImage"
                                class="absolute top-0 right-0 bg-red-600 text-white p-1 text-xs">
                                ✕
                            </button>
                        </div>
                    </div>

                    <!-- Update Button -->
                    <button type="submit"
                        class="px-6 py-3 bg-[#0d6a7c] text-white text-lg hover:shadow-md transition-all duration-200 ease-in-out font-semibold self-start">
                        Update Post
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script for preview & remove -->
    <script>
        const imageInput = document.getElementById('imageUpload');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        const removeButton = document.getElementById('removeImage');
        const currentImageContainer = document.getElementById('currentImageContainer');

        imageInput.addEventListener('change', () => {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    if (currentImageContainer) {
                        currentImageContainer.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        removeButton.addEventListener('click', () => {
            imageInput.value = '';
            previewImage.src = '';
            previewContainer.classList.add('hidden');
            if (currentImageContainer) {
                currentImageContainer.classList.remove('hidden');
            }
        });
    </script>

@endsection