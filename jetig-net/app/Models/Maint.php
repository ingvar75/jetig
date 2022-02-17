<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maint extends Model
{
    use HasFactory;

    /**
     * @property int $id
     * @property string $created_at
     * @property string $updated_at
     */
    //
    public $table = "site";
    protected array $basket_user = [
        'site_status',

    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
