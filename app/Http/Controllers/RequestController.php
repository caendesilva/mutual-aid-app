<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use Illuminate\Support\Facades\Redirect;

/**
 * @deprecated
 */
class RequestController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Request::class, 'request');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $langKey = strtolower(implode('.', ['frontend.project', 'request', 'index.']));
        view()->share(['langKey' => $langKey]);
        return view('project.index', [
            'modelName' => 'request',
            'models' => Request::orderByDesc('created_at')->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create view with a new Request model.
        // While it is not yet persisted in the database, this is 
        // helpful as it unifies the state of the reusable form component.
        return view('request.create', [
            'model' => new Request
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestRequest $request)
    {
        // The incoming request is validated

        $validated = $request->validated();
        $model = Request::create($validated);
        return Redirect::to(route('requests.show', $model));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('request.show', ['request' => $request]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('request.edit', ['model' => $request]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestRequest  $formRequest
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestRequest $formRequest, Request $request)
    {
        // The incoming request is validated
        
        $validated = $formRequest->validated();
        $request->update($validated);
        return Redirect::to(route('requests.show', $request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
