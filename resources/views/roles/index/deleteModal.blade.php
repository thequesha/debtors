<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">{{ __('delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- <div class="modal-body"> --}}

            {{-- </div> --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('close') }}</button>
                {{-- <button type="button" class="btn btn-primary">Send message</button> --}}
                <form id='deleteForm' method="post" class="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger d-flex align-items-center" href="#">
                        <i data-feather="trash" class="icon-sm mr-2"></i>
                        <span class="">{{ __('delete') }}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
