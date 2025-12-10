@extends('superadmin.layouts.app')


@section('content')


    <main class="fflex-1 p-11 fixed top-[60px] left-[220px] 
    w-[calc(100vw-200px)] h-[calc(100vh-60px)] 
    overflow-hidden bg-gray-100" > 
  <h1 class="text-3xl font-bold mb-6">AUDIT LOGS</h1>


<div class="flex items-center gap-6">

    {{-- Date Filters --}}
    <div class="flex items-center gap-3 bg-gray-100 p-3 rounded-xl shadow-sm w-fit">

        <!-- FROM -->
        <div class="flex flex-col">
            <label class="text-xs text-gray-500 mb-1">From</label>
            <input 
                type="date" 
                id="fromDate"
                class="h-8 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#134573] focus:outline-none"
            >
        </div>

        <!-- Divider -->
        <span class="text-gray-400 mt-6">—</span>

        <!-- TO -->
        <div class="flex flex-col">
            <label class="text-xs text-gray-500 mb-1">To</label>
            <input 
                type="date" 
                id="toDate"
                class="h-8 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#134573] focus:outline-none"
            >
        </div>

        <!-- APPLY BUTTON -->
        <button 
            id="applyFilter"
            class="flex items-center h-8 mt-5 bg-[#A2C4D9C7] text-black px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#C1D2E1] transition">
            Apply
        </button>
    </div>

    {{-- Role Filter --}}
     <select class="h-8 px-3 text-sm focus:outline-none w-fit mt-6">
        <option selected>ROLE</option>
        <option>User</option>
        <option>Admin</option>
        <option>Superadmin</option>
    </select>

</div>


{{-- Data Table --}}
<div class="bg-white shadow-md rounded-lg overflow-hidden mt-8">
  <table class="table table-zebra w-full text-md ">
             <thead style="background-color: #134573; color: white; text-center;">
                <tr class="text-sm whitespace-nowrap">
                    <th class="py-2 px-5 border-b border-gray-200">USER ID</th>
                    <th class="py-2 px-5 border-b border-gray-200">LAST NAME</th>
                    <th class="py-2 px-5 border-b border-gray-200">FIRST NAME</th>
                    <th class="py-2 px-5 border-b border-gray-200">ROLE</th>
                    <th class="py-2 px-5 border-b border-gray-200">DATE</th>
                    <th class="py-2 px-5 border-b border-gray-200">TIME</th>
                    <th class="py-2 px-5 border-b border-gray-200">ACTION PERFORMED</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-sm whitespace-nowrap text-center">
                    <td class="py-2 px-5 border-b border-gray-200">ADM-A6243</td>
                    <td class="py-2 px-5 border-b border-gray-200">Belarma</td>
                    <td class="py-2 px-5 border-b border-gray-200">Maynilyn</td>
                    <td class="py-2 px-5 border-b border-gray-200">Admin</td>
                    <td class="py-2 px-5 border-b border-gray-200">10/22/2025</td>
                    <td class="py-2 px-5 border-b border-gray-200">8:30 AM</td>
                    <td class="py-2 px-5 border-b border-gray-200">Initiate Case Investigation</td>
                </tr>
               <tr class="text-sm whitespace-nowrap text-center">
                    <td class="py-2 px-5 border-b border-gray-200">RS-00001</td>
                    <td class="py-2 px-5 border-b border-gray-200">Dela Cruz</td>
                    <td class="py-2 px-5 border-b border-gray-200">Juan</td>
                    <td class="py-2 px-5 border-b border-gray-200">User</td>
                    <td class="py-2 px-5 border-b border-gray-200">10/22/2025</td>
                    <td class="py-2 px-5 border-b border-gray-200">7:00 AM</td>
                    <td class="py-2 px-5 border-b border-gray-200">File a Complaint</td>
                </tr>
                <tr class="text-sm whitespace-nowrap text-center">
                    <td class="py-2 px-5 border-b border-gray-200">ADM-A6243</td>
                    <td class="py-2 px-5 border-b border-gray-200">Belarma</td>
                    <td class="py-2 px-5 border-b border-gray-200">Maynilyn</td>
                    <td class="py-2 px-5 border-b border-gray-200">Admin</td>
                    <td class="py-2 px-5 border-b border-gray-200">10/20/2025</td>
                    <td class="py-2 px-5 border-b border-gray-200">4:08 PM</td>
                    <td class="py-2 px-5 border-b border-gray-200">Confirm Document Completion</td>
                </tr>
                <tr class="text-sm whitespace-nowrap text-center">
                    <td class="py-2 px-5 border-b border-gray-200">ADM-A6243</td>
                    <td class="py-2 px-5 border-b border-gray-200">elarma</td>
                    <td class="py-2 px-5 border-b border-gray-200">Maynilyn</td>
                    <td class="py-2 px-5 border-b border-gray-200">Admin</td>
                    <td class="py-2 px-5 border-b border-gray-200">10/20/2025</td>
                    <td class="py-2 px-5 border-b border-gray-200">2:30 PM</td>
                    <td class="py-2 px-5 border-b border-gray-200">Confirm Document Acceptance</td>
                </tr>
               <tr class="text-sm whitespace-nowrap text-center">
                    <td class="py-2 px-5 border-b border-gray-200">RS-00001</td>
                    <td class="py-2 px-5 border-b border-gray-200">Dela Cruz</td>
                    <td class="py-2 px-5 border-b border-gray-200">Juan</td>
                    <td class="py-2 px-5 border-b border-gray-200">User</td>
                    <td class="py-2 px-5 border-b border-gray-200">10/20/2025</td>
                    <td class="py-2 px-5 border-b border-gray-200">2:20 PM</td>
                    <td class="py-2 px-5 border-b border-gray-200">Request a Document</td>
                </tr>
            </tbody>
        </table>
</div>

     {{-- Pagination --}}
        <div class="flex justify-end mt-8">
            <a href="http://127.0.0.1:8000/superadmin/auditlog/nextpage">
            <button class="px-3  bg-[#A2C4D9C7] text-black font-semibold text-md rounded-lg hover:bg-[#C1D2E1]">
            >>
            </button>
            </a>
        </div>


   






<!-- =============================== -->
<!-- JavaScript -->
<!-- =============================== -->

<script>
function filterDateRange() {
    const from = document.getElementById('fromDate').value;
    const to = document.getElementById('toDate').value;

    if (!from || !to) {
        alert("Please select both dates.");
        return;
    }

    if (new Date(from) > new Date(to)) {
        alert("Invalid range. 'From' date must be earlier than 'To'.");
        return;
    }

    console.log("Filtered From:", from, "To:", to);

    // You can emit, fetch, reload table, whatever you want here
}
</script>





    </main>

@endsection
