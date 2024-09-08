<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name' ,   'parent_id', ];

    public function news()
    {
        return $this->belongsToMany(News::class, 'category_news');
    }


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    /*public function Recurse()
    {

        $children = $this->children()->get();


        foreach ($children as $child) {
            $children = $children->merge($child->Recurse());
        }

        return $children;
    }*/
}
