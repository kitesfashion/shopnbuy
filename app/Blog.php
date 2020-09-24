<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'firstHomeTitle','secondHomeTitle','firstInnerTitle','secondInnerTitle','firstHomeImage','firstInnerImage','homeDescription', 'innerDescription', 'urlLink','articleIcon','metaTitle','metaKeyword','metaDescription','orderBy','articleStatus'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

}