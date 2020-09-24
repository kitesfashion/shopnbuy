<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'root_menu','parent','menuName','articleName','parentArticle','firstHomeTitle','firstHomeImage', 'homeDescription', 'urlLink','menuIcon','metaTitle','metaKeyword','metaDescription','orderBy','menuStatus','showInMenu','showInFooterMenu'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

}