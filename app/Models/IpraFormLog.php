<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpraFormLog extends Model
{
    use HasFactory;
    //protected $guarded = [];

    protected $fillable = [
        'ipra_form_id',
        'user_id',
        'old_values',
        'new_values',
        'action',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    // ← Aqui criamos um "atributo virtual" chamado changes
    public function getChangesAttribute()
    {
        $old = $this->old_values ?? [];
        $new = $this->new_values ?? [];

        $resultado = [];

        foreach ($new as $campo => $valorNovo) {
            $resultado[$campo] = [
                'old' => $old[$campo] ?? null,
                'new' => $valorNovo,
            ];
        }

        return $resultado;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ipraForm()
    {
        return $this->belongsTo(IpraForm::class);
    }
}
