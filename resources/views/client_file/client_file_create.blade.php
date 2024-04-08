<form id="add_form" class="form" method="POST" action="{{ route('client-file.store') }}">
    @csrf
    <input hidden name="client_id" value="{{$clientId}}" hidden />
    <div class="py-10 px-7 px-lg-10">
        <div class="row g-5">
            <div class="col-12">
                <label class="required fs-6 fw-bold mb-2">{{ __('client.Attach File') }}</label>
                <input type="file" name="file" class="form-control form-control-solid">
            </div>
        </div>
    </div>
    <div class="modal-footer flex-center">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('client.Cancel') }}</button>
        <button id="submitbutton" type="button" onclick="addUpdateData('add_form','modal_large','yes')" class="btn btn-lg btn-primary">
            <label class="indicator-label">{{ __('client.Submit') }}</label>
            <label class="indicator-progress">{{ __('client.Please wait...') }}
                <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
        </button>
    </div>
</form>