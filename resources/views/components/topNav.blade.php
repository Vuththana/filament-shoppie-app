<div class="navbar-wrapper sticky-top shadow-lg w-full">
        <nav class="text-black flex flex-col sm:flex-row items-center gap-4 py-6 mx-10">
            <a href="/" class="font-semibold text-2xl flex items-center gap-2"><img src="../image/shoppie_logo.png" width="50px" alt="">Shoppie</a>
            <ul class="container w-full flex flex-l justify-center gap-3">
                <li>
                <div class="relative inline-block text-left">
                    <div>
                        <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                        All Category
                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                        </button>
                    </div>

                    <div class="dropdown hidden absolute left-0 md:right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="horizontal" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Electronic Device</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Gaming Accounts</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Softwares & Apps</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">Top Up</a>
                        </div>
                    </div>
                </div>

                </li>
                <li class="items-center justify-center flex md:justify-between flex-row md:flex md:w-auto md:order-1">
                    <form action="" method="GET">
                        <input type="text" value="{{ Request::get('name') }}" name="name" class="w-[200px] md:w-[300px] py-2 px-2 md:py-1 text-sm border rounded-lg focus:border-blue-500 focus:ring-blue-500 " placeholder="What are you looking for?" id="search" name="search">
                    </form>
                </li> 
            </ul>
            <div class="auth-form">
                @guest
                    <div class="guest-wrapper flex items-center">
                        <a href="{{ route('login')}}" class=" px-2 py-1 text-blue-500 text-semibold text-sm md:text-xl">Login</a>
                        <p class="mx-2 text-sm md:text-xl">/</p>
                        <a href="{{ route('register')}}" class="px-2 py-1 text-blue-500 text-semibold text-sm md:text-xl">Sign up</a>
                    </div>
                @endguest   
                
                @auth
                    <div class="auth-wrapper">
                        <button id="auth-button" type="button" class="inline-flex w-full items-center" aria-expanded="true" aria-haspopup="true"><img class="rounded-full mx-1" src="{{asset('storage/'.Auth::user()->avatar_url)}}" alt="" width="40px">{{ Auth::user()->name }}</button>
                    </div>

                    <div class="auth-dropdown hidden absolute right-0 mx-2 z-10 mt-2 w-56 orgin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="horizontal" aria-labelledby="menu-button" tabindex="-1">
                        <div class="p-1" role="none">
                        @if(Auth::user()->hasRole('Admin'))
                            <a class="px-4 py-2 text-sm mb-3" href="{{ url('admin')}}">Dashboard</a>
                        @endif
                            <form action="{{ route('logout')}}" method="POST">
                            @csrf
                                <input type="submit" class="w-full text-gray-700 block px-4 py-2 text-sm cursor-pointer text-left" value="Logout" role="menuitem" tabindex="-1" id="menu-item-0"/>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let dropDown = document.querySelector('.dropdown')
        let authDropDown = document.querySelector('.auth-dropdown')
        let menuButton = document.getElementById('menu-button')
        let authButton = document.getElementById('auth-button')

        menuButton.addEventListener('click', () => {
            dropDown.classList.toggle('hidden')
            dropDown.classList.toggle('block')
        })

        
        authButton.addEventListener('click', () => {
            authDropDown.classList.toggle('hidden')
            authDropDown.classList.toggle('block')
        })
    })
</script>