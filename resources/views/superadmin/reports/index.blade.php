@extends('superadmin.layouts.app')

@section('content')

<main class="fflex-1 p-11 fixed top-[60px] left-[220px] 
    w-[calc(100vw-200px)] h-[calc(100vh-60px)] 
    overflow-y-auto bg-gray-100"> 

  <h1 class="text-3xl font-bold mb-8">REPORTS & ANALYTICS</h1>

  {{-- Top Row Filters and Export --}}
  <div class="flex justify-end items-center mb-6 space-x-3">
      <form method="GET" action="{{ route('superadmin.reports') }}" class="flex items-center space-x-3">
          <select name="year" onchange="this.form.submit()" class="h-10 px-2 text-sm focus:outline-none border border-gray-300 rounded-lg">
              <option value="2025" {{ $year == 2025 ? 'selected' : '' }}>2025</option>
              <option value="2024" {{ $year == 2024 ? 'selected' : '' }}>2024</option>
              <option value="2023" {{ $year == 2023 ? 'selected' : '' }}>2023</option>   
              <option value="2022" {{ $year == 2022 ? 'selected' : '' }}>2022</option>
          </select>
      </form>
     
      {{-- Trigger Button --}}
      <button onclick="openModal('exportModal')" class="bg-[#A2C4D9C7] text-black px-3 py-1.5 font-semibold rounded-lg shadow-md hover:bg-[#94B8CC] transition">
          EXPORT
      </button>
  </div>


  {{-- KPI Cards --}}
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

      <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
          <p class="text-3xl font-bold text-black">{{ $stats['totalUsers'] }}</p>
          <p class="text-medium font-semibold text-black mt-1">TOTAL USER</p>
      </div>

      <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
          <p class="text-3xl font-bold text-black">{{ $stats['totalResidents'] }}</p>
          <p class="text-medium font-semibold text-black mt-1">TOTAL REGISTERED RESIDENTS</p>
      </div>

      <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
          <p class="text-3xl font-bold text-black">{{ $stats['totalStaff'] }}</p>
          <p class="text-medium font-semibold text-black mt-1">TOTAL REGISTERED STAFFS</p>
      </div>

      <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
          <p class="text-3xl font-bold text-black">{{ $stats['archivedAccounts'] }}</p>
          <p class="text-medium font-semibold text-black mt-1">ARCHIVED ACCOUNTS</p>
      </div>

  </div>


  {{-- Charts Grid --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- CHART 1 --}}
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl text-center font-bold mb-4">POPULATION BY GENDER</h2>
                <div class="relative flex flex-col justify-end" style="height: 450px;">
                    <div class="flex h-full border-b border-gray-300 relative">
                        <div class="flex flex-col justify-between text-right text-xs text-gray-500 pt-1" style="width: 50px;">
                            <span>800</span><span>600</span><span>400</span><span>200</span><span>0</span>
                        </div>
                        <div class="flex-grow flex justify-around items-end pl-2 border-l border-gray-300">
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $populationByGender['female'] }}</span>
                                <div class="bg-[#F9D3DA] w-16 rounded-t-lg" style="height: {{ ($populationByGender['female'] / 800) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $populationByGender['male'] }}</span>
                                <div class="bg-[#A2C4D9] w-16 rounded-t-lg" style="height: {{ ($populationByGender['male'] / 800) * 100 }}%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around mt-2 text-xs font-semibold text-gray-700 text-center">
                        <span class="ml-20">Female</span><span class="mr-5">Male</span>
                    </div>
                    <div class="text-center text-sm font-bold text-gray-700 mt-1">{{ $year }}</div>
                </div>
            </div>


            {{-- CHART 2 --}}
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl text-center font-bold mb-4">TOTAL REQUEST & COMPLAINTS</h2>
                <div class="relative flex flex-col justify-end" style="height: 450px;">
                    @php
                        $maxValue = max($requestsComplaints['documents'], $requestsComplaints['complaints'], 1);
                    @endphp
                    <div class="flex h-full border-b border-gray-300 relative">
                        <div class="flex flex-col justify-between text-right text-xs text-gray-500 pt-1" style="width: 50px;">
                            <span>{{ $maxValue }}</span><span>{{ round($maxValue * 0.8) }}</span><span>{{ round($maxValue * 0.6) }}</span><span>{{ round($maxValue * 0.4) }}</span><span>{{ round($maxValue * 0.2) }}</span><span>0</span>
                        </div>
                        <div class="flex-grow flex justify-around items-end pl-2 border-l border-gray-300">
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $requestsComplaints['documents'] }}</span>
                                <div class="bg-[#FCE6C9] w-16 rounded-t-lg" style="height: {{ $maxValue > 0 ? ($requestsComplaints['documents'] / $maxValue) * 100 : 0 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $requestsComplaints['complaints'] }}</span>
                                <div class="bg-[#C5E3B1] w-16 rounded-t-lg" style="height: {{ $maxValue > 0 ? ($requestsComplaints['complaints'] / $maxValue) * 100 : 0 }}%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around mt-2 text-xs font-semibold text-gray-700 text-center">
                        <span class="ml-10">Document Requests</span><span class="mr-3">Complaints</span>
                    </div>
                    <div class="text-center text-sm font-bold text-gray-700 mt-1">Month of {{ $monthName }}</div>
                </div>
            </div>


            {{-- CHART 3 --}}
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl text-center font-bold mb-4">MOST REQUESTED DOCUMENT</h2>
                <div class="relative flex flex-col justify-end" style="height: 450px;">
                    @php
                        $maxDoc = max(array_values($documentTypes));
                        $maxDoc = $maxDoc > 0 ? $maxDoc : 1;
                    @endphp
                    <div class="flex h-full border-b border-gray-300 relative">
                        <div class="flex flex-col justify-between text-right text-xs text-gray-500 pt-1" style="width: 50px;">
                            <span>{{ $maxDoc }}</span><span>{{ round($maxDoc * 0.75) }}</span><span>{{ round($maxDoc * 0.5) }}</span><span>{{ round($maxDoc * 0.25) }}</span><span>0</span>
                        </div>
                        <div class="flex-grow flex justify-around items-end pl-2 border-l border-gray-300">
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $documentTypes['Barangay Clearance'] }}</span>
                                <div class="bg-[#FFD4CD] w-16 rounded-t-lg" style="height: {{ ($documentTypes['Barangay Clearance'] / $maxDoc) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $documentTypes['Barangay Certificate'] }}</span>
                                <div class="bg-[#BFD7ED] w-20 rounded-t-lg" style="height: {{ ($documentTypes['Barangay Certificate'] / $maxDoc) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $documentTypes['Indigency'] }}</span>
                                <div class="bg-[#BFD7ED] w-20 rounded-t-lg" style="height: {{ ($documentTypes['Indigency'] / $maxDoc) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $documentTypes['Certificate of Residency'] }}</span>
                                <div class="bg-[#BFD7ED] w-20 rounded-t-lg" style="height: {{ ($documentTypes['Certificate of Residency'] / $maxDoc) * 100 }}%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around mt-1 text-xs font-semibold text-gray-700">
                        <span class="ml-15">Barangay <br>Clearance</span>
                        <span>Barangay <br>Certificate</span>
                        <span>Indigency <br>Clearance</span>
                        <span>Resident <br>Certificate</span>
                    </div>
                    <div class="text-center text-sm font-bold text-gray-700 mt-1">Month of {{ $monthName }}</div>
                </div>
            </div>


            {{-- CHART 4 --}}
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl text-center font-bold mb-4">REQUEST STATUS SUMMARY</h2>
                <div class="relative flex flex-col justify-end" style="height: 450px;">
                    @php
                        $maxStatus = max(array_values($requestStatusSummary));
                        $maxStatus = $maxStatus > 0 ? $maxStatus : 1;
                    @endphp
                    <div class="flex h-full border-b border-gray-300 relative">
                        <div class="flex flex-col justify-between text-right text-xs text-gray-500 pt-1" style="width: 50px;">
                            <span>{{ $maxStatus }}</span><span>{{ round($maxStatus * 0.75) }}</span><span>{{ round($maxStatus * 0.5) }}</span><span>{{ round($maxStatus * 0.25) }}</span><span>0</span>
                        </div>
                        <div class="flex-grow flex justify-around items-end pl-2 border-l border-gray-300">
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $requestStatusSummary['pending'] }}</span>
                                <div class="bg-[#E5D3F9] w-16 rounded-t-lg" style="height: {{ ($requestStatusSummary['pending'] / $maxStatus) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $requestStatusSummary['processing'] }}</span>
                                <div class="bg-[#C9E8FF] w-16 rounded-t-lg" style="height: {{ ($requestStatusSummary['processing'] / $maxStatus) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $requestStatusSummary['approved'] }}</span>
                                <div class="bg-[#C9E8FF] w-16 rounded-t-lg" style="height: {{ ($requestStatusSummary['approved'] / $maxStatus) * 100 }}%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around mt-1 text-xs font-semibold text-gray-700">
                        <span class="ml-25">Pending</span><span>In Progress</span><span>Completed</span>
                    </div>
                    <div class="text-center text-sm font-bold text-gray-700 mt-1">Month of {{ $monthName }}</div>
                </div>
            </div>


            {{-- CHART 5 --}}
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl text-center font-bold mb-4">MOST REPORTED COMPLAINTS</h2>
                <div class="relative flex flex-col justify-end" style="height: 450px;">
                    @php
                        $maxComplaint = max(array_values($complaintTypes));
                        $maxComplaint = $maxComplaint > 0 ? $maxComplaint : 1;
                    @endphp
                    <div class="flex h-full border-b border-gray-300 relative">
                        <div class="flex flex-col justify-between text-right text-xs text-gray-500 pt-1" style="width: 50px;">
                            <span>{{ $maxComplaint }}</span><span>{{ round($maxComplaint * 0.75) }}</span><span>{{ round($maxComplaint * 0.5) }}</span><span>{{ round($maxComplaint * 0.25) }}</span><span>0</span>
                        </div>
                        <div class="flex-grow flex justify-around items-end pl-2 border-l border-gray-300">
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $complaintTypes['Noise Disturbances'] }}</span>
                                <div class="bg-[#F9D3DA] w-16 rounded-t-lg" style="height: {{ ($complaintTypes['Noise Disturbances'] / $maxComplaint) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $complaintTypes['Illegal Parking'] }}</span>
                                <div class="bg-[#A2C4D9] w-16 rounded-t-lg" style="height: {{ ($complaintTypes['Illegal Parking'] / $maxComplaint) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $complaintTypes['Improper Garbage Disposal'] }}</span>
                                <div class="bg-[#A2C4D9] w-16 rounded-t-lg" style="height: {{ ($complaintTypes['Improper Garbage Disposal'] / $maxComplaint) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $complaintTypes['Others'] }}</span>
                                <div class="bg-[#A2C4D9] w-16 rounded-t-lg" style="height: {{ ($complaintTypes['Others'] / $maxComplaint) * 100 }}%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around mt-1 text-xs font-semibold text-gray-700">
                        <span>Noise Disturbances</span><span>Illegal Parking</span><span>Improper Garbage</span><span>Others</span>
                    </div>
                    <div class="text-center text-sm font-bold text-gray-700 mt-1">Month of {{ $monthName }}</div>
                </div>
            </div>


            {{-- CHART 6 --}}
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl text-center font-bold mb-4">COMPLAINTS STATUS SUMMARY</h2>
                <div class="relative flex flex-col justify-end" style="height: 450px;">
                    @php
                        $maxComplaintStatus = max(array_values($complaintsStatusSummary));
                        $maxComplaintStatus = $maxComplaintStatus > 0 ? $maxComplaintStatus : 1;
                    @endphp
                    <div class="flex h-full border-b border-gray-300 relative">
                        <div class="flex flex-col justify-between text-right text-xs text-gray-500 pt-1" style="width: 50px;">
                            <span>{{ $maxComplaintStatus }}</span><span>{{ round($maxComplaintStatus * 0.75) }}</span><span>{{ round($maxComplaintStatus * 0.5) }}</span><span>{{ round($maxComplaintStatus * 0.25) }}</span><span>0</span>
                        </div>
                        <div class="flex-grow flex justify-around items-end pl-2 border-l border-gray-300">
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $complaintsStatusSummary['pending'] }}</span>
                                <div class="bg-[#FCE6C9] w-16 rounded-t-lg" style="height: {{ ($complaintsStatusSummary['pending'] / $maxComplaintStatus) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $complaintsStatusSummary['investigating'] }}</span>
                                <div class="bg-[#C5E3B1] w-16 rounded-t-lg" style="height: {{ ($complaintsStatusSummary['investigating'] / $maxComplaintStatus) * 100 }}%;"></div>
                            </div>
                            <div class="flex flex-col items-center h-full justify-end">
                                <span class="text-xs font-bold mb-1">{{ $complaintsStatusSummary['resolved'] }}</span>
                                <div class="bg-[#C5E3B1] w-16 rounded-t-lg" style="height: {{ ($complaintsStatusSummary['resolved'] / $maxComplaintStatus) * 100 }}%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around mt-1 text-xs font-semibold text-gray-700">
                        <span>Open Case</span><span>In Progress</span><span>Case Resolved</span>
                    </div>
                    <div class="text-center text-sm font-bold text-gray-700 mt-1">Month of {{ $monthName }}</div>
                </div>
            </div>
        </div>
        <br><br>
