<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceInternal extends Model
{
    use HasFactory;

    protected $table = 'm_service_internals';

    protected $fillable = [
        'tgl_mulai',
        'tgl_selesai',
        'm_barang_id',
        'm_pemakai_id',
        'biaya',
        'keterangan'
    ];

    protected $casts = [
        'tgl_mulai' => 'datetime:d-M-Y',
        'tgl_selesai' => 'datetime:d-M-Y'
    ];

    public function pemakai(): BelongsTo
    {
        return $this->belongsTo(Pemakai::class);
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
