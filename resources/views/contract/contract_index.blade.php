<x-app-layout>
    <style>
        .buttons-excel {
            display: none;
        }
    </style>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                            Contracts List</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                <input type="text" data-kt-user-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13 search"
                                    placeholder="Search ..." />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button id="exportButton" type="button" class="btn btn-light-success me-3">
                                    <i class="ki-outline ki-cloud-download fs-2"></i>Export</button>
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                                <div class="menu menu-sub menu-sub-dropdown w-500px w-md-525px" data-kt-menu="true" >
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <form method="GET" action="{{ route('contract.index') }}" style="max-height: 300px; overflow: auto !important;">
                                        <div class="px-7 py-5" data-kt-user-table-filter="form">
                                            <div class="mb-10">
                                                <div class="row ">
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Start Date</label>
                                                        <input class="form-control form-control-solid kt_datepicker_2"
                                                            value="{{ request()->start_date }}"
                                                            placeholder="Enter Start Date" name="start_date" />
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">End Date</label>
                                                        <input class="form-control form-control-solid kt_datepicker_2"
                                                            value="{{ request()->end_date }}"
                                                            placeholder="Enter End Date" name="end_date" />
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Provider</label>
                                                        <select id="provider_id" name="provider_id" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Provider" {{ Auth::user()->hasRole('admin') == true ? 'onchange=providerUser()' : ''  }} data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($provider as $item)
                                                                <option data-type="{{ $item->type_of_service }}" value="{{ $item->id }}"
                                                                    {{ request()->provider_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Type of Service</label>
                                                        <select id="type_of_service" name="type_of_service" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Type of Service" data-allow-clear="true">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Monthly Fee in EUR €</label>
                                                        <input type="tel" class="form-control form-control-solid" value="{{ request()->monthly_fee }}" placeholder="Enter Monthly Fee in EUR €"
                                                        name="monthly_fee"  />
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Tension</label>
                                                        <select id="tension" name="tension" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Tension" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="BTN" {{ request()->tension == 'BTN' ? 'selected' : '' }} >BTN</option>
                                                            <option value="BTE" {{ request()->tension == 'BTE' ? 'selected' : '' }} >BTE</option>
                                                            <option value="MT" {{ request()->tension == 'MT' ? 'selected' : '' }} >MT</option>
                                                            <option value="AT" {{ request()->tension == 'AT' ? 'selected' : '' }} >AT</option>
                                                            <option value="MAT" {{ request()->tension == 'MAT' ? 'selected' : '' }} >MAT</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Power</label>
                                                        <select id="power" name="power" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Power" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="1,15" {{ request()->power == '1,15' ? 'selected' : '' }} >1,15</option>
                                                            <option value="2,30" {{ request()->power == '2,30' ? 'selected' : '' }} >2,30</option>
                                                            <option value="3,45" {{ request()->power == '3,45' ? 'selected' : '' }} >3,45</option>
                                                            <option value="4,60" {{ request()->power == '4,60' ? 'selected' : '' }} >4,60</option>
                                                            <option value="5,75" {{ request()->power == '5,75' ? 'selected' : '' }} >5,75</option>
                                                            <option value="6,90" {{ request()->power == '6,90' ? 'selected' : '' }} >6,90</option>
                                                            <option value="10,35" {{ request()->power == '10,35' ? 'selected' : '' }} >10,35</option>
                                                            <option value="13,80" {{ request()->power == '13,80' ? 'selected' : '' }} >13,80</option>
                                                            <option value="17,25" {{ request()->power == '17,25' ? 'selected' : '' }} >17,25</option>
                                                            <option value="20,70" {{ request()->power == '20,70' ? 'selected' : '' }} >20,70</option>
                                                            <option value="27,60" {{ request()->power == '27,60' ? 'selected' : '' }} >27,60</option>
                                                            <option value="34,50" {{ request()->power == '34,50' ? 'selected' : '' }} >34,50</option>
                                                            <option value="41,40" {{ request()->power == '41,40' ? 'selected' : '' }} >41,40</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Cicle</label>
                                                        <select id="cicle" name="cicle" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Cicle" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="No cicle" {{ request()->cicle == 'No cicle' ? 'selected' : '' }} >No cicle</option>
                                                            <option value="Daily" {{ request()->cicle == 'Daily' ? 'selected' : '' }} >Daily</option>
                                                            <option value="Weekly" {{ request()->cicle == 'Weekly' ? 'selected' : '' }} >Weekly</option>
                                                            <option value="Optional" {{ request()->cicle == 'Optional' ? 'selected' : '' }} >Optional</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Tariff</label>
                                                        <select id="tariff" name="tariff" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Tariff" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Simple" {{ request()->tariff == 'Simple' ? 'selected' : '' }} >Simple</option>
                                                            <option value="Bi-hourly" {{ request()->tariff == 'Bi-hourly' ? 'selected' : '' }} >Bi-hourly</option>
                                                            <option value="Tri-hourly" {{ request()->tariff == 'Tri-hourly' ? 'selected' : '' }} >Tri-hourly</option>
                                                            <option value="Tetra-hourly" {{ request()->tariff == 'Tetra-hourly' ? 'selected' : '' }} >Tetra-hourly</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Reception phase</label>
                                                        <select id="reception_phase" name="reception_phase" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Reception phase" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Monofasic" {{ request()->reception_phase == 'Monofasic' ? 'selected' : '' }} >Monofasic</option>
                                                            <option value="Trifasic" {{ request()->reception_phase == 'Trifasic' ? 'selected' : '' }} >Trifasic</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Gas pressure</label>
                                                        <select id="gas_pressure" name="gas_pressure" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Gas pressure" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Low pressure" {{ request()->gas_pressure == 'Low pressure' ? 'selected' : '' }} >Low pressure</option>
                                                            <option value="Mid pressure" {{ request()->gas_pressure == 'Mid pressure' ? 'selected' : '' }} >Mid pressure</option>
                                                            <option value="High pressure" {{ request()->gas_pressure == 'High pressure' ? 'selected' : '' }} >High pressure</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Gas Scalation</label>
                                                        <select id="gas_scalation" name="gas_scalation" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Gas Scalation" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="1" {{ request()->gas_scalation == '1' ? 'selected' : '' }} >1</option>
                                                            <option value="2" {{ request()->gas_scalation == '2' ? 'selected' : '' }} >2</option>
                                                            <option value="3" {{ request()->gas_scalation == '3' ? 'selected' : '' }} >3</option>
                                                            <option value="4" {{ request()->gas_scalation == '4' ? 'selected' : '' }} >4</option>
                                                            <option value="More than 10.000m3" {{ request()->gas_scalation == 'More than 10.000m3' ? 'selected' : '' }} >More than 10.000m3</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Gas Tariff</label>
                                                        <select id="gas_tariff" name="gas_tariff" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Gas Tariff" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Short use" {{ request()->gas_tariff == 'Short use' ? 'selected' : '' }} >Short use</option>
                                                            <option value="Long use" {{ request()->gas_tariff == 'Long use' ? 'selected' : '' }} >Long use</option>
                                                            <option value="Monthly" {{ request()->gas_tariff == 'Monthly' ? 'selected' : '' }} >Monthly</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Energy Market</label>
                                                        <select id="energy_market" name="energy_market" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Energy Market" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Indexed Market" {{ request()->energy_market == 'Indexed Market' ? 'selected' : '' }} >Indexed Market</option>
                                                            <option value="Fixed Market" {{ request()->energy_market == 'Fixed Market' ? 'selected' : '' }} >Fixed Market</option>
                                                            <option value="Mixed Market" {{ request()->energy_market == 'Mixed Market' ? 'selected' : '' }} >Mixed Market</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Gas Market</label>
                                                        <select id="gas_market" name="gas_market" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Gas Market" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Indexed Market" {{ request()->gas_market == 'Indexed Market' ? 'selected' : '' }} >Indexed Market</option>
                                                            <option value="Fixed Market" {{ request()->gas_market == 'Fixed Market' ? 'selected' : '' }} >Fixed Market</option>
                                                            <option value="Mixed Market" {{ request()->gas_market == 'Mixed Market' ? 'selected' : '' }} >Mixed Market</option>
                                                        </select>
                                                    </div>
                                                    @if(Auth::user()->hasRole('admin'))
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">User</label>
                                                        <select id="user" name="user" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select User" data-allow-clear="true">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    @endif
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">Status</label>
                                                        <select name="status" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Status" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Active"
                                                                {{ request()->status == 'Active' ? 'selected' : '' }}>
                                                                Active</option>
                                                            <option value="Closed"
                                                                {{ request()->status == 'Closed' ? 'selected' : '' }}>
                                                                Closed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('contract.index') }}"
                                                    class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-user-table-filter="reset">Reset</a>
                                                <button type="submit" class="btn btn-primary fw-semibold px-6"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-user-table-filter="filter">Apply</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <button type="button" class="btn btn-primary"
                                    onclick="openModalBox('modal_large','{{ route('contract.create') }}','Add Contract')">
                                    <i class="ki-outline ki-plus fs-2"></i>Add Contract</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9 pt-1">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="example">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 nowrap">
                                        <th style="display: none">VAT number</th>
                                        <th>Client</th>
                                        <th style="display: none">Phone Number</th>
                                        <th style="display: none">Email</th>
                                        <th style="display: none">Address</th>
                                        <th>Contract</th>
                                        <th>Start Date</th>
                                        <th>Duration</th>
                                        <th>End Date</th>
                                        <th>Renews in</th>
                                        <th>Provider</th>
                                        <th>Type of Service</th>
                                        <th style="display: none">Monthly Fee</th>
                                        <th style="display: none">Tension</th>
                                        <th style="display: none">Power</th>
                                        <th style="display: none">Cycle</th>
                                        <th style="display: none">Tariff</th>
                                        <th style="display: none">Reception Phase</th>
                                        <th style="display: none">Gas pressure</th>
                                        <th style="display: none">Gas scalation</th>
                                        <th style="display: none">Gas tariff</th>
                                        <th style="display: none">Energy market</th>
                                        <th style="display: none">Gas market</th>
                                        <th>Status</th>
                                        <th style="display: none">User</th>
                                        <th>Date Added</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600 nowrap">
                                    @foreach ($contract as $item)
                                        <tr>
                                            <td style="display: none">{{ $item->vat_number }}</td>
                                            <td class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-30px overflow-hidden me-3">
                                                    <a href="{{ route('client.show', $item->c_id) }}">
                                                        <div class="symbol-label">
                                                            <img src="{{ asset($item->c_image) }}"
                                                                alt="{{ $item->c_name }}" class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('client.show', $item->c_id) }}"
                                                        class="fw-bolder text-gray-800 text-hover-primary">{{ $item->c_name }}</a>
                                                </div>
                                            </td>
                                            <td style="display: none">{{ $item->phone }}</td>
                                            <td style="display: none">{{ $item->email }}</td>
                                            <td style="display: none">{{ $item->client_address }}</td>
                                            <td >
                                                <div class="d-flex align-items-center">
                                                    <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3"
                                                                d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                                                fill="currentColor" />
                                                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <a href="{{ route('contract.show', $item->id) }}"
                                                        class="text-gray-800 text-hover-primary">{{ $item->name }}</a>
                                                </div>
                                            </td>
                                            <td>{{ $item->start_date }}</td>
                                            <td>{{ $item->duration }} Months</td>
                                            <td>{{ $item->end_date }}</td>
                                            <td>{{ $item->renews_in_date }}</td>
                                            <td>{{ $item->p_name }}</td>
                                            <td>{{ $item->type_of_service }}</td>
                                            <td style="display: none" >{{ $item->monthly_fee }}</td>
                                            <td style="display: none" >{{ $item->tension }}</td>
                                            <td style="display: none" >{{ $item->power }}</td>
                                            <td style="display: none" >{{ $item->cycle }}</td>
                                            <td style="display: none" >{{ $item->tariff }}</td>
                                            <td style="display: none" >{{ $item->reception_phase }}</td>
                                            <td style="display: none" >{{ $item->gas_pressure }}</td>
                                            <td style="display: none" >{{ $item->gas_scalation }}</td>
                                            <td style="display: none" >{{ $item->gas_tariff }}</td>
                                            <td style="display: none" >{{ $item->energy_market }}</td>
                                            <td style="display: none" >{{ $item->gas_market }}</td>
                                            <td>
                                                <div
                                                    class="badge badge-light-{{ $item->status == 'Active' ? 'success' : 'danger' }}">
                                                    {{ $item->status }}</div>
                                            </td>
                                            <td style="display: none">{{ $item->u_name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('contract.show', $item->id) }}"
                                                    class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary">
                                                    <i class="ki-outline ki-eye fs-3" data-bs-toggle="tooltip"
                                                        title="View"></i>
                                                </a>
                                                <button
                                                    class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary">
                                                    <a href="{{ asset($item->contract_path) }}" download=""><i
                                                            class="ki-outline ki-cloud-download fs-3"
                                                            data-bs-toggle="tooltip" title="Download"></i></a>
                                                </button>
                                                @if($userType)
                                                <button type="button"
                                                    class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger"
                                                    onclick="deleteSweerAlert('This contract has been deleted.','{{ route('contract.destroy', $item->id) }}','{{ route('contract.index') }}')"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    aria-label="Delete" data-bs-original-title="Delete"
                                                    data-kt-initialized="1">
                                                    <i class="ki-outline ki-trash fs-3" data-bs-toggle="tooltip"
                                                        title="Delete"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

