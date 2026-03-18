@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

    {{-- Page Header --}}
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Hostels</h2>

            {{-- Breadcrumbs --}}
            <nav class="text-sm text-gray-500 mt-1">
                <ol class="flex space-x-2">
                    <li>
                        <a href="{{ url('/') }}" class="hover:text-indigo-600">Home</a>
                    </li>
                    <li>/</li>
                    <li class="text-gray-700 font-medium">Hostels</li>
                </ol>
            </nav>
        </div>

        <div class="flex space-x-3">
            <a href="{{ route('hostel.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                + Add Hostel
            </a>

            <a href="{{ route('hostel.all') }}"
               class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                All Hostels
            </a>
        </div>
    </div>



    {{-- Statistic Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

        <div class="bg-white shadow rounded-lg p-5">
            <p class="text-gray-500 text-sm">Total Hostels</p>
            <p class="text-2xl font-bold text-indigo-600">{{ $data['totalhostels'] ?? 0 }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-5">
            <p class="text-gray-500 text-sm">Total Rooms</p>
            <p class="text-2xl font-bold text-green-600">{{ $data['totalcapacity'] ?? 0 }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-5">
            <p class="text-gray-500 text-sm">Occupied Rooms</p>
            <p class="text-2xl font-bold text-red-600">{{ $occupiedRooms ?? 0 }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-5">
            <p class="text-gray-500 text-sm">Vacant Rooms</p>
            <p class="text-2xl font-bold text-yellow-500">{{ $vacantRooms ?? 0 }}</p>
        </div>

    </div>

    {{-- Search Section --}}
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('hostel.index') }}" class="flex flex-wrap gap-4 items-center">

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

            <a href="{{ route('hostel.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Reset
            </a>

        </form>
    </div>



    {{-- Table --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">

        <div class="px-6 py-3 border-b flex justify-between items-center">
            <h3 class="font-semibold text-gray-700">Hostels List</h3>
            <span class="text-sm text-gray-500">
                Total: {{ $hostels->count() }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">#</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Hostel</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Owner</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Location</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Total Rooms</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Available For Booking</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Manager</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Contact</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse ($hostels as $hostel)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium">{{ $hostel->name }}</td>
                        <td class="px-6 py-4">{{ $hostel->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $hostel->location }}</td>
                        <td class="px-6 py-4">{{ $hostel->capacity }}</td>
                        <td class="px-6 py-4">{{ $hostel->remaining_capacity }}</td>
                        <td class="px-6 py-4">{{ $hostel->manager_name }}</td>
                        <td class="px-6 py-4">{{ $hostel->contact_number }}</td>

                        <td class="px-6 py-4 flex space-x-3">

                            {{-- <a href="{{ route('hostel.edit', $hostel->id) }}"
                               class="text-indigo-600 hover:text-indigo-800">
                                Edit
                            </a> --}}

                            <form action="{{ route('hostel.destroy', $hostel->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this hostel?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-600 hover:text-red-800">
                                    Delete
                                </button>
                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="9" class="text-center py-6 text-gray-500">
                            No hostels found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>
@endsection
