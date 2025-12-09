<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Complaint Dashboard</title>
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

<body class="bg-gray-100 overflow-hidden" style="font-family: 'Poppins', sans-serif;">

  <!-- TOP NAVBAR -->
<nav id="top-navbar" class="fixed top-0 left-0 w-full h-[80px] font-barlow bg-[#134573CC] text-white shadow-md z-30 flex items-center justify-between px-6">


    
    <!-- LEFT SIDE: LOGOS + TEXT -->
    <div class="flex items-center gap-4">

        <!-- LOGOS SIDE BY SIDE (NO OVERLAP) -->
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

  <!-- PAGE CONTENT -->
    <div id="pageContent" class="max-w-6xl mx-auto p-8 mt-1 transition-all duration-300 pt-32">

<!-- Status Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6 ml-40 justify-center w-full">
  
  <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
      <p class="text-3xl font-bold text-black">{{ $stats['pending'] }}</p>
      <p class="text-medium font-semibold text-black mt-1">PENDING</p>
  </div>

  <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
      <p class="text-3xl font-bold text-black">{{ $stats['investigating'] }}</p>
      <p class="text-medium font-semibold text-black mt-1">IN PROGRESS</p>
  </div>

  <div class="p-5 rounded-lg shadow-md" style="background-color: #EBF0F4;">
      <p class="text-3xl font-bold text-black">{{ $stats['resolved'] }}</p>
      <p class="text-medium font-semibold text-black mt-1">COMPLETED</p>
  </div>

