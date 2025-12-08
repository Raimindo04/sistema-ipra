<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostoAdministrativo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bairros()
    {
        return $this->hasMany(Bairro::class);
    }
}
