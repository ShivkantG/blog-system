<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!DOCTYPE html>
    <html lang="en" class="">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{ config('app.name', 'Laravel') }}</title>

            <link rel="icon" href="{{ asset('images/favicon.jpg') }}">

            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
                integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">

            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <!-- Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>

        <body>
            <div class="w-screen h-svh fixed top-0 left-0 z-50 flex bg-blue-200">
                <!-- Sidebar -->
                <div id="dashboard_menu"
                    class="w-[300px] ms-[-300px] fixed top-0 left-0
                 lg:static lg:ms-0 transition-all duration-200 ease-linear min-w-[300px] h-svh bg-white shadow-md z-10">
                    <div class="flex items-center h-[72px] min-h-[72px] px-4 py-2">
                        <div id="dashboard_toggle_btn2"
                            class="w-[40px] min-w-[40px] h-[40px] lg:hidden rounded-full grid place-items-center bg-[#ebf2f9] cursor-pointer text-xl text-gray-800 dark:text-slate-300">
                            <i class="text-black fa-solid fa-xmark"></i>
                        </div>
                        <a href="/" class="flex w-full">
                            <p
                                class="text-center font-[900] text-2xl m-auto dark:text-gray-700 tracking-wide uppercase">
                                BlogSys
                            </p>
                        </a>
                    </div>
                    <div class="h-[calc(100vh-72px)] overflow-y-auto p-4 sm:py-6">
                        <ul class="flex flex-col gap-2 w-full m-0 p-0">
                            <!-- Dashboard -->
                            <li>
                                <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'bg-gray-100' : '' }} w-full flex gap-2 items-center px-1.5 text-base no-underline transition-all 
                                        duration-300 ease-in-out hover:bg-[#0d6a7c] hover:text-white">
                                    <div
                                        class="w-[40px] h-[40px] rounded-md grid place-items-center transition-all duration-300 ease-in-out">
                                        <i class="fa-solid fa-grid-2"></i>
                                    </div>
                                    <span class="transition-all duration-300 ease-in-out">Dashboard</span>
                                </a>
                            </li>

                            <li class="uppercase font-bold text-gray-900">
                                Manage Blog
                            </li>
                            @if (Auth::check() && !Auth::user()->is_admin)
                                <li>
                                    <a href="{{ route('posts.index') }}"
                                        class="{{ request()->is(['posts*']) ? 'bg-gray-100' : '' }} w-full flex gap-2 items-center px-1.5 text-base no-underline transition-all duration-300 ease-in-out hover:bg-[#0d6a7c] hover:text-white">
                                        <div
                                            class="w-[40px] h-[40px] rounded-md grid place-items-center transition-all duration-300 ease-in-out">
                                            <i class="fa-solid fa-money-check-dollar-pen"></i>
                                        </div>
                                        <span class="transition-all duration-300 ease-in-out">Manage Post</span>
                                    </a>
                                </li>

                            @endif
                            @if (Auth::check() && Auth::user()->is_admin)
                                <li>
                                    <a href="{{ route('admin.users') }}"
                                        class="{{ request()->is('admin/user*') ? 'bg-gray-100' : '' }} w-full flex gap-2 items-center px-1.5 text-base no-underline transition-all duration-300 ease-in-out hover:bg-[#0d6a7c] hover:text-white">
                                        <div class="w-[40px] h-[40px] rounded-md grid place-items-center">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <span>Manage Users</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.posts') }}"
                                        class="{{ request()->is('admin/posts*') ? 'bg-gray-100' : '' }} w-full flex gap-2 items-center px-1.5 text-base no-underline transition-all duration-300 ease-in-out hover:bg-[#0d6a7c] hover:text-white">
                                        <div class="w-[40px] h-[40px] rounded-md grid place-items-center">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </div>
                                        <span>Manage Posts</span>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}" onclick="confirmLogout(event);"
                                    class="{{ request()->is('logout') ? 'bg-gray-100' : '' }} w-full flex gap-2 items-center px-1.5 text-base no-underline transition-all duration-300 ease-in-out hover:bg-[#0d6a7c] hover:text-white">
                                    <div
                                        class="w-[40px] h-[40px] rounded-md grid place-items-center transition-all duration-300 ease-in-out">
                                        <i class="fa-solid text-base fa-right-from-bracket"></i>
                                    </div>
                                    <span class="transition-all duration-300 ease-in-out">Logout</span>
                                </a>
                            </li>


                    </div>
                </div>

                <!-- Nav bar -->
                <div class="flex-1 overflow-auto ">
                    <div class="flex justify-between items-center bg-white p-4 sm:px-6 shadow-sm h-[72px]">
                        <div>
                            <div id="dashboard_toggle_btn"
                                class="w-[40px] h-[40px] rounded-full grid place-items-center bg-[#ebf2f9] cursor-pointer text-xl text-gray-800 dark:text-slate-300">
                                <i class="text-black fa-solid fa-bars"></i>
                            </div>
                        </div>
                        <div>
                            <ul id="menu" class="flex flex-row w-fit gap-2 sm:gap-4 ">
                                @guest
                                    @if (Route::has('login'))
                                        <li class="flex md:block">
                                            <a href="{{ route('login') }}">
                                                <div
                                                    class="w-fit !px-3 sm:!px-5 !py-2 sm:!py-3 font-bold rounded-3xl transition btn-text-bg">
                                                    Login/Signup
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @else
                                    <li class="relative">
                                        <div id="user_drop_down" class="flex items-center !gap-1 cursor-pointer">
                                            <button type="button" id="userDropdown"
                                                class="text-color-1 whitespace-nowrap dark:text-slate-300 sm:text-xl font-bold h-fit capitalize">
                                                {{ Str::limit(Auth::user()->name, 5, '...') }}
                                            </button>
                                            <div class="w-[40px] h-[40px] border-2 rounded-full overflow-hidden bg-white">
                                                <img class="w-full h-full object-cover"
                                                    src="{{ Auth::user() && Auth::user()->profile_pic ? Auth::user()->profile_pic : asset('images/profile.png') }}"
                                                    alt="user-pic">
                                            </div>
                                        </div>
                                        <div id="user_drop_down_menu"
                                            class="absolute overflow-hidden max-h-0 top-[120%] right-0 bg-whiterounded-lg border-[#a2f0f2] shadow-xl w-full min-w-[180px] transition-all duration-300 ease-in-out z-50">
                                            <ul class="flex flex-col divide-y-2 divide-[#a2f0f2] dark:divide-slate-700">
                                                <li>
                                                    <a href="{{ route('dashboard') }}"
                                                        class="flex items-center gap-2 px-4 py-3 text-sm text-gray-800 dark:text-gray-100 hover:bg-[#e5fafd] hover:text-[#0a9396] dark:hover:bg-slate-700 dark:hover:text-cyan-400 transition-colors duration-200">
                                                        <i
                                                            class="fa-solid fa-gauge-high w-4 text-[#0a9396] dark:text-cyan-400"></i>
                                                        Dashboard
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('profile.edit') }}"
                                                        class="flex items-center gap-2 px-4 py-3 text-sm text-gray-800 dark:text-gray-100 hover:bg-[#e5fafd] hover:text-[#0a9396] dark:hover:bg-slate-700 dark:hover:text-cyan-400 transition-colors duration-200">
                                                        <i
                                                            class="fa-solid fa-user w-4 text-[#0a9396] dark:text-cyan-400"></i>
                                                        Profile
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('logout') }}" onclick="confirmLogout(event);"
                                                        class="flex items-center gap-2 px-4 py-3 text-sm text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-800 transition-colors duration-200">
                                                        <i class="fa-solid fa-right-from-bracket w-4"></i>
                                                        Logout
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        class="hidden">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>

                    {{-- main content with sidebar and navbar --}}
                    <div class="p-4 sm:p-6 flex-1 overflow-auto h-[calc(100dvh-72px)]">
                        @yield('dashboard')
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                $(document).ready(function () {
                    $('#user_drop_down').click(function () {
                        const menu = $('#user_drop_down_menu');
                        const isClosed = menu.hasClass('max-h-0');

                        if (isClosed) {
                            menu.removeClass('max-h-0').addClass('max-h-[200px]');
                        } else {
                            menu.removeClass('max-h-[200px]').addClass('max-h-0');
                        }
                    });

                    $("#dashboard_toggle_btn").click(function () {
                        $("#dashboard_menu").toggleClass("ms-[-300px] lg:!ms-[-300px]")
                    });
                    $("#dashboard_toggle_btn2").click(function () {
                        $("#dashboard_menu").toggleClass("ms-[-300px]")
                    });
                });
            </script>

            <script>
                function confirmLogout(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Are you sure you want to logout?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }
                    });
                }
            </script>
        </body>

    </html>