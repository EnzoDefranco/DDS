<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDeAbastecimiento extends Model
{
    use HasFactory;
    protected $table= 'ordendeabastecimiento';
    protected $primaryKey= 'ID';
    protected $fillable=['fechaEmision','plazo'];

    public $timestamps = false;



    // RELACIONES MUCHOS A MUCHOS
    public function materiales()
    {
        return $this->belongsToMany(Material::class,'material_orden_de_abastecimiento','Orden_ID','Material_ID')->withPivot('cantidad');
    }

}

