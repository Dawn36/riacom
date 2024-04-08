<form id="add_form" class="form" method="POST" action="{{ route('contract.update', $contract->id) }}">
    @method('PUT')
    @csrf
    <div class="scroll-y py-10 px-7 px-lg-10" id="modal_large" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#modal_large_header" data-kt-scroll-wrappers="#modal_large"
        data-kt-scroll-offset="200px">
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.Contract Name') }}</label>
                <input type="text" class="form-control form-control-solid" placeholder="{{ __('contract.Enter Contract Name') }}"
                    name="name" value="{{ $contract->name }}" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Start Date') }}</label>
                <input class="form-control form-control-solid kt_datepicker_3" placeholder="{{ __('contract.Enter Start Date') }}"
                    name="start_date" value="{{ $contract->start_date }}" id="start_date" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.Duration') }}</label>
                <input type="number" class="required form-control form-control-solid"
                    placeholder="{{ __('contract.Enter the number of months') }}" onkeyup="checkEndDate()" value="{{ $contract->duration }}"
                    id="duration" name="duration" required />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.End Date') }}</label>
                <input readonly class="form-control form-control-solid kt_datepicker_2" placeholder="{{ __('contract.Enter End Date') }}"
                    name="end_date" id="end_date" value="{{ $contract->end_date }}" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Renews in…') }}</label>
                <input type="number" class="form-control form-control-solid"
                    placeholder="{{ __('contract.Enter Renews in… (no. of months)') }}" value="{{ $contract->renews_in }}"
                    name="renews_in" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.Provider') }}</label>
                <select name="provider" id="provider" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Provider') }}"
                    {{ Auth::user()->hasRole('admin') == true ? 'onchange=providerUser()' : ''  }} data-allow-clear="true" required>
                    <option></option>
                    @foreach ($provider as $item)
                        <option value="{{ $item->id }}" {{ $contract->provider_id == $item->id ? 'selected' : '' }}
                            data-type="{{ $item->type_of_service }}">{{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.Monthly Fee in EUR €') }}</label>
                <input type="tel" class="form-control form-control-solid" placeholder="{{ __('contract.Enter Monthly Fee in EUR €') }}"
                    name="monthly_fee" value="{{ $contract->monthly_fee }}" required />
            </div>
            
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">
                    <span class="required">{{ __('contract.Type of Service') }}</span>
                    <i class="ki-outline ki-information-5 ms-1 fs-6" data-bs-toggle="tooltip"
                        title="{{ __('contract.Select the Provider to see the Type of Service') }}"></i>
                </label>
                <select id="type_of_service" name="type_of_service" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Type of Service') }}" data-allow-clear="true">
                    <option></option>
                </select>
                
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Tension') }}</label>
                <select name="tension" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Tension') }}"
                    data-allow-clear="true">
                    <option></option>
                    <option value="BTN" {{ $contract->tension == 'BTN' ? 'selected' : '' }}>{{ __('contract.BTN') }}</option>
                    <option value="BTE" {{ $contract->tension == 'BTE' ? 'selected' : '' }}>{{ __('contract.BTE') }}</option>
                    <option value="MT" {{ $contract->tension == 'MT' ? 'selected' : '' }}>{{ __('contract.MT') }}</option>
                    <option value="AT" {{ $contract->tension == 'AT' ? 'selected' : '' }}>{{ __('contract.AT') }}</option>
                    <option value="MAT" {{ $contract->tension == 'MAT' ? 'selected' : '' }}>{{ __('contract.MAT') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Power') }}</label>
                <select name="power" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Power') }}"
                    data-allow-clear="true">
                    <option></option>
                    <option value="1,15" {{ $contract->power == '1,15' ? 'selected' : '' }}>{{ __('contract.1,15') }}</option>
                    <option value="2,30" {{ $contract->power == '2,30' ? 'selected' : '' }}>{{ __('contract.2,30') }}</option>
                    <option value="3,45" {{ $contract->power == '3,45' ? 'selected' : '' }}>{{ __('contract.3,45') }}</option>
                    <option value="4,60" {{ $contract->power == '4,60' ? 'selected' : '' }}>{{ __('contract.4,60') }}</option>
                    <option value="5,75" {{ $contract->power == '5,75' ? 'selected' : '' }}>{{ __('contract.5,75') }}</option>
                    <option value="6,90" {{ $contract->power == '6,90' ? 'selected' : '' }}>{{ __('contract.6,90') }}</option>
                    <option value="10,35" {{ $contract->power == '10,35' ? 'selected' : '' }}>{{ __('contract.10,35') }}</option>
                    <option value="13,80" {{ $contract->power == '13,80' ? 'selected' : '' }}>{{ __('contract.13,80') }}</option>
                    <option value="17,25" {{ $contract->power == '17,25' ? 'selected' : '' }}>{{ __('contract.17,25') }}</option>
                    <option value="20,70" {{ $contract->power == '20,70' ? 'selected' : '' }}>{{ __('contract.20,70') }}</option>
                    <option value="27,60" {{ $contract->power == '27,60' ? 'selected' : '' }}>{{ __('contract.27,60') }}</option>
                    <option value="34,50" {{ $contract->power == '34,50' ? 'selected' : '' }}>{{ __('contract.34,50') }}</option>
                    <option value="41,40" {{ $contract->power == '41,40' ? 'selected' : '' }}>{{ __('contract.41,40') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Cicle') }}</label>
                <select name="cicle" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Cicle') }}"
                    data-allow-clear="true">
                    <option></option>
                    <option value="No cicle" {{ $contract->cicle == 'No cicle' ? 'selected' : '' }}>{{ __('contract.No cicle') }}</option>
                    <option value="Daily" {{ $contract->cicle == 'Daily' ? 'selected' : '' }}>{{ __('contract.Daily') }}</option>
                    <option value="Weekly" {{ $contract->cicle == 'Weekly' ? 'selected' : '' }}>{{ __('contract.Weekly') }}</option>
                    <option value="Optional" {{ $contract->cicle == 'Optional' ? 'selected' : '' }}>{{ __('contract.Optional') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Tariff') }}</label>
                <select name="tariff" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Tariff') }}"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Simple" {{ $contract->tariff == 'Simple' ? 'selected' : '' }}>{{ __('contract.Simple') }}</option>
                    <option value="Bi-hourly" {{ $contract->tariff == 'Bi-hourly' ? 'selected' : '' }}>{{ __('contract.Bi-hourly') }}
                    </option>
                    <option value="Tri-hourly" {{ $contract->tariff == 'Tri-hourly' ? 'selected' : '' }}>{{ __('contract.Tri-hourly') }}
                    </option>
                    <option value="Tetra-hourly" {{ $contract->tariff == 'Tetra-hourly' ? 'selected' : '' }}>
                        {{ __('contract.Tetra-hourly') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Reception phase') }}</label>
                <select name="reception_phase" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Reception phase') }}"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Monofasic" {{ $contract->reception_phase == 'Monofasic' ? 'selected' : '' }}>
                        {{ __('contract.Monofasic') }}</option>
                    <option value="Trifasic" {{ $contract->reception_phase == 'Trifasic' ? 'selected' : '' }}>{{ __('contract.Trifasic') }}
                    </option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas pressure') }}</label>
                <select name="gas_pressure" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Gas pressure') }}"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Low pressure" {{ $contract->gas_pressure == 'Low pressure' ? 'selected' : '' }}>{{ __('contract.Low pressure') }}</option>
                    <option value="Mid pressure" {{ $contract->gas_pressure == 'Mid pressure' ? 'selected' : '' }}>{{ __('contract.Mid pressure') }}</option>
                    <option value="High pressure" {{ $contract->gas_pressure == 'High pressure' ? 'selected' : '' }}>
                        {{ __('contract.High pressure') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas Scalation') }}</label>
                <select name="gas_scalation" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Gas Scalation') }}"
                    data-allow-clear="true">
                    <option></option>
                    <option value="1" {{ $contract->gas_scalation == '1' ? 'selected' : '' }}>{{ __('contract.1') }}</option>
                    <option value="2" {{ $contract->gas_scalation == '2' ? 'selected' : '' }}>{{ __('contract.2') }}</option>
                    <option value="3" {{ $contract->gas_scalation == '3' ? 'selected' : '' }}>{{ __('contract.3') }}</option>
                    <option value="4" {{ $contract->gas_scalation == '4' ? 'selected' : '' }}>{{ __('contract.4') }}</option>
                    <option value="More than 10.000m3"
                        {{ $contract->gas_scalation == 'More than 10.000m3' ? 'selected' : '' }}>{{ __('contract.More than 10.000m3') }}
                    </option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas Tariff') }}</label>
                <select name="gas_tariff" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Gas Tariff') }}"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Short use" {{ $contract->gas_tariff == 'Short use' ? 'selected' : '' }}>{{ __('contract.Short use') }}
                    </option>
                    <option value="Long use" {{ $contract->gas_tariff == 'Long use' ? 'selected' : '' }}>{{ __('contract.Long use') }}
                    </option>
                    <option value="Monthly" {{ $contract->gas_tariff == 'Monthly' ? 'selected' : '' }}>{{ __('contract.Monthly') }}
                    </option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Energy Market') }}</label>
                <select name="energy_market" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Energy Market') }}"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Indexed Market"
                        {{ $contract->energy_market == 'Indexed Market' ? 'selected' : '' }}>{{ __('contract.Indexed Market') }}</option>
                    <option value="Fixed Market" {{ $contract->energy_market == 'Fixed Market' ? 'selected' : '' }}>
                        {{ __('contract.Fixed Market') }}</option>
                    <option value="Mixed Market" {{ $contract->energy_market == 'Mixed Market' ? 'selected' : '' }}>
                        {{ __('contract.Mixed Market') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas Market') }}</label>
                <select name="gas_market" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Gas Market') }}"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Indexed Market" {{ $contract->gas_market == 'Indexed Market' ? 'selected' : '' }}>
                        {{ __('contract.Indexed Market') }}</option>
                    <option value="Fixed Market" {{ $contract->gas_market == 'Fixed Market' ? 'selected' : '' }}>{{ __('contract.Fixed Market') }}</option>
                    <option value="Mixed Market" {{ $contract->gas_market == 'Mixed Market' ? 'selected' : '' }}>{{ __('contract.Mixed Market') }}</option>
                </select>
            </div>

            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.Status') }}</label>
                <select name="status" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select Status') }}"
                    data-allow-clear="true" required>
                    <option></option>
                    <option value="Active" {{ $contract->status == 'Active' ? 'selected' : '' }}>{{ __('contract.Active') }}</option>
                    <option value="Closed" {{ $contract->status == 'Closed' ? 'selected' : '' }}>{{ __('contract.Closed') }}</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Attach Contract') }}</label>
                <input type="file" class="form-control form-control-solid" name="contract"
                    accept-language="pt" />
            </div>
            @if(Auth::user()->hasRole('admin'))
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.User') }}</label>
                <select name="user" id="user" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="{{ __('contract.Select User') }}"
                    data-allow-clear="true" required>
                    <option></option>

                </select>
            </div>
            @else
                <input hidden name="user" value="{{Auth::user()->id}}"/>
            @endif
        </div>
    </div>
    <div class="modal-footer flex-center">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('contract.Cancel') }}</button>
        <button id="submitbutton" type="button" onclick="addUpdateData('add_form','modal_large','yes')"
            class="btn btn-lg btn-primary">
            <label class="indicator-label">{{ __('contract.Update') }}</label>
            <label class="indicator-progress">{{ __('contract.Please wait...') }}
                <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
        </button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('select[name="provider"]').on('change', function() {
            var selectedType = $(this).find(':selected').data('type');
            var typeArray = selectedType.split(',');
            
            document.getElementById('type_of_service').innerHTML = '<option></option>';
            for (var i = 0; i < typeArray.length; i++) {
                var option = document.createElement('option');
                option.value = typeArray[i];
                option.innerHTML = typeArray[i];
                if (typeArray[i] == "{{ isset($contract->type_of_service) ? $contract->type_of_service : '' }}") option.defaultSelected = true;
                document.getElementById('type_of_service').appendChild(option);
            }
        });
        $('#provider').trigger('change');

       
    });

    function calculateEndDate(startDate, durationMonths) {
        console.log(startDate);
        // Parse the start date string to a Date object
        var startDateObj = new Date(startDate);

        // Calculate the end date
        var endDate = new Date(startDateObj.getFullYear(), startDateObj.getMonth() + durationMonths, startDateObj
            .getDate());

        // Format the end date as YYYY-MM-DD
        var endDateFormatted = endDate.getFullYear() + '-' + ('0' + (endDate.getMonth() + 1)).slice(-2) + '-' + ('0' +
            endDate.getDate()).slice(-2);

        $('#end_date').val(endDateFormatted);
    }
    checkEndDate();

    function checkEndDate() {
        $('#duration').val();
        $('#start_date').val();
        calculateEndDate($('#start_date').val(), parseInt($('#duration').val(), 10));
    }
    providerUser();

    function providerUser() {
        provider = $('#provider').val();
        let value = {
            provider: provider,
        };
        $.ajax({
            type: 'GET',
            url: "{{ route('get-provider-user') }}",
            data: value,
            success: function(result) {
                // console.log(result);
                document.getElementById('user').innerHTML = '<option></option>';
                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement('option');
                    option.value = result[i].id;
                    option.innerHTML = result[i].name;
                    if (result[i].id == "{{ isset($contract->user_id) ? $contract->user_id : '' }}") option
                        .defaultSelected =
                        true;
                    document.getElementById('user').appendChild(option);
                }

            }
        });
    }
    $(".kt_datepicker_3").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            // Your code to handle the change here
            checkEndDate();
        }
    });

    KTScroll.createInstances();
    var input1 = document.querySelector(".kt_tagify_1");
    new Tagify(input1, {});
    $('.js-example-basic-single').select2();
</script>
