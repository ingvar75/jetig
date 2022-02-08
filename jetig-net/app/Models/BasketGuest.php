<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketGuest extends Model
{
    use HasFactory;

    /**
     * @property int $id
     * @property string $created_at
     * @property string $updated_at
     */
    //
    public $table = "basket_guest";
    protected array $basket_guest= [
        'ses_token',
        'item_name',
        'description',
        'price',
        'currency',
        'unit_of_measurement',
        'image_link',
        'availability',
        'manufacturer_tramp',
        'unique_identifier',
        'id_group',
        'images_home',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