</x-app-layout>
<script>
    var table = $('#example').DataTable({
        // order: [],
        // "scrollY": "500px",
        info: !1,
        "aaSorting": [],
        pageLength: 10,
        lengthChange: !1,
        dom: 'Brtip',
        buttons: [{
            extend: 'excelHtml5',
            className: 'btn btn-light-success me-3',
            text: '<i class="ki-outline ki-cloud-download fs-2"></i> Export',
        }],
        columnDefs: [
            {
                orderable: !1,
                targets: -1
            },
        ],
        
    });

    $('#exportButton').on('click', function() {
        // Handle export functionality
        // For example, trigger the Excel export
        $('.buttons-excel').click();
    });

    $('.search').on('keyup', function() {
        table.search(this.value).draw();
    });

    $(document).ready(function() {
        $('select[name="provider_id"]').on('change', function() {
            var selectedType = $(this).find(':selected').data('type');
            var typeArray = selectedType.split(',');
            
            document.getElementById('type_of_service').innerHTML = '<option></option>';
            for (var i = 0; i < typeArray.length; i++) {
                var option = document.createElement('option');
                option.value = typeArray[i];
                option.innerHTML = typeArray[i];
                if (typeArray[i] == "{{ isset(request()->type_of_service) ? request()->type_of_service : '' }}") option.defaultSelected =true;
                document.getElementById('type_of_service').appendChild(option);
            }
        });
        $('#provider_id').trigger('change');
    });

    function providerUser() {
        provider = $('#provider_id').val();
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
                    if (result[i].id == "{{ isset(request()->user) ? request()->user : '' }}") option.defaultSelected = true;
                    document.getElementById('user').appendChild(option);
                }

            }
        });
    }
    providerUser();
</script>
