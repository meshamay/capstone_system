@extends('superadmin.layouts.app')


@section('content')


<main class="fflex-1 p-11 fixed top-[60px] left-[220px] 
    w-[calc(100vw-200px)] h-[calc(100vh-60px)] 
    overflow-hidden bg-gray-100" > 
  <h1 class="text-3xl font-bold mb-6">USERS</h1>

  <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-7">

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $stats['totalResidents'] }}</p>
        <p class="text-medium font-semibold text-black mt-1">REGISTERED RESIDENTS</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $stats['totalMale'] }}</p>
        <p class="text-medium font-semibold text-black mt-1">MALE</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $stats['totalFemale'] }}</p>
        <p class="text-medium font-semibold text-black mt-1">FEMALE</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $stats['totalArchived'] }}</p>
        <p class="text-medium font-semibold text-black mt-1">ARCHIVED ACCOUNTS</p>
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
  <select class="h-8 px-3 text-sm focus:outline-none w-full">
    <option>GENDER</option>
    <option>Male</option>
    <option>Female</option>
  </select>

  <select class="h-8 px-3 text-sm focus:outline-none w-full">
    <option>STATUS</option>
    <option>Pending</option>
    <option>Approved</option>
    <option>Reject</option>
    <option>Archive</option>
  </select>
</div>


    </div>
</div>

<!-- TABLE-->
<div class="bg-white shadow-md rounded-lg overflow-hidden">
  <table class="table table-zebra w-full text-md">
    
    <thead style="background-color: #134573; color: white;">
      <tr class="text-sm whitespace-nowrap">
        <th class="py-2 px-5 border-b border-gray-200">RESIDENT ID NO.</th>
        <th class="py-2 px-5 border-b border-gray-200">LAST NAME</th>
        <th class="py-2 px-5 border-b border-gray-200">FIRST NAME</th>
        <th class="py-2 px-5 border-b border-gray-200">GENDER</th>
        <th class="py-2 px-5 border-b border-gray-200">DATE REGISTERED</th>
        <th class="py-2 px-5 border-b border-gray-200">STATUS</th>
        <th class="py-2 px-5 border-b border-gray-200">ACTION</th>
      </tr>
    </thead>

    <tbody>

      <!-- ROW 1 -->
      <tr class="text-sm whitespace-nowrap">

        <td class="py-2 px-5 text-center border-b border-gray-200">RS-00001</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Dela Cruz</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Juan</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Male</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">11/20/2025</td>

        <td class="py-2 px-5 text-center border-b border-gray-200">
          <span class="bg-orange-200 text-orange-800 text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">Pending</span>
        </td>

        <td class="py-2 px-5 border-b border-gray-200">
          <div class="flex justify-start items-center gap-1.5 ml-4">

            <!-- View -->
            <div class="relative group">
              <a href="/superadmin/users/profile/view" class="w-7 h-7 flex items-center justify-center rounded hover:bg-blue-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
                  <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
                  <circle cx="12" cy="12" r="4" fill="white"/>
                  <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
                </svg>
              </a>
              <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">View</span>
            </div>

            <!-- Archive -->
            <div class="relative group">
              <button onclick="openArchiveModal('archiveModal')" class="w-7 h-7 flex items-center justify-center rounded hover:bg-gray-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-gray-700">
                  <path d="M3 6h18v4H3V6zm2 6h14v8H5v-8zm7 1l-3 3h6l-3-3z"/>
                </svg>
              </button>
              <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">Archive</span>
            </div>

            <!-- Approved -->
            <div class="relative group">
              <button onclick="openApprovedModal('approvedModal')" class="w-7 h-7 flex items-center justify-center rounded hover:bg-green-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-green-600">
                  <path d="M9 16.2l-3.5-3.5-1.4 1.4L9 19 20 8l-1.4-1.4z"/>
                </svg>
              </button>
              <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">Approved</span>
            </div>

            <!-- Reject -->
            <div class="relative group">
              <button onclick="openRejectModal('rejectModal')" class="w-7 h-7 flex items-center justify-center rounded hover:bg-red-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-red-600">
                  <path d="M18.3 5.7L12 12l6.3 6.3-1.4 1.4L12 13.4l-6.3 6.3-1.4-1.4L10.6 12 4.3 5.7l1.4-1.4L12 10.6l6.3-6.3z"/>
                </svg>
              </button>
              <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">Reject</span>
            </div>

          </div>
        </td>

      </tr>

      <!-- ROW 2 -->
      <tr class="text-sm whitespace-nowrap">

        <td class="py-2 px-5 text-center border-b border-gray-200">RS-00002</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Dela Cruz</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Juan</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Male</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">11/20/2025</td>

        <td class="py-2 px-5 text-center border-b border-gray-200">
          <span class="bg-green-200 text-green-800 text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">Approved</span>
        </td>

        <td class="py-2 px-5 border-b border-gray-200">
          <div class="flex justify-start items-center gap-1.5 ml-4">

            <!-- View -->
            <div class="relative group">
              <button class="w-7 h-7 flex items-center justify-center rounded hover:bg-blue-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
                  <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
                  <circle cx="12" cy="12" r="4" fill="white"/>
                  <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
                </svg>
              </button>
              <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">View</span>
            </div>

            <!-- Archive -->
            <div class="relative group">
              <button class="w-7 h-7 flex items-center justify-center rounded hover:bg-gray-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-gray-700">
                  <path d="M3 6h18v4H3V6zm2 6h14v8H5v-8zm7 1l-3 3h6l-3-3z"/>
                </svg>
              </button>
              <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">Archive</span>
            </div>

          </div>
        </td>

      </tr>

      <!-- ROW 3 -->
      <tr class="text-sm whitespace-nowrap">

        <td class="py-2 px-5 text-center border-b border-gray-200">RS-00003</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Dela Cruz</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Juan</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Male</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">11/20/2025</td>

        <td class="py-2 px-5 text-center border-b border-gray-200">
          <span class="bg-red-200 text-red-800 text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">Reject</span>
        </td>

        <td class="py-2 px-5 border-b border-gray-200">
          <div class="flex justify-start items-center gap-1.5 ml-4">

            <!-- View -->
            <div class="relative group">
              <button class="w-7 h-7 flex items-center justify-center rounded hover:bg-blue-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
                  <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
                  <circle cx="12" cy="12" r="4" fill="white"/>
                  <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
                </svg>
              </button>
              <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">View</span>
            </div>

          </div>
        </td>

      </tr>

      <!-- ROW 4 -->
      <tr class="text-sm whitespace-nowrap">

        <td class="py-2 px-5 text-center border-b border-gray-200">RS-00004</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Dela Cruz</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Juan</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Male</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">11/20/2025</td>

        <td class="py-2 px-5 text-center border-b border-gray-200">
          <span class="bg-gray-200 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">Archived</span>
        </td>

        <td class="py-2 px-5 border-b border-gray-200">
          <div class="flex justify-start items-center gap-1.5 ml-4">

            <!-- View -->
            <div class="relative group">
              <button class="w-7 h-7 flex items-center justify-center rounded hover:bg-blue-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
                  <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
                  <circle cx="12" cy="12" r="4" fill="white"/>
                  <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
                </svg>
              </button>
              <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">View</span>
            </div>

          </div>
        </td>

      </tr>

      <!-- ROW 5 -->
      <tr class="text-sm whitespace-nowrap">

        <td class="py-2 px-5 text-center border-b border-gray-200">RS-00005</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Dela Cruz</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Juan</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">Male</td>
        <td class="py-2 px-5 text-center border-b border-gray-200">11/20/2025</td>

        <td class="py-2 px-5 text-center border-b border-gray-200">
          <span class="bg-gray-200 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">Archived</span>
        </td>

        <td class="py-2 px-5 border-b border-gray-200">
          <div class="flex justify-start items-center gap-1.5 ml-4">

            <!-- View -->
            <div class="relative group">
              <button class="w-7 h-7 flex items-center justify-center rounded hover:bg-blue-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
                  <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
                  <circle cx="12" cy="12" r="4" fill="white"/>
                  <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
                </svg>
              </button>
              <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100">View</span>
            </div>

          </div>
        </td>

      </tr>

    </tbody>
  </table>
