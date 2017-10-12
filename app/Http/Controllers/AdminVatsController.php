<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Vat;
use App\Http\Requests;

class AdminVatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $vats = Vat::all();

        return view('admin.lists.vat.index', compact('vats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.lists.vat.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $this->validate($request, [
        'vat_code' => 'required|unique:vats',
        'rate' => 'required',
        ]);

        Vat::create($request->all());
        return redirect('/admin/lists/vat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.lists.vat.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $vat = Vat::findOrFail($id);
        return view('admin.lists.vat.index', compact('vat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
        'vat_code' => 'required|unique:vats,vat_code,'. $id,
        'rate' => 'required',
        ]);
        $vat = Vat::findOrFail($id);
        $input = $request->all();
        $vat->update($input);
        return redirect('/admin/lists/vat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $vat = Vat::findOrFail($id);

        $vat->delete();

        Session::flash('deleted_vat','The vat code has been deleted');

        return redirect('/admin/lists/vat');
    }
}
