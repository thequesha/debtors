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
        'mainHeader' => isset($user) ? 'Редактировать пользователя' : 'Добавить пользователя',
        'parentPage' => 'Пользователи',
        'parentPath' => route('users.index'),
        'currentPage' => isset($user) ? 'Редактировать пользователя' : 'Новый пользователь',
    ])

    @include('partials.messages')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">
                        Персональная информация
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @if (isset($user))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                @include('form-inputs.input', [
                                    'inputName' => 'surname',
                                    'attrName' => 'surname',
                                    'attrValue' => $user->surname ?? null,
                                    'label' => 'Фамилия',
                                    'required' => true,
                                    'type' => 'text',
                                    'inputId' => 'surname',
                                    'min' => false,
                                    'max' => false,
                                    'maxlength' => 120,
                                ])
                                @include('form-inputs.input', [
                                    'inputName' => 'name',
                                    'attrName' => 'name',
                                    'attrValue' => $user->name ?? null,
                                    'label' => 'Имя',
                                    'required' => true,
                                    'type' => 'text',
                                    'inputId' => 'name',
                                    'min' => false,
                                    'max' => false,
                                    'maxlength' => 120,
                                ])
                                @include('form-inputs.input', [
                                    'inputName' => 'middle_name',
                                    'attrName' => 'middle_name',
                                    'attrValue' => $user->middle_name ?? null,
                                    'label' => 'Отчество',
                                    'required' => false,
                                    'type' => 'text',
                                    'inputId' => 'middle_name',
                                    'min' => false,
                                    'max' => false,
                                    'maxlength' => 120,
                                ])

                                @include('form-inputs.date-select', [
                                    'inputName' => 'birth_date',
                                    'attrName' => 'birth_date',
                                    'attrValue' => isset($user) ? $user->birth_date?->format('d-m-Y') : null,
                                    'label' => 'Дата рождения',
                                    'required' => true,
                                    'inputId' => 'datePickerExample',
                                ])



                                @include('form-inputs.input', [
                                    'inputName' => 'phone',
                                    'attrName' => 'phone',
                                    'attrValue' => $user->phone ?? null,
                                    'label' => 'Номер телефона',
                                    'required' => true,
                                    'type' => 'text',
                                    'inputId' => 'phone',
                                    'min' => false,
                                    'max' => false,
                                ])

                                {{-- Username field removed as we're using phone-based authentication --}}
                                @include('form-inputs.input', [
                                    'inputName' => 'password',
                                    'attrName' => 'password',
                                    'attrValue' => null,
                                    'label' => 'Пароль',
                                    'required' => !isset($user),
                                    'type' => 'password',
                                    'inputId' => 'password',
                                    'min' => false,
                                    'max' => false,
                                    'maxlength' => 50,
                                ])
                            </div>

                            <div class="col-md-6">
                                @include('form-inputs.role-select', [
                                    'attrValue' => isset($user) ? $user->roles->pluck('id')->toArray() : [],
                                ])

                                @include('form-inputs.status-select', [
                                    'is_fired' => isset($user) ? $user->trashed() : false,
                                ])

                                @include('form-inputs.image', [
                                    'name' => 'image',
                                    'label' => 'Изображение',
                                    'image' => isset($user) ? $user->getFirstMediaUrl('users') : null,
                                    'resolution' => 'x',
                                    'required' => false,
                                ])

                                {{-- @include('form-items.checkbox', [
                                    'inputName' => 'is_active',
                                    'attrName' => 'is_active',
                                    'attrValue' => isset($user) ? $user->is_active : false,
                                    'label' => 'Активен',
                                    'required' => false,
                                ]) --}}
                            </div>



                            <div class="col-md-12 mt-4">
                                <div class="d-flex justify-content-between">
                                    @include('form-items.submit', [
                                        'text' => isset($user) ? 'Сохранить' : 'Создать',
                                    ])
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Отмена</a>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#roles, #status').select2();
    </script>
@endpush
