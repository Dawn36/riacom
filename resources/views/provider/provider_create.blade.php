<form id="add_form" class="form" method="POST" action="{{ route('provider.store') }}">
    @csrf
    <div class="scroll-y py-10 px-7 px-lg-10" id="modal_large" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#modal_large_header" data-kt-scroll-wrappers="#modal_large"
        data-kt-scroll-offset="200px">
        <label class="fs-6 fw-semibold mb-4">{{ __('provider.Image') }}</label>
        <div class="fv-row mb-5">
            <style>
                .image-input-placeholder {
                    background-image: url({{ asset('theme/assets/media/svg/avatars/blank.svg') }});
                }

                [data-bs-theme="dark"] .image-input-placeholder {
                    background-image: url({{ asset('theme/assets/media/svg/avatars/blank-dark.svg') }});
                }
            </style>
            <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true"
                style="background-image: url({{ asset('theme/assets/media/svg/avatars/blank.svg') }})">
                <div class="image-input-wrapper w-125px h-125px" style="background-image: none;"></div>
                <label
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    aria-label="Change avatar" data-bs-original-title="{{ __('provider.Change avatar') }}" data-kt-initialized="1">
                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                    <input type="hidden" name="avatar_remove" value="1">
                </label>
                <span
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    aria-label="Cancel avatar" data-bs-original-title="{{ __('provider.Cancel avatar') }}" data-kt-initialized="1">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
                <span
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    aria-label="Remove avatar" data-bs-original-title="{{ __('provider.Remove avatar') }}" data-kt-initialized="1">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
            </div>
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">{{ __('provider.Full name') }}</label>
            <input type="text" class="form-control form-control-solid" placeholder="{{ __('provider.Enter Full name') }}"
                name="name" />
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">{{ __('provider.Email') }}</label>
            <input type="text" class="form-control form-control-solid" placeholder="{{ __('provider.Enter Email') }}" name="email" />
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">{{ __('provider.Phone') }}</label>
            <input type="text" class="form-control form-control-solid" placeholder="{{ __('provider.Enter phone number') }}"
                name="phone" />
        </div>
        @if (Auth::user()->hasRole('admin'))
            <div class="fv-row mb-5">
                <label class="fs-6 fw-semibold mb-2">{{ __('provider.Users') }}</label>
                <select name="users[]" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('provider.Assign Users') }}"
                    data-allow-clear="true" multiple>
                    <option></option>
                    @foreach ($user as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <input hidden name="users[]" value="{{ Auth::user()->id }}" />
        @endif
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">{{ __('provider.Type of Service') }}</label>
            <input type="text" class="form-control form-control-solid kt_tagify_1"
                placeholder="{{ __('provider.Enter Type of Service') }}" name="type_of_service" />
        </div>
    </div>
    <div class="modal-footer flex-center">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('provider.Cancel') }}</button>
        <button id="submitbutton" type="button" onclick="addUpdateData('add_form','modal_large','yes')"
            class="btn btn-lg btn-primary">
            <label class="indicator-label">{{ __('provider.Submit') }}</label>
            <label class="indicator-progress">{{ __('provider.Please wait...') }}
                <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
        </button>
    </div>
</form>
<script>
     var input1 = document.querySelector(".kt_tagify_1");
    new Tagify(input1, {});
    
    KTScroll.createInstances()

    $('.js-example-basic-single').select2();
    KTImageInput.createInstances();
</script>
