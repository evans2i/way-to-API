<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * Class User
 * @package App\Models
 * @version August 30, 2019, 10:43 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string name
 * @property string email
 * @property string phone
 * @property string verified
 * @property string verification_token
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property string remember_token
 */
class User extends Authenticatable
{
    use SoftDeletes;
    use LaratrustUserTrait;
    use Notifiable;

    public $table = 'users';

    const UNVERIFIED_USER = '0';
    const VERIFIED_USER = '1';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'phone',
        'verified',
        'verification_token',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'verified' => 'string',
        'verification_token' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'verified' => 'required',
        'password' => 'required'
    ];

    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }
    public static function generateVerificationCode()
    {
        return str_random(40);
    }

    public function sellers()
    {
        return $this->hasMany(\App\Models\Seller::class);
    }

    public function buyers()
    {
        return $this->hasMany(\App\Models\Buyer::class);
    }
}
