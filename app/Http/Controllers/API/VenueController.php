<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\VenueUpdateRequest;
use App\Models\Venue;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //Get all venues
        $venues = Venue::all();

        return response()->json($venues, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store()
    {
        $image = request()->file('image')->store('uploads', 'public');
        $attributes = request()->validate([
            'name'        => 'required',
            'alias'       => 'required',
            'status'      => 'required',
            'description' => 'required',
            'image'       => 'required|image'
        ]);
        $attributes['user_id'] = auth()->id();
        $attributes['department_id'] = auth()->user();
        $attributes['image'] = Storage::disk('public')->url($image);

        // dd(auth()->user()->lname);

        Venue::create($attributes);
        // https://webportalapp.com/sp/login/heagrantapplicationhttps://webportalapp.com/sp/login/heagrantapplication
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //Show venues by id
        $venue = Venue::findOrFail($id);
        return response()->json($venue, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Venue  $venue
     * @param  VenueUpdateRequest  $request
     * @return Response
     */
    public function update(Venue $venue, VenueUpdateRequest $request): Response
    {
        $validated = $request->validated();

        if (isset($validated['image'])) {
            $validated['image']->store('uploads');
            $validated['image'] = $validated['image']->store('uploads', 'public');
        }

        abort_unless($venue->fill($validated)->save(), 500, 'Failed to update venue.');

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //Delete venues
        $venue = Venue::findOrFail($id);
        $venue->delete();
    }

}
