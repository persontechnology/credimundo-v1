<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Credito extends Model
{
    use HasFactory;

    protected $fillable=[
        'numero',
        'monto',
        'dia_pago',
        'fecha_vencimiento',
        'tasa_efectiva_anual',
        'tasa_nominal',
        'numero_cuotas',
        'plazo',
        'pago_mensual',
        'pagos_totales',
        'interes_totales',
        'estado',
        'detalle',
        'actividad',
        'ahorro_programado',
        'total_ahorro_programado',
        'tipo_credito_id',
        'cuenta_user_id',
        'creado_x',
        'actualizado_x'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->creado_x=Auth::id();
            $model->numero = $model->NumeroSiguente();
        });
        self::updating(function($model){
            $model->actualizado_x = Auth::id();
        });
        self::created(function($model){
            $model->tasa_efectiva_anual=$model->tipoCredito->tasa_efectiva_anual;
            $model->save();
         });
    }
    
    //Deivid, crear numero siguente para el crédito
    public function scopeNumeroSiguente()
    {
        $orden = $this->select('numero')->latest('id')->first();
        if ($orden) {
            $ordenNumeroGenerado = $orden->numero + 1;
        } else {
            $ordenNumeroGenerado = 1;
        }
        return $ordenNumeroGenerado;
    }

    // Deivid un credito tiene una cuenta de usuario
    public function cuentaUser()
    {
        return $this->belongsTo(CuentaUser::class,'cuenta_user_id');
    }

    // Deivid un credito tiene un tipo de credito
    public function tipoCredito()
    {
        return $this->belongsTo(TipoCredito::class,'tipo_credito_id');
    }

    // Deivid, un credito tiene varias tabal de credito
    public function tablaCreditos()
    {
        return $this->hasMany(TablaCredito::class, 'credito_id');
    }

     // Deivid, una cuenta de usuario tiene un usuario
     public function creadoPor()
     {
         return $this->belongsTo(User::class, 'creado_x');
     }
    
    // Deivid, ultima fecha de vencimiento
    public function getFechaVencimientoCAttribute()
    {
        return $this->tablaCreditos()->latest()->first()->fecha_pago;
    }
    

    // Deivid, un crdito tiene varios garantes
    public function garantes()
    {
        return $this->belongsToMany(User::class, 'credito_garantes', 'credito_id', 'user_id');
    }
    
    // Deivid, color de estado del credito
    public function getColorEstadoAttribute()
    {
        // INGRESADO, REVISION, ENTREGADO, CANCELADO
        $colorEstado = '';
        switch ($this->estado) {
            case 'INGRESADO':
                $colorEstado = "primary";
                break;
            case 'ENTREGADO':
                $colorEstado = "warning";
                break;
            case 'CANCELADO':
                $colorEstado = "success";
                break;
            case 'ANULADO':
                $colorEstado = "danger";
                break;
        }
        return  $colorEstado;
    }
}