</div>
       

   
    
  <div class="flex justify-end mt-4">
     <a href="http://127.0.0.1:8000/superadmin/users/nextpage">
    <button class="px-3  bg-[#A2C4D9C7] text-black font-semibold text-md rounded-lg hover:bg-[#C1D2E1]">
        >>
    </button>
</a>
</div>



<!-- =============================== -->
<!-- MODALS -->
<!-- =============================== -->

<!-- ARCHIVE MODAL -->
<div id="archiveModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-60">
  <div class="bg-[#DDE1E5] w-[480px] rounded-2xl shadow-xl p-10 border-2 border-black relative z-50 text-center">
      <div class="flex justify-center mb-4">
        <div class="w-20 h-20 rounded-full border-4 border-gray-500 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M9 6v12m6-12v12M5 6l1 14h12l1-14" />
          </svg>
        </div>
      </div>

      <h2 class="font-extrabold text-xl mb-3 text-black tracking-wide">
        ARE YOU SURE YOU WANT TO ARCHIVE THIS USER?
      </h2>
        <br>
      <p class="text-xs text-black leading-relaxed mb-5">
        Archiving will deactivate the user temporarily, but their data 
        will still remain stored in the system.
      </p>

      <div class="flex justify-center gap-5">
        <button onclick="closeArchiveModal()" 
                class=" mt-4 bg-[#A2C4D9] hover:bg-[#94B8CC] px-6 py-1 rounded-2xl text-sm font-semibold text-black transition">
          CANCEL
        </button>
        <button onclick="confirmArchive()" 
                class="mt-4 bg-gray-500 hover:bg-gray-600 px-6 py-1 rounded-2xl text-sm font-semibold text-black transition">
          ARCHIVE
        </button>
      </div>
  </div>
