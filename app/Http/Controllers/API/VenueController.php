<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all venues
        $venues = Venue::all();
        
        return response()->json($venues,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
      

        $image=request()->file('image')->store('uploads','public');
        $attributes= request()->validate([
            'name' =>'required',
            'alias'=>'required',
            'status'=>'required',
            'description'=>'required',
            'image'=>'required|image'
        ]);
        $attributes['user_id']=auth()->id();
        $attributes['department_id']=auth()->user();
        $attributes['image']=Storage::disk('public')->url($image);
    
        // dd(auth()->user()->lname);

        Venue::create($attributes);
        // https://webportalapp.com/sp/login/heagrantapplicationhttps://webportalapp.com/sp/login/heagrantapplication
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show venues by id
        $venue = Venue::findOrFail($id);
        return response()->json($venue,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Venue $venue)
    {
        // $file =request()->file('image');  
        // $imagename= Str::random(7).'_'.$file->getClientOriginalName();
        // $path=$file->store('uploads/'.$imagename,'public');
        $attributes= request()->validate([
            'name' =>'required',
            'alias'=>'required',
            'status'=>'required',
            'description'=>'required',
            'image'=>'image'
        ]);
        if(isset($attributes['image'])){
            $attributes['image']=Storage::disk('public')->url(request()->file('image')->store('uploads','public'));
        }
        // $venue->update($attributes);
        dd($attributes);
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete venues
        $venue = Venue::findOrFail($id);
        $venue->delete();
    }

}
