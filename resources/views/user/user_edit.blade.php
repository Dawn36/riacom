<form id="add_form" class="form" method="POST" action="{{ route('user.update',$user->id) }}">
    @method('PUT')
    @csrf
    <div class="py-10 px-7 px-lg-10">
        <label class="fs-6 fw-semibold mb-4">{{ __('admin.Image') }}</label>
        <div class="fv-row mb-5">
            <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true"
                style="background-image: url({{ asset($user->profile_picture)}})">
                <div class="image-input-wrapper w-125px h-125px" style="background-image: none;"></div>
                <label
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    aria-label="Change avatar" data-bs-original-title="{{ __('admin.Change avatar') }}" data-kt-initialized="1">
                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                    <input type="hidden" name="avatar_remove" value="1">
                </label>
                <span
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    aria-label="Cancel avatar" data-bs-original-title="{{ __('admin.Cancel avatar') }}" data-kt-initialized="1">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
                <span
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    aria-label="Remove avatar" data-bs-original-title="{{ __('admin.Remove avatar') }}" data-kt-initialized="1">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
            </div>
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">{{ __('admin.Full name') }}</label>
            <input type="text" value="{{ $user->name }}" class="form-control form-control-solid" placeholder="{{ __('admin.Enter Full name') }}"
                name="name" />
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">{{ __('admin.Email') }}</label>
            <input type="text" value="{{ $user->email }}" class="form-control form-control-solid" placeholder="{{ __('admin.Enter Email') }}" name="email" />
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">{{ __('admin.Phone') }}</label>
            <input type="text" class="form-control form-control-solid kt_inputmask_2" placeholder="{{ __('admin.Enter phone number') }}"
                name="phone_number" value="{{ $user->phone_number }}" />
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">{{ __('admin.Password') }}</label>
            <input type="password" class="form-control form-control-solid" placeholder="{{ __('admin.Enter password number') }}"
                name="password" />
        </div>
    </div>
    <div class="modal-footer flex-center">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('admin.Cancel') }}</button>
        <button id="submitbutton" type="button" onclick="addUpdateData('add_form','modal_large','yes')" class="btn btn-lg btn-primary">
            <label class="indicator-label">{{ __('admin.Submit') }}</label>
            <label class="indicator-progress">{{ __('admin.Please wait...') }}
                <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
        </button>
    </div>
</form>
<script>
    Inputmask({
        "mask": "(999) 999-9999"
    }).mask(".kt_inputmask_2");
    KTImageInput.createInstances();
</script>
