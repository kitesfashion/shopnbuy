<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent','categoryName','headerImage','originalImage','image','icon','showInHomepage','showInHomeCategoryProduct','showInHomeCategoryProductWithSubcategory','showInHomeCategoryProductWithProduct','metaTitle','metaKeyword','metaDescription','orderBy','categoryStatus',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

}