</main>


    <!-- =============================== -->
    <!-- 1. EXPORT SETTINGS MODAL -->
    <!-- =============================== -->
    <div id="exportModal" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black/50 font-poppins">
        <div class="bg-[#F9F5F0]  w-[500px] rounded-3xl overflow-hidden shadow-2xl flex flex-col relative">
           
            <!-- Blue Header -->
            <div class="bg-[#2e5478] flex items-center px-5 py-3">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxqDxTyUPRaADhPEUlOlFYUnvFckf-ruIw5Q&sg" class="w-8 h-8 rounded-full border-2 border-white object-cover mr-3">
                <h1 class="text-white font-sans font-bold text-base">Barangay Daang Bakal</h1>
            </div>


            <!-- Body Content -->
            <div class="p-6">
                <h2 class="text-2xl font-bold text-black mb-1">Export Report</h2>
                <p class="text-gray-500 text-xs mb-4">Select the format and section to include in your export.</p>


                <!-- Dropdowns -->
                <div class="flex gap-3 mb-4">
                    <div class="w-1/2 relative">
                        <select class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 font-medium appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer shadow-sm">
                            <option>2025</option>
                            <option>2024</option>
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <svg class="w-3 h-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <div class="w-1/2 relative">
                        <select class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 font-medium appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer shadow-sm">
                            <option>Month</option>
                            <option>January</option>
                            <option>February</option>
                            <option>October</option>
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <svg class="w-3 h-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>


                <!-- Export Format -->
                <h3 class="text-sm font-bold text-black mb-2">Export Format</h3>
                <div class="space-y-2 mb-4">
                    <label class="flex items-center p-2.5 bg-white rounded-xl shadow-sm border border-transparent hover:border-gray-300 cursor-pointer transition">
                        <div class="w-8 h-8 mr-3 flex-shrink-0">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" fill="#EA4335"/><path d="M14 2V8H20" fill="#E6E6E6"/><text x="6" y="17" fill="white" font-size="6" font-weight="bold">PDF</text></svg>
                        </div>
                        <div>
                            <p class="font-bold text-black text-xs">PDF Document</p>
                            <p class="text-gray-500 text-[10px]">Print friendly Format with chart and tables.</p>
                        </div>
                        <input type="radio" name="format" class="ml-auto w-4 h-4 text-red-600 focus:ring-red-500">
                    </label>
                    <label class="flex items-center p-2.5 bg-white rounded-xl shadow-sm border border-transparent hover:border-gray-300 cursor-pointer transition">
                        <div class="w-8 h-8 mr-3 flex-shrink-0">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" fill="#34A853"/><path d="M14 2V8H20" fill="#E6E6E6"/><path d="M8 12H16M8 16H16M8 8H10" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-black text-xs">Excel Spreadsheet</p>
                            <p class="text-gray-500 text-[10px]">Editable data tables and charts.</p>
                        </div>
                        <input type="radio" name="format" class="ml-auto w-4 h-4 text-green-600 focus:ring-green-500">
                    </label>
                </div>


                <!-- Section to Include -->
                <h3 class="text-sm font-bold text-black mb-2">Section to Include</h3>
                <div class="space-y-2 pl-1 mb-6">
                    <label class="flex items-center cursor-pointer"><input type="checkbox" class="w-4 h-4 bg-gray-300 border-none rounded text-blue-600 focus:ring-0 cursor-pointer"><span class="ml-3 text-xs font-bold text-black uppercase">Population by Gender</span></label>
                    <label class="flex items-center cursor-pointer"><input type="checkbox" class="w-4 h-4 bg-gray-300 border-none rounded text-blue-600 focus:ring-0 cursor-pointer"><span class="ml-3 text-xs font-bold text-black uppercase">Total Request & Complaint</span></label>
                    <label class="flex items-center cursor-pointer"><input type="checkbox" class="w-4 h-4 bg-gray-300 border-none rounded text-blue-600 focus:ring-0 cursor-pointer"><span class="ml-3 text-xs font-bold text-black uppercase">Most Requested Document</span></label>
                    <label class="flex items-center cursor-pointer"><input type="checkbox" class="w-4 h-4 bg-gray-300 border-none rounded text-blue-600 focus:ring-0 cursor-pointer"><span class="ml-3 text-xs font-bold text-black uppercase">Request Status Summary</span></label>
                    <label class="flex items-center cursor-pointer"><input type="checkbox" class="w-4 h-4 bg-gray-300 border-none rounded text-blue-600 focus:ring-0 cursor-pointer"><span class="ml-3 text-xs font-bold text-black uppercase">Most Reported Complaints</span></label>
                    <label class="flex items-center cursor-pointer"><input type="checkbox" class="w-4 h-4 bg-gray-300 border-none rounded text-blue-600 focus:ring-0 cursor-pointer"><span class="ml-3 text-xs font-bold text-black uppercase">Complaint Status Summary</span></label>
                </div>


                <!-- Footer Buttons -->
                <div class="flex justify-end gap-3 mt-4">
                    <button onclick="closeModal('exportModal')" class="bg-[#A2C4D9] hover:bg-gray-400 text-black px-6 py-2 rounded-lg text-xs font-bold shadow-sm transition">CANCEL</button>
                    <!-- Calls submitExport() -->
                    <button onclick="submitExport()" class="bg-[#58A576] hover:bg-[#468c62] text-black px-6 py-2 rounded-lg text-xs font-bold shadow-sm transition">EXPORT</button>
                </div>
            </div>
        </div>
    </div>


    <!-- =============================== -->
    <!-- 2. SUCCESS MODAL (PIXEL PERFECT) -->
    <!-- =============================== -->
    <div id="exportSuccessModal" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black/50 font-poppins">
        <!-- Gray Card Container -->
        <div class="bg-[#E5E5E5] w-[600px] rounded-3xl p-10 shadow-2xl relative border-2 border-black">
           
            <!-- Header Text -->
            <h2 class="text-3xl font-extrabold text-black mb-1">Export Completed</h2>
            <p class="text-gray-600 text-sm font-semibold mb-6">Your report have been successfully generated and downloaded.</p>


            <!-- Cream/Beige Inner Box -->
            <div class="bg-[#F9F5F0] rounded-3xl p-8 mb-8">
                <h3 class="font-extrabold text-black text-lg mb-4">File Details</h3>
               
                <!-- File Details List -->
                <div class="space-y-3 text-sm text-black mb-6 pl-2">
                    <p class="flex items-start"><span class="w-24">File Name:</span> <span>BARIS_Report_2025.pdf</span></p>
                    <p class="flex items-start"><span class="w-24">Format:</span> <span>PDF</span></p>
                    <p class="flex items-start"><span class="w-24">Size:</span> <span>245 KB</span></p>
                    <p class="flex items-start"><span class="w-24">Generated:</span> <span>10/25/2025, 1:12 PM</span></p>
                </div>


                <!-- White Notification Box -->
                <div class="bg-white rounded-lg py-3 text-center shadow-sm">
                    <p class="font-bold text-black text-sm">The file has been downloaded to your default folder.</p>
                </div>
            </div>


            <!-- Done Button -->
            <div class="flex justify-center">
                <button onclick="closeModal('exportSuccessModal')"
                        class="bg-[#58A576] hover:bg-[#468c62] text-black font-extrabold text-sm py-3 px-24 rounded-full shadow-md transition">
                    DONE
                </button>
            </div>
        </div>
    </div>


    <!-- JavaScript to Handle Modals -->

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }


        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }


        // Logic to switch modals
        function submitExport() {
            closeModal('exportModal');       // Close first modal
            openModal('exportSuccessModal'); // Open second modal
        }


        // Close modal if user clicks outside
        window.onclick = function(event) {
            const exportModal = document.getElementById('exportModal');
            const successModal = document.getElementById('exportSuccessModal');
           
            if (event.target == exportModal) {
                closeModal('exportModal');
            }
            if (event.target == successModal) {
                closeModal('exportSuccessModal');
            }
        }
    </script>


@endsection

