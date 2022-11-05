<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CuentaUser extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'numero',
        'valor_apertura',
        'valor_debito',
        'valor_disponible',
        'estado',
        'descripcion',
        'user_id',
        'tipo_cuenta_id',
    ];

    protected $hidden = [
        // 'numero',
        // 'valor_disponible',
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


    // Deivid, una cuenta de usuario tiene un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Deivid, una cuenta de usuario tiene un usuario
    public function tipoCuenta()
    {
        return $this->belongsTo(TipoCuenta::class, 'tipo_cuenta_id');
    }

    // Deivid, una c uentaUser tiene varias transacciones
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'cuenta_user_id');
    }
    
}
