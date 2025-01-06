<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Complaints List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-0">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('complaints.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create New Complaint
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-800">
                                <th class="px-6 py-3 border border-gray-200 text-left">#</th>
                                <th class="px-6 py-3 border border-gray-200 text-left">Complainer</th>
                                <th class="px-6 py-3 border border-gray-200 text-left">Contact Number</th>
                                <th class="px-6 py-3 border border-gray-200 text-left">Email</th>
                                <th class="px-6 py-3 border border-gray-200 text-left">System</th>
                                <th class="px-6 py-3 border border-gray-200 text-left">Details</th>
                                <th class="px-6 py-3 border border-gray-200 text-left">Status</th>
                                <th class="px-6 py-3 border border-gray-200 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($complaints as $index => $complaint)
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
                                    <td class="px-6 py-3 border 
                                        @if($complaint->status == 'pending') bg-red-200 text-red-800 
                                        @elseif($complaint->status == 'in_progress') bg-yellow-200 text-yellow-800 
                                        @elseif($complaint->status == 'resolved') bg-green-200 text-green-800 
                                        @endif">
                                        {{ ucfirst($complaint->status) }}
                                    </td>
                                    <td class="px-6 py-3 border text-center">
                                        <!-- Edit Button with Icon -->
                                        <a href="{{ route('complaints.edit', $complaint) }}" class="text-yellow-500 hover:text-yellow-600 text-xl">
                                            <i class="fas fa-edit"></i> <!-- Edit icon -->
                                        </a>

                                        <!-- Delete Button with Icon -->
                                        <form action="{{ route('complaints.destroy', $complaint) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600 text-xl" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash-alt"></i> <!-- Trash icon -->
                                            </button>
                                        </form>
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
            </div>
        </div>
    </div>
</x-app-layout>
