<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\Pemakai;
use App\Models\Service;
use App\Models\Supplier;
use App\Models\ServiceCenter;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Pemakai::factory(50)->create();
        Barang::factory(50)->create();
        Supplier::factory(50)->create();
        ServiceCenter::factory(50)->create();
        Service::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}