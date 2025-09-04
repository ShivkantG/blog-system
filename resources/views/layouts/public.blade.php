<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div>
        <header class="w-full shadow-mgd" style="box-shadow: rgba(67, 71, 85, 0.27) 0px 1px 2px;">
            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                <nav class="flex justify-between items-center py-2">
                    <div class="flex w-fit items-center">
                        <div class="w-fit !mr-2 sm:!mr-4 h-fit grid place-items-center lg:hidden">
                            <button aria-label="Toggle left menu" type="button" class="" id="toggleBtn">
                                <i class="fa-solid fa-bars !text-3xl"></i>
                            </button>
                        </div>
                        <a class="" href="{{ url('/') }}">
                            <p
                                class="text-center font-[900] text-2xl m-auto dark:text-gray-700 tracking-wide uppercase">
                                BlogSys
                            </p>
                        </a>
                    </div>

                    <div style="box-shadow: rgba(67, 71, 85, 0.27) 1px 0px 2px;" id="sidebar2"
                        class="lg:!shadow-none lg:block !fixed top-0 left-0 !z-50 bg-white w-[300px] ms-[-300px] lg:ms-0 h-screen lg:!static lg:w-auto lg:!bg-transparent lg:h-auto transition-all duration-300 !overflow-y-auto lg:!overflow-y-visible">

                        <!-- Mobile Topbar -->
                        <div
                            class="flex items-center justify-center !p-3 sm:!px-4 lg:!px-8 bg- h-[85px] w-full lg:hidden ">
                            <div class="w-fit mr-5 sm:mx-2 h-full grid place-items-center text-3xl lg:hidden">
                                <button aria-label="Nav Menu Close" type="button" id="toggleClose">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <a href="{{ url('/') }}" class="flex w-full">
                                <div class="min-w-[150px] max-w-[190px]">
                                    <p
                                        class="text-center font-[900] text-2xl m-auto dark:text-gray-700 tracking-wide uppercase">
                                        BlogSys
                                    </p>
                                </div>
                            </a>
                        </div>

                        <!-- Nav Items -->
                        <ul class="flex flex-col lg:flex-row gap-2 lg:gap-6 xl:gap-8 px-4 pt-3 lg:p-0">
                            <!-- Home -->
                            <li>
                                <a href="{{ url('/') }}"
                                    class="{{ request()->is('/') ? '' : '' }} w-full flex gap-2 items-center py-2 px-3 text-base sm:text-lg no-underline transition-all duration-300 ease-in-out hover:text-[#16454e] hover:font-bold hover:bg-[#0d6a7c] hover:text-white lg:hover:text-black lg:bg-transparent lg:hover:bg-transparent ">
                                    <div class="w-[40px] h-[40px] rounded-md grid place-items-center lg:hidden">
                                        <i class="fa-solid fa-house"></i>
                                    </div>
                                    <span>Home</span>
                                </a>
                            </li>

                            <!-- Services -->
                            <li>
                                <a href="{{ url('/blogs') }}"
                                    class="{{ request()->is('settings') ? '' : '' }} w-full flex gap-2 items-center py-2 px-3 text-base sm:text-lg no-underline transition-all duration-300 ease-in-out hover:text-[#16454e] hover:font-bold hover:bg-[#0d6a7c] hover:text-white lg:hover:text-black lg:bg-transparent lg:hover:bg-transparent ">
                                    <div class="w-[40px] h-[40px] rounded-md grid place-items-center lg:hidden">
                                        <i class="fa-solid fa-gear"></i>
                                    </div>
                                    <span>Blogs</span>
                                </a>
                            </li>

                            <!-- About -->
                            <li>
                                <a href="#"
                                    class="{{ request()->is('settings') ? '' : '' }} w-full flex gap-2 items-center py-2 px-3 text-base sm:text-lg no-underline transition-all duration-300 ease-in-out hover:text-[#16454e] hover:font-bold hover:bg-[#0d6a7c] hover:text-white lg:hover:text-black lg:bg-transparent lg:hover:bg-transparent ">
                                    <div class="w-[40px] h-[40px] rounded-md grid place-items-center lg:hidden">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                    <span>About</span>
                                </a>
                            </li>

                            <!-- Contact -->
                            <li>
                                <a href="#"
                                    class="{{ request()->is('settings') ? '' : '' }} w-full flex gap-2 items-center py-2 px-3 text-base sm:text-lg no-underline transition-all duration-300 ease-in-out hover:text-[#16454e] hover:font-bold hover:bg-[#0d6a7c] hover:text-white lg:hover:text-black lg:bg-transparent lg:hover:bg-transparent ">
                                    <div class="w-[40px] h-[40px] rounded-md grid place-items-center lg:hidden">
                                        <i class="fa-solid fa-headset"></i>
                                    </div>
                                    <span>Contact</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <ul id="menu" class="flex flex-row w-fit gap-2 sm:gap-4">
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
                                            src="{{ Auth::user() && Auth::user()->profile_pic ? Auth::user()->profile_pic : asset('images/auth/profile.png') }}"
                                            alt="user-pic">
                                    </div>
                                </div>
                                <div id="user_drop_down_menu"
                                    class="absolute overflow-hidden max-h-0 top-[120%] right-0 bg-white dark:bg-gray-800 border-[#a2f0f2] shadow-xl w-full min-w-[180px] transition-all duration-300 ease-in-out hover:text-[#16454e] hover:font-bold z-50">
                                    <ul class="flex flex-col divide-y-2 divide-[#a2f0f2] dark:divide-slate-700">
                                        <li>
                                            <a href="{{ route('dashboard') }}"
                                                class="flex items-center gap-2 px-4 py-3 text-sm text-gray-800 dark:text-gray-100 hover:bg-[#e5fafd] hover:text-[#0a9396] dark:hover:bg-slate-700 dark:hover:text-cyan-400 transition-colors duration-200">
                                                <i class="fa-solid fa-gauge-high w-4 text-[#0a9396] dark:text-cyan-400"></i>
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile.edit') }}"
                                                class="flex items-center gap-2 px-4 py-3 text-sm text-gray-800 dark:text-gray-100 hover:bg-[#e5fafd] hover:text-[#0a9396] dark:hover:bg-slate-700 dark:hover:text-cyan-400 transition-colors duration-200">
                                                <i class="fa-solid fa-user w-4 text-[#0a9396] dark:text-cyan-400"></i>
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
                </nav>
            </div>
        </header>
    </div>
    <div class="mt-1">
        @yield('public')
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
                $("#dashboard_menu").toggleClass("ms-[-300px]")
            });
            $("#dashboard_toggle_btn2").click(function () {
                $("#dashboard_menu").toggleClass("ms-[-300px]")
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#toggleBtn").click(function () {
                $("#sidebar2").toggleClass("ms-[-300px]");
            });

            $("#toggleClose").click(function () {
                $("#sidebar2").toggleClass("ms-[-300px]")
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