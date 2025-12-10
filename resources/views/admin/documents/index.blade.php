@extends('superadmin.layouts.app')


@section('content')


<main class="fflex-1 p-11 fixed top-[60px] left-[220px] 
    w-[calc(100vw-200px)] h-[calc(100vh-60px)] 
    overflow-hidden bg-gray-100" > 
  <h1 class="text-3xl font-bold mb-6">DOCUMENT REQUEST</h1>
  
  @if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
  </div>
  @endif

  <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $requests->count() }}</p>
        <p class="text-medium font-semibold text-black mt-1">TOTAL REQUEST</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $requests->where('status', 'pending')->count() }}</p>
        <p class="text-medium font-semibold text-black mt-1">PENDING</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $requests->where('status', 'processing')->count() }}</p>
        <p class="text-medium font-semibold text-black mt-1">IN PROGRESS</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $requests->where('status', 'approved')->count() }}</p>
        <p class="text-medium font-semibold text-black mt-1">COMPLETED</p>
    </div>
</div>


  <div class="flex justify-between items-center mb-6">
    <div class="flex items-center space-x-4">
      <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#00000080]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
        <input type="text" placeholder="Search..." class="w-96 h-8 border border-gray-300 rounded-lg pl-10 pr-3 text-sm focus:outline-none" />
      </div>
      
<div class="flex gap-2 w-fit">
  <select class="h-8 px-3 text-sm focus:outline-none w-55">
    <option>DOCUMENT TYPE</option>
    <option>Barangay Clearance</option>
    <option>Barangay Certificate</option>
    <option>Indigency Clearance</option>
    <option>Resident Certificate</option>
  </select>

  <select class="h-8 px-3 text-sm focus:outline-none w-50">
    <option>STATUS</option>
    <option>Pending</option>
    <option>In Progress</option>
    <option>Completed</option>
  </select>
</div>


    </div>
