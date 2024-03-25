<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                            View Product Details</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a class="text-muted">Product</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0">
                        <div class="card-title flex-column">
                            <h2 class="mb-1">Campaigns</h2>
                            <div class="fs-6 fw-semibold text-muted">Total {{ count($productDocumentCampaign) }} Campaign(s)</div>
                        </div>
                        @php 
                            $data = ['type' => 'Campaign','product_id' => $product->id];
                            $data = json_encode($data);
                        @endphp
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-sm btn-flex btn-light-primary" onclick="openModalBox('modal_large','{{ route('product-doc.create') }}','Add Campaign',{{ $data }})">
                                <i class="ki-outline ki-fasten fs-3"></i>Add Campaigns</button>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-3 kt_datatable_example_1">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-50px">Name</th>
                                        <th class="min-w-125px">Date Added</th>
                                        <th class="w-125px"></th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach ($productDocumentCampaign as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor" />
                                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <a href="#" class="text-gray-800 text-hover-primary">{{ $item->doc_name }}</a>
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
                                                            <a href="{{asset($item->path)}}" class="menu-link px-3" download="">Download File</a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link text-danger px-3" data-kt-filemanager-table-filter="delete_row" onclick="deleteSweerAlert('This document has been deleted.','{{ route('product-doc.destroy',$item->id) }}','{{route('product.show',$product->id)}}')">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0">
                        <div class="card-title flex-column">
                            <h2 class="mb-1">Documents</h2>
                            <div class="fs-6 fw-semibold text-muted">Total {{ count($productDocumentDocument) }}  document(s)</div>
                        </div>
                        @php 
                            $data = ['type' => 'Document','product_id' => $product->id];
                            $data = json_encode($data);
                        @endphp
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-sm btn-flex btn-light-primary" onclick="openModalBox('modal_large','{{ route('product-doc.create') }}','Add Document',{{ $data }})">
                                <i class="ki-outline ki-fasten fs-3"></i>Add Documents</button>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-3 kt_datatable_example_1">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-50px">Name</th>
                                        <th class="min-w-125px">Date Added</th>
                                        <th class="w-125px"></th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach ($productDocumentDocument as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor" />
                                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <a href="#" class="text-gray-800 text-hover-primary">{{ $item->doc_name }}</a>
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
                                                            <a href="{{asset($item->path)}}" class="menu-link px-3" download="">Download File</a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link text-danger px-3" data-kt-filemanager-table-filter="delete_row" onclick="deleteSweerAlert('This document has been deleted.','{{ route('product-doc.destroy',$item->id) }}','{{route('product.show',$product->id)}}')">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content-->
    </div>
</x-app-layout>