</div>


    <!-- Dropdown and Table -->
    <div class="flex justify-between items-center mb-5 relative">
      <h3 class="text-lg font-bold text-gray-800">List of Complaints</h3> 
      <button id="addButton" class="bg-[#A2C4D9] text-black px-4 py-1 text-sm rounded-md font-semibold hover:bg-[#cbd4e0]" onclick="openModal('modalGeneralComplaint')">
        File a Complaint +
      </button>
    </div>

  <!-- Success Message -->
  @if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
  </div>
  @endif

    <!-- Table -->
  <div class="bg-white shadow-md rounded-lg overflow-hidden">
  <table class="table table-zebra w-full text-md">
    <thead style="background-color: #134573; color: white;">
      <tr class="text-sm whitespace-nowrap">
            <th class="px-4 py-2 border-b border-gray-200">TRANSACTION ID</th>
            <th class="px-4 py-2 border-b border-gray-200">LAST NAME</th>
            <th class="px-4 py-2 border-b border-gray-200">FIRST NAME</th>
            <th class="px-4 py-2 border-b border-gray-200">COMPLAINT TYPE</th>
            <th class="px-4 py-2 border-b border-gray-200">DATE FILED</th>
            <th class="px-4 py-2 border-b border-gray-200">DATE RESOLVE</th>
            <th class="px-4 py-2 border-b border-gray-200">STATUS</th>
          </tr>
        </thead>
        <tbody>
          @forelse($complaints as $complaint)
           @php
             $nameParts = explode(' ', $complaint->complainant_name, 2);
             $lastName = $nameParts[0] ?? '';
             $firstName = $nameParts[1] ?? '';
           @endphp
           <tr class="text-sm font-thin text-center">
            <td class="px-4 py-2 border-b border-gray-200">CMP-{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</td>
            <td class="px-4 py-2 border-b border-gray-200">{{ $lastName }}</td>
            <td class="px-4 py-2 border-b border-gray-200">{{ $firstName }}</td>
            <td class="px-4 py-2 border-b border-gray-200">{{ $complaint->complaint_type }}</td>
            <td class="px-4 py-2 border-b border-gray-200">{{ $complaint->created_at->format('m/d/Y') }}</td>
            <td class="px-4 py-2 border-b border-gray-200">{{ $complaint->status == 'resolved' && $complaint->updated_at ? $complaint->updated_at->format('m/d/Y') : '-' }}</td>
            <td class="px-4 py-2 border-b border-gray-200 
              @if($complaint->status == 'pending') text-yellow-600
              @elseif($complaint->status == 'investigating') text-blue-600
              @elseif($complaint->status == 'resolved') text-green-600
              @elseif($complaint->status == 'dismissed') text-red-600
              @endif font-medium">
              {{ ucfirst($complaint->status) }}
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="px-4 py-8 text-center text-gray-500">No complaints filed yet.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="flex justify-end mt-40">
  <button onclick="window.location.href='/user/homepage'" 
        class="bg-[#A2C4D9] hover:bg-[#94B8CC] text-xs text-black font-extrabold px-6 py-1.5 rounded-md transition-all duration-200 shadow-sm">
  BACK
</button>
   
    </div>
  </div>


  <!-- MODAL: General Complaint -->
  <div id="modalGeneralComplaint" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black/40 backdrop-blur-sm">
    <div class="bg-[#f5f0e8] w-[520px] rounded-3xl border border-black overflow-hidden flex flex-col pointer-events-auto">

      <!-- Header -->
      <div class="bg-[#2e5478] flex items-center px-4 py-3 rounded-t-3xl">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxqDxTyUPRaADhPEUlOlFYUnvFckf-ruIw5Q&sg" class="w-10 h-10 rounded-full border-2 border-white object-cover mr-3">
        <h1 class="text-white font-sans font-bold">Barangay Daang Bakal</h1>
      </div>

      <!-- BODY -->
      <div class="px-8 py-6 flex-1 overflow-y-auto">
        <h2 class="text-center text-lg font-bold text-gray-800 mb-6 tracking-wide">
          GENERAL COMPLAINT FORM
        </h2>

        <form id="formComplaint" action="{{ route('user.complaints.store') }}" method="POST" class="space-y-4">
          @csrf
          <input type="hidden" name="complainant_name" id="complaint_name">
          <input type="hidden" name="complainant_email" id="complaint_email">
          <input type="hidden" name="complainant_phone" id="complaint_phone">
          <input type="hidden" name="complaint_type" id="complaint_type_hidden">
          <input type="hidden" name="complaint_details" id="complaint_details_hidden">
          <input type="hidden" name="respondent_name" id="respondent_name">

          <!-- Incident Date -->
          <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-800 w-[45%]">Incident Date:</label>
            <input type="date" id="incident_date" class="w-[60%] border border-black rounded-sm px-3 py-1 text-sm focus:ring-blue-500 focus:outline-none bg-white">
          </div>

          <!-- Incident Time -->
          <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-800 w-[45%]">Incident Time:</label>
            <input type="time" id="incident_time" class="w-[60%] border border-black rounded-sm px-3 py-1 text-sm focus:ring-blue-500 focus:outline-none bg-white">
          </div>

          <!-- Defendant Name -->
          <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-800 w-[45%]">Defendant's Name:</label>
            <input type="text" id="defendant_name" placeholder="" class="w-[60%] border border-black rounded-sm px-3 py-1 text-sm focus:ring-blue-500 focus:outline-none bg-white">
          </div>

          <!-- Defendant Address -->
          <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-800 w-[45%]">Defendant's Address:</label>
            <input type="text" id="defendant_address" class="w-[60%] border border-black rounded-sm px-3 py-1 text-sm focus:ring-blue-500 focus:outline-none bg-white">
          </div>

          <!-- Level of Urgency -->
          <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-800 w-[45%]">Level of Urgency:</label>
            <select id="levelOfUrgency" class="w-[60%] border border-black rounded-sm px-3 py-1.5 text-sm text-gray-400"
              onchange="this.classList.remove('text-gray-400'); this.classList.add('text-gray-900');">
              <option value="" disabled selected hidden>Select</option>
              <option value="Low">Low(Non-urgent)</option>
              <option value="Medium">Medium(Normal)</option>
              <option value="High">High(Urgent)</option>
            </select>
          </div>

          <!-- Types of Complaints -->
          <div class="flex items-center justify-between">
            <label for="description" class="text-sm font-medium text-gray-800 w-[45%]">Types of Complaints:</label>
            <select id="description" name="description" class="w-[60%] border border-black rounded-sm px-3 py-1.5 text-sm text-gray-400"
              onchange="toggleSpecifyField(); this.classList.remove('text-gray-400'); this.classList.add('text-gray-900');">
              <option value="" disabled selected hidden>Types of Complaints</option>
              <option value="Community Issues">Community Issues (e.g., noise, garbage, vandalism etc.)</option>
              <option value="Physical Harassment">Physical Harrasments (e.g., Unwanted touching, punching, hitting etc.)</option>
              <option value="Neighbor Disputes">Neighbor Disputes (e.g., arguments, boundary issues, property damage etc.)</option>
              <option value="Money Problems">Money Problems (e.g., unpaid debts, rent issues, loan disputes etc.)</option>
              <option value="Misbehavior">Misbehavior  (e.g., insults, verbal arguing or shouting, bullying etc.)</option>
              <option value="Others">Others (please specify)</option>
            </select>
          </div>

          <!-- Hidden Others -->
          <div id="specifyField" class="hidden mt-1.5 ml-[45%] w-[55%]">
            <input type="text" id="specifyInput" name="specifyInput" class="border-b border-gray-400 focus:border-black w-full outline-none transition-all duration-300" placeholder="Please specify..." onfocus="removePlaceholder()" onblur="restorePlaceholder()">
          </div>

          <!-- Complaint Statement -->
          <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-800 w-[45%]">Complaint Statement:</label>
            <textarea id="complaint_statement" placeholder="" class="w-[60%] border border-black rounded-sm px-3 py-1 text-sm resize-none focus:ring-blue-500 focus:outline-none h-22 bg-white"></textarea>
          </div>

          <div class="flex items-start mt-2">
            <input type="checkbox" id="complaint_cert" class="mt-0.8 mr-2 border-gray-400 rounded">
            <label class="text-[10px] text-gray-600 leading-snug">I certify that the information provided above is accurate and complete to the best of my knowledge.</label>
          </div>

        </form>
      </div>

 <!-- FOOTER BUTTONS -->
    <div class="flex justify-end gap-3 bg-[#F6F1E7] border-t border-gray-300 px-8 py-3 rounded-b-2xl">
      <button type="button" onclick="closeModal('modalGeneralComplaint')" 
             class="bg-[#A2C4D9] hover:bg-gray-400 text-gray-900 px-4 py-1.5 rounded-md text-[10px] font-bold">CANCEL</button>
      <button type="button" onclick="submitComplaintForm()" 
              class="bg-green-600 hover:bg-green-700 text-white px-4 py-1.5 rounded-md text-[10px] font-bold">SUBMIT</button>
      </div>
    </div>

  </div>
</div>

  <!-- SUCCESS MODAL -->
<div id="successModal" class="hidden fixed inset-0 bg-black/30 backdrop-blur-none flex items-center justify-center z-50">

  <div class="bg-[#DDE1E5] w-[480px] rounded-2xl shadow-xl p-10 border-2 border-black relative z-50 text-center">

      <div class="flex justify-center mb-4">
        <div class="w-20 h-20 rounded-full border-4 border-green-700 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-700" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        </div>
      </div>

      <h2 class="font-extrabold text-xl mb-3 text-black tracking-wide">
        REQUEST SUBMITTED SUCCESSFULLY!
      </h2>

      <p class="text-sm text-black leading-relaxed mb-1">
        Thank you, your Complaint has been received.
      </p>
      <br>
      <p class="text-sm text-black leading-relaxed">
        Barangay officials will review your complaint and get back to you as soon as possible.
        Expect an initial response within 24-48 hours.
      </p>

      <button onclick="closeSuccessModal()" 
              class="mt-7 bg-[#A2C4D9] hover:bg-[#94B8CC] px-7 py-1 rounded-2xl text-sm font-semibold text-black transition">
        CLOSE
      </button>
  </div>

</div>




















 <!-- =============================== -->
  <!-- JavaScript -->
  <!-- =============================== -->

  <script>
    function openModal(id) {
      document.getElementById(id).classList.remove('hidden');
      document.getElementById('pageContent').classList.add('blur-sm');
    }
    function closeModal(id) {
      document.getElementById(id).classList.add('hidden');
      const anyOpen = Array.from(document.querySelectorAll('[id^="modal"]'))
                       .some(mod => !mod.classList.contains('hidden'));
      if (!anyOpen) document.getElementById('pageContent').classList.remove('blur-sm');
    }
    
    function submitComplaintForm() {
      const incidentDate = document.getElementById('incident_date').value;
      const incidentTime = document.getElementById('incident_time').value;
      const defendantName = document.getElementById('defendant_name').value;
      const defendantAddress = document.getElementById('defendant_address').value;
      const urgency = document.getElementById('levelOfUrgency').value;
      const complaintType = document.getElementById('description').value;
      const specifyInput = document.getElementById('specifyInput').value;
      const statement = document.getElementById('complaint_statement').value;
      const cert = document.getElementById('complaint_cert').checked;
      
      if (!complaintType) {
        alert('Please select complaint type');
        return;
      }
      if (!statement) {
        alert('Please enter complaint statement');
        return;
      }
      if (!cert) {
        alert('Please check the certification checkbox');
        return;
      }
      
      // Build complaint details
      let details = '';
      if (incidentDate) details += 'Date: ' + incidentDate + ', ';
      if (incidentTime) details += 'Time: ' + incidentTime + ', ';
      if (urgency) details += 'Urgency: ' + urgency + ', ';
      details += 'Statement: ' + statement;
      
      if (defendantAddress) details += ', Address: ' + defendantAddress;
      
      // Set form values
      document.getElementById('complaint_name').value = 'User Account Name';
      document.getElementById('complaint_email').value = '';
      document.getElementById('complaint_phone').value = '';
      document.getElementById('respondent_name').value = defendantName;
      
      // Set complaint type (use specify if Others selected)
      let finalType = complaintType;
      if (complaintType === 'Others' && specifyInput) {
        finalType = specifyInput;
      }
      document.getElementById('complaint_type_hidden').value = finalType;
      document.getElementById('complaint_details_hidden').value = details;
      
      // Submit form
      document.getElementById('formComplaint').submit();
    }
    
    function closeSuccessModal() {
      document.getElementById("successModal").classList.add("hidden");
      document.getElementById('pageContent').classList.remove('blur-sm');
    }

    function toggleSpecifyField() {
      const select = document.getElementById('description');
      const specify = document.getElementById('specifyField');
      specify.classList.toggle('hidden', select.value !== 'Others');
    }
    function removePlaceholder() {
      document.getElementById('specifyInput').placeholder = '';
    }
    function restorePlaceholder() {
      document.getElementById('specifyInput').placeholder = 'Please specify...';
    }


    document.addEventListener('DOMContentLoaded', () => {
      const profileIcon = document.getElementById('profileIcon');
      if (profileIcon) {
        profileIcon.addEventListener('click', () => {
          console.log('Profile icon clicked! Redirecting...');
          window.location.href = 'user-profile';
        });
      }
    });

  </script>

</body>
</html>
