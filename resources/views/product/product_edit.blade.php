<form id="add_form" class="form" method="POST" action="{{ route('product.update',$product->id) }}">
    @method('PUT')
    @csrf
    <div class="py-10 px-7 px-lg-10">
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">Name</label>
                <input type="text" class="form-control form-control-solid" value="{{ $product->name }}" placeholder="Enter Name" name="name" />
            </div>
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