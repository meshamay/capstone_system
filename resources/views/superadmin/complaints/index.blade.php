@extends('superadmin.layouts.app')

@section('content')

<main class="fflex-1 p-11 fixed top-[60px] left-[220px] 
    w-[calc(100vw-200px)] h-[calc(100vh-60px)] 
    overflow-hidden bg-gray-100"> 
  <h1 class="text-3xl font-bold mb-6">COMPLAINTS</h1>

  <!-- CARDS -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $complaints->count() }}</p>
        <p class="text-medium font-semibold text-black mt-1">TOTAL REQUEST</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $complaints->where('status', 'pending')->count() }}</p>
        <p class="text-medium font-semibold text-black mt-1">PENDING</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $complaints->where('status', 'investigating')->count() }}</p>
        <p class="text-medium font-semibold text-black mt-1">IN PROGRESS</p>
    </div>

    <div class="p-4 rounded-lg shadow-md" style="background-color: #EBF0F4;">
        <p class="text-3xl font-bold text-black">{{ $complaints->where('status', 'resolved')->count() }}</p>
        <p class="text-medium font-semibold text-black mt-1">COMPLETED</p>
    </div>
  </div>

  <!-- Success Message -->
  @if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
  </div>
  @endif

  <!-- TABLE-->
  <div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="table table-zebra w-full text-md">
      <thead style="background-color: #134573; color: white;">
        <tr class="text-sm whitespace-nowrap">
          <th class="py-1.5 px-4">TRANSACTION ID</th>
          <th class="py-1.5 px-4">LAST NAME</th>
          <th class="py-1.5 px-4">FIRST NAME</th>
          <th class="py-1.5 px-4">COMPLAINT TYPE</th>
          <th class="py-1.5 px-4">DATE FILED</th>
          <th class="py-1.5 px-4">DATE COMPLETED</th>
          <th class="py-1.5 px-4">STATUS</th>
          <th class="py-1.5 px-4">ACTION</th>
        </tr>
      </thead>
      <tbody>
        @forelse($complaints as $complaint)
        @php
          $nameParts = explode(' ', $complaint->complainant_name, 2);
          $lastName = $nameParts[0] ?? '';
          $firstName = $nameParts[1] ?? '';
        @endphp
        <tr class="text-sm whitespace-nowrap">
          <td class="py-1.5 px-4 text-center border-b border-gray-200">CMP-{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</td>
          <td class="py-1.5 px-4 text-center border-b border-gray-200">{{ $lastName }}</td>
          <td class="py-1.5 px-4 text-center border-b border-gray-200">{{ $firstName }}</td>
          <td class="py-1.5 px-4 text-center border-b border-gray-200">{{ $complaint->complaint_type }}</td>
          <td class="py-1.5 px-4 text-center border-b border-gray-200">{{ $complaint->created_at->format('d/m/Y') }}</td>
          <td class="py-1.5 px-4 text-center border-b border-gray-200">{{ $complaint->status == 'resolved' && $complaint->updated_at ? $complaint->updated_at->format('d/m/Y') : '-' }}</td>
          <td class="py-1.5 px-4 text-center border-b border-gray-200">
            <span class="text-xs font-semibold px-3 py-1 rounded-full w-24 h-6 inline-flex items-center justify-center
              @if($complaint->status == 'pending') bg-orange-200 text-orange-800
              @elseif($complaint->status == 'investigating') bg-blue-200 text-blue-800
              @elseif($complaint->status == 'resolved') bg-green-200 text-green-800
              @elseif($complaint->status == 'dismissed') bg-red-200 text-red-800
              @endif">
              {{ ucfirst($complaint->status) }}
            </span>
          </td>
          <td class="py-1.5 px-4 border-b border-gray-200">
            <div class="flex justify-start items-center space-x-2">
              <!-- View -->
              <div class="relative group">
                <button onclick="openViewModal({{ $complaint->id }})" class="w-8 h-8 flex items-center justify-center rounded hover:bg-blue-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-blue-600">
                    <path d="M12 5C6 5 2 12 2 12s4 7 10 7 10-7 10-7-4-7-10-7z"/>
                    <circle cx="12" cy="12" r="4" fill="white"/>
                    <circle cx="12" cy="12" r="2" fill="#1d72f1ff"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">View</span>
              </div>

              <!-- In Progress -->
              <div class="relative group">
                <button onclick="openStatusModal({{ $complaint->id }}, 'investigating')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-yellow-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-7 h-7 text-yellow-500">
                    <path d="M6 2h12v2l-4 5 4 5v2H6v-2l4-5-4-5V2zm2 2v1.382l2.618 3.272L8 11.618V13h8v-1.382l-2.618-3.272L16 5.382V4H8z"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">In progress</span>
              </div>

              <!-- Complete -->
              <div class="relative group">
                <button onclick="openStatusModal({{ $complaint->id }}, 'resolved')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-green-100 transition">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 fill-green-600">
                    <path d="M9 16.2l-3.5-3.5-1.4 1.4L9 19 20 8l-1.4-1.4z"/>
                  </svg>
                </button>
                <span class="absolute bottom-full mb-1 left-1/2 transform -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Complete</span>
              </div>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="px-4 py-8 text-center text-gray-500">No complaints found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Status Update Modal -->
  <div id="statusModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white w-[450px] rounded-lg shadow-xl p-6">
      <h2 class="text-xl font-bold mb-4">Update Complaint Status</h2>
      <form id="statusForm" method="POST" action="">
        @csrf
        <input type="hidden" name="status" id="modalStatus">
        
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes (Optional)</label>
          <textarea name="admin_notes" rows="4" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <div class="flex justify-end gap-3">
          <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</button>
          <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Update Status</button>
        </div>
      </form>
    </div>
  </div>

  <!-- View Modal -->
  <div id="viewModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white w-[600px] rounded-lg shadow-xl p-6 max-h-[80vh] overflow-y-auto">
      <h2 class="text-xl font-bold mb-4">Complaint Details</h2>
      <div id="modalContent"></div>
      <div class="flex justify-end mt-6">
        <button onclick="closeViewModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
      </div>
    </div>
  </div>

</main>

<script>
function openStatusModal(complaintId, status) {
  document.getElementById('statusModal').classList.remove('hidden');
  document.getElementById('modalStatus').value = status;
  document.getElementById('statusForm').action = '/superadmin/complaints/' + complaintId + '/update-status';
}

function closeStatusModal() {
  document.getElementById('statusModal').classList.add('hidden');
}

function openViewModal(complaintId) {
  const complaint = @json($complaints);
  const item = complaint.find(c => c.id === complaintId);
  
  if (item) {
    const content = `
      <div class="space-y-3">
        <div><strong>Transaction ID:</strong> CMP-${String(item.id).padStart(5, '0')}</div>
        <div><strong>Complainant:</strong> ${item.complainant_name}</div>
        <div><strong>Email:</strong> ${item.complainant_email || 'N/A'}</div>
        <div><strong>Phone:</strong> ${item.complainant_phone || 'N/A'}</div>
        <div><strong>Complaint Type:</strong> ${item.complaint_type}</div>
        <div><strong>Respondent:</strong> ${item.respondent_name || 'N/A'}</div>
        <div><strong>Details:</strong> ${item.complaint_details}</div>
        <div><strong>Date Filed:</strong> ${new Date(item.created_at).toLocaleDateString()}</div>
        <div><strong>Status:</strong> <span class="capitalize">${item.status}</span></div>
        ${item.admin_notes ? `<div><strong>Admin Notes:</strong> ${item.admin_notes}</div>` : ''}
      </div>
    `;
    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('viewModal').classList.remove('hidden');
  }
}

function closeViewModal() {
  document.getElementById('viewModal').classList.add('hidden');
}
</script>

@endsection

