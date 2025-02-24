<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'barang_kode' => 'B001', 'barang_nama' => 'Laptop', 'harga_beli' => 5000000, 'harga_jual' => 5500000],
            ['kategori_id' => 1, 'barang_kode' => 'B002', 'barang_nama' => 'Smartphone', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['kategori_id' => 2, 'barang_kode' => 'B003', 'barang_nama' => 'Kaos Polos', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['kategori_id' => 2, 'barang_kode' => 'B004', 'barang_nama' => 'Jaket Kulit', 'harga_beli' => 400000, 'harga_jual' => 500000],
            ['kategori_id' => 3, 'barang_kode' => 'B005', 'barang_nama' => 'Mie Instan', 'harga_beli' => 3000, 'harga_jual' => 5000],
            ['kategori_id' => 3, 'barang_kode' => 'B006', 'barang_nama' => 'Minuman Soda', 'harga_beli' => 8000, 'harga_jual' => 12000],
            ['kategori_id' => 4, 'barang_kode' => 'B007', 'barang_nama' => 'Oli Motor', 'harga_beli' => 40000, 'harga_jual' => 50000],
            ['kategori_id' => 4, 'barang_kode' => 'B008', 'barang_nama' => 'Ban Mobil', 'harga_beli' => 500000, 'harga_jual' => 600000],
            ['kategori_id' => 5, 'barang_kode' => 'B009', 'barang_nama' => 'Kompor Gas', 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['kategori_id' => 5, 'barang_kode' => 'B010', 'barang_nama' => 'Meja Lipat', 'harga_beli' => 150000, 'harga_jual' => 180000],
        ];
        DB::table('m_barang')->insert($data);
    }
}
