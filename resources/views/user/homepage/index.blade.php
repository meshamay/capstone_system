<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            poppins: ['Poppins', 'sans-serif'],
            barlow: ['Barlow Semi Condensed', 'sans-serif'],
          }
        }
      }
    }
    </script>
</head>
<body class="font-poppins bg-gray-100 text-slate-800 min-h-screen flex flex-col">


<!-- TOP NAVBAR -->
<nav id="top-navbar" class="fixed top-0 left-0 w-full h-[80px] font-barlow bg-[#134573CC] text-white shadow-md z-30 flex items-center justify-between px-6">


    
    <!-- LEFT SIDE: LOGOS + TEXT -->
    <div class="flex items-center gap-4">

        <!-- LOGOS SIDE BY SIDE-->
        <div class="flex items-center space-x-3">
        <label for="sidebar-toggle" class="cursor-pointer md:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </label>
       
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Mandaluyong_seal.svg/1024px-Mandaluyong_seal.svg.png" alt="Mandaluyong Seal" class="w-12 h-12">
        <img src="https://tse2.mm.bing.net/th/id/OIP._bP7eQwOSrZjwv-doDDsWAHaHa?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Barangay Seal" class="w-12 h-12 rounded-full object-cover">
       
        <div>
          <h1 class="text-xl font-semibold">Barangay Daang Bakal</h1>
          <p class="text-lg font-semibold">Mandaluyong City</p>
        </div>
      </div>
   
    </div>

    <!-- RIGHT SIDE: NOTIFICATION + PROFILE -->
    <div class="flex items-center gap-6">

        <!-- NOTIFICATION BELL -->
    
 <div class="flex items-center space-x-5">
<div x-data="{ open: false }" class="relative">
  <!-- Bell Icon Button -->
  <button @click="open = !open" class="relative p-2 rounded-full hover:bg-gray-100">
    <!-- Bell Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="h-6 w-6 text-white-700" 
         fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 
           6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 
           6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 
           1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
    </svg>

  </button>

  <!-- Dropdown Panel -->
  <div
    x-show="open"
    @click.outside="open = false"
    class="absolute right-0 mt-3 w-80 bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden z-50">

    <div class="p-4 border-b">
      <h3 class="text-lg font-semibold text-gray-700">Notifications</h3>
    </div>

    <div class="max-h-96 overflow-y-auto">

      <!-- Notification Item -->
      <div class="p-4 border-b hover:bg-gray-50">
        <div class="flex items-start gap-3">
          <div class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-800">
              Your complaint (CMP-T8634) has been received and is currently being processed.
            </p>
            <p class="text-xs text-gray-500 mt-1">Date Filed: 10/22/2025</p>
          </div>
        </div>
      </div>

      <!-- Another Item -->
      <div class="p-4 border-b hover:bg-gray-50">
        <div class="flex items-start gap-3">
          <div class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-800">
              Your document request is pending. Please wait for admin approval.
            </p>
            <p class="text-xs text-gray-500 mt-1">Date Requested: 10/20/2025</p>
          </div>
        </div>
      </div>

      <!-- Completed Item -->
      <div class="p-4 hover:bg-gray-50">
        <div class="flex items-start gap-3">
          <div class="w-8 h-8 flex items-center justify-center bg-green-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600"
              fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <div>
            <p class="text-sm text-gray-800">
              Your document request has been completed. You may now claim it.
            </p>
            <p class="text-xs text-gray-500 mt-1">Date Completed: 09/15/2025</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- PROFILE SECTION -->
          <div class="flex items-center pl-6 border-l border-blue-300/30 h-8">
                       
           <div class="text-right mr-3 hidden sm:block">
              <p class="text-md font-bold text-white leading-none">Juan Dela Cruz</p>
              <p class="text-xs text-blue-200 font-medium mt-1">Resident</p>
          </div>
          <div>
              <a href="http://127.0.0.1:8000/user/profile" id="profileIcon"
              class="h-10 w-10 rounded-full bg-white/10 border border-white/40 flex items-center justify-center text-white backdrop-blur-sm hover:bg-white/20 transition cursor-pointer">  
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </a>
                    </div>
              </div>
            </div>
        </div>
      </div>
    </nav>
  
   <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 space-y-8">
 


