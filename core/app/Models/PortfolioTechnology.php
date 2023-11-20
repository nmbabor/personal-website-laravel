<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioTechnology extends Model
{
    use HasFactory;
    protected $fillable = ['technology_id','portfolio_id'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }
}
