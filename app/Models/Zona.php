<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model;

class Zona extends Model
{
    use HasApiTokens, Notifiable, Authenticatable;
    
    protected $connection = 'mongodb';
    protected $collection = 'zonas';

    protected $fillable = [
        '_id',
        'id',
        'nombre',
        'encendido'
    ];
}
