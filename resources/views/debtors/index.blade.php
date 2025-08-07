@extends('layouts.app')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title mb-0">Должники</h3>
        <form method="POST" action="{{ route('debtors.generate') }}" class="ml-auto">
            @csrf
            <button type="submit" class="btn btn-primary mr-2">Создать 1000</button>
        </form>
        <form method="POST" action="{{ route('debtors.clear') }}">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить всех должников?')">Удалить
                всех</button>
        </form>

    </div>



    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('debtors.sheet') }}" class="mb-3">



        @csrf
        <div class="form-row align-items-top">
            <div class="col">
                <input type="url" name="url" value="{{ $sheetUrl?->url }}" class="form-control"
                    placeholder="Ссылка на Google Sheet" required>
                <small class="form-text text-muted">Перед использованием дайте доступ «Редактор» для
                    sheet-bot@test-ad4c7.iam.gserviceaccount.com</small>
            </div>
            <div class="col-auto">
                <button class="btn btn-success">Сохранить URL</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($debtors as $debtor)
                            <tr>
                                <td>{{ $debtor->name }}</td>
                                <td>
                                    <span class="badge badge-{{ $debtor->status === 'allowed' ? 'success' : 'danger' }}">
                                        {{ ucfirst($debtor->status) }}
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('debtors.destroy', $debtor) }}" class="d-inline" onsubmit="return confirm('Удалить этого должника?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">Должников не найдено.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $debtors->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
