<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;

class OfferController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Offer::class, 'offer');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get tne language key for the model
        $langKey = strtolower(implode('.', ['frontend.project', 'offer', 'index.']));
        view()->share(['langKey' => $langKey]);

        // Handle the religious providers filter and form

        // Does the request include the checkbox data, or is a cookie set?
        if (request()->has('includeReligiousProviders') || request()->cookie('includeReligiousProviders')) {
            $offers = Offer::orderByDesc('created_at')->paginate();
            Cookie::queue('includeReligiousProviders', true, 2592000);
            $includeReligiousProviders = true;
        } else {
            Cookie::queue('includeReligiousProviders', false, 2592000);
            $offers = Offer::where('is_religious', '!=', true)->orderByDesc('created_at')->paginate();
        }

        // If the checkbox has been disabled, set the state to false
        if (request()->has('toggleUserPreference') && !request()->has('includeReligiousProviders')) {
            Cookie::queue('includeReligiousProviders', false, 2592000);
            $includeReligiousProviders = false;
        }

        // Return the view
        return view('project.index', [
            'modelName' => 'offer',
            'models' => $offers,
            'includeReligiousProviders' => $includeReligiousProviders ?? false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create view with a new Offer model.
        // While it is not yet persisted in the database, this is 
        // helpful as it unifies the state of the reusable form component.
        return view('offer.create', [
            'model' => new Offer
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferRequest $request)
    {
        // The incoming request is validated
        
        $validated = $request->validated();
        $model = Offer::create($validated);
        return Redirect::to(route('offers.show', $model));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return view('offer.show', ['offer' => $offer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        return view('offer.edit', ['model' => $offer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfferRequest  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $validated = $request->validated();
        $offer->update($validated);
        return Redirect::to(route('offers.show', $offer));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
