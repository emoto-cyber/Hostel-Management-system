@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">
            Edit User
        </h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update',$user->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name"
                        value="{{ old('name', $user->name) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Admission Number --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Admission No</label>
                    <input type="text" name="adm_no"
                        value="{{ old('adm_no', $user->adm_no) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Contact --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact</label>
                    <input type="text" name="contact"
                        value="{{ old('contact', $user->contact) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Course --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Course</label>
                    <input type="text" name="course"
                        value="{{ old('course', $user->course) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $user->email) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Password (Leave blank to keep current)
                    </label>
                    <input type="password" name="password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Role --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- Buttons --}}
            <div class="mt-6 flex justify-end">
                <a href="{{ route('users.index') }}"
                   class="mr-3 px-4 py-2 bg-gray-500 text-white rounded-md">
                    Cancel
                </a>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection