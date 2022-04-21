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
}
