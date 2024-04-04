<form id="add_form" class="form" method="POST" action="{{ route('provider.update',$provider->id) }}">
    @method('PUT')
    @csrf
    <div class="scroll-y py-10 px-7 px-lg-10" id="modal_large" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#modal_large_header" data-kt-scroll-wrappers="#modal_large"
        data-kt-scroll-offset="200px">
        <label class="fs-6 fw-semibold mb-4">Image</label>
        <div class="fv-row mb-5">
            <style>
                .image-input-placeholder {
                    background-image: url({{asset('theme/assets/media/svg/avatars/blank.svg')}});
                }

                [data-bs-theme="dark"] .image-input-placeholder {
                    background-image: url({{asset('theme/assets/media/svg/avatars/blank-dark.svg')}});
                }
            </style>
            <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true"
                style="background-image: url({{asset($provider->image)}})">
                <div class="image-input-wrapper w-125px h-125px" style="background-image: none;"></div>
                <label
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                    <input type="hidden" name="avatar_remove" value="1">
                </label>
                <span
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
                <span
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
            </div>
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">Full name</label>
            <input type="text" class="form-control form-control-solid" value="{{ $provider->name }}" placeholder="Enter Full name"
                name="name" />
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">Email</label>
            <input type="text" class="form-control form-control-solid" value="{{ $provider->email }}" placeholder="Enter Email" name="email" />
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">Phone</label>
            <input type="text" class="form-control form-control-solid" value="{{ $provider->phone }}" placeholder="Enter phone number"
                name="phone" />
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">Users</label>
            <select name="users[]" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large" data-control="select2"
                data-close-on-select="true" data-placeholder="Assign Users" data-allow-clear="true" multiple>
                <option></option>
                @foreach ($user as $item)
                    <option value="{{ $item->id }}" {{ in_array($item->id, $providerUser) ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="fv-row mb-5">
            <label class="fs-6 fw-semibold mb-2">Type of Service</label>
            <input type="text" class="form-control form-control-solid kt_tagify_1"
                placeholder="Enter Type of Service" value="{{ $provider->type_of_service }}" name="type_of_service" />
        </div>
    </div>
    <div class="modal-footer flex-center">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
        <button id="submitbutton" type="button" onclick="addUpdateData('add_form','modal_large','yes')" class="btn btn-lg btn-primary">
            <label class="indicator-label">Update</label>
            <label class="indicator-progress">Please wait...
                <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
        </button>
    </div>
</form>
<script>
    KTScroll.createInstances()

    $('.js-example-basic-single').select2();
    KTImageInput.createInstances();
</script>
