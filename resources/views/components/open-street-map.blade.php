<iframe class="w-auto mt-3" width="425" height="256" frameborder="0" scrolling="no" marginheight="0"
    marginwidth="0"
    src="{{ $mapSource }}"
    style="border: 1px solid black">
</iframe>
<small>
    <a href="https://www.openstreetmap.org/#map=11/{{ $mapData->lat }}/{{ $mapData->lon }}"
        title="Links to external site">Show bigger map</a>
</small>
<!--
    Map Data:
    {{ print_r((array) $mapData) }}
-->