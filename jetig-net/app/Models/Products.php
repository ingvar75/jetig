<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    /**
     * @property int $id
     * @property string $created_at
     * @property string $updated_at
     */
    //
    public $table = "products";
    protected array $products = [
        'product_code',
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
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
