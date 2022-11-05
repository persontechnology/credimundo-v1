<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TablaCredito extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'numero',
        'fecha_pago',
        'monto_pago',
        'interes_total',
        'pagos_total',
        'saldo_capital',
        'total_pagar',
        'estado',
        'credito_id',
        'creado_x',
        'actualizado_x',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->creado_x=Auth::id();
        });
        self::updating(function($model){
            $model->actualizado_x = Auth::id();
        });
    }

    public function getFechaPagoCAttribute()
    {
        $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
        $fecha = Carbon::parse($this->fecha_pago);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ',' . $mes . ' ' . $fecha->format('Y');
    }
    
    
    
    


}
