<x-guest-layout>
    <form class="form w-100" novalidate="novalidate" method="POST" action="{{ route('password.store') }}">
        @csrf
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">{{ __('login.Reset Password ?') }}</h1>
            <!--end::Title-->
            <!--begin::Link-->
            {{-- <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.
            </div> --}}
            <!--end::Link-->
        </div>

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <input type="text" placeholder="{{ __('login.Email') }}" name="email" autocomplete="off" value="{{ old('email', $request->email) }}" class="form-control bg-transparent" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <input type="password" placeholder="{{ __('login.Password') }}" name="password" autocomplete="off" class="form-control bg-transparent" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 mb-4">
            <input type="password" placeholder="{{ __('login.password confirmation') }}" name="password_confirmation" autocomplete="off" class="form-control bg-transparent" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
        </div>

        <div class="d-grid mb-10">
            <button type="submit"  class="btn btn-primary">{{ __('Reset Password') }}</button>
        </div>
    </form>
</x-guest-layout>

