@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            Create Permission
        </h2>
        <p class="text-sm text-gray-500">
            Define a new permission for roles
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <form method="POST" action="{{ route('permissions.store') }}" class="space-y-5">
            @csrf

            <!-- Permission Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Permission Name
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. manage hostels"
                    class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >
                <p class="text-xs text-gray-500 mt-1">
                    Use lowercase words separated by spaces
                </p>

                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-white font-medium hover:bg-indigo-700"
                >
                    Create Permission
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
