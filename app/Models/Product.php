<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the game associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    /**
     * Get all of the image for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function image()
    {
        return $this->hasMany(ProductImage::class, 'id_product', 'id');
    }

    /**
     * Get all of the portofolio for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function portofolio()
    {
        return $this->hasMany(Portofolio::class, 'id_product', 'id');
    }
}
