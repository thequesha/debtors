<div class="">
    @if (!$user->trashed())
        <span class="badge badge-success">Активен</span>
    @else
        <span class="badge badge-danger">Уволен</span>
    @endif
</div>
