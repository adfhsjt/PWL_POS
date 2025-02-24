<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kategori_kode' => 'ELEK', 'kategori_nama' => 'Elektronik'],
            ['kategori_kode' => 'FASH', 'kategori_nama' => 'Fashion'],
            ['kategori_kode' => 'MAKN', 'kategori_nama' => 'Makanan'],
            ['kategori_kode' => 'OTOM', 'kategori_nama' => 'Otomotif'],
            ['kategori_kode' => 'RUMH', 'kategori_nama' => 'Perabotan Rumah'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
