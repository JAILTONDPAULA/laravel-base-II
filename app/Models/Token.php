<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'token';
    protected $fillable = [
        'usuario_id',
        'token',
        'utilizado',
        'email',
    ];

    const CREATED_AT = 'registrado';
    const UPDATED_AT = 'atualizado';

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

}
