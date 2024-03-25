<form id="add_form" class="form" method="POST" action="{{ route('client.store') }}">
    @csrf
    <div class="py-10 px-7 px-lg-10">
        <label class="fs-6 fw-bold mb-4">Picture</label>
        <div class="fv-row mb-5">
            <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true" style="background-image: url({{ asset('theme/assets/media/svg/avatars/blank.svg')}})">
                <!-- <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/svg/avatars/blank.svg)"> -->
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('theme/assets/media/svg/avatars/blank.svg')}})"></div>
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <i class="ki-outline ki-pencil fs-5"></i>
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                </label>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                    <i class="ki-outline ki-cross fs-2"></i>
                </span>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                    <i class="ki-outline ki-cross fs-2"></i>
                </span>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Full Name</label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Full Name" name="name"  />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">Job Title</label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Job Title" name="job_title" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Email</label>
                <input type="eamil" class="required form-control form-control-solid" placeholder="Enter Email" name="email"  />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Phone</label>
                <input type="tel" class="form-control form-control-solid" placeholder="Enter Phone" name="phone"  />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">VAT number</label>
                <input type="tel" class="form-control form-control-solid" placeholder="Enter VAT number" name="vat_number"  />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Contact person name</label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Contact person name" name="contact_person_name"  />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">ID document photo or pdf attachment</label>
                <input type="file" class="form-control form-control-solid" name="document_or_photo"  />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Status</label>
                <select name="status" class="form-select form-select-solid js-example-basic-single" data-control="select2" data-close-on-select="true" data-placeholder="Select Status" data-allow-clear="true" >
                    <option></option>
                    <option value="to be contacted">To be Contacted</option>
                    <option value="contact">Contact</option>
                    <option value="under negotiation">Under Negotiation</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="pending">Pending</option>
                    <option value="not interested">Not Interested</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            @if (Auth::user()->hasRole('admin'))
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">User</label>
                <select name="user[]" class="form-select form-select-solid js-example-basic-single" data-control="select2" data-close-on-select="true" data-placeholder="Select User" data-allow-clear="true" multiple >
                    <option></option>
                    @foreach ($user as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @else
                <input hidden name="user[]" value="{{ Auth::user()->id }}" />
            @endif
            <div class="row">
                    <div class="form-group"  id="repeater">
                        <div class="form-group row g-5 mt-1 repeater-item">
                            <div class="col-12">
                                <div class="separator my-2"></div>
                            </div>
                            <div class="col-6">
                                <label class="required fs-6 fw-bold mb-2">CPE (electricity number)</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter CPE (electricity number)" name="cpe[]"  />
                            </div>
                            <div class="col-6">
                                <label class="required fs-6 fw-bold mb-2">CUI (gas number)</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter CUI (gas number)" name="cui[]"  />
                            </div>
                            <div class="col-6">
                                <label class="required fs-6 fw-bold mb-2">Electricity consumption</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Electricity consumption" name="electricity_consumption[]"  />
                            </div>
                            <div class="col-6">
                                <label class="required fs-6 fw-bold mb-2">Gas consumption</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Gas consumption" name="gas_consumption[]"  />
                            </div>
                            <div class="col-11">
                                <label class="required fs-6 fw-bold mb-2">Address</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Address" name="address[]"  />
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-icon btn-light-danger mt-3 mt-md-8"  data-repeater-delete>
                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-5">
                        <button type="button" id="addButton" class="btn btn-light-primary">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Add
                        </button>
                    </div>
            </div>
        </div>
    </div>
    <div class="modal-footer flex-center">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
        <button id="submitbutton" type="button" onclick="addUpdateData('add_form','modal_large','yes')" class="btn btn-lg btn-primary">
            <label class="indicator-label">Submit</label>
            <label class="indicator-progress">Please wait...
                <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
        </button>
    </div>
</form>
<script>
     $(document).ready(function() {
    $('#repeater').repeater({
        isFirstItemUndeletable: true,
        show: function() {
            $(this).slideDown();
        },
        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

    $('#addButton').click(function() {
        var $lastItem = $('#repeater .repeater-item:last');
        var $clone = $lastItem.clone();
        
        // Clear input values in the cloned item
        $clone.find('input[type="text"]').val('');

        // Insert the cloned item after the last item
        $clone.insertAfter($lastItem);
    });

    $(document).on('click', '[data-repeater-delete]', function() {
        $(this).parents('.repeater-item').remove();
    });
});

    KTImageInput.createInstances();

    $('.js-example-basic-single').select2();
</script>