</div>


<!--Approved Modal-->


<div id="approvedModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-60">

  <div class="bg-[#DDE1E5] w-[480px] rounded-2xl shadow-xl p-10 border-2 border-black relative z-50 text-center">

      <div class="flex justify-center mb-4">
        <div class="w-20 h-20 rounded-full border-4 border-green-700 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>
      </div>

      <h2 class="font-extrabold text-xl mb-3 text-black tracking-wide">
        Approved Resident Registration
      </h2>
      <br>
      <p class="text-xs text-black leading-relaxed mb-1">
        Are you sure you want to approve this resident's account? 
Once approved, they will gain access to the system according to their role.
      </p>

      <div class="flex justify-center gap-4">
      <button onclick="closeApprovedModal()" 
              class="mt-7 bg-[#A2C4D9] hover:bg-blue-100 px-7 py-1 rounded-2xl text-sm font-semibold text-black transition">
        CANCEL
      </button>
        <button onclick="confirmApproved()" 
              class="mt-7 bg-[#239549C7] hover:bg-green-400 px-7 py-1 rounded-2xl text-sm font-semibold text-black transition">
        CONFIRM
      </button>
  </div>
</div>
</div>

<!--Reject Modal-->


<div id="rejectModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-60">

  <div class="bg-[#DDE1E5] w-[480px] rounded-2xl shadow-xl p-10 border-2 border-black relative z-50 text-center">

      <div class="flex justify-center mb-4">
        <div class="w-20 h-20 rounded-full border-4 border-green-700 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>
      </div>


      <h2 class="font-extrabold text-xl mb-3 text-black tracking-wide">
        Reject Resident Registration
      </h2>
      <br>
      <p class="text-xs text-black leading-relaxed mb-1">
       Are you sure you want to reject this registration? Once confirmed, this action cannot be undone.
      </p>
  <div class="flex justify-center gap-5">
      <button onclick="closeRejectModal()" 
              class="mt-7 bg-[#A2C4D9] hover:bg-blue-100 px-7 py-1 rounded-2xl text-sm font-semibold text-black transition gap-4">
        CANCEL
      </button>
        <button onclick="confirmReject()" 
              class="mt-7 bg-[#F01136E5] hover:bg-red-400 px-7 py-1 rounded-2xl text-sm font-semibold text-black transition">
        REJECT
      </button>
  </div>
  </div>
</div>













 <!-- =============================== -->
  <!-- JavaScript -->
  <!-- =============================== -->

<script>

function openArchiveModal(modalId) {
  const modal = document.getElementById(modalId);
  const mainContent = document.getElementById('main-content');
  if(modal) modal.classList.remove('hidden');
  if(mainContent) mainContent.classList.add('blur-sm'); // blur background
}

function closeArchiveModal() {
  const modal = document.getElementById('archiveModal');
  const mainContent = document.getElementById('main-content');
  if(modal) modal.classList.add('hidden');
  if(mainContent) mainContent.classList.remove('blur-sm'); // remove blur
}

// Example function when archive is confirmed
function confirmArchive() {
  alert("Record has been archived!");
  closeArchiveModal();
}


function openApprovedModal(modalId) {
  const modal = document.getElementById(modalId);
  const mainContent = document.getElementById('main-content');
  if(modal) modal.classList.remove('hidden');
  if(mainContent) mainContent.classList.add('blur-sm'); // blur background
}
function closeApprovedModal() {
  const modal = document.getElementById('approvedModal');
  const mainContent = document.getElementById('main-content');
  if(modal) modal.classList.add('hidden');
  if(mainContent) mainContent.classList.remove('blur-sm'); // remove blur
}
// Example function when approved is confirmed
function confirmApproved() {
  alert("Registration has been approved!");
  closeApprovedModal();
}


function openRejectModal(modalId) {
  const modal = document.getElementById(modalId);
  const mainContent = document.getElementById('main-content');
  if(modal) modal.classList.remove('hidden');
  if(mainContent) mainContent.classList.add('blur-sm'); // blur background
}
function closeRejectModal() {
  const modal = document.getElementById('rejectModal');
  const mainContent = document.getElementById('main-content');
  if(modal) modal.classList.add('hidden');
  if(mainContent) mainContent.classList.remove('blur-sm'); // remove blur
}
//Function when reject is confirmed
function confirmReject() {
  alert("Registration did not meet the requirements and was rejected!");
  closeRejectModal();
}

</script>


</main>

@endsection

