@extends('layouts.app')
@section('content')
    @include('modules.page-header-with-button', [
        'headerName' => 'Пользователи',
        'buttonLabel' => 'Новый пользователь',
        'buttonRoute' => route('users.create'),
        'havePermission' => true,
    ])

    @include('partials.messages')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @include('users.index.filter')

                    <div class="table">
                        <table id="administratorsTable" class="table dataTable">
                            <thead>
                                <tr>
                                    <th>ФИО</th>
                                    <th>Телефон</th>
                                    <th>Роль</th>
                                    <th>Статус</th>
                                    <th>Дата создания</th>
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
    @include('users.index.deleteModal')
@endsection


@push('js')
    @include('users.index.script')
@endpush
