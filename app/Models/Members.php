<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Members extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function wanted()
    {
        return $this->hasMany(Wanted::class, 'member_id', 'id');
    }
    public function check()
    {
        return $this->hasMany(CheckOut::class, 'member_id', 'id');
    }
}
