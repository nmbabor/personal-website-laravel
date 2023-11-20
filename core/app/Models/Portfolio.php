<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function technologies()
    {
        return $this->hasMany(PortfolioTechnology::class);
    }

    public function getTechnologiesId()
    {
        return $this->technologies->pluck('technology_id')->toArray();
    }
}
