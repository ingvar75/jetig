<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    /**
     * @property int $id
     * @property string $created_at
     * @property string $updated_at
     */
    //
    public $table = "mail";
    protected array $basket_user = [
        'user_id',
        'user_email',
        'text_mail',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
