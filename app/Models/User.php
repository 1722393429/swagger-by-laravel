<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User 用户
 * @Auth: kingofzihua
 * @package App\Models
 * @SWG\Definition(
 *     required={"name","email"},
 *     @SWG\Property(property="id", type="integer",description="ID",readOnly=true ),
 *     @SWG\Property( property="name", type="string", description="姓名"),
 *     @SWG\Property( property="email", type="string", description="E-mail" ),
 * )
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
