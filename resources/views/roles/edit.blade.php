@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit Role
        </h2>
        <p class="text-sm text-gray-500">
            Update role details and permissions
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <form method="POST" action="{{ route('roles.update', $role->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Role Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Role Name
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $role->name) }}"
                    class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Permissions -->
            <div>
                <p class="text-sm font-medium text-gray-700 mb-3">
                    Permissions
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($permissions as $permission)
                        <label class="flex items-center space-x-2 text-sm text-gray-700">
                            <input
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->name }}"
                                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"

                                {{
                                    in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray()))
                                    ? 'checked' : ''
                                }}
                            >
                            <span>{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</span>
                        </label>
                    @endforeach
                </div>

                @error('permissions')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-white font-medium hover:bg-indigo-700 focus:outline-none"
                >
                    Update Role
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
