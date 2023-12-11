<?php

namespace Database\Seeders;

use App\Models\Medic;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class medicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Tongkat Jalan',
                'foto' => 'tongkat-jalan.jpg',
                'kategori' => 'Alat Bantu Jalan',
                'merk' => 'Merk A',
            ],
            [
                'name' => 'Kursi Roda',
                'foto' => 'Kursi-roda.jpg',
                'kategori' => 'Alat Bantu Jalan',
                'merk' => 'Merk B',
            ],
            [
                'name' => 'Alat Bantu Dengar',
                'foto' => 'Alat-Bantu-Dengar.jpg',
                'kategori' => 'Alat Bantu Pendengaran',
                'merk' => 'Merk C',
            ],
            [
                'name' => 'Nebulizer',
                'foto' => 'Nebulizer.jpg',
                'kategori' => 'Alat Bantu pernapasan',
                'merk' => 'Merk C',
            ],
        ];

        foreach($data as $value){
            Medic::insert([
                'name' => $value['name'],
                'foto' => $value['foto'],
                'kategori' => $value['kategori'],
                'merk' => $value['merk'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
