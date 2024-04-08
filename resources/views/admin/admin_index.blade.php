<x-app-layout>
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-5 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack flex-wrap">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">{{ __('admin.Admins List') }}</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">{{ __('admin.Home') }}</a>
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
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13 search" placeholder="{{ __('admin.Search ...') }}" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <button type="button" class="btn btn-primary" onclick="openModalBox('modal_large','{{ route('user.create') }}','{{ __('admin.Add Admin') }}','admin')">
                                <i class="ki-outline ki-plus fs-2"></i>{{ __('admin.Add Admin') }}</button>
                        </div>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 kt_datatable_example_1" id="kt_datatable_example_1">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 no-wrap">
                                <th>{{ __('admin.Full Name') }}</th>
                                <th>{{ __('admin.Email & Phone') }}</th>
                                <th>{{ __('admin.Role') }}</th>
                                <th>{{ __('admin.Creation date') }}</th>
                                <th class="text-end min-w-100px"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($admin as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a>
                                                <div class="symbol-label">
                                                    <img src="{{ asset($item->profile_picture) }}" alt="Softixs" class="w-100">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-block">
                                            <a class="fw-bolder text-gray-800 text-hover-primary mb-1">{{ $item->name }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:{{ $item->email }}" class="fw-bold text-gray-800 text-hover-primary mb-1">{{ $item->email }}</a>
                                    <br>
                                    <a href="tel:(954) 820-6948" class="fw-normal text-gray-800 text-hover-primary mb-1">{{ $item->phone_number }}</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-primary fw-bold">{{ __('admin.Admin') }}</div>
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td class="text-end nowrap">
                                    <button class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary" onclick="openModalBox('modal_large','{{ route('user.edit',$item->id) }}','{{ __('admin.Edit Admin') }}')">
                                        <i class="ki-duotone ki-pencil fs-1" data-bs-toggle="tooltip" title="Edit">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger " onclick="deleteSweerAlert('{{ __('admin.This admin has been deleted') }}.','{{ route('user.destroy',$item->id) }}','{{route('admin')}}')" data-bs-toggle="tooltip" title="{{ __('admin.Delete') }}" data-bs-placement="top">
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