<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version August 30, 2019, 10:28 am UTC
 *
 * @property \App\Models\Seller seller
 * @property \Illuminate\Database\Eloquent\Collection categories
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection products
 * @property string name
 * @property string description
 * @property integer quantity
 * @property string image
 * @property integer seller_id
 */
class Product extends Model
{
    use SoftDeletes;

    const AVAILABLE_PRODUCT = 'availabe';
    const UNAVAILABLE_PRODUCT = 'unavailable';
    public $table = 'products';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'quantity',
        'image',
        'seller_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'quantity' => 'integer',
        'image' => 'string',
        'seller_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'description' => 'required',
        'seller_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function seller()
    {
        return $this->belongsTo(\App\Models\Seller::class, 'seller_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function categories()
    {
        return $this->belongsToMany(\App\Models\Category::class, 'category_product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function products()
    {
        return $this->hasMany(\App\Models\Transaction::class, 'product_id');
    }
}
