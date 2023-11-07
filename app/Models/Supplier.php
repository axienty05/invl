<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'm_suppliers';

    protected $fillable = [
        'nama_supplier',
        'alamat',
        'email',
        'no_telp',
        'cp',
        'no_hp',
        'keterangan'
    ];

    public function mutasis(): HasMany
    {
        return $this->hasMany(MTMutasi::class, 'm_supplier_id');
    }
}