@if ($user->has('store'))
    <div class="row">
        {{ $user->store->name }}
    </div>
@endif
