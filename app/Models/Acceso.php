<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Acceso extends Model
{
    use HasApiTokens, Notifiable, Authenticatable;

    protected $connection = 'mongodb';
    protected $collection = 'accesos';

    protected $fillable = [
        '_id',
        'fecha',
        '_idZona',
        'tipo'
    ];
}
