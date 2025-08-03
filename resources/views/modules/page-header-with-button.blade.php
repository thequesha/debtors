<div class="float-left">
    <h4>{{ $headerName }}</h4>
</div>
@if ($havePermission)
    <div class="d-flex align-items-center flex-wrap text-nowrap float-right">
        <a href="{{ $buttonRoute }}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
            <i data-feather="plus" class="create-new-plus-icon"></i> {{ $buttonLabel }}
        </a>
    </div>
@endif
<div class="clearfix mb-3"></div>
