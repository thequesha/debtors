<div class="d-flex flex-row">
    <div class="dropdown">
        <button class="btn p-0" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
            {{-- edit section --}}
            {{-- @can('edit_administrators') --}}
            <a href="{{ route('users.edit', $user) }}" class="dropdown-item d-flex align-items-center">
                <i data-feather="edit-2" class="icon-sm mr-2"></i>
                <span class="">Изменить</span>
            </a>
            {{-- @endcan --}}
            {{-- @can('delete_administrators') --}}
            @if (!$user->trashed())
                <button class="dropdown-item d-flex align-items-center" type="button" data-toggle="modal"
                    data-target="#deleteModal" data-administrator="{{ $user->id }}" data-name="{{ $user->name }}">
                    <i data-feather="trash" class="icon-sm mr-2"></i>
                    <span class="">Уволить</span>
                </button>
            @endif
            {{-- @endcan --}}
        </div>
    </div>
</div>
