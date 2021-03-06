<?php

namespace App\Http\Controllers;

use App\Events\ListingCreated;
use Illuminate\Support\Facades\App;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Http\Livewire\ListingIndex;
use App\Http\Livewire\UpdateListingPage;
use App\Jobs\UpdateListingsGeospatialIndexEntry;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ListingController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['index', 'show']);
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return App::call([new ListingIndex(), '__invoke']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        switch ($request->get('type') ?? null) {
            case 'offer':
                $type = 'offer';
                $Type = 'Offer';
                break;
            case 'request':
                $type = 'request';
                $Type = 'Request';
                break;
            default:
                $type = false;
                break;
        }

        return view('listing.listing-create-page', [
            'type' => $type,
            'Type' => $Type ?? null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreListingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListingRequest $request)
    {
        $validated = $request->validated();

        $listing = Auth::user()->listings()->create($validated);

        if ($validated['is_religious'] ?? false) {
            $listing->metadata = (object) ['is_religious' => true];
            $listing->save();
        }

        ListingCreated::dispatch($listing);
        UpdateListingsGeospatialIndexEntry::dispatch($listing);
        return Redirect::to(route('listings.show', $listing));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view('listing.show', [
            'listing' => $listing,
            'type' => $listing->type,
            'Type' => ucfirst($listing->type),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Listing $listing)
    {
        $component = new UpdateListingPage();
        if ($request->has('confirmingModelDeletion')) {
            $component->confirmingListingDeletion = true;
        }
        return App::call([$component, '__invoke']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateListingRequest  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateListingRequest $request, Listing $listing)
    {
        $validated = $request->validated();
        $listing->update($validated);
        
        UpdateListingsGeospatialIndexEntry::dispatch($listing);
        return Redirect::to(route('listings.show', $listing));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->route('listings.index')->banner('Listing deleted successfully.');
    }
}
