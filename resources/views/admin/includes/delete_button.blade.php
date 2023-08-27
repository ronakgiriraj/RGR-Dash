<a href="javascript:void(0);" class="@if ($btn_type ?? '' === 'dropdown') dropdown-item @else btn-transparent @endif defaultDeleteModelBtn text-primary" delete-href="{{ $url }}">
    <i class="bx text-danger bx-trash me-1"></i>
    @if ($btn_type ?? '' === 'dropdown')
        <span class="text-danger">Delete</span>
    @endif
</a>


