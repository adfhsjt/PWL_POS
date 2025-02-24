<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 30; $i++) {
            $data[] = [
                'penjualan_id' => rand(1, 10),
                'barang_id' => rand(1, 10),
                'harga' => rand(5000, 500000),
                'jumlah' => rand(1, 5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('t_penjualan_detail')->insert($data);
    }
}
