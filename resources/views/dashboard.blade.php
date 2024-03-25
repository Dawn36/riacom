<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10 ">
            <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                            Dashboard
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a class="text-muted">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button type="button" class="btn btn-light-primary me-3 d-flex" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">Filter Options</div>
                        </div>
                        <div class="separator border-gray-200"></div>
                        <form method="GET" action="{{ route('dashboard') }}">
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
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('dashboard') }}"
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
                </div>
            </div>
        </div>
    
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="donations.php" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-outline ki-document text-primary fs-2x ms-n1"></i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ number_format($contractCount) }}</div>
                                <div class="fw-semibold text-gray-600">Number of contracts</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="events.php" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-outline ki-user-tick text-primary fs-2x ms-n1"></i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ number_format($clientCount) }}</div>
                                <div class="fw-semibold text-gray-600">Number of clients</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="campaigns.php" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-outline ki-questionnaire-tablet text-primary fs-2x ms-n1"></i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">€{{ number_format($totalMonthlyFee) }}</div>
                                <div class="fw-semibold text-gray-600">Active Contracts monthly fee (EUR €)</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <a href="partnered_organizations.php" class="card bg-body hoverable card-xl-stretch mb-xl-8 hover-elevate-up shadow-hover">
                            <div class="card-body">
                                <i class="ki-outline ki-data text-primary fs-2x ms-n1"></i>
                                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-5">{{ number_format($leadCount) }}</div>
                                <div class="fw-semibold text-gray-600">Number of leads</div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
</x-app-layout>
