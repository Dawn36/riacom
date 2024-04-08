<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                            {{ __('client.Clients List') }}</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">{{ __('client.Home') }}</a>
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
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                <input type="text" data-kt-user-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13 search"
                                    placeholder="{{ __('client.Search ...') }}" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-outline ki-filter fs-2"></i>{{ __('client.Filter') }}</button>
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">{{ __('client.Filter Options') }}</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <form  method="GET"
                                        action="{{ route('client.index') }}">
                                        <div class="px-7 py-5" data-kt-user-table-filter="form">
                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-semibold">{{ __('client.Status') }}:</label>
                                                <select class="form-select form-select-solid fw-bold" name="status"
                                                    data-kt-select2="true" data-placeholder="Select option"
                                                    data-allow-clear="true" data-kt-user-table-filter="role"
                                                    data-hide-search="true">
                                                    <option></option>
                                                    <option value="to be contacted" {{ request()->status == 'to be contacted' ? 'selected' : '' }}>{{ __('client.To be Contacted') }}</option>
                                                    <option value="contact" {{ request()->status == 'contact' ? 'selected' : '' }}>{{ __('client.Contact') }}</option>
                                                    <option value="under negotiation" {{ request()->status == 'under negotiation' ? 'selected' : '' }}>{{ __('client.Under Negotiation') }}</option>
                                                    <option value="active" {{ request()->status == 'active' ? 'selected' : '' }}>{{ __('client.Active') }}</option>
                                                    <option value="inactive" {{ request()->status == 'inactive' ? 'selected' : '' }}>{{ __('client.Inactive') }}</option>
                                                    <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>{{ __('client.Pending') }}</option>
                                                    <option value="not interested" {{ request()->status == 'not interested' ? 'selected' : '' }}>{{ __('client.Not Interested') }}</option>
                                                    <option value="rejected" {{ request()->status == 'rejected' ? 'selected' : '' }}>{{ __('client.Rejected') }}</option>
                                                </select>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('client.index') }}"
                                                    class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-user-table-filter="reset">{{ __('client.Reset') }}</a>
                                                <button type="submit" class="btn btn-primary fw-semibold px-6"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-user-table-filter="filter">{{ __('client.Apply') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <button type="button" class="btn btn-primary"
                                    onclick="openModalBox('modal_large','{{ route('client.create') }}','{{ __('client.Add Client') }}')">
                                    <i class="ki-outline ki-plus fs-2"></i>{{ __('client.Add Client') }}</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 kt_datatable_example_1"
                            id="kt_datatable_example_1">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="">{{ __('client.Name & Job Title') }}</th>
                                    <th class="">{{ __('client.Email & Phone') }}</th>
                                    <th class="">{{ __('client.Status') }}</th>
                                    <th class="min-w-125px">{{ __('client.# Of Phone Calls') }}</th>
                                    <th class="min-w-125px">{{ __('client.Creation Date') }}</th>
                                    <th class="text-end min-w-100px">{{ __('client.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($client as $item)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="{{ route('client.show', $item->id) }}">
                                                    <div class="symbol-label">
                                                        <img src="{{ asset($item->image) }}" alt="Brian Cox"
                                                            class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('client.show', $item->id) }}"
                                                    class="fw-bolder text-gray-800 text-hover-primary mb-1">{{ $item->name }}</a>
                                                <span>{{ $item->job_title }}</span>
                                            </div>
                                        </td>
                                        <td class="no-wrap">
                                            <a href="mailto:{{ $item->email }}"
                                                class="fw-bolder text-gray-800 text-hover-primary mb-1">{{ $item->email }}</a>
                                            <br>
                                            <a href="tel:{{ $item->phone }}"
                                                class="fw-normal text-gray-800 text-hover-primary mb-1">{{ $item->phone }}</a>
                                        </td>
                                        <td>
                                            <div class="badge badge-lg badge-light-{{ $item->status == 'inactive' || $item->status == 'rejected' ? 'danger' : 'primary' }} d-inline cursor-pointer"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                {{ __('client.'. ucwords($item->status)) }}</div>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                                                data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                        {{ __('client.Update Status') }}</div>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-3"
                                                        onclick="clientStatusUpdate('To be Contacted','{{ $item->id }}',this)">{{ __('client.To be Contacted') }}</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-3"
                                                        onclick="clientStatusUpdate('Contact','{{ $item->id }}',this)">{{ __('client.Contact') }}</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-3"
                                                        onclick="clientStatusUpdate('Under Negotiation','{{ $item->id }}',this)">{{ __('client.Under Negotiation') }}</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link active px-3"
                                                        onclick="clientStatusUpdate('Active','{{ $item->id }}',this)">{{ __('client.Active') }}</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-3"
                                                        onclick="clientStatusUpdate('Inactive','{{ $item->id }}',this)">{{ __('client.Inactive') }}</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-3"
                                                        onclick="clientStatusUpdate('Pending','{{ $item->id }}',this)">{{ __('client.Pending') }}</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-3"
                                                        onclick="clientStatusUpdate('Not Interested','{{ $item->id }}',this)">{{ __('client.Not Interested') }}</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a class="menu-link px-3"
                                                        onclick="clientStatusUpdate('Rejected','{{ $item->id }}',this)">{{ __('client.Rejected') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a style="cursor: pointer;"
                                                onclick="addContactCounter('no_phone_number','{{ $item->id }}',this)">
                                                <div class="border border-gray-300 border-dashed rounded py-1 px-1 text-center"
                                                    style="width: 110px;">
                                                    <div class="fs-5 fw-bolder text-gray-700">
                                                        <span class="w-50px fs-5">{{ $item->no_phone_call }}</span>
                                                        <span class="svg-icon svg-icon-3 svg-icon-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24"
                                                                fill="currentColor">
                                                                <rect opacity="0.8" x="11" y="18" width="12"
                                                                    height="2" rx="1"
                                                                    transform="rotate(-90 11 18)" fill="currentColor">
                                                                </rect>
                                                                <rect x="6" y="11" width="12" height="2"
                                                                    rx="1" fill="currentColor"></rect>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="fw-bold text-muted fs-8">
                                                        {{ $item->no_phone_call_date }}
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        
                                        <td class="text-end nowrap">
                                            <a href="{{ route('client.show', $item->id) }}"
                                                class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary">
                                                <i class="ki-duotone ki-eye fs-1" data-bs-toggle="tooltip"
                                                    title="View">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </a>
                                            @if($userType)
                                            <button
                                                class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary"
                                                onclick="openModalBox('modal_large','{{ route('client.edit', $item->id) }}','{{ __('client.Edit Client') }}')">
                                                <i class="ki-duotone ki-pencil fs-1" data-bs-toggle="tooltip"
                                                    title="Edit">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger "
                                                onclick="deleteSweerAlert('{{ __('client.This client has been deleted') }}.','{{ route('client.destroy', $item->id) }}','{{ route('client.index') }}')"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete" data-kt-initialized="1">
                                                <span class="svg-icon svg-icon-2" data-bs-toggle="tooltip"
                                                    title="{{ __('client.Delete') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                            fill="currentColor"></path>
                                                        <path opacity="0.5"
                                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                            fill="currentColor"></path>
                                                        <path opacity="0.5"
                                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                            fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <script>
        function addContactCounter(status, contactsId, obj) {
            valueCount = obj.children[0].children[0].children[0].textContent;
            valueCount++;
            var value = {
                status: status,
                value: valueCount,
                contacts_id: contactsId
            };
            $.ajax({
                type: 'GET',
                url: "{{ route('clinet_counter') }}",
                data: value,
                success: function(result) {
                    value = obj.children[0].children[0].children[0].textContent;
                    value++;
                    obj.children[0].children[0].children[0].textContent = value;
                    const d = new Date();
                    month = d.getMonth() + 1;
                    obj.children[0].children[1].textContent = +month + "/" + d.getDate() + "/" + d
                        .getFullYear() + " " + " " + formatAMPM(new Date);

                }
            });
        }

        function formatAMPM(date) {

            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + seconds + ' ' + ampm;
            //   var strTime = hours + ':' + minutes + ':' +  seconds;
            return strTime;
        }

        function clientStatusUpdate(status, id, obj) {
            if (status == "Inactive" || status == "Rejected") {
                obj.parentElement.parentElement.previousElementSibling.classList.remove('badge-light-primary');
                obj.parentElement.parentElement.previousElementSibling.classList.add('badge-light-danger');
            } else {
                obj.parentElement.parentElement.previousElementSibling.classList.add('badge-light-primary');
                obj.parentElement.parentElement.previousElementSibling.classList.remove('badge-light-danger');
            }
            obj.parentElement.parentElement.parentElement.children[0].textContent = status;
            obj.parentElement.parentElement.parentElement.children[1].classList.remove('show');
            var value = {
                status: status,
                contacts_id: id,
                _token: '{{ csrf_token() }}',
            };
            $.ajax({
                url: "{{ route('client_status_update') }}",
                method: 'POST',
                data: value,

                success: function(result) {

                }
            });
        }
    </script>
</x-app-layout>
