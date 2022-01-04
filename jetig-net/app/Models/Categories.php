<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    /**
     * @property int $id
     * @property string $created_at
     * @property string $updated_at
     */
    //
    public $table = "categories";
    protected array $categories = [
        'name_group',
        'id_group',
        'id_group_parent',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
