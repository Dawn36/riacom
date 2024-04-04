<form id="add_form" class="form" method="POST" action="{{ route('lead.store') }}">
    @csrf
    <div class="scroll-y py-10 px-7 px-lg-10" id="modal_large" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#modal_large_header" data-kt-scroll-wrappers="#modal_large"
        data-kt-scroll-offset="200px">
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">Name</label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Name" name="name" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">Email</label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Email" name="email" />
            </div>
            <div class="col-12">
                <label class="fs-6 fw-semibold mb-2">Message</label>
                <textarea name="message" class="form-control form-control-solid" cols="30" rows="5"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">Type of Service</label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Type of Service" name="type_of_service" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Status</label>
                <select name="status" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="Select Status" data-allow-clear="true" required>
                    <option></option>
                    <option value="lead">Lead</option>
                    <option value="client">Client</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">District</label>
                <select name="district" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="Select District" data-allow-clear="true" required>
                    <option></option>
                    <option value="Aveiro">Aveiro</option>
                    <option value="Beja">Beja</option>
                    <option value="Braga">Braga</option>
                    <option value="Bragança">Bragança</option>
                    <option value="Castelo Branco">Castelo Branco</option>
                    <option value="Coimbra">Coimbra</option>
                    <option value="Évora">Évora</option>
                    <option value="Faro">Faro</option>
                    <option value="Guarda">Guarda</option>
                    <option value="Leiria">Leiria</option>
                    <option value="Lisboa">Lisboa</option>
                    <option value="Portalegre">Portalegre</option>
                    <option value="Porto">Porto</option>
                    <option value="Região Autónoma dos Açores">Região Autónoma dos Açores</option>
                    <option value="Região Autónoma da Madeira">Região Autónoma da Madeira</option>
                    <option value="Santarém">Santarém</option>
                    <option value="Setúbal">Setúbal</option>
                    <option value="Viana do Castelo">Viana do Castelo</option>
                    <option value="Vila Real">Vila Real</option>
                    <option value="Viseu">Viseu</option>
                </select>
            </div>
            @if(Auth::user()->hasRole('admin'))
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">User</label>
                <select name="user" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="Select User" data-allow-clear="true" required>
                    <option></option>
                    @foreach ($user as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @else
            <input hidden name="user" value="{{Auth::user()->id}}"/>
            @endif
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
    KTScroll.createInstances()

    $('.js-example-basic-single').select2();
</script>