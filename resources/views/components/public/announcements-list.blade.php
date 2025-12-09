@props(['announcements'])


@php
    if (!isset($announcements) || (is_iterable($announcements) && count($announcements) == 0)) {
        $announcements = collect([
            (object) [
                'title' => 'MAGANDANG UMAGA, DAANG BAKAL!',
                'content' => 'Mag-ingat po sa umuusong sakit na Influenza (Trangkaso). Ugaliing maghugas ng kamay...',
                'created_at' => now(),
                'end_date' => now()->addDays(7),
            ],
            (object) [
                'title' => 'GUSTO MO BA MAG TUPAD?',
                'content' => 'Tara na, kabarangay! Isa itong magandang pagkakataon para sa karagdagang hanapbuhay...',
                'created_at' => now()->subDays(4),
                'end_date' => now()->addDays(2),
            ],
            (object) [
                'title' => 'TARA, BASA TAYO!',
                'content' => 'Alam niyo ba? May Mini Library tayo sa 2nd Floor ng Barangay Daang Bakal Hall!',
                'created_at' => now()->subDays(8),
                'end_date' => now()->subDays(1),
            ],
            (object) [
                'title' => 'WORLD HEALTH DAY',
                'content' => 'Nakikiisa ang Barangay Daang Bakal sa pagdiriwang ng World Mental Health Day!',
                'created_at' => now()->subDays(11),
                'end_date' => now()->subDays(5),
            ],
            (object) [
                'title' => 'REHAB REFERRAL DESK',
                'content' => 'Isa sa mga serbisyong hatid ng Barangay Daang Bakal ay ang Rehab Referral Desk...',
                'created_at' => now()->subDays(14),
                'end_date' => null,
            ]
        ]);
    }
@endphp


<section id="announcements" class="bg-white py-12 px-4 font-sans text-slate-900">
    <div class="max-w-5xl mx-auto">
        <h2 class="font-barlow text-3xl md:text-4xl font-black text-center mb-8 tracking-tight uppercase">
            ANNOUNCEMENTS
        </h2>


        <div class="flex flex-col md:flex-row gap-4 mb-2">
            <div class="w-20 md:w-24 flex-shrink-0 flex justify-center items-center">
                <img src="{{ asset('image/announcement.png') }}" alt="Announcements" class="w-14 h-14 object-contain">
            </div>
            <div class="flex-grow">
                <form action="" method="GET" class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </span>
                    <input type="text" name="search" placeholder="Search..."
                        class="w-full py-2 pl-9 pr-4 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-400 focus:border-transparent placeholder-gray-400 shadow-sm">
                </form>
            </div>
        </div>


        <div class="flex gap-4 mb-6">
            <div class="w-20 md:w-24 flex-shrink-0 flex justify-center">
                <a href="#"
                    class="inline-block border-b-2 border-black font-bold text-xs tracking-wider pb-0.5 uppercase text-black">
                    ALL
                </a>
            </div>
            <div class="flex-grow border-b border-transparent"></div>
        </div>


        <div class="space-y-0">
            @foreach($announcements as $announcement)
                <div class="flex gap-4 group">


                    <div class="w-20 md:w-24 flex-shrink-0 text-right pt-1">
                        @php
                            $createdDate = \Carbon\Carbon::parse($announcement->created_at);
                            $endDate = isset($announcement->end_date) ? \Carbon\Carbon::parse($announcement->end_date) : null;
                           
                            $isExpired = $endDate && $endDate->isPast();
                        @endphp
                        <div class="font-bold text-lg md:text-xl uppercase leading-none text-black font-barlow {{ $isExpired ? 'opacity-50' : '' }}">
                            {{ $createdDate->format('M d') }}
                        </div>
                    </div>


                    <div class="flex-grow border-l-2 border-gray-300 pl-5 pb-8 relative">
                        <h3 class="text-lg md:text-xl font-bold uppercase text-black mb-1 leading-tight font-barlow {{ $isExpired ? 'opacity-60 decoration-slate-400' : '' }}">
                            {{ $announcement->title }}
                        </h3>


                        <div class="mb-2">
                            @if($isExpired)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-red-100 text-red-800 border border-red-200">
                                    🔴 EXPIRED: {{ $endDate->format('M d, Y') }}
                                </span>
                            @elseif($endDate)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-800 border border-green-200">
                                    🟢 VALID UNTIL: {{ $endDate->format('M d, Y') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    ∞ NO EXPIRATION
                                </span>
                            @endif
                        </div>


                        <p class="text-xs md:text-sm text-gray-700 leading-relaxed font-sans {{ $isExpired ? 'opacity-60' : '' }}">
                            {{ Str::limit($announcement->content, 200) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="mt-4 text-center text-xs md:text-sm text-gray-800 font-sans">
            Para sa karagdagang mga update, bisitahin lamang ang Opisyal na Facebook Page ng Barangay Daang Bakal!
        </div>


    </div>
</section>



