<div class="">
    @foreach ($user->getRoleNames() as $role)
        <span class="badge badge-light">{{ $role }}</span>
    @endforeach

</div>
