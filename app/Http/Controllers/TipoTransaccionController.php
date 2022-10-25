<?php

namespace App\Http\Controllers;

use App\DataTables\TipoTransaccionDataTable;
use App\Models\TipoTransaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TipoTransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TipoTransaccionDataTable $dataTable)
    {
        return $dataTable->render('tipo-transacciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo-transacciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo'=>'required|string|max:255|unique:tipo_transaccions,codigo',
            'nombre'=>'required|string|max:255|unique:tipo_transaccions,nombre',
            'detalle'=>'nullable|string|max:255',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'tipo'=>'required|in:INGRESO,SALIDA,DEBITO,ABONO',
            'descripcion'=>'nullable|string|max:255|',
        ]);
        TipoTransaccion::create($request->all());
        Session::flash('success','Tipo de transacción ingresado.');
        return redirect()->route('tipo-transacciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoTransaccion  $tipoTransaccion
     * @return \Illuminate\Http\Response
     */
    public function show(TipoTransaccion $tipoTransaccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoTransaccion  $tipoTransaccion
     * @return \Illuminate\Http\Response
     */
    public function edit($tipoTransaccionId)
    {
        $tipoTransaccion=TipoTransaccion::findOrFail($tipoTransaccionId);
        return view('tipo-transacciones.edit',['tt'=>$tipoTransaccion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoTransaccion  $tipoTransaccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tipoTransaccionId)
    {
        $request->validate([
            'codigo'=>'required|string|max:255|unique:tipo_transaccions,codigo,'.$tipoTransaccionId,
            'nombre'=>'required|string|max:255|unique:tipo_transaccions,nombre,'.$tipoTransaccionId,
            'detalle'=>'nullable|string|max:255',
            'estado'=>'required|in:ACTIVO,INACTIVO',
            'tipo'=>'required|in:INGRESO,SALIDA,DEBITO,ABONO',
            'descripcion'=>'nullable|string|max:255|',
        ]);
        $tipoTransaccion=TipoTransaccion::findOrFail($tipoTransaccionId);
        $tipoTransaccion->update($request->all());
        Session::flash('success','Tipo de transacción actualizado.');
        return redirect()->route('tipo-transacciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoTransaccion  $tipoTransaccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($tipoTransaccionId)
    {
        $tipoTransaccion=TipoTransaccion::findOrFail($tipoTransaccionId);
        try {
            $tipoTransaccion->delete();
            Session::flash('success','Tipo de transacción eliminado.');
        } catch (\Throwable $th) {
            Session::flash('info','Tipo de transacción no eliminado.');
        }
        return redirect()->route('tipo-transacciones.index');
    }
}