</div>
<!-- TABLE-->
<div class="bg-white shadow-md rounded-lg overflow-hidden">
  <table class="table table-zebra w-full text-md">
    <thead style="background-color: #134573; color: white;">
      <tr class="text-sm whitespace-nowrap">
        <th class="py-1.5 px-4">TRANSACTION NO.</th>
        <th class="py-1.5 px-4">LAST NAME</th>
        <th class="py-1.5 px-4">FIRST NAME</th>
        <th class="py-1.5 px-4">DOCUMENT TYPE</th>
        <th class="py-1.5 px-4">DATE FILED</th>
        <th class="py-1.5 px-4">DATE COMPLETED</th>
        <th class="py-1.5 px-4">STATUS</th>
        <th class="py-1.5 px-4">ACTION</th>
      </tr>
    </thead>
    <tbody>
      @forelse($requests as $request)
      <tr class="text-sm whitespace-nowrap">
        <td class="py-1.5 px-4 text-center border-b border-gray-200">DOC-{{ str_pad($request->id, 5, '0', STR_PAD_LEFT) }}</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">{{ explode(' ', $request->requester_name)[count(explode(' ', $request->requester_name))-1] ?? $request->requester_name }}</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">{{ explode(' ', $request->requester_name)[0] }}</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">{{ $request->document_type }}</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">{{ $request->created_at->format('d/m/Y') }}</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">
          {{ $request->status == 'approved' ? $request->updated_at->format('d/m/Y') : '--/--/----' }}
        </td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">
          <span class="
            @if($request->status == 'pending') bg-orange-200 text-orange-800
            @elseif($request->status == 'processing') bg-yellow-200 text-yellow-800
            @elseif($request->status == 'approved') bg-green-200 text-green-800
            @elseif($request->status == 'rejected') bg-red-200 text-red-800
            @endif
            text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">
            {{ ucfirst($request->status) }}
          </span>
        </td>
        <td class="py-1.5 px-4 border-b border-gray-200">
          <div class="flex justify-start items-center mr-2">
            <div class="flex space-x-1.5 items-center">
              <!-- View Icon -->
              <div class="relative group">
                <button onclick="openViewModal({{ $request->id }})" class="w-8 h-8 flex items-center justify-center rounded hover:bg-blue-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
                    <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
                    <circle cx="12" cy="12" r="4" fill="white"/>
                    <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">View</span>
              </div>

              @if($request->status != 'approved' && $request->status != 'rejected')
              <!-- In Progress/Update Icon -->
              <div class="relative group">
                <button onclick="openStatusModal({{ $request->id }}, 'processing')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-yellow-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-7 h-7 text-yellow-500">
                    <path d="M6 2h12v2l-4 5 4 5v2H6v-2l4-5-4-5V2zm2 2v1.382l2.618 3.272L8 11.618V13h8v-1.382l-2.618-3.272L16 5.382V4H8z"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">In progress</span>
              </div>

              <!-- Complete Icon -->
              <div class="relative group">
                <button onclick="openStatusModal({{ $request->id }}, 'approved')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-green-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 fill-green-600">
                    <path d="M9 16.2l-3.5-3.5-1.4 1.4L9 19 20 8l-1.4-1.4z"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Completed</span>
              </div>
              @endif
            </div>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="8" class="py-8 text-center text-gray-500">No document requests found.</td>
      </tr>
      @endforelse
    </tbody>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">DOC-CLE-125</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Dela Cruz</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Juan</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Barangay Clearance</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">21/11/2025</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">--/--/----</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">
          <span class="bg-orange-200 text-orange-800 text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">Pending</span>
        </td>
        <td class="py-1.5 px-4 border-b border-gray-200">

          <div class="flex justify-start items-center mr-2">
            <div class="flex space-x-1.5 items-center">

              <!-- View Icon -->
              <div class="relative group">
                <button onclick="openModal('modalClearance')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-blue-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
                    <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
                    <circle cx="12" cy="12" r="4" fill="white"/>
                    <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">View</span>
              </div>

              <!-- In Progress Icon -->
              <div class="relative group">
                <button onclick="openModal('inprogressModal')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-yellow-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-7 h-7 text-yellow-500">
                    <path d="M6 2h12v2l-4 5 4 5v2H6v-2l4-5-4-5V2zm2 2v1.382l2.618 3.272L8 11.618V13h8v-1.382l-2.618-3.272L16 5.382V4H8z"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">In progress</span>
              </div>

              <!-- Complete Icon -->
              <div class="relative group">
                <button onclick="openModal('completedModal')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-green-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 fill-green-600">
                    <path d="M9 16.2l-3.5-3.5-1.4 1.4L9 19 20 8l-1.4-1.4z"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Completed</span>
              </div>

            </div>
          </div>

        </td>
      </tr>

      <!-- Row 2 -->
      <tr class="text-sm whitespace-nowrap">
        <td class="py-1.5 px-4 text-center border-b border-gray-200">DOC-CER-124</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Dela Cruz</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Juan</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Barangay Certificate</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">20/11/2025</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">--/--/----</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">
          <span class="bg-orange-200 text-orange-800 text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">Pending</span>
        </td>
        <td class="py-1.5 px-4 border-b border-gray-200">

          <div class="flex justify-start items-center mr-2">
            <div class="flex space-x-1.5 items-center">

              <!-- View Icon -->
              <div class="relative group">
                <button onclick="openModal('modalCertificate')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-blue-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
                    <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
                    <circle cx="12" cy="12" r="4" fill="white"/>
                    <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">View</span>
              </div>

              <!-- In Progress Icon -->
              <div class="relative group">
                <button onclick="openModal('inprogressModal')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-yellow-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-7 h-7 text-yellow-500">
                    <path d="M6 2h12v2l-4 5 4 5v2H6v-2l4-5-4-5V2zm2 2v1.382l2.618 3.272L8 11.618V13h8v-1.382l-2.618-3.272L16 5.382V4H8z"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">In progress</span>
              </div>

              <!-- Complete Icon -->
              <div class="relative group">
                <button onclick="openModal('completedModal')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-green-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 fill-green-600">
                    <path d="M9 16.2l-3.5-3.5-1.4 1.4L9 19 20 8l-1.4-1.4z"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">Completed</span>
              </div>

            </div>
          </div>

        </td>
      </tr>

