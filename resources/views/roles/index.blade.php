@extends('layouts.app')
@section('content')
    @include('modules.page-header-with-button', [
        'headerName' => 'Rollar',
        'buttonLabel' => 'Täze rol',
        'buttonRoute' => route('roles.create'),
        'havePermission' => auth()->user()->can('create_roles'),
    ])
    @include('partials.messages')



    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('roles.index.filter')
                    <div class="table">
                        <table id="rolesTable" class="table dataTable">
                            <thead>
                                <tr>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('permissions') }}</th>
                                    <th style=""></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- delete modal section --}}
    @include('roles.index.deleteModal')
@endsection


@push('js')
    @include('roles.index.script')
@endpush
