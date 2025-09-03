@extends('layouts.app')
@section('dashboard')

    <div class="w-full flex flex-col gap-6">
        <!-- Blog Section -->
        <div
            class="bg-white shadow-md p-6 md:p-10 rounded-md min-h-[calc(100vh-73px)] flex flex-col transition-all duration-300">

            <!-- Header -->
            <h1 class="text-3xl md:text-4xl font-bold text-[#0d6a7c] mb-6 text-center">
                Blog Management
            </h1>

            <!-- Create Post Form -->
            <div class="mb-8 bg-gray-50 p-6 rounded-lg shadow-inner">
                <h2 class="text-xl font-semibold text-[#0d6a7c] mb-4">Create a New Post</h2>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
                    class="flex flex-col gap-4">
                    @csrf
                    <input type="text" name="title" placeholder="Post Title"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#0d6a7c] outline-none" required>
                    <!-- Image Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (optional)</label>
                        <input type="file" name="image" id="imageUpload" accept="image/*"
                            class="block w-full text-sm text-gray-900 border rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#0d6a7c]">

                        <!-- Preview Box -->
                        <div id="imagePreviewContainer" class="relative mt-3 hidden">
                            <img id="imagePreview" src="" alt="Preview"
                                class="w-40 h-40 object-cover rounded-lg border shadow">

                            <!-- Remove Button -->
                            <button type="button" id="removeImage"
                                class="absolute top-0 right-0 bg-red-600 text-white rounded-full p-1 text-xs">
                                ✕
                            </button>
                        </div>
                    </div>
                    <textarea name="content" placeholder="Write your post..."
                        class="w-full px-4 py-2 border rounded-lg h-32 focus:ring-2 focus:ring-[#0d6a7c] outline-none"
                        required>
                                                        </textarea>
                    <button type="submit"
                        class="px-6 py-3 bg-[#0d6a7c] text-white text-lg rounded-lg hover:shadow-md transition-all duration-200 ease-in-out font-semibold self-start">
                        Add Post
                    </button>
                </form>
            </div>

            <!-- Post List -->
            <div class="flex flex-col gap-6">
                @foreach ($posts as $post)

                    <div class="p-6 bg-white border rounded-lg shadow-md">
                        <h3 class="text-2xl font-semibold text-[#0d6a7c] mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-700 mb-4">{{ $post->content }}</p>
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="mt-3 rounded-lg shadow max-h-60 object-cover">
                        @endif
                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600">
                                Read More
                            </a>

                            <p class="text-sm text-gray-500">
                                By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            @if($post->user_id !== auth()->id())
                                <button class="like-btn" data-id="{{ $post->id }}">
                                    👍 <span
                                        id="like-count-{{ $post->id }}">{{ $post->reactions()->where('reaction', 1)->count() }}</span>
                                </button>


                                <button class="dislike-btn" data-id="{{ $post->id }}">
                                    👎 <span
                                        id="dislike-count-{{ $post->id }}">{{ $post->reactions()->where('reaction', -1)->count() }}</span>
                                </button>
                            @else
                                <p class="text-sm text-gray-500">You cannot react on your own post</p>
                            @endif
                        </div>
                        <!-- Edit/Delete for Owner -->
                        @if($post->user_id == auth()->id())
                            <div class="flex gap-3 mt-4">
                                <button onclick="location.href='{{ route('posts.edit', $post) }}'"
                                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Edit</button>

                                <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $post->id }})"
                                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Script for preview & remove -->
    <script>
        const imageInput = document.getElementById('imageUpload');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        const removeButton = document.getElementById('removeImage');

        imageInput.addEventListener('change', () => {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        removeButton.addEventListener('click', () => {
            imageInput.value = '';
            previewImage.src = '';
            previewContainer.classList.add('hidden');
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".like-btn").forEach(btn => {
                btn.addEventListener("click", () => {
                    let postId = btn.getAttribute("data-id");
                    fetch(`/post/${postId}/like`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({})
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (!data.error) {
                                document.getElementById(`like-count-${postId}`).innerText = data.likes;
                                document.getElementById(`dislike-count-${postId}`).innerText = data.dislikes;
                            } else {
                                alert(data.error);
                            }
                        });
                });
            });

            document.querySelectorAll(".dislike-btn").forEach(btn => {
                btn.addEventListener("click", () => {
                    let postId = btn.getAttribute("data-id");
                    fetch(`/post/${postId}/dislike`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({})
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (!data.error) {
                                document.getElementById(`like-count-${postId}`).innerText = data.likes;
                                document.getElementById(`dislike-count-${postId}`).innerText = data.dislikes;
                            } else {
                                alert(data.error);
                            }
                        });
                });
            });
        });
    </script>

    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmEdit(url) {
            Swal.fire({
                title: "Are you sure?",
                text: "You are about to edit this post.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
        function confirmDelete(userId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("delete-form-" + userId).submit();
                }
            });
        }
    </script>

@endsection