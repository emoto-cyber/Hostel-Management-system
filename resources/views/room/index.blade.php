@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

      {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Rooms Management</h2>

        <div class="flex items-center space-x-3">
            <a href="{{ route('room.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                + Add Room
            </a>
            <a href="{{ route('room.occupied') }}"
               class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Occupied
            </a>
            <a href="{{ route('room.available') }}"
               class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                Available
            </a>

               <a href="{{ route('room.index') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                All
            </a>
        </div>
    </div>




    {{-- DASHBOARD CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Rooms -->
        <div class="bg-white shadow rounded-lg p-6 flex items-center space-x-4">
            <div class="p-3 bg-indigo-100 rounded-full">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-4m0 0l7-4 7 4m-7 4v10m0-10L3 8m18 4v10l-9 5-9-5v-10"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Rooms</p>
                <p class="text-2xl font-bold text-gray-800">{{ $rooms->count() }}</p>
            </div>
        </div>
 <!-- Available Rooms -->
        <div class="bg-white shadow rounded-lg p-6 flex items-center space-x-4">
            <div class="p-3 bg-green-100 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Available Rooms</p>
                <p class="text-2xl font-bold text-green-600">{{ $availableRooms ?? 0 }}</p>
            </div>
        </div>

        <!-- Occupied Rooms -->
        <div class="bg-white shadow rounded-lg p-6 flex items-center space-x-4">
            <div class="p-3 bg-red-100 rounded-full">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.856-1.487M7 20H2v-2a3 3 0 015.856-1.487M13 16a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 14a4 4 0 00-8 0"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Occupied Rooms</p>
                <p class="text-2xl font-bold text-red-600">{{ $totalOccupied ?? 0 }}</p>
            </div>
        </div>

   <!-- Total Capacity -->
        <div class="bg-white shadow rounded-lg p-6 flex items-center space-x-4">
            <div class="p-3 bg-yellow-100 rounded-full">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Capacity</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalCapacity ?? 0 }}</p>
            </div>
        </div>
    </div>

     {{-- Search Section --}}
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('room.index') }}" class="flex flex-wrap gap-4 items-center">

            {{-- Search Records --}}
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search hostel"
                   class="border rounded-md px-3 py-2 w-64 focus:ring focus:ring-indigo-200">

            {{-- Search Month --}}
            <input type="month"
                   name="month"
                   value="{{ request('month') }}"
                   class="border rounded-md px-3 py-2 focus:ring focus:ring-indigo-200">

            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Search
            </button>

            <a href="{{ route('room.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Reset
            </a>

        </form>
    </div>


    {{-- Table --}}
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm">#</th>
                    <th class="px-6 py-3 text-left text-sm">Hostel</th>
                    <th class="px-6 py-3 text-left text-sm">Room Number</th>
                    <th class="px-6 py-3 text-left text-sm">Capacity</th>
                    <th class="px-6 py-3 text-left text-sm">Price</th>
                    <th class="px-6 py-3 text-left text-sm">Room Type</th>
                    <th class="px-6 py-3 text-left text-sm">Status</th>
                    <th class="px-6 py-3 text-left text-sm">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($rooms as $room)
                    <tr>
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $room->hostel->name ?? "N/A" }}</td>
                        <td class="px-6 py-4">{{ $room->room_number }}</td>
                        <td class="px-6 py-4">{{ $room->capacity }}</td>
                        <td class="px-6 py-4">{{ $room->price }}</td>
                        {{-- <td class="px-6 py-4">{{ $room->room_type }}</td> --}}

                              <td class="px-6 py-4">
                            <span
                                class="badge room-status text-white px-2 py-1 rounded bg-{{ $room->room_color }}"
                                data-room-id="{{ $room->id }}"
                                data-room-type="{{ strtolower($room->room_type ?? '') }}">
                                {{ ucfirst(strtolower($room->room_type ?? '')) }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="badge room-status text-white px-2 py-1 rounded bg-{{ $room->status_color }}"
                                data-room-id="{{ $room->id }}"
                                data-status="{{ strtolower($room->status ?? '') }}">
                                {{ ucfirst(strtolower($room->status ?? '')) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 space-x-2 whitespace-nowrap">
                            <button type="button"
                                    class="js-toggle-status inline-block text-sm px-2 py-1 rounded text-white"
                                    data-room-id="{{ $room->id }}"
                                    data-status="{{ strtolower($room->status ?? '') }}">
                                {{ strtolower($room->status ?? '') === 'occupied' ? 'Mark Available' : 'Mark Occupied' }}
                            </button>

                            <a href="{{ route('room.edit', $room->id) }}" class="text-indigo-600 hover:underline">Book Now</a>

                            <form action="{{ route('room.destroy', $room->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this room?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">No rooms found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const colorMap = { occupied: 'red-600', vacant: 'green-600', available: 'indigo-600' };

    document.querySelectorAll('.js-toggle-status').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.roomId;
            const oldStatus = (btn.dataset.status || '').toLowerCase();

            btn.disabled = true;
            try {
                const res = await fetch(`/room/${id}/toggle`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                });

                if (!res.ok) throw new Error('Network response was not ok');

                const json = await res.json();
                const newStatus = (json.status || '').toLowerCase();

                // update button dataset and label
                btn.dataset.status = newStatus;
                btn.textContent = newStatus === 'occupied' ? ' Available' : ' Occupied';

                // update status span
                const span = document.querySelector(`.room-status[data-room-id="${id}"]`);
                if (span) {
                    span.dataset.status = newStatus;
                    span.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                    span.className = 'badge room-status text-white px-2 py-1 rounded bg-' + (colorMap[newStatus] || 'gray-400');
                }
            } catch (err) {
                console.error(err);
                alert('Failed to toggle room status.');
            } finally {
                btn.disabled = false;
            }
        });
    });
});
</script>
@endsection