<!-- Row 3: Indigency -->
<tr class="text-sm whitespace-nowrap">
  <td class="py-1.5 px-4 text-center border-b border-gray-200">DOC-CLE-123</td>
  <td class="py-1.5 px-4 text-center border-b border-gray-200">Dela Cruz</td>
  <td class="py-1.5 px-4 text-center border-b border-gray-200">Juan</td>
  <td class="py-1.5 px-4 text-center whitespace-nowrap border-b border-gray-200">Indigency Clearance</td>
  <td class="py-1.5 px-4 text-center border-b border-gray-200">15/11/2025</td>
  <td class="py-1.5 px-4 text-center border-b border-gray-200">--/--/----</td>
  <td class="py-1.5 px-4 text-center border-b border-gray-200">
    <span class="bg-yellow-200 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">
      In Progress
    </span>
  </td>
  <td class="py-1.5 px-4 border-b border-gray-200">
    <div class="flex justify-start items-center mr-2">
      <div class="flex space-x-1.5 items-center">

        <!-- View Icon -->
        <div class="relative group">
          <button onclick="openModal('modalIndigency')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-blue-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
              <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
              <circle cx="12" cy="12" r="4" fill="white"/>
              <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
            </svg>
          </button>
          <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
            View
          </span>
        </div>

        <!-- Complete Check Icon -->
        <div class="relative group">
          <button onclick="openModal('completedModal')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-green-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 fill-green-600">
              <path d="M9 16.2l-3.5-3.5-1.4 1.4L9 19 20 8l-1.4-1.4z"/>
            </svg>
          </button>
          <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
            Completed
          </span>
        </div>

      </div>
    </div>
  </td>
</tr>


    <!-- Row 4: Resident -->
      <tr class="text-sm whitespace-nowrap">
        <td class="py-1.5 px-4 text-center border-b border-gray-200">DOC-RES-122</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Dela Cruz</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Juan</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Resident Certificate </td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">15/9/2025</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">15/10/2025</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">
          <span class="bg-green-200 text-green-800 text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">Completed</span>
        </td>
        <td class="py-1.5 px-4 border-b border-gray-200">
          <div class="flex justify-start items-center mr-2">
          
                 <!-- View Icon -->
      <div class="relative group">
        <button onclick="openModal('modalResidency')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-blue-100 transition">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
            <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
            <circle cx="12" cy="12" r="4" fill="white"/>
            <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
          </svg>
        </button>
        <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">View</span>
      </div>

</td>
</tr>
    <!-- Row 5: Clearance -->
      <tr class="text-sm whitespace-nowrap">
        <td class="py-1.5 px-4 text-center border-b border-gray-200">DOC-CLE-121</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Dela Cruz</td>
        <td class="py-1.5px-4 text-center border-b border-gray-200">Juan</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">Barangay Clearance</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">03/09/2025</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">03/10/2025</td>
        <td class="py-1.5 px-4 text-center border-b border-gray-200">
          <span class="bg-green-200 text-green-800 text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">Completed</span>
        </td>
        <td class="py-1.5 px-4 border-b border-gray-200">
          <div class="flex justify-start items-center mr-4">
        <!-- View Icon -->
      <div class="relative group">
        <button onclick="openModal('modalClearance')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-blue-100 transition">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
            <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
            <circle cx="12" cy="12" r="4" fill="white"/>
            <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
          </svg>
        </button>
  </table>
</div>

  <div class="flex justify-end mt-4">
    <a href="http://127.0.0.1:8000/superadmin/documents/nextpage">
    <button class="px-3  bg-[#A2C4D9C7] text-black font-semibold text-md rounded-lg hover:bg-[#C1D2E1]">
        >>
    </button>
</a>
</div>

    </div>
  </div>
</div>




<!-- =============================== -->
<!-- MODALS -->
<!-- =============================== -->

