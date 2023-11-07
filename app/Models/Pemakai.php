<?php

namespace App\Models;

use App\Enums\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemakai extends Model
{
    use HasFactory;
    protected $table = 'm_pemakais';

    protected $fillable = [
        'nama',
        'department'
    ];

    protected $casts = [
        'department' => Department::class,
    ];

    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class);
    }

    protected function nama(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    public function scopeSearch($query, $value)
    {
        $query->where('nama', 'like', "%$value%")
            ->orWhere('department', 'like', "%$value%");
    }
}
