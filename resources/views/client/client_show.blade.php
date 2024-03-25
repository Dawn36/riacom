<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                            View Client Details</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a class="text-muted">Clients</a>
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
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Summary-->
                                <!--begin::User Info-->
                                <div class="d-flex flex-center flex-column py-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        <img src="{{ asset($client->image) }}" alt="image" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $client->name }}</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="mb-9">
                                        <!--begin::Badge-->
                                        <div class="badge badge-lg badge-light-primary d-inline">
                                            Client</div>
                                        <!--begin::Badge-->
                                    </div>
                                    <!--end::Position-->
                                </div>
                                <!--end::User Info-->
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible">Details</div>
                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit customer details">
                                        <a href="#" class="btn btn-sm btn-light-primary" onclick="openModalBox('modal_large','{{ route('client.edit', $client->id) }}','Edit Client')">Edit</a>
                                    </span>
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details content-->
                                <div id="kt_user_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">
                                        <div class="fw-bold mt-5">Full Name</div>
                                        <div class="text-gray-600">{{ $client->name }}</div>
    
                                        <div class="fw-bold mt-5">Job Title</div>
                                        <div class="text-gray-600">{{ $client->job_title }}</div>
    
                                        <div class="fw-bold mt-5">Email</div>
                                        <div class="text-gray-600">
                                            <a class="text-gray-600 text-hover-primary">{{ $client->email }}</a>
                                        </div>
    
                                        <div class="fw-bold mt-5">Phone</div>
                                        <div class="text-gray-600">
                                            <a class="text-gray-600 text-hover-primary">{{ $client->phone }}</a>
                                        </div>
    
                                        <div class="fw-bold mt-5">Status</div>
                                        <div class="text-gray-600">
                                            <div class="badge badge-lg badge-light-success mt-1">{{ ucwords($client->status) }}</div>
                                        </div>
    
                                        <div class="fw-bold mt-5">Addresses</div>
                                        <div class="text-gray-600">
                                            @php
                                                $address=explode('||||', $client->address);
                                            @endphp
                                            <ol>
                                                @for($i=0; $i < count($address); $i++)
                                                <li>
                                                    <a class="text-gray-600 text-hover-primary">{{ $address[$i] }}</a>
                                                </li>
                                                @endfor
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Details content-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#tab_contracts">Contracts</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#tab_notes">Notes</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#tab_files">Files</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="tab_contracts" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card card-flush mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header mt-6">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h2 class="mb-1">Client's Contracts</h2>
                                            <div class="fs-6 fw-semibold text-muted">Total {{ count($contract) }} contract(s)</div>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-light-primary btn-sm" onclick="openModalBox('modal_large','{{ route('contract.create') }}','Add Contract','{{ $client->id }}')">
                                                <i class="ki-outline ki-tablet-book fs-3"></i>Add Contract</button>
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body p-9 pt-1">
                                        <div class="card-title">
                                            <div class="d-flex align-items-center position-relative">
                                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13 search" placeholder="Search contracts" />
                                            </div>
                                        </div>
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-3 kt_datatable_example_1">
                                                <thead>
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 nowrap">
                                                        <th>Contract</th>
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
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor" />
                                                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                                <a href="{{ route('contract.show',$item->id) }}" class="text-gray-800 text-hover-primary">{{ $item->name }}</a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-light-{{ $item->status == 'Active' ? 'success' : 'danger' }}">{{ $item->status }}</div>
                                                        </td>
                                                        <td>{{ $item->start_date }}</td>
                                                        <td>{{ $item->end_date }}</td>
                                                        <td>{{ $item->duration }} Months</td>
                                                        <td>{{ $item->type_of_service }}</td>
                                                        <td>{{ $item->p_name }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td class="text-end">
                                                            <a href="{{ route('contract.show',$item->id) }}" class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary">
                                                                <i class="ki-outline ki-eye fs-3" data-bs-toggle="tooltip" title="View"></i>
                                                            </a>
                                                            <button class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary">
                                                                <a href="{{asset($item->contract_path)}}" download=""><i class="ki-outline ki-cloud-download fs-3" data-bs-toggle="tooltip" title="Download"></i></a>
                                                            </button>
                                                            @if($userType)
                                                            <button type="button" class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger" onclick="deleteSweerAlert('This contract has been deleted.','{{ route('contract.destroy', $item->id) }}','{{ route('client.show',$client->id) }}')" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete" data-bs-original-title="Delete" data-kt-initialized="1">
                                                                <i class="ki-outline ki-trash fs-3" data-bs-toggle="tooltip" title="Delete"></i>
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
                            <!--end:::Tab pane-->
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade" id="tab_notes" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card card-flush mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header mt-6">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h2 class="mb-1">Client's Notes</h2>
                                            <div class="fs-6 fw-semibold text-muted">Total {{ count($clientNote) }} note(s) in
                                                backlog</div>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-light-primary btn-sm" onclick="openModalBox('modal_large','{{ route('client-note.create') }}','Add Note' ,'{{ $client->id }}')">
                                                <i class="ki-outline ki-add-files fs-3"></i>Add Note</button>
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-column">
                                        <!--begin::Item-->
                                        @foreach ($clientNote as $item)
                                        <div class="d-flex align-items-center position-relative mb-10">
                                            <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                            </div>
                                            <div class="fw-semibold ms-5">
                                                <a href="#" class="fs-6 fw-semibold text-dark text-hover-primary">{{ $item->note }}</a>
                                                <div class="fs-7 text-muted">Added on {{ $item->created_at }} by
                                                    <a href="#">{{ $item->user_name }}</a>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger" onclick="deleteSweerAlert('This note has been deleted.','{{ route('client-note.destroy', $item->id) }}','{{ route('client.show',$client->id) }}')" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete" data-bs-original-title="Delete" data-kt-initialized="1">
                                                <i class="ki-outline ki-trash fs-3" data-bs-toggle="tooltip" title="Delete"></i>
                                            </button>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade" id="tab_files" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h2 class="mb-1">Client's Files</h2>
                                            <div class="fs-6 fw-semibold text-muted">Total {{ count($clientFile) }} file(s)</div>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Filter-->
                                            <button type="button" class="btn btn-sm btn-flex btn-light-primary" onclick="openModalBox('modal_large','{{ route('client-file.create') }}','Add File','{{ $client->id }}')">
                                                <i class="ki-outline ki-fasten fs-3"></i>Add File</button>
                                            <!--end::Filter-->
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-3 kt_datatable_example_1">
                                                <thead>
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-50px">Name</th>
                                                        <th class="min-w-125px">Date Added</th>
                                                        <th class="w-125px"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-600">
                                                    @foreach ($clientFile as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor" />
                                                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                                <a href="#" class="text-gray-800 text-hover-primary">{{ $item->name }}</a>
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td class="text-end" data-kt-filemanager-table="action_dropdown">
                                                            <div class="d-flex justify-content-end">
                                                                <div class="ms-2">
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-300px" data-kt-menu="true">
                                                                        <div class="card card-flush">
                                                                            <div class="card-body p-5">
                                                                                <div class="d-flex flex-column text-start">
                                                                                    <div class="d-flex mb-3">
                                                                                        <span class="svg-icon svg-icon-2 svg-icon-success me-3">
                                                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                <path d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z" fill="currentColor" />
                                                                                            </svg>
                                                                                        </span>
                                                                                        <div class="fs-6 text-dark">Share Link Generated</div>
                                                                                    </div>
                                                                                    <input type="text" class="form-control form-control-sm" value="https://path/to/file/or/folder/" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-end">
                                                                        <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <rect x="10" y="10" width="4" height="4" rx="2" fill="currentColor" />
                                                                                <rect x="17" y="10" width="4" height="4" rx="2" fill="currentColor" />
                                                                                <rect x="3" y="10" width="4" height="4" rx="2" fill="currentColor" />
                                                                            </svg>
                                                                        </span>
                                                                    </button>
                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                                                                        <div class="menu-item px-3">
                                                                            <a href="{{ $item->path }}" class="menu-link px-3" download="">Download File</a>
                                                                        </div>
                                                                        <div class="menu-item px-3">
                                                                            <a href="#" class="menu-link text-danger px-3" onclick="deleteSweerAlert('This file has been deleted.','{{ route('client-file.destroy', $item->id) }}','{{ route('client.show',$client->id) }}')" data-kt-filemanager-table-filter="delete_row">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                            <!--end:::Tab pane-->
                        </div>
                        <!--end:::Tab content-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
</x-app-layout>
