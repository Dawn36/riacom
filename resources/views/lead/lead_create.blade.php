<form id="add_form" class="form" method="POST" action="{{ route('lead.store') }}">
    @csrf
    <div class="scroll-y py-10 px-7 px-lg-10" id="modal_large" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#modal_large_header" data-kt-scroll-wrappers="#modal_large"
        data-kt-scroll-offset="200px">
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">{{ __('lead.Name') }}</label>
                <input type="text" class="form-control form-control-solid" placeholder="{{ __('lead.Enter Name') }}" name="name" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">{{ __('lead.Email') }}</label>
                <input type="text" class="form-control form-control-solid" placeholder="{{ __('lead.Enter Email') }}" name="email" />
            </div>
            <div class="col-12">
                <label class="fs-6 fw-semibold mb-2">{{ __('lead.Message') }}</label>
                <textarea name="message" class="form-control form-control-solid" cols="30" rows="5"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-semibold mb-2">{{ __('lead.Type of Service') }}</label>
                <input type="text" class="form-control form-control-solid" placeholder="{{ __('lead.Enter Type of Service') }}" name="type_of_service" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('lead.Status') }}</label>
                <select name="status" class="form-select form-select-solid" data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="{{ __('lead.Select Status') }}" data-allow-clear="true" required>
                    <option>{{ __('lead.Select Status') }}</option>
                    <option value="lead">{{ __('lead.Lead') }}</option>
                    <option value="client">{{ __('lead.Client') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('lead.District') }}</label>
                <select name="district" class="form-select form-select-solid " data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="{{ __('lead.Select District') }}" data-allow-clear="true" required>
                    <option>{{ __('lead.Select District') }}</option>
                    <option value="Aveiro">{{ __('lead.Aveiro') }}</option>
                    <option value="Beja">{{ __('lead.Beja') }}</option>
                    <option value="Braga">{{ __('lead.Braga') }}</option>
                    <option value="Bragança">{{ __('lead.Bragança') }}</option>
                    <option value="Castelo Branco">{{ __('lead.Castelo Branco') }}</option>
                    <option value="Coimbra">{{ __('lead.Coimbra') }}</option>
                    <option value="Évora">{{ __('lead.Évora') }}</option>
                    <option value="Faro">{{ __('lead.Faro') }}</option>
                    <option value="Guarda">{{ __('lead.Guarda') }}</option>
                    <option value="Leiria">{{ __('lead.Leiria') }}</option>
                    <option value="Lisboa">{{ __('lead.Lisboa') }}</option>
                    <option value="Portalegre">{{ __('lead.Portalegre') }}</option>
                    <option value="Porto">{{ __('lead.Porto') }}</option>
                    <option value="Região Autónoma dos Açores">{{ __('lead.Região Autónoma dos Açores') }}</option>
                    <option value="Região Autónoma da Madeira">{{ __('lead.Região Autónoma da Madeira') }}</option>
                    <option value="Santarém">{{ __('lead.Santarém') }}</option>
                    <option value="Setúbal">{{ __('lead.Setúbal') }}</option>
                    <option value="Viana do Castelo">{{ __('lead.Viana do Castelo') }}</option>
                    <option value="Vila Real">{{ __('lead.Vila Real') }}</option>
                    <option value="Viseu">{{ __('lead.Viseu') }}</option>
                </select>
            </div>
            @if(Auth::user()->hasRole('admin'))
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('lead.User') }}</label>
                <select name="user" class="form-select form-select-solid" data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true" data-placeholder="{{ __('lead.Select User') }}" data-allow-clear="true" required>
                    <option>{{ __('lead.Select User') }}</option>
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