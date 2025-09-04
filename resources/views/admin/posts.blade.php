@extends('layouts.app')

@section('dashboard')
    <div class="w-full flex flex-col gap-4 sm:gap-6">
        <!-- Page Heading -->
        <div class="bg-white shadow-md p-[18px]  flex justify-center items-center">
            <h1 class="text-xl font-bold text-[#0d6a7c]">Posts List</h1>
        </div>
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
        <div class="p-6 bg-white shadow-md">

            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-3 py-2 border">ID</th>
                        <th class="px-3 py-2 border">Title</th>
                        <th class="px-3 py-2 border">Author</th>
                        <th class="px-3 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr class="border-t">
                            <td class="px-3 py-2 border">{{ $post->id }}</td>
                            <td class="px-3 py-2 border">{{ $post->title }}</td>
                            <td class="px-3 py-2 border">{{ $post->user->name }}</td>
                            <td class="px-3 py-2 border flex gap-2">
                                <button onclick="confirmEdit('{{ route('admin.posts.edit', $post) }}')" class="px-2 py-1 bg-green-500 text-white
                                                            rounded">
                                    Edit
                                </button>
                                <form id="delete-form-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post) }}"
                                    method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $post->id }})"
                                        class="px-2 py-1 bg-red-500 text-white rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


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