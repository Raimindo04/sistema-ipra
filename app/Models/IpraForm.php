<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class IpraForm extends Model
{
    use HasFactory;

    public $incrementing = false; // Disable auto-increment
    protected $keyType = 'string'; // UUIDs are strings

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    public function logs()
    {
        return $this->hasMany(\App\Models\IpraFormLog::class);
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

// 🔵 REGISTAR CRIAÇÃO
    static::created(function ($model) {
        DB::table('ipra_form_logs')->insert([
            'ipra_form_id' => $model->id,
            'user_id'      => auth()->id(),
            'old_values'   => null,
            'new_values'   => json_encode($model->getAttributes()),
            'action'       => 'create',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    });

    // 🟡 REGISTAR ACTUALIZAÇÃO
    static::updating(function ($model) {
        DB::table('ipra_form_logs')->insert([
            'ipra_form_id' => $model->id,
            'user_id'      => auth()->id(),
            'old_values'   => json_encode($model->getOriginal()),
            'new_values'   => json_encode($model->getDirty()),
            'action'       => 'update',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    });

    // 🔴 REGISTAR ELIMINAÇÃO
    static::deleting(function ($model) {
        DB::table('ipra_form_logs')->insert([
            'ipra_form_id' => $model->id,
            'user_id'      => auth()->id(),
            'old_values'   => json_encode($model->getAttributes()),
            'new_values'   => null,
            'action'       => 'delete',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    });
    }
}
