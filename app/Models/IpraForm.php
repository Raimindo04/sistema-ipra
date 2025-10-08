<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class IpraForm extends Model
{
    use HasFactory;

    public $incrementing = false; // Disable auto-increment
    protected $keyType = 'string'; // UUIDs are strings

    protected $guarded = [];


    public function tipoDocumentoIdentificacao()
    {
        return $this->belongsTo(TipoDocumentoIdentificacao::class);
    }

    public function postoAdministrativo()
    {
        return $this->belongsTo(PostoAdministrativo::class);
    }

    public function bairro()
    {
        return $this->belongsTo(Bairro::class);
    }

    public function classeImovel()
    {
        return $this->belongsTo(ClasseImovel::class);
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function finalidadeImovel()
    {
        return $this->belongsTo(FinalidadeImovel::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Automatically generate UUID if not provided
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
