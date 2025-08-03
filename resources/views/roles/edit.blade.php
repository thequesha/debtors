@extends('layouts.app')

@push('css')
    <style>
        .col-md-6 .card {
            margin-bottom: 12px;
            border: #0c14274f 2px solid !important;
        }
    </style>
@endpush

@section('content')
    @include('modules.page-header', [
        'mainHeader' => 'Rollar',
        'parentPage' => 'Rollar',
        'parentPath' => route('roles.index'),
        'currentPage' => 'Rol üýtgetmek',
    ])

    @include('partials.messages')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('roles.update', $role) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                @include('form-inputs.input', [
                                    'inputName' => 'name',
                                    'attrName' => 'name',
                                    'attrValue' => $role->name,
                                    'label' => 'Ady',
                                    'required' => true,
                                    'type' => 'text',
                                    'inputId' => 'name',
                                    'max' => false,
                                    'min' => false,
                                ])
                            </div>

                            <div class="col-md-9">
                                <div class="pb-3">
                                    <label for="permissions"> Permissions
                                        <span class="required">*</span>
                                    </label>
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                            <div class="col-md-3">
                                                <div class="pb-2 pl-4">
                                                    @include('form-items.checkbox-withValue', [
                                                        'inputName' => 'permissions[]',
                                                        'attrValue' => $role->hasPermissionTo($permission->id),
                                                        'value' => $permission->id,
                                                        'label' => $permission->name,
                                                    ])
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                @include('form-items.submit', [
                                    'text' => 'Üýtgetmek',
                                ])
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
