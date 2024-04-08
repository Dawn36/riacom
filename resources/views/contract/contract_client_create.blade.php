<form id="add_form" class="form" method="POST" action="{{ route('contract.store') }}">
    @csrf
    <div class="scroll-y py-10 px-7 px-lg-10" id="modal_large" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#modal_large_header" data-kt-scroll-wrappers="#modal_large"
        data-kt-scroll-offset="200px">
        <input hidden name="client_id" value="{{ $clientId }}" />
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.Contract Name') }}</label>
                <input type="text" class="form-control form-control-solid" placeholder="{{ __('contract.Enter Contract Name') }}"
                    name="name" required />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Start Date') }}</label>
                <input class="form-control form-control-solid kt_datepicker_3" placeholder="{{ __('contract.Enter Start Date') }}"
                    name="start_date" id="start_date" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.Duration') }}</label>
                <input type="number" class="required form-control form-control-solid"
                    placeholder="{{ __('contract.Enter the number of months') }}" value="0" onkeyup="checkEndDate()" id="duration"
                    name="duration" required />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.End Date') }}</label>
                <input readonly class="form-control form-control-solid kt_datepicker_2" placeholder="{{ __('contract.Enter End Date') }}"
                    name="end_date" id="end_date" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Renews in…') }}</label>
                <input type="number" class="form-control form-control-solid"
                    placeholder="{{ __('contract.Enter Renews in… (no. of months)') }}" name="renews_in" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.Provider') }}</label>
                <select name="provider" id="provider" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-dropdown-parent="#modal_large" data-control="select2"
                    data-close-on-select="true" data-placeholder="{{ __('contract.Select Provider') }}"
                    {{ Auth::user()->hasRole('admin') == true ? 'onchange=providerUser()' : '' }}
                    data-allow-clear="true" required>
                    <option></option>
                    @foreach ($provider as $item)
                        <option value="{{ $item->id }}" data-type="{{ $item->type_of_service }}">{{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.Monthly Fee in EUR €') }}</label>
                <input type="tel" class="form-control form-control-solid" placeholder="{{ __('contract.Enter Monthly Fee in EUR €') }}"
                    name="monthly_fee" required />
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
                <select name="tension" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Tension') }}" data-allow-clear="true">
                    <option></option>
                    <option value="BTN">{{ __('contract.BTN') }}</option>
                    <option value="BTE">{{ __('contract.BTE') }}</option>
                    <option value="MT">{{ __('contract.MT') }}</option>
                    <option value="AT">{{ __('contract.AT') }}</option>
                    <option value="MAT">{{ __('contract.MAT') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Power') }}</label>
                <select name="power" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Power') }}" data-allow-clear="true">
                    <option></option>
                    <option value="1,15">{{ __('contract.1,15') }}</option>
                    <option value="2,30">{{ __('contract.2,30') }}</option>
                    <option value="3,45">{{ __('contract.3,45') }}</option>
                    <option value="4,60">{{ __('contract.4,60') }}</option>
                    <option value="5,75">{{ __('contract.5,75') }}</option>
                    <option value="6,90">{{ __('contract.6,90') }}</option>
                    <option value="10,35">{{ __('contract.10,35') }}</option>
                    <option value="13,80">{{ __('contract.13,80') }}</option>
                    <option value="17,25">{{ __('contract.17,25') }}</option>
                    <option value="20,70">{{ __('contract.20,70') }}</option>
                    <option value="27,60">{{ __('contract.27,60') }}</option>
                    <option value="34,50">{{ __('contract.34,50') }}</option>
                    <option value="41,40">{{ __('contract.41,40') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Cicle') }}</label>
                <select name="cicle" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Cicle') }}" data-allow-clear="true">
                    <option></option>
                    <option value="No cicle">{{ __('contract.No cicle') }}</option>
                    <option value="Daily">{{ __('contract.Daily') }}</option>
                    <option value="Weekly">{{ __('contract.Weekly') }}</option>
                    <option value="Optional">{{ __('contract.Optional') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Tariff') }}</label>
                <select name="tariff" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Tariff') }}" data-allow-clear="true">
                    <option></option>
                    <option value="Simple">{{ __('contract.Simple') }}</option>
                    <option value="Bi-hourly">{{ __('contract.Bi-hourly') }}</option>
                    <option value="Tri-hourly">{{ __('contract.Tri-hourly') }}</option>
                    <option value="Tetra-hourly">{{ __('contract.Tetra-hourly') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Reception phase') }}</label>
                <select name="reception_phase" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Reception phase') }}" data-allow-clear="true">
                    <option></option>
                    <option value="Monofasic">{{ __('contract.Monofasic') }}</option>
                    <option value="Trifasic">{{ __('contract.Trifasic') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas pressure') }}</label>
                <select name="gas_pressure" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Gas pressure') }}" data-allow-clear="true">
                    <option></option>
                    <option value="Low pressure">{{ __('contract.Low pressure') }}</option>
                    <option value="Mid pressure">{{ __('contract.Mid pressure') }}</option>
                    <option value="High pressure">{{ __('contract.High pressure') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas Scalation') }}</label>
                <select name="gas_scalation" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Gas Scalation') }}" data-allow-clear="true">
                    <option></option>
                    <option value="1">{{ __('contract.1') }}</option>
                    <option value="2">{{ __('contract.2') }}</option>
                    <option value="3">{{ __('contract.3') }}</option>
                    <option value="4">{{ __('contract.4') }}</option>
                    <option value="More than 10.000m3">{{ __('contract.More than 10.000m3') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas Tariff') }}</label>
                <select name="gas_tariff" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Gas Tariff') }}" data-allow-clear="true">
                    <option></option>
                    <option value="Short use">{{ __('contract.Short use') }}</option>
                    <option value="Long use">{{ __('contract.Long use') }}</option>
                    <option value="Monthly">{{ __('contract.Monthly') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Energy Market') }}</label>
                <select name="energy_market" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Energy Market') }}" data-allow-clear="true">
                    <option></option>
                    <option value="Indexed Market">{{ __('contract.Indexed Market') }}</option>
                    <option value="Fixed Market">{{ __('contract.Fixed Market') }}</option>
                    <option value="Mixed Market">{{ __('contract.Mixed Market') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas Market') }}</label>
                <select name="gas_market" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Gas Market') }}" data-allow-clear="true">
                    <option></option>
                    <option value="Indexed Market">{{ __('contract.Indexed Market') }}</option>
                    <option value="Fixed Market">{{ __('contract.Fixed Market') }}</option>
                    <option value="Mixed Market">{{ __('contract.Mixed Market') }}</option>
                </select>
            </div>

            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">{{ __('contract.Status') }}</label>
                <select name="status" class="form-select form-select-solid js-example-basic-single"
                    data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                    data-placeholder="{{ __('contract.Select Status') }}" data-allow-clear="true" required>
                    <option></option>
                    <option value="Active">{{ __('contract.Active') }}</option>
                    <option value="Closed">{{ __('contract.Closed') }}</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="fs-6 fw-bold mb-2">{{ __('contract.Attach Contract') }}</label>
                <input type="file" class="form-control form-control-solid" name="contract"
                    accept-language="pt" />
            </div>
            @if (Auth::user()->hasRole('admin'))
                <div class="col-12 col-md-6">
                    <label class="required fs-6 fw-bold mb-2">{{ __('contract.User') }}</label>
                    <select name="user" id="user"
                        class="form-select form-select-solid js-example-basic-single"
                        data-dropdown-parent="#modal_large" data-control="select2" data-close-on-select="true"
                        data-placeholder="{{ __('contract.Select User') }}" data-allow-clear="true" required>
                        <option></option>

                    </select>
                </div>
            @else
                <input hidden name="user" value="{{ Auth::user()->id }}" />
            @endif
        </div>
    </div>
    <div class="modal-footer flex-center">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('contract.Cancel') }}</button>
        <button id="submitbutton" type="button" onclick="addUpdateData('add_form','modal_large','yes')"
            class="btn btn-lg btn-primary">
            <label class="indicator-label">{{ __('contract.Submit') }}</label>
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
                // if (result[i].id == "{{ isset($branch->area_id) ? $branch->area_id : '' }}") option
                //     .defaultSelected =
                //     true;
                document.getElementById('type_of_service').appendChild(option);
            }

        });
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

    function checkEndDate() {
        $('#duration').val();
        $('#start_date').val();
        calculateEndDate($('#start_date').val(), parseInt($('#duration').val(), 10));
    }

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
                    // if (result[i].id == "{{ isset($branch->area_id) ? $branch->area_id : '' }}") option
                    //     .defaultSelected =
                    //     true;
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
    KTScroll.createInstances()
    var input1 = document.querySelector(".kt_tagify_1");
    new Tagify(input1, {});
        $('.js-example-basic-single').select2();
</script>
