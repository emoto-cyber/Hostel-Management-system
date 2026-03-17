<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

           <!-- Admission Number -->
        <div>
            <x-input-label for="adm_no" :value="__('Admission Number/id')" />
            <x-text-input id="adm_no" class="block mt-1 w-full" type="text" name="adm_no" :value="old('adm_no')" required autofocus autocomplete="adm_no" />
            <x-input-error :messages="$errors->get('adm_no')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
<!-- Contact -->
<div>
    <x-input-label for="contact" :value="__('Contact')" />
    <x-text-input
        id="contact"
        class="block mt-1 w-full"
        type="text"
        name="contact"
        value="{{ old('contact', '+254') }}"
        required
        autofocus
        autocomplete="contact"
    />
    <x-input-error :messages="$errors->get('contact')" class="mt-2" />
</div>


        <!-- Course -->
        <div>
            <x-input-label for="course" :value="__('Course')" />
            <x-text-input id="course" class="block mt-1 w-full" type="text" name="course" :value="old('course')" required autofocus autocomplete="course" />
            <x-input-error :messages="$errors->get('course')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
