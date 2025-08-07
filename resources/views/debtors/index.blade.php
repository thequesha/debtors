@extends('layouts.app')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title mb-0">Должники</h3>
        <form method="POST" action="{{ route('debtors.generate') }}" class="ml-auto">
            @csrf
            <button type="submit" class="btn btn-primary">Создать 1000</button>
        </form>


    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Статус</th>
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
