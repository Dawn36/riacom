<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('error')" />

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ __('admin.Account Settings') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="dashboard" class="text-muted text-hover-primary">{{ __('admin.Home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('admin.Account') }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('admin.Profile Details') }}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="" class="form" action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('admin.Avatar') }}</label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url('{{ asset($data['profile_picture'])}}')">
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url({{ asset($data['profile_picture'])}})"></div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="{{ __('admin.Change avatar') }}">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <input type="file" name="profile_picture" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="{{ __('admin.Cancel avatar') }}">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="{{ __('admin.Remove avatar') }}">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                        </div>
                                        <div class="form-text">{{ __('admin.Allowed file types: png, jpg, jpeg') }}.</div>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('admin.Full Name') }}</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="name"
                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                    placeholder="{{ __('admin.Please enter the Full Name') }}" value="{{$data['name']}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">{{ __('admin.Phone') }}</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="{{ __('admin.Phone number must be active') }}"></i>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="tel" name="phone_number"
                                            class="form-control form-control-lg form-control-solid kt_inputmask_2"
                                            placeholder="{{ __('admin.Please enter the Phone Number') }}" value="{{$data['phone_number']}}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="">{{ __('admin.Address') }}</span>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="address"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="{{ __('admin.Please enter the Address') }}" value="{{$data['address']}}" />
                                    </div>
                                </div>
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2">{{ __('admin.Discard') }}</button>
                                <button type="submit" class="btn btn-primary"
                                    >{{ __('admin.Save Changes') }}</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
                <!--begin::Sign-in Method-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('admin.Sign-in Method') }}</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Email Address-->
                            <div class="d-flex flex-wrap align-items-center">
                                <!--begin::Label-->
                                <div id="kt_signin_email">
                                    <div class="fs-6 fw-bold mb-1">{{ __('admin.Email Address') }}</div>
                                    <div class="fw-semibold text-gray-600">{{ $data['email'] }}</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Edit-->
                                <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                    <!--begin::Form-->
                                    <form id="" action="{{ route('updateEmail', ['id' => $data['id']]) }}" method="POST" class="form" novalidate="novalidate">
                                        @csrf
                                        <div class="row mb-6">
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <label for="emailaddress"
                                                        class="form-label fs-6 fw-bold mb-3">{{ __('admin.Enter New Email Address') }}</label>
                                                    <input type="email"
                                                        class="form-control form-control-lg form-control-solid"
                                                        id="emailaddress" placeholder="{{ __('admin.Email Address') }}"
                                                        name="email" value="{{ $data['email'] }}" />
                                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="fv-row mb-0">
                                                    <label for="confirmemailpassword"
                                                        class="form-label fs-6 fw-bold mb-3">{{ __('admin.Confirm Password') }}</label>
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="confirmemailpassword" id="confirmemailpassword" />
                                                        <x-input-error :messages="$errors->get('confirmemailpassword')" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button id="kt_signin_submit" type="submit"
                                                class="btn btn-primary me-2 px-6">{{ __('admin.Update Email') }}</button>
                                            <button id="kt_signin_cancel" type="button"
                                                class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('admin.Cancel') }}</button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Edit-->
                                <!--begin::Action-->
                                <div id="kt_signin_email_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary">{{ __('admin.Change Email') }}</button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Email Address-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-6"></div>
                            <!--end::Separator-->
                            <!--begin::Password-->
                            <div class="d-flex flex-wrap align-items-center mb-10">
                                <!--begin::Label-->
                                <div id="kt_signin_password">
                                    <div class="fs-6 fw-bold mb-1">{{ __('admin.Password') }}</div>
                                    <div class="fw-semibold text-gray-600">************</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Edit-->
                                <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                    <!--begin::Form-->
                                    <form id="" class="form" novalidate="novalidate" method="Post" action="{{ route('updatePassword', ['id' => $data['id']]) }}">
                                        @csrf
                                        <div class="row mb-1">
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="old_password"
                                                        class="form-label fs-6 fw-bold mb-3">{{ __('admin.Current Password') }}</label>
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="old_password" id="old_password" />
                                                        <x-input-error :messages="$errors->get('old_password')" class="mt-2" />

                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="password" class="form-label fs-6 fw-bold mb-3">{{ __('admin.New Password') }}</label>
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="password" id="password" />
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="password_confirmation"
                                                        class="form-label fs-6 fw-bold mb-3">{{ __('admin.Confirm New Password') }}</label>
                                                    <input type="password"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="password_confirmation" id="password_confirmation" />
                                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-text mb-5">{{ __('admin.Password must be at least 8 character and contain symbols') }}</div>
                                        <div class="d-flex">
                                            <button id="kt_password_submit" type="submit"
                                                class="btn btn-primary me-2 px-6">{{ __('admin.Update Password') }}</button>
                                            <button id="kt_password_cancel" type="button"
                                                class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('admin.Cancel') }}</button>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Edit-->
                                <!--begin::Action-->
                                <div id="kt_signin_password_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary">{{ __('admin.Reset Password') }}</button>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Password-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Content-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <script>
        Inputmask({
            "mask": "(999) 999-9999"
        }).mask(".kt_inputmask_2");
    </script>
</x-app-layout>
<script src="{{ asset('theme/assets/js/custom/account/settings/signin-methods.js')}}"></script>
