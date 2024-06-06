<?php

namespace App\Http\Controllers;

use App\Models\BTS;
use Illuminate\Http\Request;

class BTSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Getting Data
        $data = BTS::get();

        return view("pages.bts.index", compact("data"));
    }

    // to create
    public function insert(Request $request) {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BTS $bTS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BTS $bTS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BTS $bTS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BTS $bTS)
    {
        //
    }
}
