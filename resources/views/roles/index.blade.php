@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Roles Management
            </h2>
            <p class="text-sm text-gray-500">
                View and manage system roles
            </p>
        </div>

        <a href="{{ route('roles.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
            + Create Role
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Roles Table -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">

            <!-- Table Head -->
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        #
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Role Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Permissions
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                        Actions
                    </th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($roles as $index => $role)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            {{ ucfirst($role->name) }}
                        </td>

                        <!-- Permissions -->
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <div class="flex flex-wrap gap-2">
                                @foreach($role->permissions as $permission)
                                    <span class="px-2 py-1 bg-gray-100 rounded text-xs">
                                        {{ str_replace('_', ' ', $permission->name) }}
                                    </span>
                                @endforeach
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <a href="{{ route('roles.edit', $role->id) }}"
                               class="text-indigo-600 hover:text-indigo-900">
                                Edit
                            </a>

                            <form action="{{ route('roles.destroy', $role->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Delete this role?')">
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
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            No roles found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection
