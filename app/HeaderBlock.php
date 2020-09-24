<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderBlock extends Model
{	protected $table = 'header_block';
	protected $fillable = [
        'articleName','firstHomeTitle','secondHomeTitle','firstInnerTitle','secondInnerTitle','firstHomeImage','firstInnerImage','homeDescription', 'innerDescription', 'urlLink','articleIcon','metaTitle','metaKeyword','metaDescription','orderBy','articleStatus','section'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

}