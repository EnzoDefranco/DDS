<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table= 'material';
    protected $primaryKey= 'ID';
    protected $fillable=['nombre','codigo','esMateriaPrima'];

    public $timestamps = false;

    //RELACION MUCHOS A MUCHOS
    public function ordenes()
    {
        return $this->belongsToMany(OrdenDeAbastecimiento::class,'material_orden_de_abastecimiento','Orden_ID','Material_ID');

    }


}