<!-- MODAL 1: REQUEST FOR BARANGAY CLEARANCE -->

<div id="modalClearance" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-[100001] ">

  <div class="bg-[#f5f0e8] w-[750px] h-[620px] rounded-3xl overflow-hidden flex flex-col">
    
    <!-- HEADER -->
    <div class="bg-[#2e5478] flex items-center px-4 py-3 rounded-t-3xl gap-3">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxqDxTyUPRaADhPEUlOlFYUnvFckf-ruIw5Q&sg"
           class="w-10 h-10 rounded-full border-2 object-cover">
      <h1 class="text-white text-lg font-bold">Barangay Daang Bakal</h1>
    </div>

    <!-- BODY -->
    <div class="px-8 py-5 flex-1 overflow-y-auto">
      <h2 class="text-xl font-bold mb-6 text-gray-900">
        REQUEST FOR BARANGAY CLEARANCE
      </h2>

      <!-- FORM GRID -->
      <form class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm">

        <!-- PERSONAL INFO FIELDS -->
        <div>
          <label class="font-semibold text-gray-700">Last Name:</label>
          <input placeholder="Cruz" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">First Name:</label>
          <input placeholder="Juan" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Middle Name:</label>
          <input placeholder="Dela" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Suffix:</label>
          <input placeholder="" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Age:</label>
          <input placeholder="26" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Date of Birth:</label>
          <input placeholder="03/23/2003" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Place of Birth:</label>
          <input placeholder="San Juan City" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Gender:</label>
          <input placeholder="Male" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Civil Status:</label>
          <input placeholder="Single" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Citizenship:</label>
          <input placeholder="Filipino" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <!-- Attachments -->
        <div class="col-span-2 mt-4">
          <label class="font-semibold text-gray-700">Valid ID Attachment</label>

          <div class="mt-2 grid grid-cols-2 gap-4">
            <button class="border-2 border-dashed border-gray-500 rounded-xl py-6 flex flex-col items-center text-sm w-full">
              <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="w-10 opacity-70 mb-2">
              Front of Valid ID
            </button>

            <button class="border-2 border-dashed border-gray-500 rounded-xl py-6 flex flex-col items-center text-sm w-full">
              <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="w-10 opacity-70 mb-2">
              Back of Valid ID
            </button>
          </div>
        </div>

        <!-- Divider -->
        <div class="col-span-2 my-4">
          <label class="font-bold text-gray-800 mt-6 mb-4 block">
            ---------------------------------------------------------------------------------
          </label>
        </div>

        <!-- ROW 1 -->
        <div>
          <label class="font-semibold text-gray-700">Lenght of Residency:</label>
          <input placeholder="26" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Valid ID Number:</label>
          <input placeholder="123-456-7890" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <!-- ROW 2 -->
        <div>
          <label class="font-semibold text-gray-700">Registered Voter:</label>
          <input placeholder="Yes" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Purpose of Request:</label>
          <input placeholder="Educational..............." class="w-full border border-gray-700 rounded-md px-3 py-6 mt-1">
        </div>

      </form>

      <div class="bg-[#f5f0e8] flex justify-end">
        <button onclick="closeModal('modalClearance')" class="bg-[#A2C4D9] mt-4 hover:bg-gray-400 text-gray-900 px-5 py-1.5 rounded-xl text-[12px] font-bold">
          CLOSE
        </button>
      </div>

    </div>
  </div>
</div>


<!-- MODAL 2: REQUEST FOR BARANGAY CERTIFICATE -->

