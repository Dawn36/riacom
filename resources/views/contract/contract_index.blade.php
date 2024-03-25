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
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <form method="GET" action="{{ route('contract.index') }}">
                                        <div class="px-7 py-5" data-kt-user-table-filter="form">
                                            <div class="mb-10">
                                                <div class="row gap-3">
                                                    <div class="col-12">
                                                        <label class="fs-6 fw-bold mb-2">Start Date</label>
                                                        <input class="form-control form-control-solid kt_datepicker_2"
                                                            value="{{ request()->start_date }}"
                                                            placeholder="Enter Start Date" name="start_date" />
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="fs-6 fw-bold mb-2">End Date</label>
                                                        <input class="form-control form-control-solid kt_datepicker_2"
                                                            value="{{ request()->end_date }}"
                                                            placeholder="Enter End Date" name="end_date" />
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="fs-6 fw-bold mb-2">Provider</label>
                                                        <select name="provider_id" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Provider" data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($provider as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ request()->provider_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="fs-6 fw-bold mb-2">Status</label>
                                                        <select name="status" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="Select Provider" data-allow-clear="true">
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
                                        <th>Contract</th>
                                        <th>Client</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Duration</th>
                                        <th>Type of Service</th>
                                        <th>Provider</th>
                                        <th>Date Added</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600 nowrap">
                                    @foreach ($contract as $item)
                                        <tr>
                                            <td>
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
                                            <td>
                                                <div
                                                    class="badge badge-light-{{ $item->status == 'Active' ? 'success' : 'danger' }}">
                                                    {{ $item->status }}</div>
                                            </td>
                                            <td>{{ $item->start_date }}</td>
                                            <td>{{ $item->end_date }}</td>
                                            <td>{{ $item->duration }} Months</td>
                                            <td>{{ $item->type_of_service }}</td>
                                            <td>{{ $item->p_name }}</td>
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
            // {
            //     orderable: !1,
            //     targets: 0
            // },
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
</script>
