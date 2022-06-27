
@if(isset($show) || $show)
    <div>
    <span class="badge bg-primary badge-{{ $type ?? 'success' }} "> {{ $slot }}</span>
    </div>
@endif

