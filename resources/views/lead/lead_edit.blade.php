<form id="add_form" class="form" method="POST" action="{{ route('lead.update',$lead->id) }}">
    @method('PUT')
    @csrf
    <div class="py-10 px-7 px-lg-10">
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">Name</label>
                <input type="text" class="form-control form-control-solid" value="{{ $lead->name }}" placeholder="Enter Name" name="name" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">Email</label>
                <input type="text" class="form-control form-control-solid" value="{{ $lead->email }}" placeholder="Enter Email" name="email" />
            </div>
            <div class="col-12">
                <label class="fs-6 fw-semibold mb-2">Message</label>
                <textarea name="message" class="form-control form-control-solid" cols="30" rows="5">{{ $lead->message }}</textarea>
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">Type of Service</label>
                <input type="text" class="form-control form-control-solid" value="{{ $lead->type_of_service }}" placeholder="Enter Type of Service" name="type_of_service" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Status</label>
                <select name="status" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="Select Status" data-allow-clear="true" required>
                    <option></option>
                    <option value="lead" {{ $lead->status == 'lead' ? 'selected' : '' }}>Lead</option>
                    <option value="client" {{ $lead->status == 'client' ? 'selected' : '' }}>Client</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">District</label>
                <select name="district" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="Select District" data-allow-clear="true" required>
                    <option></option>
                    <option value="Aveiro" {{ $lead->district == 'Aveiro' ? 'Selected' : '' }}>Aveiro</option>
                    <option value="Beja" {{ $lead->district == 'Beja' ? 'Selected' : '' }}>Beja</option>
                    <option value="Braga" {{ $lead->district == 'Braga' ? 'Selected' : '' }}>Braga</option>
                    <option value="Bragança" {{ $lead->district == 'Bragança' ? 'Selected' : '' }}>Bragança</option>
                    <option value="Castelo Branco" {{ $lead->district == 'Castelo Branco' ? 'Selected' : '' }}>Castelo Branco</option>
                    <option value="Coimbra" {{ $lead->district == 'Coimbra' ? 'Selected' : '' }}>Coimbra</option>
                    <option value="Évora" {{ $lead->district == 'Évora' ? 'Selected' : '' }}>Évora</option>
                    <option value="Faro" {{ $lead->district == 'Faro' ? 'Selected' : '' }}>Faro</option>
                    <option value="Guarda" {{ $lead->district == 'Guarda' ? 'Selected' : '' }}>Guarda</option>
                    <option value="Leiria" {{ $lead->district == 'Leiria' ? 'Selected' : '' }}>Leiria</option>
                    <option value="Lisboa" {{ $lead->district == 'Lisboa' ? 'Selected' : '' }}>Lisboa</option>
                    <option value="Portalegre" {{ $lead->district == 'Portalegre' ? 'Selected' : '' }}>Portalegre</option>
                    <option value="Porto" {{ $lead->district == 'Porto' ? 'Selected' : '' }}>Porto</option>
                    <option value="Região Autónoma dos Açores" {{ $lead->district == 'Região Autónoma dos Açores' ? 'Selected' : '' }}>Região Autónoma dos Açores</option>
                    <option value="Região Autónoma da Madeira" {{ $lead->district == 'Região Autónoma da Madeira' ? 'Selected' : '' }}>Região Autónoma da Madeira</option>
                    <option value="Santarém" {{ $lead->district == 'Santarém' ? 'Selected' : '' }}>Santarém</option>
                    <option value="Setúbal" {{ $lead->district == 'Setúbal' ? 'Selected' : '' }}>Setúbal</option>
                    <option value="Viana do Castelo" {{ $lead->district == 'Viana do Castelo' ? 'Selected' : '' }}>Viana do Castelo</option>
                    <option value="Vila Real" {{ $lead->district == 'Vila Real' ? 'Selected' : '' }}>Vila Real</option>
                    <option value="Viseu" {{ $lead->district == 'Viseu' ? 'Selected' : '' }}>Viseu</option>
                </select>
            </div>
            @if(Auth::user()->hasRole('admin'))
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">User</label>
                <select name="user" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="Select User" data-allow-clear="true" required>
                    <option></option>
                    @foreach ($user as $item)
                        <option value="{{ $item->id }}" {{ $lead->user_id == $item->id ? 'Selected' : '' }}>{{ $item->name }}</option>
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
            <label class="indicator-label">Update</label>
            <label class="indicator-progress">Please wait...
                <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
        </button>
    </div>
</form>
<script>
    $('.js-example-basic-single').select2();
</script>