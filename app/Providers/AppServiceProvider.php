<?php

namespace App\Providers;

use App\Models\Service;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Service::created(function ($service) {
            if (empty($service->tgl_selesai)) {
                $service->barang->status = 'sedang_service';
            } else {
                $service->barang->status = 'aktif';
            }
            $service->barang->save();
        });
    }
}