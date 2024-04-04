<form id="add_form" class="form" method="POST" action="{{ route('client.update', $client->id) }}">
    @method('PUT')
    @csrf
    <div class="scroll-y py-10 px-7 px-lg-10" id="modal_large" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#modal_large_header" data-kt-scroll-wrappers="#modal_large"
        data-kt-scroll-offset="200px">
        <label class="fs-6 fw-bold mb-4">Picture</label>
        <div class="fv-row mb-5">
            <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true"
                style="background-image: url({{ asset($client->image) }})">
                <!-- <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/svg/avatars/blank.svg)"> -->
                <div class="image-input-wrapper w-125px h-125px"
                    style="background-image: url({{ asset($client->image) }})"></div>
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <i class="ki-outline ki-pencil fs-5"></i>
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                </label>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                    <i class="ki-outline ki-cross fs-2"></i>
                </span>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                    <i class="ki-outline ki-cross fs-2"></i>
                </span>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Full Name</label>
                <input type="text" class="form-control form-control-solid" value="{{ $client->name }}"
                    placeholder="Enter Full Name" name="name" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">Job Title</label>
                <input type="text" class="form-control form-control-solid" value="{{ $client->job_title }}"
                    placeholder="Enter Job Title" name="job_title" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Email</label>
                <input type="eamil" class="required form-control form-control-solid" value="{{ $client->email }}"
                    placeholder="Enter Email" name="email" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Phone</label>
                <input type="tel" class="form-control form-control-solid" placeholder="Enter Phone" name="phone"
                    value="{{ $client->phone }}" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">VAT number</label>
                <input type="tel" class="form-control form-control-solid" placeholder="Enter VAT number"
                    name="vat_number" value="{{ $client->vat_number }}" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Contact person name</label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Contact person name"
                    name="contact_person_name" value="{{ $client->contact_person_name }}" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">ID document photo or pdf attachment</label>
                <input type="file" class="form-control form-control-solid" name="document_or_photo" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Status</label>
                <select name="status" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large" data-control="select2"
                    data-close-on-select="true" data-placeholder="Select Status" data-allow-clear="true">
                    <option></option>
                    <option value="to be contacted" {{ $client->status == 'to be contacted' ? 'selected' : '' }}>To be
                        Contacted</option>
                    <option value="contact" {{ $client->status == 'contact' ? 'selected' : '' }}>Contact</option>
                    <option value="under negotiation" {{ $client->status == 'under negotiation' ? 'selected' : '' }}>
                        Under Negotiation</option>
                    <option value="active" {{ $client->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $client->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="pending" {{ $client->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="not interested" {{ $client->status == 'not interested' ? 'selected' : '' }}>Not
                        Interested</option>
                    <option value="rejected" {{ $client->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">User</label>
                <select name="user[]" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select User"
                    data-allow-clear="true" multiple>
                    <option></option>
                    @foreach ($user as $item)
                        <option value="{{ $item->id }}" {{ in_array($item->id, $clientUser) ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @php
                $cpe=explode('||||', $client->cpe);
                $cui=explode('||||', $client->cui);
                $electricityConsumption=explode('||||', $client->electricity_consumption);
                $gasConsumption=explode('||||', $client->gas_consumption);
                $address=explode('||||', $client->address);
            @endphp
            <div class="row">
                <div class="form-group" id="repeater">
                    <div class="form-group row g-5 mt-1 repeater-item">
                        <div class="col-12">
                            <div class="separator my-2"></div>
                        </div>
                        <div class="col-6">
                            <label class="required fs-6 fw-bold mb-2">CPE (electricity number)</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter CPE (electricity number)" name="cpe[]" value="{{ @$cpe[0] }}" />
                        </div>
                        <div class="col-6">
                            <label class="required fs-6 fw-bold mb-2">CUI (gas number)</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter CUI (gas number)" name="cui[]" value="{{ @$cui[0] }}" />
                        </div>
                        <div class="col-6">
                            <label class="required fs-6 fw-bold mb-2">Electricity consumption</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter Electricity consumption" name="electricity_consumption[]" value="{{ @$electricityConsumption[0] }}" />
                        </div>
                        <div class="col-6">
                            <label class="required fs-6 fw-bold mb-2">Gas consumption</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter Gas consumption" name="gas_consumption[]" value="{{ @$gasConsumption[0] }}" />
                        </div>
                        <div class="col-11">
                            <label class="required fs-6 fw-bold mb-2">Address</label>
                            <input type="text" class="form-control form-control-solid" value="{{ @$address[0] }}" placeholder="Enter Address"
                                name="address[]" />
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-icon btn-light-danger mt-3 mt-md-8"
                                data-repeater-delete>
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                        class="path2"></span><span class="path3"></span><span
                                        class="path4"></span><span class="path5"></span></i>
                            </button>
                        </div>
                    </div>
                    @for($i=1; $i < count($cpe); $i++)
                    <div class="form-group row g-5 mt-1 repeater-item">
                        <div class="col-12">
                            <div class="separator my-2"></div>
                        </div>
                        <div class="col-6">
                            <label class="required fs-6 fw-bold mb-2">CPE (electricity number)</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter CPE (electricity number)" name="cpe[]" value="{{ @$cpe[$i] }}" />
                        </div>
                        <div class="col-6">
                            <label class="required fs-6 fw-bold mb-2">CUI (gas number)</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter CUI (gas number)" name="cui[]" value="{{ @$cui[$i] }}" />
                        </div>
                        <div class="col-6">
                            <label class="required fs-6 fw-bold mb-2">Electricity consumption</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter Electricity consumption" name="electricity_consumption[]" value="{{ @$electricityConsumption[$i] }}" />
                        </div>
                        <div class="col-6">
                            <label class="required fs-6 fw-bold mb-2">Gas consumption</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter Gas consumption" name="gas_consumption[]" value="{{ @$gasConsumption[$i] }}" />
                        </div>
                        <div class="col-11">
                            <label class="required fs-6 fw-bold mb-2">Address</label>
                            <input type="text" class="form-control form-control-solid" value="{{ @$address[$i] }}" placeholder="Enter Address"
                                name="address[]" />
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-icon btn-light-danger mt-3 mt-md-8"
                                data-repeater-delete>
                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                        class="path2"></span><span class="path3"></span><span
                                        class="path4"></span><span class="path5"></span></i>
                            </button>
                        </div>
                    </div>
                    @endfor
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
        <button id="submitbutton" type="button" onclick="addUpdateData('add_form','modal_large','yes')"
            class="btn btn-lg btn-primary">
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
    KTScroll.createInstances()

    $('.js-example-basic-single').select2();
</script>
