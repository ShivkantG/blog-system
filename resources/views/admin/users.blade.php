@extends('layouts.app')

@section('dashboard')
    <div class="p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Users List</h2>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-3 py-2 border">ID</th>
                    <th class="px-3 py-2 border">Name</th>
                    <th class="px-3 py-2 border">Email</th>
                    <th class="px-3 py-2 border">Status</th>
                    <th class="px-3 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="px-3 py-2 border">{{ $user->id }}</td>
                        <td class="px-3 py-2 border">{{ $user->name }}</td>
                        <td class="px-3 py-2 border">{{ $user->email }}</td>
                        <td class="px-3 py-2 border">
                            @if($user->is_blocked)
                                <span class="text-red-500 font-semibold ">Blocked</span>
                            @else
                                <span class="text-green-600 font-semibold">Active</span>
                            @endif
                        </td>
                        <td class="p-2 flex gap-2">

                            <!-- Toggle Block/Unblock -->
                            <form action="{{ route('admin.users.toggle', $user) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="px-2 py-1 bg-yellow-500 text-white rounded">
                                    {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                                </button>
                            </form>
                            <!-- Delete -->
                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}"
                                method="POST">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $user->id }})"
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
    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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