<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Seller
 * @package App\Models
 * @version August 30, 2019, 11:45 am UTC
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection sellers
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string lat
 * @property string lang
 * @property string city
 * @property string street
 * @property string Block
 * @property integer user_id
 */
class Seller extends Model
{
    use SoftDeletes;

    public $table = 'sellers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'lat',
        'lang',
        'city',
        'street',
        'Block',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'lat' => 'string',
        'lang' => 'string',
        'city' => 'string',
        'street' => 'string',
        'Block' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'lat' => 'required',
        'lang' => 'required',
        'city' => 'required',
        'street' => 'required',
        'Block' => 'required',
        'user_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }
}
