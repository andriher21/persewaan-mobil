<?php

namespace App\Http\Controllers;

use App\Models\Mobils;
use App\Http\Requests\StoreMobilsRequest;
use App\Http\Requests\UpdateMobilsRequest;
use Illuminate\Http\Request;

class MobilsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        if(!empty($search)){
            $data= Mobils::where('mobils.id','like','%'.$search.'%')
            ->orwhere('mobils.model','like','%'.$search.'%')
            ->paginate(10)->fragment('std');
        }
        else{
            $data = Mobils::paginate(10);
        }
        
        return view('mobil.data')->with([
            'mobil' => $data,
            'search' => $search,
        ]);
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
    public function store(StoreMobilsRequest $request)
    {
        $validate =$request->validated();
        $mobil= New Mobils;
        $mobil->merek = $request->merek;
        $mobil->model = $request->model;
        $mobil->no_plat= $request->no_plat;
        $mobil->harga= $request->harga;
        $mobil->save();

        return redirect('mobil')->with('msg','Add New Succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mobils $mobils)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mobils $mobils)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMobilsRequest $request,  $id)
    {
        $mobil = New Mobils;
        $data = $mobil->find($id);
        $data->merek = $request->merek;
        $data->model = $request->model;
        $data->no_plat= $request->no_plat;
        $data->harga= $request->harga;
        $data->save();

        return redirect('mobil')->with('msg','Data Mobil'.$data->name.' Berhasil diUpdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mobils $mobils)
    {
        //
    }
}
