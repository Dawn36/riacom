<form id="add_form" class="form" method="POST" action="{{ route('contract.store') }}">
    @csrf
    <input hidden name="client_id" id="client_id" value="" />
    <div class="py-10 px-7 px-lg-10">
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">VAT number</label>
                <input type="text" class="form-control form-control-solid" onkeyup="checkVatNumber()" placeholder="Search by VAT number" id="vat_number" name="vat_number" required />
                <div class="myClass" id="vat_number_check" style="color: red; display: none">The VAT number not found.</div>
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Contract Name</label>
                <input type="text" class="form-control form-control-solid" placeholder="Enter Contract Name"
                    name="name" required />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">Start Date</label>
                <input class="form-control form-control-solid kt_datepicker_3" placeholder="Enter Start Date"
                    name="start_date" id="start_date" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Duration</label>
                <input type="number" class="required form-control form-control-solid"
                    placeholder="Enter the number of months" value="0" onkeyup="checkEndDate()" id="duration" name="duration"
                    required />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">End Date</label>
                <input readonly class="form-control form-control-solid kt_datepicker_2" placeholder="Enter End Date"
                    name="end_date" id="end_date" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">Renews in…</label>
                <input type="number" class="form-control form-control-solid"
                    placeholder="Enter Renews in… (no. of months)" name="renews_in" />
            </div>
            <div class="col-12 col-md-6">
                <label class="fs-6 fw-bold mb-2">
                    <span class="required">Type of Service</span>
                    <i class="ki-outline ki-information-5 ms-1 fs-6" data-bs-toggle="tooltip"
                        title="Select the Provider to see the Type of Service"></i>
                </label>
                <input readonly type="text" class="form-control form-control-solid" id="type_of_service"
                    name="type_of_service" />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Monthly Fee in EUR €</label>
                <input type="tel" class="form-control form-control-solid" placeholder="Enter Monthly Fee in EUR €"
                    name="monthly_fee" required />
            </div>
            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Provider</label>
                <select name="provider" id="provider" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Provider"
                    {{ Auth::user()->hasRole('admin') == true ? 'onchange=providerUser()' : ''  }}   data-allow-clear="true" required>
                    <option></option>
                    @foreach ($provider as $item)
                        <option value="{{ $item->id }}" data-type="{{ $item->type_of_service }}">{{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Tension</label>
                <select name="tension" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Tension"
                    data-allow-clear="true">
                    <option></option>
                    <option value="BTN">BTN</option>
                    <option value="BTE">BTE</option>
                    <option value="MT">MT</option>
                    <option value="AT">AT</option>
                    <option value="MAT">MAT</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Power</label>
                <select name="power" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Power"
                    data-allow-clear="true">
                    <option></option>
                    <option value="1,15">1,15</option>
                    <option value="2,30">2,30</option>
                    <option value="3,45">3,45</option>
                    <option value="4,60">4,60</option>
                    <option value="5,75">5,75</option>
                    <option value="6,90">6,90</option>
                    <option value="10,35">10,35</option>
                    <option value="13,80">13,80</option>
                    <option value="17,25">17,25</option>
                    <option value="20,70">20,70</option>
                    <option value="27,60">27,60</option>
                    <option value="34,50">34,50</option>
                    <option value="41,40">41,40</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Cicle</label>
                <select name="cicle" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Cicle"
                    data-allow-clear="true">
                    <option></option>
                    <option value="No cicle">No cicle</option>
                    <option value="Daily">Daily</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Optional">Optional</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Tariff</label>
                <select name="tariff" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Tariff"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Simple">Simple</option>
                    <option value="Bi-hourly">Bi-hourly</option>
                    <option value="Tri-hourly">Tri-hourly</option>
                    <option value="Tetra-hourly">Tetra-hourly</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Reception phase</label>
                <select name="reception_phase" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Reception phase"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Monofasic">Monofasic</option>
                    <option value="Trifasic">Trifasic</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Gas pressure</label>
                <select name="gas_pressure" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Gas pressure"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Low pressure">Low pressure</option>
                    <option value="Mid pressure">Mid pressure</option>
                    <option value="High pressure">High pressure</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Gas Scalation</label>
                <select name="gas_scalation" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Gas Scalation"
                    data-allow-clear="true">
                    <option></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="More than 10.000m3">More than 10.000m3</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Gas Tariff</label>
                <select name="gas_tariff" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Gas Tariff"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Short use">Short use</option>
                    <option value="Long use">Long use</option>
                    <option value="Monthly">Monthly</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Energy Market</label>
                <select name="energy_market" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Energy Market"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Indexed Market">Indexed Market</option>
                    <option value="Fixed Market">Fixed Market</option>
                    <option value="Mixed Market">Mixed Market</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <label class="fs-6 fw-bold mb-2">Gas Market</label>
                <select name="gas_market" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Gas Market"
                    data-allow-clear="true">
                    <option></option>
                    <option value="Indexed Market">Indexed Market</option>
                    <option value="Fixed Market">Fixed Market</option>
                    <option value="Mixed Market">Mixed Market</option>
                </select>
            </div>

            <div class="col-12 col-md-6">
                <label class="required fs-6 fw-bold mb-2">Status</label>
                <select name="status" class="form-select form-select-solid js-example-basic-single"
                    data-control="select2" data-close-on-select="true" data-placeholder="Select Status"
                    data-allow-clear="true" required>
                    <option></option>
                    <option value="Active">Active</option>
                    <option value="Closed">Closed</option>
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
                <select name="user" id="user" class="form-select form-select-solid js-example-basic-single"
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
            <label class="indicator-label">Submit</label>
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

    function checkEndDate() {
        $('#duration').val();
        $('#start_date').val();
        calculateEndDate($('#start_date').val(), parseInt($('#duration').val(), 10));
    }

    function checkVatNumber(){
        vatNumber = $('#vat_number').val();
        let value = {
            vat_number: vatNumber,
        };
        $.ajax({
            type: 'GET',
            url: "{{ route('check-vat-number-client') }}",
            data: value,
            success: function(result) {
                console.log(result.id);
                if(result == '')
                {
                    $('#vat_number_check').show();
                }
                else
                {
                    $('#vat_number_check').hide();
                    $('#client_id').val(result.id);
                }
            }
        });
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


    $('.js-example-basic-single').select2();
</script>
