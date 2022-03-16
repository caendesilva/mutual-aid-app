<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Kolirt\Openstreetmap\Facade\Openstreetmap as OSM;

class OpenStreetMap extends Component
{
    public object|null $mapData = null;

    public string|null $boundingBox = null;

    public string|null $mapSource = null;

    /**
     * @todo use data from the geospatial index instead
     * 
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $search)
    {
        $result = OSM::search($search, 1);
        if (!$result) {
            return;
        }
        $this->mapData = $result[0];

        // We need to reorder the array because the OSM API does not return data in the same format it accepts.
        $array = $this->mapData->boundingbox;

        $a = $array[0];
        $b = $array[1];
        $c = $array[2];
        $d = $array[3];

        $boundingBox = [
            $d,
            $a,
            $c,
            $b,
        ];

        $this->boundingBox = implode(',', $boundingBox);
        // $this->boundingBox = $this->mapData->lon . "," . $this->mapData->lat;

        $this->mapSource = sprintf(
            "https://www.openstreetmap.org/export/embed.html?bbox=%s&amp;layer=mapnik",
            urlencode($this->boundingBox)
        );
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.open-street-map');
    }
}
