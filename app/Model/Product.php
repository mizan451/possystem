<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function Suplier()
    {
    	return $this->belongsTo(Suplier::class, 'suplier_id', 'id');
    }

    public function Unit()
    {
    	return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function Category()
    {
    	return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
