<?php

namespace App\Http\Controllers;

use App\DataTables\Transaccion\CuentaUserDataTable;
use App\DataTables\TransaccionDataTable;
use App\Http\Requests\Transaccion\RqActualizar;
use App\Http\Requests\Transaccion\RqGuardar;
use App\Models\TipoTransaccion;
use App\Models\Transaccion;
use App\Rules\ValidarTransaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransaccionDataTable $dataTable)
    {
        return $dataTable->render('transacciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CuentaUserDataTable $dataTable)
    {
        $data = array(
            'tipoTransacciones' => TipoTransaccion::where('estado','ACTIVO')->get(),
        );
        return $dataTable->render('transacciones.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RqGuardar $request)
    {
        $data = array(
            'valor_efectivo'=>$request->valor_efectivo,
            'valor_cheque'=>$request->valor_cheque,
            'estado'=>'ACTIVO',
            'detalle'=>$request->detalle,
            'cuenta_user_id'=>$request->cuentaUser,
            'tipo_transaccion_id'=>$request->tipoTransaccion,
        );

        try {
            DB::beginTransaction();
            $t=Transaccion::create($data);
            DB::commit();
            Session::flash('success','Transacción realizado');
            return redirect()->route('transacciones.show',$t);
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('info','Transacción no realizado'.$th->getMessage());
            return redirect()->back()->withInput();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function show($transaccionId)
    {
        $transaccion=Transaccion::findOrFail($transaccionId);
        $data = array(
            'trans' => $transaccion,
            'ultimos_trans'=>$transaccion->cuentaUser->transacciones()->where('id','<',$transaccion->id)->latest()->take(3)->get()
        );
        return view('transacciones.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function edit($transaccionId)
    {
        $transaccion=Transaccion::findOrFail($transaccionId);

        $data = array(
            'trans' => $transaccion,
            'tipoTransacciones' => TipoTransaccion::where('estado','ACTIVO')->get(),
        );
        return view('transacciones.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function update(RqActualizar $request,$transaccionId)
    {
        $data = array(
            'estado'=>$request->estado,
            'detalle'=>$request->detalle
        );

        try {
            DB::beginTransaction();
            $t=Transaccion::findOrFail($transaccionId);
            if($t->estado=='ACTIVO'){
                $t->update($data);
                switch ($t->tipoTransaccion->tipo) {
                    case 'SALIDA':
                    case 'DEBITO':
                        $t->cuentaUser->valor_disponible=$t->cuentaUser->valor_disponible+$t->total_efectivo_cheque;   
                        break;
                    
                    case 'ABONO':
                    case 'INGRESO':
                        $t->cuentaUser->valor_disponible=$t->cuentaUser->valor_disponible-$t->total_efectivo_cheque;   
                        break;
                    default:
                        # code...
                        break;
                }
                $t->cuentaUser->save();
                $t->valor_disponible=$t->cuentaUser->valor_disponible;
                $t->save();
            }

            DB::commit();
            Session::flash('success','Transacción actualizado');
            return redirect()->route('transacciones.show',$t);
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('info','Transacción no actualizado');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaccion  $transaccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaccion $transaccion)
    {
        //
    }

    public function imprimirRecibo($transaccionId)
    {
        $transaccion=Transaccion::findOrFail($transaccionId);

        $data = array(
            'trans'=>$transaccion,
            'ultimos_trans'=>$transaccion->cuentaUser->transacciones()->where('id','<',$transaccion->id)->latest()->take(3)->get()
        );
        $pdf = PDF::loadView('transacciones.imprimir-recibo', $data)
        ->setOption('page-width', '78')
        ->setOption('page-height', '62')
        ->setOption('margin-top', 2)
        ->setOption('margin-bottom', 2)
        ->setOption('margin-left', 2)
        ->setOption('margin-right', 2);
        return $pdf->inline('Recibo N° '.$transaccion->numero);
    }

    public function imprimirComprobante($transaccionId)
    {
        $transaccion=Transaccion::findOrFail($transaccionId);
        $data = array(
            'trans'=>$transaccion,
            'ultimos_trans'=>$transaccion->cuentaUser->transacciones()->where('id','<',$transaccion->id)->latest()->take(3)->get()
        );
        $pdf = PDF::loadView('transacciones.imprimir-comprobante', $data)
        ->setOption('page-width', '163')
        ->setOption('page-height', '62')
        ->setOption('margin-top', 2)
        ->setOption('margin-bottom', 2)
        ->setOption('margin-left', 2)
        ->setOption('margin-right', 2);
        return $pdf->inline('Comprobante N° '.$transaccion->numero);
    }
}
