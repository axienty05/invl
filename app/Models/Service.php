<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $table = 'm_services';

    protected $fillable = [
        'no_sj',
        'm_pemakai_id',
        'm_barang_id',
        'm_service_center_id',
        'tgl_service',
        'tgl_selesai',
        'biaya',
        'kerusakan',
        'analisa',
        'solusi'
    ];

    protected $casts = [
        'tgl_service' => 'datetime:Y-m-d',
        'tgl_selesai' => 'datetime:Y-m-d'
    ];

    public function pemakai(): BelongsTo
    {
        return $this->belongsTo(Pemakai::class, 'm_pemakai_id')->withDefault([
            "nama" => "Pemakai tidak tersedia"
        ]);
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'm_barang_id')->withDefault([
            "nama_barang" => "Barang tidak tersedia",

        ]);
    }

    public function serviceCenter(): BelongsTo
    {
        return $this->belongsTo(ServiceCenter::class, 'm_service_center_id')->withDefault([
            'nama_service' => "Service tutup"
        ]);
    }

    public function scopeSearch($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $query->where('no_sj', 'like', "%$value%")
                ->orWhere('tgl_service', '=', $value)
                ->orWhere('tgl_selesai', '=', $value)
                ->orWhereHas('pemakai', function ($query) use ($value) {
                    $query->where('nama', 'like', "%$value%");
                })
                ->orWhereHas('barang', function ($query) use ($value) {
                    $query->where('nama_barang', 'like', "%$value%")
                        ->orWhere('serial_number', 'like', "%$value%");
                })
                ->orWhereHas('servicecenter', function ($query) use ($value) {
                    $query->where('nama_service', 'like', "%$value%");
                });
        });
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($service) {
            if (empty($service->tgl_selesai)) {
                $service->barang->status = 'sedang_service';
            } else {
                $service->barang->status = 'aktif';
            }
            $service->barang->save();
        });

        self::updating(function ($service) {
            if ($service->isDirty('tgl_selesai')) {
                if (empty($service->tgl_selesai)) {
                    $service->barang->status = 'sedang_service';
                } else {
                    $service->barang->status = 'aktif';
                }
                $service->barang->save();
            }
        });
    }
}