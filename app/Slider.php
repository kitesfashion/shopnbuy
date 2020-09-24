<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
	protected $fillable = [
        'title','image','section','productId','link','status','metaTitle','metaKeyword','metaDescription','orderBy'
    ];
}
