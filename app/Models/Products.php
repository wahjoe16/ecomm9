<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id')->select('id', 'name');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->select('id', 'category_name');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brands', 'brand_id')->select('id', 'name');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id')->select('id', 'name');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id')->select('id', 'name');
    }
}