<div id="modalCertificate" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-[100001] ">

  <div class="bg-[#f5f0e8] w-[750px] h-[620px] rounded-3xl overflow-hidden flex flex-col">
    
    <!-- HEADER -->
    <div class="bg-[#2e5478] flex items-center px-4 py-3 rounded-t-3xl gap-3">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxqDxTyUPRaADhPEUlOlFYUnvFckf-ruIw5Q&sg"
           class="w-10 h-10 rounded-full border-2 object-cover">
      <h1 class="text-white text-lg font-bold">Barangay Daang Bakal</h1>
    </div>

    <!-- BODY -->
    <div class="px-8 py-5 flex-1 overflow-y-auto">
      <h2 class="text-xl font-bold mb-6 text-gray-900">
        REQUEST FOR BARANGAY CERTIFICATE
      </h2>

      <!-- FORM GRID -->
      <form class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm">

        <!-- PERSONAL INFO FIELDS -->
        <div>
          <label class="font-semibold text-gray-700">Last Name:</label>
          <input placeholder="Cruz" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">First Name:</label>
          <input placeholder="Juan" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Middle Name:</label>
          <input placeholder="Dela" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Suffix:</label>
          <input placeholder="" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Age:</label>
          <input placeholder="26" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Date of Birth:</label>
          <input placeholder="03/23/2003" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Place of Birth:</label>
          <input placeholder="San Juan City" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Gender:</label>
          <input placeholder="Male" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Civil Status:</label>
          <input placeholder="Single" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Citizenship:</label>
          <input placeholder="Filipino" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <!-- Attachments -->
        <div class="col-span-2 mt-4">
          <label class="font-semibold text-gray-700">Valid ID Attachment</label>

          <div class="mt-2 grid grid-cols-2 gap-4">
            <button class="border-2 border-dashed border-gray-500 rounded-xl py-6 flex flex-col items-center text-sm w-full">
              <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="w-10 opacity-70 mb-2">
              Front of Valid ID
            </button>

            <button class="border-2 border-dashed border-gray-500 rounded-xl py-6 flex flex-col items-center text-sm w-full">
              <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="w-10 opacity-70 mb-2">
              Back of Valid ID
            </button>
          </div>
        </div>

        <!-- Divider -->
        <div class="col-span-2 my-4">
          <label class="font-bold text-gray-800 mt-6 mb-4 block">
            ---------------------------------------------------------------------------------
          </label>
        </div>

        <!-- ROW 1 -->
        <div>
          <label class="font-semibold text-gray-700">Lenght of Residency:</label>
          <input placeholder="26" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Valid ID Number:</label>
          <input placeholder="123-456-7890" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <!-- ROW 2 -->
        <div>
          <label class="font-semibold text-gray-700">Registered Voter:</label>
          <input placeholder="Yes" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Purpose of Request:</label>
          <input placeholder="Educational..............." class="w-full border border-gray-700 rounded-md px-3 py-6 mt-1">
        </div>

      </form>

      <div class="bg-[#f5f0e8] flex justify-end">
        <button onclick="closeModal('modalCertificate')" class="bg-[#A2C4D9] mt-4 hover:bg-gray-400 text-gray-900 px-5 py-1.5 rounded-xl text-[12px] font-bold">
          CLOSE
        </button>
      </div>

    </div>
  </div>
</div>

<!-- MODAL 3: REQUEST FOR INDIGENCY CLEARANCE -->


