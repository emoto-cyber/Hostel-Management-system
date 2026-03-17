@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            Create User
        </h2>
        <p class="text-sm text-gray-500">
            Add a new user and assign a role
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <form method="POST" action="{{ route('users.store') }}" class="space-y-5">
            @csrf
             <!-- addmission -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Admission Number
                </label>
                <input
                    type="text"
                    name="adm_no"
                    value="{{ old('adm_no') }}"
                    class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="eg. ABC/1234/56"
                >
                @error('adm_no')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Full Name
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="John Doe"
                >
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

                  <!-- Contact -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Contact
                </label>
                <input
                    type="text"
                    name="contact"
                    {{-- value="{{ old('contact') }}" --}}
                    class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="John Doe"
                      value="{{ old('contact', '+254') }}"
    required
    onfocus="if(this.value === '') this.value='+254';"
    oninput="
        if(!this.value.startsWith('+254')) {
            this.value = '+254';
        }
                >
                @error('contact')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

                  <!-- Course -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Course
                </label>
                <input
                    type="text"
                    name="course"
                    value="{{ old('course') }}"
                    class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="eg. Bachelor of Science in Computer Science"
                >
                @error('course')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Email Address
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="user@example.com"
                >
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="********"
                >
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Role
                </label>
                <select
                    name="role"
                    class="mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Select role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ old('role') === $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-white font-medium hover:bg-indigo-700 focus:outline-none"
                >
                    Create User
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
