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
                            {{ __('contract.Contracts List') }}</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">{{ __('contract.Home') }}</a>
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
                                    placeholder="{{ __('contract.Search ...') }}" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button id="exportButton" type="button" class="btn btn-light-success me-3">
                                    <i class="ki-outline ki-cloud-download fs-2"></i>{{ __('contract.Export') }}</button>
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-outline ki-filter fs-2"></i>{{ __('contract.Filter') }}</button>
                                <div class="menu menu-sub menu-sub-dropdown w-500px w-md-525px" data-kt-menu="true" >
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">{{ __('contract.Filter Options') }}</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <form method="GET" action="{{ route('contract.index') }}" style="max-height: 300px; overflow: auto !important;">
                                        <div class="px-7 py-5" data-kt-user-table-filter="form">
                                            <div class="mb-10">
                                                <div class="row ">
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Start Date') }}</label>
                                                        <input class="form-control form-control-solid kt_datepicker_2"
                                                            value="{{ request()->start_date }}"
                                                            placeholder="{{ __('contract.Enter Start Date') }}" name="start_date" />
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.End Date') }}</label>
                                                        <input class="form-control form-control-solid kt_datepicker_2"
                                                            value="{{ request()->end_date }}"
                                                            placeholder="{{ __('contract.Enter End Date') }}" name="end_date" />
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Provider') }}</label>
                                                        <select id="provider_id" name="provider_id" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Provider') }}" {{ Auth::user()->hasRole('admin') == true ? 'onchange=providerUser()' : ''  }} data-allow-clear="true">
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
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Type of Service') }}</label>
                                                        <select id="type_of_service" name="type_of_service" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Type of Service') }}" data-allow-clear="true">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Monthly Fee in EUR €') }}</label>
                                                        <input type="tel" class="form-control form-control-solid" value="{{ request()->monthly_fee }}" placeholder="{{ __('contract.Enter Monthly Fee in EUR €') }}"
                                                        name="monthly_fee"  />
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Tension') }}</label>
                                                        <select id="tension" name="tension" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Tension') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="BTN" {{ request()->tension == 'BTN' ? 'selected' : '' }} >{{ __('contract.BTN') }}</option>
                                                            <option value="BTE" {{ request()->tension == 'BTE' ? 'selected' : '' }} >{{ __('contract.BTE') }}</option>
                                                            <option value="MT" {{ request()->tension == 'MT' ? 'selected' : '' }} >{{ __('contract.MT') }}</option>
                                                            <option value="AT" {{ request()->tension == 'AT' ? 'selected' : '' }} >{{ __('contract.AT') }}</option>
                                                            <option value="MAT" {{ request()->tension == 'MAT' ? 'selected' : '' }} >{{ __('contract.MAT') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Power') }}</label>
                                                        <select id="power" name="power" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Power') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="1,15" {{ request()->power == '1,15' ? 'selected' : '' }} >{{ __('contract.1,15') }}</option>
                                                            <option value="2,30" {{ request()->power == '2,30' ? 'selected' : '' }} >{{ __('contract.2,30') }}</option>
                                                            <option value="3,45" {{ request()->power == '3,45' ? 'selected' : '' }} >{{ __('contract.3,45') }}</option>
                                                            <option value="4,60" {{ request()->power == '4,60' ? 'selected' : '' }} >{{ __('contract.4,60') }}</option>
                                                            <option value="5,75" {{ request()->power == '5,75' ? 'selected' : '' }} >{{ __('contract.5,75') }}</option>
                                                            <option value="6,90" {{ request()->power == '6,90' ? 'selected' : '' }} >{{ __('contract.6,90') }}</option>
                                                            <option value="10,35" {{ request()->power == '10,35' ? 'selected' : '' }} >{{ __('contract.10,35') }}</option>
                                                            <option value="13,80" {{ request()->power == '13,80' ? 'selected' : '' }} >{{ __('contract.13,80') }}</option>
                                                            <option value="17,25" {{ request()->power == '17,25' ? 'selected' : '' }} >{{ __('contract.17,25') }}</option>
                                                            <option value="20,70" {{ request()->power == '20,70' ? 'selected' : '' }} >{{ __('contract.20,70') }}</option>
                                                            <option value="27,60" {{ request()->power == '27,60' ? 'selected' : '' }} >{{ __('contract.27,60') }}</option>
                                                            <option value="34,50" {{ request()->power == '34,50' ? 'selected' : '' }} >{{ __('contract.34,50') }}</option>
                                                            <option value="41,40" {{ request()->power == '41,40' ? 'selected' : '' }} >{{ __('contract.41,40') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Cicle') }}</label>
                                                        <select id="cicle" name="cicle" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Cicle') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="No cicle" {{ request()->cicle == 'No cicle' ? 'selected' : '' }} >{{ __('contract.No cicle') }}</option>
                                                            <option value="Daily" {{ request()->cicle == 'Daily' ? 'selected' : '' }} >{{ __('contract.Daily') }}</option>
                                                            <option value="Weekly" {{ request()->cicle == 'Weekly' ? 'selected' : '' }} >{{ __('contract.Weekly') }}</option>
                                                            <option value="Optional" {{ request()->cicle == 'Optional' ? 'selected' : '' }} >{{ __('contract.Optional') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Tariff') }}</label>
                                                        <select id="tariff" name="tariff" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Tariff') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Simple" {{ request()->tariff == 'Simple' ? 'selected' : '' }} >{{ __('contract.Simple') }}</option>
                                                            <option value="Bi-hourly" {{ request()->tariff == 'Bi-hourly' ? 'selected' : '' }} >{{ __('contract.Bi-hourly') }}</option>
                                                            <option value="Tri-hourly" {{ request()->tariff == 'Tri-hourly' ? 'selected' : '' }} >{{ __('contract.Tri-hourly') }}</option>
                                                            <option value="Tetra-hourly" {{ request()->tariff == 'Tetra-hourly' ? 'selected' : '' }} >{{ __('contract.Tetra-hourly') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Reception phase') }}</label>
                                                        <select id="reception_phase" name="reception_phase" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Reception phase') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Monofasic" {{ request()->reception_phase == 'Monofasic' ? 'selected' : '' }} >{{ __('contract.Monofasic') }}</option>
                                                            <option value="Trifasic" {{ request()->reception_phase == 'Trifasic' ? 'selected' : '' }} >{{ __('contract.Trifasic') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas pressure') }}</label>
                                                        <select id="gas_pressure" name="gas_pressure" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Gas pressure') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Low pressure" {{ request()->gas_pressure == 'Low pressure' ? 'selected' : '' }} >{{ __('contract.Low pressure') }}</option>
                                                            <option value="Mid pressure" {{ request()->gas_pressure == 'Mid pressure' ? 'selected' : '' }} >{{ __('contract.Mid pressure') }}</option>
                                                            <option value="High pressure" {{ request()->gas_pressure == 'High pressure' ? 'selected' : '' }} >{{ __('contract.High pressure') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas Scalation') }}</label>
                                                        <select id="gas_scalation" name="gas_scalation" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Gas Scalation') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="1" {{ request()->gas_scalation == '1' ? 'selected' : '' }} >{{ __('contract.1') }}</option>
                                                            <option value="2" {{ request()->gas_scalation == '2' ? 'selected' : '' }} >{{ __('contract.2') }}</option>
                                                            <option value="3" {{ request()->gas_scalation == '3' ? 'selected' : '' }} >{{ __('contract.3') }}</option>
                                                            <option value="4" {{ request()->gas_scalation == '4' ? 'selected' : '' }} >{{ __('contract.4') }}</option>
                                                            <option value="More than 10.000m3" {{ request()->gas_scalation == 'More than 10.000m3' ? 'selected' : '' }} >{{ __('contract.More than 10.000m3') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas Tariff') }}</label>
                                                        <select id="gas_tariff" name="gas_tariff" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Gas Tariff') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Short use" {{ request()->gas_tariff == 'Short use' ? 'selected' : '' }} >{{ __('contract.Short use') }}</option>
                                                            <option value="Long use" {{ request()->gas_tariff == 'Long use' ? 'selected' : '' }} >{{ __('contract.Long use') }}</option>
                                                            <option value="Monthly" {{ request()->gas_tariff == 'Monthly' ? 'selected' : '' }} >{{ __('contract.Monthly') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Energy Market') }}</label>
                                                        <select id="energy_market" name="energy_market" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Energy Market') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Indexed Market" {{ request()->energy_market == 'Indexed Market' ? 'selected' : '' }} >{{ __('contract.Indexed Market') }}</option>
                                                            <option value="Fixed Market" {{ request()->energy_market == 'Fixed Market' ? 'selected' : '' }} >{{ __('contract.Fixed Market') }}</option>
                                                            <option value="Mixed Market" {{ request()->energy_market == 'Mixed Market' ? 'selected' : '' }} >{{ __('contract.Mixed Market') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Gas Market') }}</label>
                                                        <select id="gas_market" name="gas_market" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Gas Market') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Indexed Market" {{ request()->gas_market == 'Indexed Market' ? 'selected' : '' }} >{{ __('contract.Indexed Market') }}</option>
                                                            <option value="Fixed Market" {{ request()->gas_market == 'Fixed Market' ? 'selected' : '' }} >{{ __('contract.Fixed Market') }}</option>
                                                            <option value="Mixed Market" {{ request()->gas_market == 'Mixed Market' ? 'selected' : '' }} >{{ __('contract.Mixed Market') }}</option>
                                                        </select>
                                                    </div>
                                                    @if(Auth::user()->hasRole('admin'))
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.User') }}</label>
                                                        <select id="user" name="user" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select User') }}" data-allow-clear="true">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    @endif
                                                    <div class="col-6">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('contract.Status') }}</label>
                                                        <select name="status" class="form-select form-select-solid"
                                                            data-control="select2" data-close-on-select="true"
                                                            data-placeholder="{{ __('contract.Select Status') }}" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="Active"
                                                                {{ request()->status == 'Active' ? 'selected' : '' }}>
                                                                {{ __('contract.Active') }}</option>
                                                            <option value="Closed"
                                                                {{ request()->status == 'Closed' ? 'selected' : '' }}>
                                                                {{ __('contract.Closed') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <a href="{{ route('contract.index') }}"
                                                    class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-user-table-filter="reset">{{ __('contract.Reset') }}</a>
                                                <button type="submit" class="btn btn-primary fw-semibold px-6"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-user-table-filter="filter">{{ __('contract.Apply') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <button type="button" class="btn btn-primary"
                                    onclick="openModalBox('modal_large','{{ route('contract.create') }}','{{ __('contract.Add Contract') }}')">
                                    <i class="ki-outline ki-plus fs-2"></i>{{ __('contract.Add Contract') }}</button>
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
                                        <th style="display: none">{{ __('contract.VAT number') }}</th>
                                        <th>{{ __('contract.Client') }}</th>
                                        <th style="display: none">{{ __('contract.Phone Number') }}</th>
                                        <th style="display: none">{{ __('contract.Email') }}</th>
                                        <th style="display: none">{{ __('contract.Address') }}</th>
                                        <th>{{ __('contract.Contract') }}</th>
                                        <th>{{ __('contract.Start Date') }}</th>
                                        <th>{{ __('contract.Duration') }}</th>
                                        <th>{{ __('contract.End Date') }}</th>
                                        <th>{{ __('contract.Renews in') }}</th>
                                        <th>{{ __('contract.Provider') }}</th>
                                        <th>{{ __('contract.Type of Service') }}</th>
                                        <th style="display: none">{{ __('contract.Monthly Fee') }}</th>
                                        <th style="display: none">{{ __('contract.Tension') }}</th>
                                        <th style="display: none">{{ __('contract.Power') }}</th>
                                        <th style="display: none">{{ __('contract.Cycle') }}</th>
                                        <th style="display: none">{{ __('contract.Tariff') }}</th>
                                        <th style="display: none">{{ __('contract.Reception Phase') }}</th>
                                        <th style="display: none">{{ __('contract.Gas pressure') }}</th>
                                        <th style="display: none">{{ __('contract.Gas scalation') }}</th>
                                        <th style="display: none">{{ __('contract.Gas tariff') }}</th>
                                        <th style="display: none">{{ __('contract.Energy market') }}</th>
                                        <th style="display: none">{{ __('contract.Gas market') }}</th>
                                        <th>{{ __('contract.Status') }}</th>
                                        <th style="display: none">{{ __('contract.User') }}</th>
                                        <th>{{ __('contract.Date Added') }}</th>
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
                                            <td>{{ $item->duration }} {{ __('contract.Months') }}</td>
                                            <td>{{ $item->end_date }}</td>
                                            <td>{{ $item->renews_in_date }}</td>
                                            <td>{{ $item->p_name }}</td>
                                            <td>{{ $item->type_of_service }}</td>
                                            <td style="display: none" >{{ $item->monthly_fee }}</td>
                                            <td style="display: none" >{{ __('contract.'.$item->tension) }}</td>
                                            <td style="display: none" >{{ __('contract.'.$item->power) }}</td>
                                            <td style="display: none" >{{ __('contract.'.$item->cycle) }}</td>
                                            <td style="display: none" >{{ __('contract.'.$item->tariff) }}</td>
                                            <td style="display: none" >{{ __('contract.'.$item->reception_phase) }}</td>
                                            <td style="display: none" >{{ __('contract.'.$item->gas_pressure) }}</td>
                                            <td style="display: none" >{{ __('contract.'.$item->gas_scalation) }}</td>
                                            <td style="display: none" >{{ __('contract.'.$item->gas_tariff) }}</td>
                                            <td style="display: none" >{{ __('contract.'.$item->energy_market) }}</td>
                                            <td style="display: none" >{{ __('contract.'.$item->gas_market) }}</td>
                                            <td>
                                                <div
                                                    class="badge badge-light-{{ $item->status == 'Active' ? 'success' : 'danger' }}">
                                                    {{ __('contract.'.$item->status) }}</div>
                                            </td>
                                            <td style="display: none">{{ $item->u_name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('contract.show', $item->id) }}"
                                                    class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary">
                                                    <i class="ki-outline ki-eye fs-3" data-bs-toggle="tooltip"
                                                        title="{{ __('contract.View') }}"></i>
                                                </a>
                                                <button
                                                    class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary">
                                                    <a href="{{ asset($item->contract_path) }}" download=""><i
                                                            class="ki-outline ki-cloud-download fs-3"
                                                            data-bs-toggle="tooltip" title="{{ __('contract.Download') }}"></i></a>
                                                </button>
                                                @if($userType)
                                                <button type="button"
                                                    class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger"
                                                    onclick="deleteSweerAlert('{{ __('contract.This contract has been deleted') }}.','{{ route('contract.destroy', $item->id) }}','{{ route('contract.index') }}')"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    aria-label="{{ __('contract.Delete') }}" data-bs-original-title="{{ __('contract.Delete') }}"
                                                    data-kt-initialized="1">
                                                    <i class="ki-outline ki-trash fs-3" data-bs-toggle="tooltip"
                                                        title="{{ __('contract.Delete') }}"></i>
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