<div id="modalIndigency" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-[100001] ">

  <div class="bg-[#f5f0e8] w-[750px] h-[620px] rounded-3xl overflow-hidden flex flex-col">
    
    <!-- HEADER -->
    <div class="bg-[#2e5478] flex items-center px-4 py-3 rounded-t-3xl gap-3">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxqDxTyUPRaADhPEUlOlFYUnvFckf-ruIw5Q&sg"
           class="w-10 h-10 rounded-full border-2 object-cover">
      <h1 class="text-white text-lg font-bold">Barangay Daang Bakal</h1>
    </div>

    <!-- BODY -->
    <div class="px-8 py-5 flex-1 overflow-y-auto">
      <h2 class="text-xl font-bold mb-6 text-gray-900">
        REQUEST FOR INDIGENCY CLEARANCE
      </h2>

      <!-- FORM GRID -->
      <form class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm">

        <!-- PERSONAL INFO FIELDS -->
        <div>
          <label class="font-semibold text-gray-700">Last Name:</label>
          <input placeholder="Cruz" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">First Name:</label>
          <input placeholder="Juan" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Middle Name:</label>
          <input placeholder="Dela" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Suffix:</label>
          <input placeholder="" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Age:</label>
          <input placeholder="26" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Date of Birth:</label>
          <input placeholder="03/23/2003" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Place of Birth:</label>
          <input placeholder="San Juan City" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Gender:</label>
          <input placeholder="Male" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Civil Status:</label>
          <input placeholder="Single" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Citizenship:</label>
          <input placeholder="Filipino" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <!-- Attachments -->
        <div class="col-span-2 mt-4">
          <label class="font-semibold text-gray-700">Valid ID Attachment</label>

          <div class="mt-2 grid grid-cols-2 gap-4">
            <button class="border-2 border-dashed border-gray-500 rounded-xl py-6 flex flex-col items-center text-sm w-full">
              <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="w-10 opacity-70 mb-2">
              Front of Valid ID
            </button>

            <button class="border-2 border-dashed border-gray-500 rounded-xl py-6 flex flex-col items-center text-sm w-full">
              <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="w-10 opacity-70 mb-2">
              Back of Valid ID
            </button>
          </div>
        </div>

        <!-- Divider -->
        <div class="col-span-2 my-4">
          <label class="font-bold text-gray-800 mt-6 mb-4 block">
            ---------------------------------------------------------------------------------
          </label>
        </div>

        <!-- ROW 1 -->
        <div>
          <label class="font-semibold text-gray-700">Certificate of Being Indigent:</label>
          <input placeholder="26" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Other Purpose:</label>
          <input placeholder="123-456-7890" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

<!-- ROW 2 -->
<div class="col-span-2 mt-4 grid grid-cols-2 gap-4 items-start">
  <!-- Proof of Request -->
  <div>
    <label class="font-semibold text-gray-700 mb-2 block">Proof of Request</label>
    <label class="border-2 border-dashed border-gray-500 rounded-xl py-6 flex flex-col items-center text-sm w-full">
      <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="w-10 opacity-70 mb-2">
      Uploaded Photo/File
    </label>
  </div>

  <!-- Purpose of Request -->
  <div>
    <label class="font-semibold text-gray-700 mb-2 block">Purpose of Request:</label>
    <input placeholder="Educational..............." class="w-full border border-gray-700 rounded-md px-3 py-12">
  </div>
</div>

      </form>

      <div class="bg-[#f5f0e8] flex justify-end">
        <button onclick="closeModal('modalIndigency')" class="bg-[#A2C4D9] mt-4 hover:bg-gray-400 text-gray-900 px-5 py-1.5 rounded-xl text-[12px] font-bold">
          CLOSE
        </button>
      </div>

    </div>
  </div>
</div>



<!-- MODAL 4: REQUEST FOR BARANGAY RESIDENCY -->

