<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DTMutasi extends Model
{
    use HasFactory;

    protected $table = 'dt_mutasis';

    protected $fillable = [
        'pemakai_lama',
        'pemakai_baru',
        'mt_mutasi_id',
        'm_barang_id',
        'harga',
    ];

    public function mtmutasi(): BelongsTo
    {
        return $this->belongsTo(MTMutasi::class, 'mt_mutasi_id');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'm_barang_id')->withDefault(['nama_barang' => null]);
    }

    public function pemakaiBaru(): BelongsTo
    {
        return $this->belongsTo(Pemakai::class, 'pemakai_baru')->withDefault(['nama' => '-']);
    }

    public function pemakaiLama()
    {
        return $this->belongsTo(Pemakai::class, 'pemakai_lama');
    }
}