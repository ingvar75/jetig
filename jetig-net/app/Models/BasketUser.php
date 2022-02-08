<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketUser extends Model
{
    use HasFactory;

    /**
     * @property int $id
     * @property string $created_at
     * @property string $updated_at
     */
    //
    public $table = "basket_user";
    protected array $basket_user = [
        'user_id',
        'user_email',
        'mob_tel',
        'ses_token',
        'xsrf_token',
        'b_status',
        'product_code',
        'id_group',
        'count',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
