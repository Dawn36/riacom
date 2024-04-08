<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="form w-100" novalidate="novalidate" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">{{ __('login.Forgot Password ?') }}</h1>
            <!--end::Title-->
            <!--begin::Link-->
            <div class="text-gray-500 fw-semibold fs-6">{{ __('login.Enter your email to reset your password') }}.
            </div>
            <!--end::Link-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group=-->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="{{ __('login.Email') }}" name="email" autocomplete="off" value="{{ old('email') }}" class="form-control bg-transparent" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <!--end::Email-->
        </div>
        <!--begin::Actions-->
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit"  class="btn btn-primary me-4">{{ __('login.Submit') }}</button>
            <a href="{{ route('login') }}" class="btn btn-light">{{ __('login.Cancel') }}</a>
        </div>
        <!--end::Actions-->
    </form>
</x-guest-layout>
