<?php

namespace App\Http\Controllers;

use App\DataTables\CuentaUser\UserDataTable;
use App\DataTables\CuentaUserDataTable;
use App\Models\CuentaUser;
use App\Models\TipoCuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use PDF;

class CuentaUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CuentaUserDataTable $dataTable)
    {
        return $dataTable->render('cuentas-usuario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserDataTable $dataTable)
    {
        $data = array('tipoCuentas' => TipoCuenta::where('estado','ACTIVO')->get() );
        return $dataTable->render('cuentas-usuario.create',$data);
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
            'tipoCuenta'=>[
                'required',
                Rule::unique('cuenta_users','tipo_cuenta_id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->userid)->where('tipo_cuenta_id',$request->tipoCuenta);
                })
            ]
        ]);

        $tc=TipoCuenta::findOrFail($request->tipoCuenta);
        $data = array(
            'valor_apertura'=>$tc->valor_apertura,
            'valor_debito'=>$tc->valor_debito,
            'valor_disponible'=>0,
            'estado'=>'INACTIVO',
            'descripcion'=>$request->descripcion,
            'user_id'=>$request->userid,
            'tipo_cuenta_id'=>$tc->id,
        );
        
        try {
            CuentaUser::create($data);
            Session::flash('success','Cuenta ingresado');
        } catch (\Throwable $th) {
            Session::flash('warning','Cuenta no ingresado'.$th->getMessage());
        }

        return redirect()->route('cuentas-usuario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CuentaUser  $cuentaUser
     * @return \Illuminate\Http\Response
     */
    public function show(CuentaUser $cuentaUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CuentaUser  $cuentaUser
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDataTable $dataTable,$cuentaUserId)
    {
        $cuentaUser=CuentaUser::findOrFail($cuentaUserId);
        $data = array(
            'cuentaUser' => $cuentaUser,
            'tipoCuentas'=> TipoCuenta::where('estado','ACTIVO')->get()
        );
        return $dataTable->render('cuentas-usuario.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuentaUser  $cuentaUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cuentaUserId)
    {
        $cuentaUser=CuentaUser::findOrFail($cuentaUserId);

        $request->validate([
            'tipoCuenta'=>[
                'required',
                Rule::unique('cuenta_users','tipo_cuenta_id')->where(function ($query) use ($request,$cuentaUserId) {
                    return $query->where('user_id', $request->userid)
                    ->where('tipo_cuenta_id',$request->tipoCuenta)
                    ->where('id','!=',$cuentaUserId);
                })
            ]
        ]);

        $data = array(
            'valor_disponible'=>$request->valor_disponible,
            'estado'=>$request->estado,
            'descripcion'=>$request->descripcion,
            'user_id'=>$request->userid,
            'tipo_cuenta_id'=>$request->tipoCuenta,
        );
        $cuentaUser->update($data);

        Session::flash('success','Cuenta de usuario actualizado.!');
        return redirect()->route('cuentas-usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuentaUser  $cuentaUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($cuentaUserId)
    {
        $cuentaUser=CuentaUser::findOrFail($cuentaUserId);
        try {
            $cuentaUser->delete();
            Session::flash('success','Cuenta de usuario eliminado');
        } catch (\Throwable $th) {
            Session::flash('info','Cuenta de usuario no eliminado');
        }
        return redirect()->route('cuentas-usuario.index');
    }
    
    public function solicitudAperturaCuenta($cuentaUserId)
    {
        $cuentaUser=CuentaUser::findOrFail($cuentaUserId);
        $title='SOLICITUD APERTURA DE CUENTA # '.$cuentaUser->numero;
        $headerHtml = view()->make('pdf.header',['title'=>$title])->render();
        $footerHtml = view()->make('pdf.footer')->render();
        $data = array(
            'cuentaUser'=>$cuentaUser,
            'user'=>$cuentaUser->user,
            'title'=>$title
        );
        
        $pdf = PDF::loadView('cuentas-usuario.solicitu-apertura-cuenta', $data)
        ->setOption('header-html', $headerHtml)
        ->setOption('footer-html', $footerHtml);
        return $pdf->inline($title );
        
    }
}
