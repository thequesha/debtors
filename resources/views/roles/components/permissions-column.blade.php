<div class="">
    @foreach ($role->getPermissionNames() as $permission)
        <span class="badge badge-light">{{ $permission }}</span>
    @endforeach

</div>
