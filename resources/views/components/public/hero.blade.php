<div id="hero"
    class="relative w-full h-[85vh] flex flex-col justify-center items-center bg-cover bg-center overflow-hidden"
    style="background-image: url('{{ asset('https://drive.google.com/file/d/1pI3i0XNrrqNOOPWZLeWXy2ElPRon8S3H/view?usp=sharing') }}'); background-color: #333;">


    <div class="absolute inset-0 bg-black/25"></div>


    <div class="relative z-10 flex flex-col items-center w-full max-w-[90rem] px-4">


        <h2 class="font-barlow text-white/90 text-3xl sm:text-4xl md:text-5xl lg:text-6xl
           font-bold tracking-[0.15em] uppercase drop-shadow-md mb-10 leading-tight ml-28">
            WELCOME TO
        </h2>


        <div class="w-full flex justify-end pt-25 mr-96">
            <p class="font-sans text-white text-base sm:text-xl md:text-2xl font-normal tracking-wide drop-shadow-md">
                We Serve and Protect.
            </p>
        </div>


        <a href="{{ url('/register') }}" class="group flex items-center gap-3 bg-[#A2C4D9C7] hover:bg-[#94B8CC] text-black
                  px-8 py-4 rounded-md text-sm sm:text-base font-bold uppercase tracking-wider
                  transition-all duration-200 hover:scale-105 shadow-xl backdrop-blur-sm mt-14">
            <span>REGISTER TO ACCESS BARANGAY SERVICES</span>


            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-5 h-5 transition-transform group-hover:translate-x-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
        </a>


    </div>
</div>



