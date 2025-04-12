<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores'; // Tên bảng trong database

    protected $fillable = [
        'name',
        'address',
        'phone',
        'latitude',
        'longitude'
    ];
}
