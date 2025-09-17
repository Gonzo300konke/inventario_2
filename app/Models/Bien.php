<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    protected $table = 'bienes';



    protected $fillable = [
        'dependencia_id',
        'responsable_id',
        'codigo',
        'descripcion',
        'ubicacion',
        'estado',
        'fecha_registro',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
        'estado' => EstadoBien::class, // Enum PHP 8.1+
    ];

    // Relaciones
    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }

    public function responsable()
    {
        return $this->belongsTo(Responsable::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
