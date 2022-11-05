<?php

namespace App\Http\Controllers;

use App\DataTables\TipoCreditoDataTable;
use App\Models\TipoCredito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TipoCreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TipoCreditoDataTable $dataTable)
    {
        return $dataTable->render('tipo-creditos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo-creditos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";

        $request->validate([
            'codigo'=>'required|string|max:255|unique:tipo_creditos,codigo',
            'nombre'=>'required|string|max:255|unique:tipo_creditos,nombre',
            'tasa_efectiva_anual'=>'required|regex:'.$rg_decimal.'|gt:0',
            'tasa_nominal'=>'required|regex:'.$rg_decimal.'|gt:0',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'descripcion'=>'nullable|string|max:255'
        ]);
        TipoCredito::create($request->all());
        Session::flash('success','Tipo de crédito ingresado.!');
        return redirect()->route('tipo-creditos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoCredito  $tipoCredito
     * @return \Illuminate\Http\Response
     */
    public function show(TipoCredito $tipoCredito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoCredito  $tipoCredito
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoCredito $tipoCredito)
    {
        return view('tipo-creditos.edit',['tc'=>$tipoCredito]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoCredito  $tipoCredito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoCredito $tipoCredito)
    {
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";

        $request->validate([
            'codigo'=>'required|string|max:255|unique:tipo_creditos,codigo,'.$tipoCredito->id,
            'nombre'=>'required|string|max:255|unique:tipo_creditos,nombre,'.$tipoCredito->id,
            'tasa_efectiva_anual'=>'required|regex:'.$rg_decimal.'|gt:0',
            'tasa_nominal'=>'required|regex:'.$rg_decimal.'|gt:0',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'descripcion'=>'nullable|string|max:255'
        ]);
        $tipoCredito->update($request->all());
        Session::flash('success','Tipo de crédito actualizado.!');
        return redirect()->route('tipo-creditos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoCredito  $tipoCredito
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoCredito $tipoCredito)
    {
        try {
            $tipoCredito->delete();
            Session::flash('success','Tipo de crédito eliminado.!');
        } catch (\Throwable $th) {
            Session::flash('info','Tipo de crédito no eliminado.!');
        }
        return redirect()->route('tipo-creditos.index');
    }
}
