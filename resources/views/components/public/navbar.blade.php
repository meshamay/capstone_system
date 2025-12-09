<nav class="bg-[#4c6b8a] text-white shadow-md w-full z-50">
    <div class="max-w-[1920px] mx-auto px-4 sm:px-8">
        <div class="flex justify-between items-center h-20">


            <div class="flex items-center gap-4">
                <div class="flex space-x-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Mandaluyong_seal.svg/1024px-Mandaluyong_seal.svg.png"
                        alt="Mandaluyong Seal" class="h-14 w-14 object-contain drop-shadow-md">
                    <img src="https://tse2.mm.bing.net/th/id/OIP._bP7eQwOSrZjwv-doDDsWAHaHa?rs=1&pid=ImgDetMain&o=7&rm=3"
                        alt="Barangay Seal" class="h-14 w-14 object-contain drop-shadow-md rounded-full">
                </div>
                <div class="flex flex-col text-white">
                    <h1 class="font-barlow font-bold text-base sm:text-2xl leading-none tracking-wide">Barangay Daang
                        Bakal</h1>
                    <span class="text-sm sm:text-base font-medium opacity-90">City of Mandaluyong</span>
                </div>
            </div>


            <div class="hidden lg:flex items-center space-x-6">
                <a href="#hero" class="font-bold text-base hover:text-gray-200 transition tracking-wide">Home</a>
                <a href="#services" class="font-bold text-base hover:text-gray-200 transition tracking-wide">Services</a>
                <a href="#about" class="font-bold text-base hover:text-gray-200 transition tracking-wide">About</a>
                <a href="{{ url('/login') }}"
                    class="font-bold text-base hover:text-gray-200 transition tracking-wide">Login</a>
            </div>


            <div class="lg:hidden" x-data="{ open: false }">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div x-show="open" @click.outside="open = false"
                    class="absolute top-20 right-0 left-0 bg-[#4c6b8a] text-white p-4 shadow-xl z-50 flex flex-col gap-4 text-center border-t border-white/20">
                    <a href="#hero" class="font-bold text-lg py-2">Home</a>
                    <a href="#services" class="font-bold text-lg py-2">Services</a>
                    <a href="#about" class="font-bold text-lg py-2">About</a>
                    <a href="{{ url('/login') }}" class="font-bold text-lg py-2">Login</a>
                </div>
            </div>
        </div>
    </div>
</nav>

