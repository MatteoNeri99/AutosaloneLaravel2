<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;

}



