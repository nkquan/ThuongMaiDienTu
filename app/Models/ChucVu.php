<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_chuc_vu',
    ];
    public function user () {
        return $this->hasMany(User::class);
    }
}
