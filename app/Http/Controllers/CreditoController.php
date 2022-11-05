<?php

namespace App\Http\Controllers;

use App\DataTables\CreditoDataTable;
use App\DataTables\Creditos\CuentaUserDataTable;
use App\DataTables\Creditos\GaranteDataTable;
use App\Http\Requests\CreditoStoreRq;
use App\Models\Credito;
use App\Models\TablaCredito;
use App\Models\TipoCredito;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class CreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CreditoDataTable $dataTable)
    {
        return $dataTable->render('creditos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CuentaUserDataTable $dataTable)
    {
        
        $data = array(
            'tipo_creditos' => TipoCredito::where('estado','ACTIVO')->get(),
            'fecha_pago'=>Carbon::today()->format('Y-m-d')
         );
        return $dataTable->render('creditos.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreditoStoreRq $request)
    {
        $data = array(
            'monto'=>$request->amount,
            'dia_pago'=>$request->dia_pago,
            'tasa_nominal'=>$request->rate,
            'numero_cuotas'=>$request->Numero_Pagos,
            'plazo'=>$request->term,
            'pago_mensual'=>$request->Pago_Mensual,
            'pagos_totales'=>$request->Pagos_Totales,
            'interes_totales'=>$request->Interes_Total,
            'estado'=>'INGRESADO',
            'tipo_credito_id'=>$request->tipoCredito,
            'cuenta_user_id'=>$request->cuentaUser,
            'ahorro_programado'=>$request->ahorro_programado,
            'total_ahorro_programado'=>$request->ahorro_programado*$request->Numero_Pagos,
            'actividad'=>$request->actividad,
            'detalle'=>$request->detalle,
        );
        
        try {
            DB::beginTransaction();
            $credito=Credito::create($data);
            foreach ($request->numero_pago_tabla as $npt) {
                $tabla = array(
                    'numero'=>$npt,
                    'fecha_pago'=>$request->fecha_pago_tabla[$npt],
                    'monto_pago'=>$request->monto_pago_tabla[$npt],
                    'interes_total'=>$request->interes_total_tabla[$npt],
                    'pagos_total'=>$request->pagos_total_tabla[$npt],
                    'saldo_capital'=>$request->saldo_capital_tabla[$npt],
                    'total_pagar'=>$request->total_a_pagar_tabla[$npt],
                    'estado'=>'PENDIENTE',
                    'credito_id'=>$credito->id
                );
                TablaCredito::create($tabla);
            }
            $credito->fecha_vencimiento=$credito->tablaCreditos()->latest()->first()->fecha_pago;
            $credito->save();
            DB::commit();
            Session::flash('success','Crédito ingresado.!');
            return redirect()->route('creditos.show',$credito);
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('info','Crédito no ingresado.!'.$th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function show(Credito $credito)
    {
        return view('creditos.show',['credito'=>$credito]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function edit(Credito $credito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credito $credito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credito $credito)
    {
        //
    }

    public function tablaAmortizacion($creditoId)
    {
        $credito=Credito::findOrFail($creditoId);
      
        
        $title='CREDITO N° # '.$credito->numero;
        $headerHtml = view()->make('pdf.header',['title'=>$title])->render();
        $footerHtml = view()->make('pdf.footer')->render();
        $data = array(
            'credito'=>$credito,
            'title'=>$title
        );
        
        $pdf = PDF::loadView('creditos.tablaAmortizacion', $data)
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline($title );
    }

    public function pagare($creditoId)
    {
        $credito=Credito::findOrFail($creditoId);
      
        
        $title='PAGARE A LA ORDEN N° # '.$credito->numero;
        $headerHtml = view()->make('pdf.header',['title'=>$title])->render();
        $footerHtml = view()->make('pdf.footer')->render();
        $data = array(
            'credito'=>$credito,
            'title'=>$title
        );
        
        $pdf = PDF::loadView('creditos.pagare', $data)
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline($title );
    }
    public function garantes(GaranteDataTable $dataTable, $creditoId)
    {
        $data = array('credito' => Credito::findOrFail($creditoId) );
        return $dataTable->with('idCredito',$creditoId)->render('creditos.garantes',$data);
    }

    public function garantesActualizar(Request $request)
    {
        $request->validate([
            'credito'=>'nullable|exists:creditos,id',
            'garantes'=>'nullable|array',
            'garantes.*'=>'nullable|exists:users,id'
        ]);
        
        $credito=Credito::findOrFail($request->credito);
        $credito->garantes()->sync($request->garantes);
        Session::flash('success','Garantes actualizados');
        return redirect()->route('creditos.garantes',$credito);
    }
}
