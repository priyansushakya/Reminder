<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['title', 'message', 'email', 'remind_at', 'is_sent'];
}
