<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class UserJoki extends Model
{
    use HasFactory, HasApiTokens;
    protected $guarded = [];

    /**
     * Get the balance associated with the UserJoki
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function balance()
    {
        return $this->hasOne(BalanceUser::class, 'user_id', 'id');
    }

    /**
     * Get all of the topUp for the UserJoki
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topUp()
    {
        return $this->hasMany(TopUp::class, 'id_akun', 'id');
    }

    /**
     * Get all of the order for the UserJoki
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    /**
     * Get all of the message for the UserJoki
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function message()
    {
        return $this->hasMany(Message::class, 'user_id', 'id');
    }

    /**
     * Get all of the review for the UserJoki
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function review()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }
}
