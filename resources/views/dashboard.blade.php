@extends('layouts.app')
@section('dashboard')
    <div class="w-full flex flex-col gap-4 sm:gap-6">
        <!-- Page Heading -->
        <div class="bg-white shadow-md p-[18px]  flex justify-center items-center">
            <h1 class="text-xl font-bold text-[#0d6a7c]">Dashboard Overview</h1>
        </div>

        <div class="w-full md:px-0 min-h-[200px] grid place-items-center sm:p-2">
            <!-- Post List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
                @forelse ($posts as $post)
                    <!-- Blog Card -->
                    <div
                        class="p-5 bg-white border shadow-md flex flex-col transition-all duration-300 hover:shadow-lg">
                        <!-- Image Section -->
                        <div class="w-full h-48 overflow-hidden">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            @else
                                <img src="https://via.placeholder.com/400x250?text=No+Image" class="w-full h-full object-cover">
                            @endif
                        </div>

                        <!-- Content Section -->
                        <div class="flex-1 mt-4 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-[#0d6a7c] mb-2 line-clamp-2">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
                                    {{ $post->content }}
                                </p>
                            </div>

                            <!-- Footer -->
                            <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <span>✍️ {{ $post->user->name }}</span>
                                    <span>•</span>
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                                <a href="{{ route('posts.slug', $post->slug) }}"
                                    class="px-3 py-1 bg-indigo-500 text-white text-xs sm:text-sm hover:bg-indigo-600 transition">
                                    Read More
                                </a>
                            </div>

                            <!-- Reactions -->
                            <div class="flex items-center gap-4 mt-3">
                                @if($post->user_id !== auth()->id())
                                    <button class="like-btn flex items-center gap-1 text-gray-600 hover:text-green-600"
                                        data-id="{{ $post->id }}">
                                        👍 <span id="like-count-{{ $post->id }}">
                                            {{ $post->reactions()->where('reaction', 1)->count() }}
                                        </span>
                                    </button>
                                    <button class="dislike-btn flex items-center gap-1 text-gray-600 hover:text-red-600"
                                        data-id="{{ $post->id }}">
                                        👎 <span id="dislike-count-{{ $post->id }}">
                                            {{ $post->reactions()->where('reaction', -1)->count() }}
                                        </span>
                                    </button>
                                @else
                                    <p class="text-xs text-gray-400">You cannot react on your own post</p>
                                @endif
                            </div>

                            <!-- Edit/Delete Buttons -->
                            @if($post->user_id == auth()->id())
                                <div class="flex gap-3 mt-4">
                                    <button onclick="location.href='{{ route('posts.edit', $post) }}'"
                                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                        Edit
                                    </button>
                                    <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post) }}"
                                        method="POST">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $post->id }})"
                                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Static Fallback Cards -->
                    @foreach(range(1, 3) as $i)
                        <div
                            class="p-5 bg-white border shadow-md flex flex-col transition-all duration-300 hover:shadow-lg">
                            <!-- Image Section -->
                            <div class="w-full h-48 overflow-hidden">
                                <img src="https://st3.depositphotos.com/3591429/13269/i/450/depositphotos_132694218-stock-photo-woman-writing-notes-in-diary.jpg"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            </div>

                            <!-- Content Section -->
                            <div class="flex-1 mt-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-[#0d6a7c] mb-2 line-clamp-2">
                                        Welcome to Our Blog
                                    </h3>
                                    <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
                                        This is a sample blog post. Start creating your own posts to see them appear here!
                                    </p>
                                </div>

                                <!-- Footer -->
                                <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <span>✍️ Admin</span>
                                        <span>•</span>
                                        <span>Just now</span>
                                    </div>
                                    <a href="#"
                                        class="px-3 py-1 bg-indigo-500 text-white text-xs sm:text-sm hover:bg-indigo-600 transition">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>


    </div>
@endsection