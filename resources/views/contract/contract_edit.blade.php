<form id="add_form" class="form" method="POST" action="{{ route('contract.update', $contract->id) }}">
    @method('PUT')
    @csrf
    <div class="py-10 px-7 px-lg-10">
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Contract Name</label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Contract Name"
                    name="name" value="{{ $contract->name }}" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">Start Date</label>
                <input class="form-control form-control-solid kt_datepicker_3" placeholder="Enter Start Date"
                    name="start_date" value="{{ $contract->start_date }}" id="start_date" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Duration</label>
                <input type="number" class="required form-control form-control-solid"
                    placeholder="Enter the number of months" onkeyup="checkEndDate()" value="{{ $contract->duration }}"
                    id="duration" name="duration" required />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">End Date</label>
                <input readonly class="form-control form-control-solid kt_datepicker_2" placeholder="Enter End Date"
                    name="end_date" id="end_date" value="{{ $contract->end_date }}" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">Renews in…</label>
                <input type="number" class="form-control form-control-solid"
                    placeholder="Enter Renews in… (no. of months)" value="{{ $contract->renews_in }}"
                    name="renews_in" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">
                    <span class="required">Type of Service</span>
                    <i class="ki-outline ki-information-5 ms-1 fs-6" data-bs-toggle="tooltip"
                        title="Select the Provider to see the Type of Service"></i>
                </label>
                <input readonly type="text" class="form-control form-control-solid" id="type_of_service"
                    name="type_of_service" value="{{ $contract->type_of_service }}" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Monthly Fee in EUR €</label>
                <input type="tel" class="form-control form-control-solid" placeholder="Enter Monthly Fee in EUR €"
                    name="monthly_fee" value="{{ $contract->monthly_fee }}" required />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Provider</label>
                <select name="provider" id="provider" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Provider"
                    {{ Auth::user()->hasRole('admin') == true ? 'onchange=providerUser()' : ''  }} data-allow-clear="true" required>
                    <option></option>
                    @foreach ($provider as $item)
                        <option value="{{ $item->id }}" {{ $contract->provider_id == $item->id ? 'selected' : '' }}
                            data-type="{{ $item->type_of_service }}">{{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Tension</label>
                <select name="tension" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Tension"
                    data-allow-clear="true">
                    <option></option>
                    <option value="BTN" {{ $contract->tension == 'BTN' ? 'selected' : '' }}>BTN</option>
                    <option value="BTE" {{ $contract->tension == 'BTE' ? 'selected' : '' }}>BTE</option>
                    <option value="MT" {{ $contract->tension == 'MT' ? 'selected' : '' }}>MT</option>
                    <option value="AT" {{ $contract->tension == 'AT' ? 'selected' : '' }}>AT</option>
                    <option value="MAT" {{ $contract->tension == 'MAT' ? 'selected' : '' }}>MAT</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Power</label>
                <select name="power" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Power"
                    data-allow-clear="true">
                    <option></option>
                    <option value="1,15" {{ $contract->power == '1,15' ? 'selected' : '' }}>1,15</option>
                    <option value="2,30" {{ $contract->power == '2,30' ? 'selected' : '' }}>2,30</option>
                    <option value="3,45" {{ $contract->power == '3,45' ? 'selected' : '' }}>3,45</option>
                    <option value="4,60" {{ $contract->power == '4,60' ? 'selected' : '' }}>4,60</option>
                    <option value="5,75" {{ $contract->power == '5,75' ? 'selected' : '' }}>5,75</option>
                    <option value="6,90" {{ $contract->power == '6,90' ? 'selected' : '' }}>6,90</option>
                    <option value="10,35" {{ $contract->power == '10,35' ? 'selected' : '' }}>10,35</option>
                    <option value="13,80" {{ $contract->power == '13,80' ? 'selected' : '' }}>13,80</option>
                    <option value="17,25" {{ $contract->power == '17,25' ? 'selected' : '' }}>17,25</option>
                    <option value="20,70" {{ $contract->power == '20,70' ? 'selected' : '' }}>20,70</option>
                    <option value="27,60" {{ $contract->power == '27,60' ? 'selected' : '' }}>27,60</option>
                    <option value="34,50" {{ $contract->power == '34,50' ? 'selected' : '' }}>34,50</option>
                    <option value="41,40" {{ $contract->power == '41,40' ? 'selected' : '' }}>41,40</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Cicle</label>
                <select name="cicle" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Cicle"
                    data-allow-clear="true">
                    <option></option>
                    <option value="No cicle" {{ $contract->cicle == 'No cicle' ? 'selected' : '' }}>No cicle</option>
                    <option value="Daily" {{ $contract->cicle == 'Daily' ? 'selected' : '' }}>Daily</option>
                    <option value="Weekly" {{ $contract->cicle == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="Optional" {{ $contract->cicle == 'Optional' ? 'selected' : '' }}>Optional</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Tariff</label>
                <select name="tariff" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Tariff"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Simple" {{ $contract->tariff == 'Simple' ? 'selected' : '' }}>Simple</option>
                    <option value="Bi-hourly" {{ $contract->tariff == 'Bi-hourly' ? 'selected' : '' }}>Bi-hourly
                    </option>
                    <option value="Tri-hourly" {{ $contract->tariff == 'Tri-hourly' ? 'selected' : '' }}>Tri-hourly
                    </option>
                    <option value="Tetra-hourly" {{ $contract->tariff == 'Tetra-hourly' ? 'selected' : '' }}>
                        Tetra-hourly</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Reception phase</label>
                <select name="reception_phase" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Reception phase"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Monofasic" {{ $contract->reception_phase == 'Monofasic' ? 'selected' : '' }}>
                        Monofasic</option>
                    <option value="Trifasic" {{ $contract->reception_phase == 'Trifasic' ? 'selected' : '' }}>Trifasic
                    </option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Gas pressure</label>
                <select name="gas_pressure" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Gas pressure"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Low pressure" {{ $contract->gas_pressure == 'Low pressure' ? 'selected' : '' }}>Low
                        pressure</option>
                    <option value="Mid pressure" {{ $contract->gas_pressure == 'Mid pressure' ? 'selected' : '' }}>Mid
                        pressure</option>
                    <option value="High pressure" {{ $contract->gas_pressure == 'High pressure' ? 'selected' : '' }}>
                        High pressure</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Gas Scalation</label>
                <select name="gas_scalation" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Gas Scalation"
                    data-allow-clear="true">
                    <option></option>
                    <option value="1" {{ $contract->gas_scalation == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ $contract->gas_scalation == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ $contract->gas_scalation == '3' ? 'selected' : '' }}>3</option>
                    <option value="4" {{ $contract->gas_scalation == '4' ? 'selected' : '' }}>4</option>
                    <option value="More than 10.000m3"
                        {{ $contract->gas_scalation == 'More than 10.000m3' ? 'selected' : '' }}>More than 10.000m3
                    </option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Gas Tariff</label>
                <select name="gas_tariff" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Gas Tariff"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Short use" {{ $contract->gas_tariff == 'Short use' ? 'selected' : '' }}>Short use
                    </option>
                    <option value="Long use" {{ $contract->gas_tariff == 'Long use' ? 'selected' : '' }}>Long use
                    </option>
                    <option value="Monthly" {{ $contract->gas_tariff == 'Monthly' ? 'selected' : '' }}>Monthly
                    </option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Energy Market</label>
                <select name="energy_market" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Energy Market"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Indexed Market"
                        {{ $contract->energy_market == 'Indexed Market' ? 'selected' : '' }}>Indexed Market</option>
                    <option value="Fixed Market" {{ $contract->energy_market == 'Fixed Market' ? 'selected' : '' }}>
                        Fixed Market</option>
                    <option value="Mixed Market" {{ $contract->energy_market == 'Mixed Market' ? 'selected' : '' }}>
                        Mixed Market</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Gas Market</label>
                <select name="gas_market" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Gas Market"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Indexed Market" {{ $contract->gas_market == 'Indexed Market' ? 'selected' : '' }}>
                        Indexed Market</option>
                    <option value="Fixed Market" {{ $contract->gas_market == 'Fixed Market' ? 'selected' : '' }}>Fixed
                        Market</option>
                    <option value="Mixed Market" {{ $contract->gas_market == 'Mixed Market' ? 'selected' : '' }}>Mixed
                        Market</option>
                </select>
            </div>

            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Status</label>
                <select name="status" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Status"
                    data-allow-clear="true" required>
                    <option></option>
                    <option value="Active" {{ $contract->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Closed" {{ $contract->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="fs-6 fw-bold mb-2">Attach Contract</label>
                <input type="file" class="form-control form-control-solid" name="contract"
                    accept-language="pt" />
            </div>
            @if(Auth::user()->hasRole('admin'))
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">User</label>
                <select name="user" id="user" class="form-select form-select-solid js-example-basic-single" data-dropdown-parent="#modal_large"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select User"
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
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
        <button id="submitbutton" type="button" onclick="addUpdateData('add_form','modal_large','yes')"
            class="btn btn-lg btn-primary">
            <label class="indicator-label">Update</label>
            <label class="indicator-progress">Please wait...
                <label class="spinner-border spinner-border-sm align-middle ms-2"></label></label>
        </button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('select[name="provider"]').on('change', function() {
            var selectedType = $(this).find(':selected').data('type');
            // console.log(selectedType); // Output the selected type to console
            $('#type_of_service').val(selectedType);
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


    $('.js-example-basic-single').select2();
</script>
