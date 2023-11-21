<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class,'portfolio_category_id','id');
    }
    public function features()
    {
        return $this->hasMany(PortfolioFeature::class);
    }
    public function technologies()
    {
        return $this->hasMany(PortfolioTechnology::class);
    }

    public function getTechnologiesId()
    {
        return $this->technologies->pluck('technology_id')->toArray();
    }

    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }
}
