<?php

namespace App\Models;

use App\Enums\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'm_barangs';

    protected $fillable = [
        'm_pemakai_id',
        'kode_barang',
        'nama_barang',
        'serial_number',
        'kategori',
        'harga',
        'keterangan',
        'status'
    ];

    protected $casts = [
        'kategori' => Kategori::class,
    ];

    public function pemakai(): BelongsTo
    {
        return $this->belongsTo(Pemakai::class, 'm_pemakai_id')->withDefault([
            "nama" => "IT"
        ]);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function serviceinternals(): HasMany
    {
        return $this->hasMany(ServiceInternal::class);
    }

    protected function kode_barang(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    protected function nama_barang(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    public function scopeSearch($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $query->where('kode_barang', 'like', "%$value%")
                ->orWhere('nama_barang', 'like', "%$value%")
                ->orWhere('serial_number', 'like', "%$value%")
                ->orWhere('kategori', 'like', "%$value%")
                ->orWhere('keterangan', 'like', "%$value%")
                ->orWhereHas('pemakai', function ($query) use ($value) {
                    $query->where('nama', 'like', "%$value%");
                });

            if ($value == 'aktif' || $value == 'tidak aktif' || $value == 'sedang service') {
                $query->orWhere('status', str_replace(' ', '_', $value));
            } else {
                $query->orWhere('status', 'like', "%$value%");
            }
        });
    }
}