<div id="modalResidency" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-[100001] ">

  <div class="bg-[#f5f0e8] w-[750px] h-[620px] rounded-3xl overflow-hidden flex flex-col">
    
    <!-- HEADER -->
    <div class="bg-[#2e5478] flex items-center px-4 py-3 rounded-t-3xl gap-3">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxqDxTyUPRaADhPEUlOlFYUnvFckf-ruIw5Q&sg"
           class="w-10 h-10 rounded-full border-2 object-cover">
      <h1 class="text-white text-lg font-bold">Barangay Daang Bakal</h1>
    </div>

    <!-- BODY -->
    <div class="px-8 py-5 flex-1 overflow-y-auto">
      <h2 class="text-xl font-bold mb-6 text-gray-900">
        REQUEST FOR BARANGAY RESIDENCY
      </h2>

      <!-- FORM GRID -->
      <form class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm">

        <!-- PERSONAL INFO FIELDS -->
        <div>
          <label class="font-semibold text-gray-700">Last Name:</label>
          <input placeholder="Cruz" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">First Name:</label>
          <input placeholder="Juan" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Middle Name:</label>
          <input placeholder="Dela" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Suffix:</label>
          <input placeholder="" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Age:</label>
          <input placeholder="26" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Date of Birth:</label>
          <input placeholder="03/23/2003" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Place of Birth:</label>
          <input placeholder="San Juan City" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Gender:</label>
          <input placeholder="Male" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Civil Status:</label>
          <input placeholder="Single" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Citizenship:</label>
          <input placeholder="Filipino" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <!-- Attachments -->
        <div class="col-span-2 mt-4">
          <label class="font-semibold text-gray-700">Valid ID Attachment</label>

          <div class="mt-2 grid grid-cols-2 gap-4">
            <button class="border-2 border-dashed border-gray-500 rounded-xl py-6 flex flex-col items-center text-sm w-full">
              <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="w-10 opacity-70 mb-2">
              Front of Valid ID
            </button>

            <button class="border-2 border-dashed border-gray-500 rounded-xl py-6 flex flex-col items-center text-sm w-full">
              <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="w-10 opacity-70 mb-2">
              Back of Valid ID
            </button>
          </div>
        </div>

        <!-- Divider -->
        <div class="col-span-2 my-4">
          <label class="font-bold text-gray-800 mt-6 mb-4 block">
            ---------------------------------------------------------------------------------
          </label>
        </div>

        <!-- ROW 1 -->
        <div>
          <label class="font-semibold text-gray-700">Lenght of Residency:</label>
          <input placeholder="26" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Valid ID Number:</label>
          <input placeholder="123-456-7890" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <!-- ROW 2 -->
        <div>
          <label class="font-semibold text-gray-700">Registered Voter:</label>
          <input placeholder="Yes" class="w-full border border-gray-700 rounded-md px-3 py-1.5 mt-1">
        </div>

        <div>
          <label class="font-semibold text-gray-700">Purpose of Request:</label>
          <input placeholder="Educational..............." class="w-full border border-gray-700 rounded-md px-3 py-6 mt-1">
        </div>

      </form>

      <div class="bg-[#f5f0e8] flex justify-end">
        <button onclick="closeModal('modalResidency')" class="bg-[#A2C4D9] mt-4 hover:bg-gray-400 text-gray-900 px-5 py-1.5 rounded-xl text-[12px] font-bold">
          CLOSE
        </button>
      </div>

    </div>
  </div>
</div>





<!--Inprogress Modal-->


<div id="inprogressModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-60">

  <div class="bg-[#DDE1E5] w-[480px] h-[390px] rounded-2xl shadow-xl p-10 border-2 border-black relative z-50 text-center">

      <div class="flex justify-center mb-4">
        <div class="w-20 h-20 rounded-full border-4 border-green-700 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>
      </div>

      <h2 class="font-extrabold text-xl mb-3 text-black tracking-wide">
        ACCEPT DOCUMENT REQUEST
      </h2>
      <br>
      <p class="text-xs text-black leading-relaxed mb-1">
        You are accepting the document request.
        This action cannot be undone. <br><br>
        Once confirmed document request will be moved to "In Progress" status.
      </p>

      <button onclick="closeInprogressModal()" 
              class="mt-7 bg-[#A2C4D9] hover:bg-blue-100 px-7 py-1 rounded-2xl text-sm font-semibold text-black transition gap-4">
        CANCEL
      </button>
        <button onclick="confirmInprogressModal()" 
              class="mt-7 bg-[#239549C7] hover:bg-green-400 px-7 py-1 rounded-2xl text-sm font-semibold text-black transition">
        CONFIRM
      </button>
  </div>

</div>


<!--Completed Modal-->


