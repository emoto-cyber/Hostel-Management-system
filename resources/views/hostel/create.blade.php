@extends('layouts.app')

@section('header')
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Hostel
        </h2>
    </div>
</header>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

    <div class="bg-white shadow rounded-lg p-6">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('hostel.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Hostel Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Hostel Name
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                </div>

                {{-- Location --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Location
                    </label>
                    <input type="text"
                           name="location"
                           value="{{ old('location') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                </div>

                {{-- Capacity --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Capacity
                    </label>
                    <input type="number"
                           name="capacity"
                           value="{{ old('capacity') }}"
                           min="1"
                           class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                </div>

                {{-- Manager Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Manager Name
                    </label>
                    <input type="text"
                           name="manager_name"
                           value="{{ old('manager_name') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                </div>

                {{-- Contact Number --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Contact Number
                    </label>
                    <input type="text"
                           name="contact_number"
                           value="{{ old('contact_number') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           required>
                </div>

            </div>

            {{-- Actions --}}
            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('hostel.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Save Hostel
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
