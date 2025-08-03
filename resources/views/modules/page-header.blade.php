<div class="text-center">
    <h4 class="mb-3 mb-md-0 ">{{ $mainHeader }}</h4>
</div>
<div class="clearfix mb-3"></div>
@if ($parentPath && $parentPage && $currentPage)
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ $parentPath }}">{{ $parentPage }}</a></li>
            <li class="breadcrumb-item active">{{ $currentPage }}</li>
        </ol>
    </nav>
@endif
