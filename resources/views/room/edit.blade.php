@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">

    {{-- Page Header --}}
    <div class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Room
        </h2>
    </div>

    {{-- Form Card --}}
    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{ route('room.update', $room->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Hostel --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">
                    Hostel
                </label>
                <select name="hostel_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @foreach ($hostels as $hostel)
                        <option value="{{ $hostel->id }}"
                            {{ $room->hostel_id == $hostel->id ? 'selected' : '' }}>
                            {{ $hostel->name }}
                        </option>
                    @endforeach
                </select>
                @error('hostel_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Room Number --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">
                    Room Number
                </label>
                <input type="text"
                       name="room_number"
                       value="{{ old('room_number', $room->room_number) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                       required>
                @error('room_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Capacity --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">
                    Capacity
                </label>
                <input type="number"
                       name="capacity"
                       value="{{ old('capacity', $room->capacity) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                       required>
                @error('capacity')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Price --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">
                    Price
                </label>
                <input type="number"
                       name="price"
                       value="{{ old('price', $room->price) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                       required>
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Room Type --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">
                    Room Type
                </label>
                <select name="room_type"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <option value="Single" {{ $room->room_type == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Double" {{ $room->room_type == 'Double' ? 'selected' : '' }}>Double</option>
                    <option value="Self Contained" {{ $room->room_type == 'Self Contained' ? 'selected' : '' }}>
                        Self Contained
                    </option>
                </select>
                @error('room_type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">
                    Status
                </label>
                <select name="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <option value="Available" {{ $room->status == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Occupied" {{ $room->status == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('room.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                    Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Confirm Booking
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
