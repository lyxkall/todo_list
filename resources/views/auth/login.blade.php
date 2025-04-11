<x-guest-layout>
    {{-- <div class="w-full max-w-md mx-auto mt-16 p-8 bg-white rounded-lg shadow-md"> --}}
        {{-- <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md"> --}}
            <div class="flex justify-center mb-6">
                {{-- <img src="https://laravel.com/img/logomark.min.svg" class="h-12" alt="Laravel Logo"> --}}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Register -->
                @if (Route::has('register'))
                    <div class="mb-4 text-sm">
                        <a class="text-indigo-600 hover:underline" href="{{ route('register') }}">
                            {{ __('Don\'t have an account yet?') }}
                        </a>
                    </div>
                @endif

                <!-- Submit -->
                <div>
                    <x-primary-button class="w-full justify-center">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
