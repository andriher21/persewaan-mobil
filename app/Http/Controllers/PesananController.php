<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Http\Requests\StorePesananRequest;
use App\Http\Requests\UpdatePesananRequest;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        if(!empty($search)){
            $data= Pesanan::where('mobils.id','like','%'.$search.'%')
            ->orwhere('mobils.model','like','%'.$search.'%')
            ->paginate(10)->fragment('std');
        }
        else{
            $data = Pesanan::paginate(10);
        }
        
        return view('pesanan.data')->with([
            'pesanan' => $data,
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
    public function store(StorePesananRequest $request)
    {
        $validate =$request->validated();
        $pesanan = New Pesanan;
        $pesanan->merek = $request->merek;
        $pesanan->model = $request->model;
        $pesanan->no_plat= $request->no_plat;
        $pesanan->harga= $request->harga;
        $pesanan->save();

        return redirect('mobil')->with('msg','Add New Succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePesananRequest $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }
}
