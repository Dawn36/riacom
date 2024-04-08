<x-app-layout>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">{{ __('lead.Leads List') }}</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">{{ __('lead.Home') }}</a>
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
                                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13 search" placeholder="{{ __('lead.Search ...') }}" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="btn btn-primary" onclick="openModalBox('modal_large','{{ route('lead.create') }}','{{ __('lead.Add Lead') }}')">
                                    <i class="ki-outline ki-plus fs-2"></i>{{ __('lead.Add Lead') }}</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 kt_datatable_example_1" id="kt_datatable_example_1">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 nowrap">
                                    <th>{{ __('lead.Name & Email') }}</th>
                                    <th>{{ __('lead.Type of Service') }}</th>
                                    <th>{{ __('lead.District') }}</th>
                                    <th class="min-w-300px">{{ __('lead.Message') }}</th>
                                    <th>{{ __('lead.Status') }}</th>
                                    <th>{{ __('lead.Creation date') }}</th>
                                    <th>{{ __('lead.User') }}</th>
                                    <th class="text-end min-w-100px"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($lead as $item)
                                <tr>
                                    <td>
                                        <a class="fw-bolder text-gray-800 text-hover-primary mb-1">{{ $item->name }}</a>
                                        <a href="mailto:{{ $item->email }}" class="fw-normal text-gray-700 text-hover-primary mb-1">{{ $item->email }}</a>
                                    </td>
                                    <td>
                                        {{ $item->type_of_service }}
                                    </td>
                                    <td>
                                        {{ $item->district }}
                                    </td>
                                    <td>
                                        {{ $item->message }}
                                    </td>
                                    <td>
                                        <div class="badge badge-light-{{ $item->status == 'lead' ? 'warning' : 'primary' }} fw-bold">{{ $item->status == '' ? '' : __('lead.'.ucwords($item->status)) }}</div>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->user_name }}</td>
                                    <td class="text-end nowrap">
                                        <button class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary" onclick="openModalBox('modal_large','{{ route('lead.edit',$item->id) }}','{{ __('lead.Edit Lead') }}')">
                                            <i class="ki-duotone ki-pencil fs-1" data-bs-toggle="tooltip" title="{{ __('lead.Edit Lead') }}">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger " onclick="deleteSweerAlert('{{ __('lead.This lead has been deleted') }}.','{{ route('lead.destroy',$item->id) }}','{{route('lead.index')}}')" data-bs-toggle="tooltip" title="{{ __('lead.Delete') }}" data-bs-placement="top">
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </button>
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
</x-app-layout>