<div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-white via-blue-50 to-indigo-50 border border-blue-100 shadow-sm group mt-24">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-0 rounded-full blur-3xl"></div>
           
            <div class="relative p-8 md:p-10">
                <h1 class="text-3xl md:text-4xl font-bold mb-3 text-[#134573]">Welcome back, Juan!</h1>
                    <p class="text-slate-600 text-lg leading-relaxed">
                        Access your barangay services quickly. Manage requests, file complaints, and view your history all in one place.
                    </p>
                    <br>

                <div class="flex flex-wrap gap-4 md:gap-8 text-sm font-medium text-white inline-flex px-6 py-3 rounded-xl shadow-sm backdrop-blur-sm border border-white/40 bg-[#4A6F95]">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z" clip-rule="evenodd" />
                        </svg>
                        <span>45-B Sen. Neptali Gonzales St.</span>
                    </div>
                    <div class="w-px h-4 bg-slate-400 hidden md:block"></div>
                    <div class="flex items-center gap-2">
                         <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                        </svg>
                        <span class="tracking-wider text-white font-bold">RS-00001</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
           
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#4A6F95]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Recent Activity
                    </h2>
                    <a href="#" class="text-sm text-[#4A6F95] font-bold hover:underline">View All</a>
                </div>


                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="divide-y divide-gray-100">
                       @forelse($recentActivity as $activity)
                        @php
                            // Determine status badge
                            $statusClass = '';
                            $statusText = ucfirst($activity['status']);
                            
                            if ($activity['type'] == 'Document Request') {
                                if ($activity['status'] == 'pending') {
                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                    $statusText = 'Pending Approval';
                                } elseif ($activity['status'] == 'processing') {
                                    $statusClass = 'bg-[#4A6F95]/10 text-[#4A6F95]';
                                    $statusText = 'In Progress';
                                } elseif ($activity['status'] == 'approved') {
                                    $statusClass = 'bg-green-100 text-green-800';
                                    $statusText = 'Completed';
                                } elseif ($activity['status'] == 'rejected') {
                                    $statusClass = 'bg-red-100 text-red-800';
                                    $statusText = 'Rejected';
                                }
                            } else { // Complaint
                                if ($activity['status'] == 'pending') {
                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                    $statusText = 'Pending';
                                } elseif ($activity['status'] == 'investigating') {
                                    $statusClass = 'bg-[#4A6F95]/10 text-[#4A6F95]';
                                    $statusText = 'In Progress';
                                } elseif ($activity['status'] == 'resolved') {
                                    $statusClass = 'bg-green-100 text-green-800';
                                    $statusText = 'Completed';
                                } elseif ($activity['status'] == 'dismissed') {
                                    $statusClass = 'bg-red-100 text-red-800';
                                    $statusText = 'Dismissed';
                                }
                            }
                        @endphp
                        <div class="p-5 hover:bg-[#f3f6f9] transition duration-150 group">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-slate-800 group-hover:text-[#4A6F95] transition">{{ $activity['title'] }}</h3>
                                    <div class="flex items-center gap-3 mt-1 text-xs text-slate-500">
                                        <span class="font-mono bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 font-medium">{{ $activity['transaction_id'] }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $activity['date_text'] }}</span>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                            </div>
                        </div>
                       @empty
                        <div class="p-8 text-center text-slate-500">
                            <p>No recent activity found.</p>
                        </div>
                       @endforelse
                    </div>
                </div>
            </div>


            <div class="space-y-4">
                <h2 class="text-xl font-bold text-slate-800">Quick Actions</h2>
               
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                    <a href="http://127.0.0.1:8000/user/document-req" class="group block p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-[#4A6F95] hover:shadow-md transition-all duration-200 relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-16 h-16 bg-[#A9C5D6] opacity-20 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                       
                        <div class="relative">
                            <div class="w-12 h-12 bg-[#e0ecf3] rounded-lg flex items-center justify-center text-[#4A6F95] mb-4 group-hover:bg-[#4A6F95] group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 group-hover:text-[#4A6F95]">Request Document</h3>
                            <p class="text-sm text-slate-500 mt-1">Request certificates, and clearances online.</p>
                        </div>
                    </a>


                    <a href="http://127.0.0.1:8000/user/complaint-files" class="group block p-6 bg-white rounded-xl shadow-sm border border-gray-200 hover:border-red-500 hover:shadow-md transition-all duration-200 relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-16 h-16 bg-red-100 opacity-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                       
                        <div class="relative">
                            <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center text-red-600 mb-4 group-hover:bg-red-600 group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 group-hover:text-red-700">File a Complaint</h3>
                            <p class="text-sm text-slate-500 mt-1">File issues and problems in the barangay.</p>
                        </div>
                    </a>
                </div>
            </div>


        </div>
    </main>



  <!-- =============================== -->
  <!-- JavaScript -->
  <!-- =============================== -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const profileIcon = document.getElementById('profileIcon');
      if (profileIcon) {
        profileIcon.addEventListener('click', () => {
          window.location.href = 'user-profile';
        });
      }

      const requestBtn = document.getElementById('requestDocumentBtn');
      if (requestBtn) {
        requestBtn.addEventListener('click', () => {
          window.location.href = 'user-document-request';
        });
      }

       const fileComplaintBtn = document.getElementById('fileComplaintBtn');
      if (fileComplaintBtn) {
        fileComplaintBtn.addEventListener('click', () => {
          window.location.href = 'user-complaint';
        });
      }

    });

      // <!-- Navbar Scroll Effect -->

  const navbar = document.getElementById('top-navbar');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 0) {
      // Remove transparency when scrolling
      navbar.style.backgroundColor = '#134573';
    } else {
      // Restore original transparent background at top
      navbar.style.backgroundColor = '#134573CC';
    }
  });
  
  </script>

</body>
</html>
