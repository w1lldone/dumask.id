<?php

namespace Database\Seeders;

use App\Models\Dropbox;
use App\Models\Station;
use Illuminate\Database\Seeder;

class StationsDropboxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Station::truncate();
        Dropbox::truncate();

        Station::factory()
        ->hasDropboxes(2)
        ->create([
            'name' => 'Kampus 1 UAD',
            'address' => 'Jl. Kapas no 9 Semaki, Yogyakarta',
            'latitude' => '-7.798718',
            'longitude' => '110.383104',
        ]);

        Station::factory()
        ->hasDropboxes(2)
        ->create([
            'name' => 'Ruko PIAT',
            'address' => 'Jl. Agro No.1, Kocoran, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281',
            'latitude' => '-7.7667411',
            'longitude' => '110.3798472',
        ]);

        Station::factory()
        ->hasDropboxes(2)
        ->create([
            'name' => 'PIAT Berbah',
            'address' => 'Jl. Tanjung Tirto, Kali Tirto, Berbah, Tanjung, Kalitirto, Kec. Berbah, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55573',
            'latitude' => '-7.7961103',
            'longitude' => '110.4631179',
        ]);
    }
}
