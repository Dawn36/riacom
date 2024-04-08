<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
<form class="form w-100" novalidate="novalidate" method="POST" action="{{ route('login') }}">
    @csrf
    <!--begin::Heading-->
    <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-gray-900 fw-bolder mb-3">{{ __('login.Sign In') }}</h1>
        <!--end::Title-->
    </div>
    <!--begin::Heading-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="{{ __('login.Email') }}" name="email" value="{{ old('email') }}" autocomplete="off" class="form-control bg-transparent" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <!--end::Email-->
    </div>
    <!--end::Input group=-->
    <div class="fv-row mb-3">
        <!--begin::Password-->
        <input type="password" placeholder="{{ __('login.Password') }}" name="password" autocomplete="off" class="form-control bg-transparent" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
        <!--end::Password-->
    </div>
    <!--end::Input group=-->
    <!--begin::Wrapper-->
    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
        <div></div>
        <!--begin::Link-->
        <a href="{{ route('password.request') }}" class="link-primary">{{ __('login.Forgot Password ?') }}</a>
        <!--end::Link-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Submit button-->
    <div class="d-grid mb-10">
        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">{{ __('login.Sign In') }}</button>
    </div>
    <!--end::Submit button-->
</form>
</x-guest-layout>
