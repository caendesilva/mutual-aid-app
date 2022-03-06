<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Kolirt\Openstreetmap\Facade\Openstreetmap as OSM;

class OpenStreetMap extends Component
{
    public object $mapData;

    public string $boundingBox;
    
    public string $mapSource;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $search)
    {
        $this->mapData = OSM::search($search, 1)[0];

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

        $this->mapSource = "https://www.openstreetmap.org/export/embed.html?bbox=".urlencode($this->boundingBox)."&amp;layer=mapnik";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.open-street-map');
    }
}
