<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Handle the incoming request and display the map page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('map', [
            'markers' => $this->getMarkers()
        ]);
    }

    /**
     * Get the markers to display on the map.
     */
    public function getMarkers()
    {
        $markers = [];

        $markers[] = [
            'lat' => 40.7128,
            'lon' => -74.0060,
            'label' => 'New York',
        ];

        return $markers;
    }
}
