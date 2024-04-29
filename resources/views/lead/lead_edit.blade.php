<form id="add_form" class="form" method="POST" action="{{ route('lead.update',$lead->id) }}">
    @method('PUT')
    @csrf
    <div class="scroll-y py-10 px-7 px-lg-10" id="modal_large" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#modal_large_header" data-kt-scroll-wrappers="#modal_large"
        data-kt-scroll-offset="200px">
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">{{ __('lead.Name') }}</label>
                <input type="text" class="form-control form-control-solid" value="{{ $lead->name }}" placeholder="{{ __('lead.Enter Name') }}" name="name" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">{{ __('lead.Email') }}</label>
                <input type="text" class="form-control form-control-solid" value="{{ $lead->email }}" placeholder="{{ __('lead.Enter Email') }}" name="email" />
            </div>
            <div class="col-12">
                <label class="fs-6 fw-semibold mb-2">{{ __('lead.Message') }}</label>
                <textarea name="message" class="form-control form-control-solid" cols="30" rows="5">{{ $lead->message }}</textarea>
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">{{ __('lead.Type of Service') }}</label>
                <input type="text" class="form-control form-control-solid" value="{{ $lead->type_of_service }}" placeholder="{{ __('lead.Enter Type of Service') }}" name="type_of_service" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('lead.Status') }}</label>
                <select name="status" class="form-select form-select-solid " data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="{{ __('lead.Select Status') }}" data-allow-clear="true" required>
                    <option>{{ __('lead.Select Status') }}</option>
                    <option value="lead" {{ $lead->status == 'lead' ? 'selected' : '' }}>{{ __('lead.Lead') }}</option>
                    <option value="client" {{ $lead->status == 'client' ? 'selected' : '' }}>{{ __('lead.Client') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('lead.District') }}</label>
                <select name="district" class="form-select form-select-solid " data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="{{ __('lead.Select District') }}" data-allow-clear="true" required>
                    <option>{{ __('lead.Select District') }}</option>
                    <option value="Aveiro" {{ $lead->district == 'Aveiro' ? 'Selected' : '' }}>{{ __('lead.Aveiro') }}</option>
                    <option value="Beja" {{ $lead->district == 'Beja' ? 'Selected' : '' }}>{{ __('lead.Beja') }}</option>
                    <option value="Braga" {{ $lead->district == 'Braga' ? 'Selected' : '' }}>{{ __('lead.Braga') }}</option>
                    <option value="Bragança" {{ $lead->district == 'Bragança' ? 'Selected' : '' }}>{{ __('lead.Bragança') }}</option>
                    <option value="Castelo Branco" {{ $lead->district == 'Castelo Branco' ? 'Selected' : '' }}>{{ __('lead.Castelo Branco') }}</option>
                    <option value="Coimbra" {{ $lead->district == 'Coimbra' ? 'Selected' : '' }}>{{ __('lead.Coimbra') }}</option>
                    <option value="Évora" {{ $lead->district == 'Évora' ? 'Selected' : '' }}>{{ __('lead.Évora') }}</option>
                    <option value="Faro" {{ $lead->district == 'Faro' ? 'Selected' : '' }}>{{ __('lead.Faro') }}</option>
                    <option value="Guarda" {{ $lead->district == 'Guarda' ? 'Selected' : '' }}>{{ __('lead.Guarda') }}</option>
                    <option value="Leiria" {{ $lead->district == 'Leiria' ? 'Selected' : '' }}>{{ __('lead.Leiria') }}</option>
                    <option value="Lisboa" {{ $lead->district == 'Lisboa' ? 'Selected' : '' }}>{{ __('lead.Lisboa') }}</option>
                    <option value="Portalegre" {{ $lead->district == 'Portalegre' ? 'Selected' : '' }}>{{ __('lead.Portalegre') }}</option>
                    <option value="Porto" {{ $lead->district == 'Porto' ? 'Selected' : '' }}>{{ __('lead.Porto') }}</option>
                    <option value="Região Autónoma dos Açores" {{ $lead->district == 'Região Autónoma dos Açores' ? 'Selected' : '' }}>{{ __('lead.Região Autónoma dos Açores') }}</option>
                    <option value="Região Autónoma da Madeira" {{ $lead->district == 'Região Autónoma da Madeira' ? 'Selected' : '' }}>{{ __('lead.Região Autónoma da Madeira') }}</option>
                    <option value="Santarém" {{ $lead->district == 'Santarém' ? 'Selected' : '' }}>{{ __('lead.Santarém') }}</option>
                    <option value="Setúbal" {{ $lead->district == 'Setúbal' ? 'Selected' : '' }}>{{ __('lead.Setúbal') }}</option>
                    <option value="Viana do Castelo" {{ $lead->district == 'Viana do Castelo' ? 'Selected' : '' }}>{{ __('lead.Viana do Castelo') }}</option>
                    <option value="Vila Real" {{ $lead->district == 'Vila Real' ? 'Selected' : '' }}>{{ __('lead.Vila Real') }}</option>
                    <option value="Viseu" {{ $lead->district == 'Viseu' ? 'Selected' : '' }}>{{ __('lead.Viseu') }}</option>
                </select>
            </div>
            @if(Auth::user()->hasRole('admin'))
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('lead.User') }}</label>
                <select name="user" class="form-select form-select-solid" data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="{{ __('lead.Select User') }}" data-allow-clear="true" required>
                    <option>{{ __('lead.Select User') }}</option>
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
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('lead.Cancel') }}</button>
        <button id="submitbutton" type="button" onclick="addUpdateData('add_form','modal_large','yes')" class="btn btn-lg btn-primary">
            <label class="indicator-label">{{ __('lead.Submit') }}</label>
            <label class="indicator-progress">{{ __('lead.Please wait...') }}
                <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
        </button>
    </div>
</form>
<script>
    KTScroll.createInstances()

</script>