@extends('superadmin.layouts.app')

@section('content')

<main class="fflex-1 p-11 fixed top-[60px] left-[220px] 
    w-[calc(100vw-200px)] h-[calc(100vh-60px)] 
    overflow-hidden bg-gray-100" > 
  <h1 class="text-3xl font-bold mb-8">DASHBOARD</h1>

  <!-- CARDS -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
      <p class="text-3xl font-bold text-black">{{ $stats['totalUsers'] }}</p>
      <p class="text-medium font-semibold text-black mt-1">TOTAL USER</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
      <p class="text-3xl font-bold text-black">{{ $stats['totalRequests'] }}</p>
      <p class="text-medium font-semibold text-black mt-1">TOTAL REQUEST</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
      <p class="text-3xl font-bold text-black">{{ $stats['totalComplaints'] }}</p>
      <p class="text-medium font-semibold text-black mt-1">TOTAL COMPLAINTS</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
      <p class="text-3xl font-bold text-black">{{ $stats['totalCompleted'] }}</p>
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
        <input type="text" placeholder="Search..." class="w-96 h-8 border border-gray-300 rounded-lg pl-10 pr-2 text-sm focus:outline-none" />
      </div>

      <div class="flex gap-2 w-fit">
        <select class="h-8 px-3 text-sm focus:outline-none">
          <option>TYPE</option>
          <option>Document Request</option>
          <option>Complaints</option>
        </select>
        <select class="h-8 px-3 text-sm focus:outline-none">
          <option>STATUS</option>
          <option>Pending</option>
          <option>In Progress</option>
          <option>Completed</option>
        </select>
      </div>
    </div>
  </div>

  <div class="bg-white shadow-md rounded-lg overflow-hidden">
  <table class="table table-zebra w-full text-md">
    <thead style="background-color: #134573; color: white;">
      <tr class="text-sm whitespace-nowrap text-center">
        <th class="py-2 px-4 border-b border-gray-200">TRANSACTION NO.</th>
        <th class="py-2 px-4 border-b border-gray-200">LAST NAME</th>
        <th class="py-2 px-4 border-b border-gray-200">FIRST NAME</th>
        <th class="py-2 px-4 border-b border-gray-200">SERVICE TYPE</th>
        <th class="py-2 px-4 border-b border-gray-200">DESCRIPTION</th>
        <th class="py-2 px-4 border-b border-gray-200">DATE FILED</th>
        <th class="py-2 px-4 border-b border-gray-200">DATE COMPLETED</th>
        <th class="py-2 px-4 border-b border-gray-200">STATUS</th>
      </tr>
    </thead>
    <tbody>
      @forelse($allRecords as $record)
        @php
          $nameParts = explode(' ', $record['name'], 2);
          $lastName = $nameParts[0] ?? '';
          $firstName = $nameParts[1] ?? '';
          
          // Determine status badge colors
          $statusClass = '';
          $statusText = ucfirst($record['status']);
          
          if ($record['type'] == 'Document Request') {
            if ($record['status'] == 'pending') {
              $statusClass = 'bg-orange-200 text-orange-800';
            } elseif ($record['status'] == 'processing') {
              $statusClass = 'bg-yellow-200 text-yellow-800';
              $statusText = 'In Progress';
            } elseif ($record['status'] == 'approved') {
              $statusClass = 'bg-green-200 text-green-800';
              $statusText = 'Completed';
            } elseif ($record['status'] == 'rejected') {
              $statusClass = 'bg-red-200 text-red-800';
            }
          } else { // Complaint
            if ($record['status'] == 'pending') {
              $statusClass = 'bg-orange-200 text-orange-800';
            } elseif ($record['status'] == 'investigating') {
              $statusClass = 'bg-yellow-200 text-yellow-800';
              $statusText = 'In Progress';
            } elseif ($record['status'] == 'resolved') {
              $statusClass = 'bg-green-200 text-green-800';
              $statusText = 'Completed';
            } elseif ($record['status'] == 'dismissed') {
              $statusClass = 'bg-red-200 text-red-800';
            }
          }
        @endphp
        <tr class="text-[0.80rem] whitespace-nowrap">
          <td class="py-2 px-4 text-center border-b border-gray-200">{{ $record['transaction_id'] }}</td>
          <td class="py-2 px-4 text-center border-b border-gray-200">{{ $lastName }}</td>
          <td class="py-2 px-4 text-center border-b border-gray-200">{{ $firstName }}</td>
          <td class="py-2 px-4 text-center border-b border-gray-200">{{ $record['type'] }}</td>
          <td class="py-2 px-4 text-center border-b border-gray-200">{{ $record['description'] }}</td>
          <td class="py-2 px-4 text-center border-b border-gray-200">{{ $record['date_filed']->format('d/m/Y') }}</td>
          <td class="py-2 px-4 text-center border-b border-gray-200">{{ $record['date_completed'] ? $record['date_completed']->format('d/m/Y') : '--/--/----' }}</td>
          <td class="py-2 px-4 text-center border-b border-gray-200">
            <span class="{{ $statusClass }} text-xs font-semibold px-3 py-1 rounded-full w-20 h-6 inline-flex items-center justify-center">{{ $statusText }}</span>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" class="px-4 py-8 text-center text-gray-500">No records found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
</main>


@endsection
