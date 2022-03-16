<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $listings = DB::table('geospatial_index')->where('for', 'listing')->get();

        foreach ($listings as $index) {
            if ($index->latitude == 0 && $index->longitude == 0) {
                // If the coordinates are invalid we do not add them to the array.
                continue;
            }
            $listing = Listing::findOrFail($index->model_id);
            $markers[] = [
                'lat' => $index->latitude,
                'lon' => $index->longitude,
                'label' => '<span class=\'map-listing-label\'>'. ($listing->type == "offer" ? '⛑️' : '🙋') . e($listing->subject).'</span> <a href=\''.route('listings.show', $listing).'\'>View Listing</a>',
                'type' => $listing->type,
            ];
        }

        return $markers;
    }
}
