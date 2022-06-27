<p class="text-muted">
    {{ empty((string) $slot) ? 'Added ' : $slot }} {{ (is_string($date) ? now()::parse($date) : $date)->diffForHumans() }}
    @if (isset($name))
        by {{ $name }}
    @endif
</p>


{{--<p class="text-muted">--}}
{{--    {{ empty(trim($slot)) ? 'Added ' : $slot }} {{ $date->diffForHumans() }}--}}
{{--    @if(isset($name))--}}
{{--        by {{ $name }}--}}
{{--    @endif--}}
{{--</p>--}}
