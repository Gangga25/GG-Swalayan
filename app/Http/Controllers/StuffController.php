<?php

namespace App\Http\Controllers;

use App\Models\Stuff;
use App\Http\Requests\StoreStuffRequest;
use App\Http\Requests\UpdateStuffRequest;
use App\Models\Category;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
class StuffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stuffs = Stuff::with(['category'])->get();

        return view('stuff.list', [
            'data' => $stuffs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('stuff.add', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStuffRequest $request)
    {
        // dd($request);

        $path = $request->file('file')->store('stuff');

        $request->merge(['image' => $path]);
        Stuff::create($request->all());

        return redirect('/stuffs')->with([
            'mess' => 'Data Berhasil Disimpan',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stuff $stuff)
    {
        return view('stuff.add', [
            'data' => $stuff,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stuff $stuff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStuffRequest $request, Stuff $stuff)
    {
        $stuff->fill($request->all());
        $stuff->save();

        return redirect('/stuffs')->with([
            'mess' => 'Data Berhasil Disimpan',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stuff $stuff)
    { 
        Storage::delete($stuff->image);

        $stuff->delete();

        return redirect('/stuffs')->with([
            'mess' => 'Data Berhasil Dihapus',
        ]);
    }
}
