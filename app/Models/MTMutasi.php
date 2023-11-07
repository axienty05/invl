<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MTMutasi extends Model
{
    use HasFactory;

    protected $table = 'mt_mutasis';

    protected $fillable = [
        'no_mutasi',
        'm_supplier_id',
        'jenis_mutasi',
        'keterangan',
        'tgl_mutasi'
    ];

    protected $casts = [
        'tgl_mutasi' => 'datetime'
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'm_supplier_id')->withDefault([
            "nama_supplier" => '-'
        ]);
    }

    public function dtmutasis(): HasMany
    {
        return $this->hasMany(DTMutasi::class, 'mt_mutasi_id');
    }

    public function barangs(): BelongsToMany
    {
        return $this->belongsToMany(Barang::class, 'm_barang_id');
    }
}