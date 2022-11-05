<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaccion extends Model
{
    use HasFactory;

    protected $fillable=[
        'numero',
        'valor_efectivo',
        'valor_cheque',
        'valor_disponible',
        'estado',
        'detalle',
        'cuenta_user_id',
        'tipo_transaccion_id',
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
        // Deivid, actualizar valor disponible cuentauser
        self::created(function($model){

            switch ($model->tipoTransaccion->tipo) {
                case 'DEBITO':
                case 'SALIDA':
                    $model->cuentaUser->valor_disponible=$model->cuentaUser->valor_disponible-$model->total_efectivo_cheque;   
                    break;
                case 'ABONO':
                case 'INGRESO':
                    $model->cuentaUser->valor_disponible=$model->cuentaUser->valor_disponible+$model->total_efectivo_cheque;   
                    break;
                default:
                    # code...
                    break;
            }
            $model->cuentaUser->save();
            $model->valor_disponible=$model->cuentaUser->valor_disponible;
            $model->save();
         });

         self::updated(function($model){
            
         });
    }

    //Deivid, crear numero siguente para la orden

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

    // Deiivd, total de transacion
    public function getTotalEfectivoChequeAttribute()
    {
        return $this->valor_efectivo+$this->valor_cheque;
    }

     // Deivid, una transaccion tiene una cuentauser
    public function cuentaUser()
    {
        return $this->belongsTo(CuentaUser::class, 'cuenta_user_id');
    }

    // Deivid, una transaccion tiene u tipotransaccion
    public function tipoTransaccion()
    {
        return $this->belongsTo(TipoTransaccion::class,'tipo_transaccion_id');
    }

    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creado_x');
    }
    public function actualizadoPor()
    {
        return $this->belongsTo(User::class, 'actualizado_x');
    }
}