<div id="completedModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-60">

  <div class="bg-[#DDE1E5] w-[480px] h-[390px] rounded-2xl shadow-xl p-10 border-2 border-black relative z-50 text-center">

      <div class="flex justify-center mb-4">
        <div class="w-20 h-20 rounded-full border-4 border-green-700 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>
      </div>

      <h2 class="font-extrabold text-xl mb-3 text-black tracking-wide">
        DOCUMENT REQUEST COMPLETION
      </h2>
      <br>
      <p class="text-xs text-black leading-relaxed mb-1">
        You have done the document request and now ready to pick up.
         <br><br>
        Once confirmed the document request will be moved to "Completed" status.
      </p>

      <button onclick="closeCompletedModal()" 
              class="mt-7 bg-[#A2C4D9] hover:bg-blue-100 px-7 py-1 rounded-2xl text-sm font-semibold text-black transition gap-4">
        CANCEL
      </button>
        <button onclick="confirmCompletedModal()" 
              class="mt-7 bg-[#239549C7] hover:bg-green-400 px-7 py-1 rounded-2xl text-sm font-semibold text-black transition">
        CONFIRM
      </button>
  </div>

</div>




<!-- =============================== -->
<!-- JAVA SCRIPT -->
<!-- =============================== -->


<script>
// ADDED: Open modal
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}

// ADDED: Close modal
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}


//Function to open Inprogress Modal
function openInprogressModal(modalId) {
  const modal = document.getElementById(modalId);
  const mainContent = document.getElementById('main-content');
  if(modal) modal.classList.remove('hidden');
  if(mainContent) mainContent.classList.add('blur-sm'); // blur background
}

//Function to close Inprogress Modal
function closeInprogressModal() {
  const modal = document.getElementById('inprogressModal');
  const mainContent = document.getElementById('main-content');
  if(modal) modal.classList.add('hidden');
  if(mainContent) mainContent.classList.remove('blur-sm'); // remove blur
}

//Function to confirm Inprogress Modal
function confirmInprogressModal() {
  alert("Document request has been moved to In Progress status.");
  closeInprogressModal();
}

//Function to open Completed Modal
function openCompletedModal(modalId) {
  const modal = document.getElementById(modalId);
  const mainContent = document.getElementById('main-content');
  if(modal) modal.classList.remove('hidden');
  if(mainContent) mainContent.classList.add('blur-sm'); // blur background
}

//Function to close Completed Modal
function closeCompletedModal() {
  const modal = document.getElementById('completedModal');
  const mainContent = document.getElementById('main-content');
  if(modal) modal.classList.add('hidden');
  if(mainContent) mainContent.classList.remove('blur-sm'); // remove blur
}

//Function to confirm Completed Modal
function confirmCompletedModal() {
  alert("Document request has been moved to Completed status.");
  closeCompletedModal();
}

// New functions for backend integration
function openStatusModal(requestId, status) {
  document.getElementById('statusRequestId').value = requestId;
  document.getElementById('statusSelect').value = status;
  document.getElementById('statusModal').classList.remove('hidden');
}

function closeStatusModal() {
  document.getElementById('statusModal').classList.add('hidden');
}

function openViewModal(requestId) {
  // For now, just show the modal - you can add AJAX to fetch details
  alert('View details for request ID: ' + requestId);
}
</script>

<!-- Status Update Modal -->
<div id="statusModal" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black/50">
  <div class="bg-white rounded-lg shadow-xl w-[500px] p-6">
    <h2 class="text-xl font-bold mb-4">Update Request Status</h2>
    
    <form action="{{ route('superadmin.documents.update-status', ['id' => 'REQUEST_ID']) }}" method="POST" id="statusForm">
      @csrf
      <input type="hidden" name="request_id" id="statusRequestId">
      
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
        <select name="status" id="statusSelect" class="w-full border border-gray-300 rounded px-3 py-2">
          <option value="pending">Pending</option>
          <option value="processing">Processing</option>
          <option value="approved">Approved</option>
          <option value="rejected">Rejected</option>
        </select>
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes (Optional)</label>
        <textarea name="admin_notes" class="w-full border border-gray-300 rounded px-3 py-2" rows="3"></textarea>
      </div>
      
      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeStatusModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancel</button>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update Status</button>
      </div>
    </form>
  </div>
</div>

<script>
// Update form action with correct request ID before submitting
document.getElementById('statusForm').addEventListener('submit', function(e) {
  const requestId = document.getElementById('statusRequestId').value;
  this.action = this.action.replace('REQUEST_ID', requestId);
});
</script>




</main>


@endsection

