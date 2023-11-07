<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCenter extends Model
{
    use HasFactory;

    protected $table = 'm_service_centers';

    protected $fillable = [
        'nama_service',
        'no_telp',
        'alamat',
        'cp',
        'no_hp',
        'keterangan'
    ];


    public function services(): HasMany
    {
        return $this->hasMany(ServiceCenter::class);
    }
}