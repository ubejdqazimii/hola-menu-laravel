<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'order'];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
