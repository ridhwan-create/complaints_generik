<x-public-layout>
    <x-slot name="title">Complaint List</x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8 space-y-0"> <!-- Ubah max-w-7xl kepada w-full -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <!-- Paparkan mesej error jika ada -->
                @if(session('error'))
                    <div class="alert alert-danger bg-red-500 text-white px-4 py-2 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                
                <!-- Title for the complaint list -->
                <h2 class="text-2xl font-semibold mb-4">Complaints Submitted</h2>

                <!-- Check if no complaints exist -->
                @if($complaints->isEmpty())
                    <p class="text-gray-500">No complaints found.</p>
                @else

                    <!-- Tabel Senarai Aduan -->
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border border-gray-200"> <!-- Tambahkan w-full di sini -->
                            <thead>
                                <tr class="bg-gray-100 text-gray-800">
                                    <th class="px-6 py-3 border border-gray-200 text-left">#</th>
                                    <th class="px-6 py-3 border border-gray-200 text-left">Complainer</th>
                                    <th class="px-6 py-3 border border-gray-200 text-left">Contact Number</th>
                                    <th class="px-6 py-3 border border-gray-200 text-left">Email</th>
                                    <th class="px-6 py-3 border border-gray-200 text-left">System</th>
                                    <th class="px-6 py-3 border border-gray-200 text-left">Details</th>
                                    <th class="px-6 py-3 border border-gray-200 text-left">Response</th>
                                    <th class="px-6 py-3 border border-gray-200 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse  ($complaints as $index => $complaint)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-3 border">{{ $index + 1 }}</td>
                                    <td class="px-6 py-3 border">{{ $complaint->complainer }}</td>
                                    <td class="px-6 py-3 border">{{ $complaint->contact_number }}</td>
                                    <td class="px-6 py-3 border">{{ $complaint->email }}</td>
                                    <td class="px-6 py-3 border">{{ $complaint->system }}</td>
                                    <td class="px-6 py-3 border">
                                        <div class="relative">
                                            <span class="block overflow-hidden text-ellipsis max-w-full" title="{{ $complaint->details }}">
                                                {{ Str::limit($complaint->details, 100) }}
                                            </span>
                                            <span class="absolute top-0 left-0 w-full h-full bg-gray-800 bg-opacity-75 text-white text-sm p-2 opacity-0 hover:opacity-100 transition-opacity duration-300 overflow-auto hidden" style="max-height: 200px; overflow-y: auto;">
                                                {{ $complaint->details }}
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-3 border">{{ $complaint->response ?? 'No response yet' }}</td>
                                    <td class="px-6 py-3 border 
                                        @if($complaint->status == 'pending') bg-red-200 text-red-800 
                                        @elseif($complaint->status == 'in_progress') bg-yellow-200 text-yellow-800 
                                        @elseif($complaint->status == 'resolved') bg-green-200 text-green-800 
                                        @endif">
                                        {{ ucfirst($complaint->status) }}
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-3 border text-center text-gray-500">
                                            No complaints found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-public-layout>
