<?php

namespace Database\Seeders;

use App\Models\Dropbox;
use App\Models\Station;
use App\Models\DropboxLog;
use Illuminate\Database\Seeder;

class DropboxOperationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $station = Station::factory()
        ->create([
            'name' => 'Kampus Operasi Dropbox',
            'address' => 'Kantor Pusat UGM Sayap Timur Lt. 1 Bulaksumur, Yogyakarta, Indonesia 55281',
            'latitude' => '-7.768086709068537',
            'longitude' => '110.37901906825736',
        ]);

        /** @var Dropbox */
        $dropboxOne = Dropbox::factory()->create([
            'station_id' => $station->id
        ]);
        /** @var Dropbox */
        $dropboxTwo = Dropbox::factory()->create([
            'station_id' => $station->id
        ]);

        $timestamp = now()->subMonths(2);
        /** @var DropboxLog */
        $logOne = $dropboxOne->dropboxLogs()->create([
            'activity' => 'replacement',
            'weight' => 300,
            'final_weight' => 2000,
            'starts_at' => $timestamp,
            'ends_at' => now()
        ]);
        $logTwo = $dropboxTwo->dropboxLogs()->create([
            'activity' => 'replacement',
            'weight' => 300,
            'final_weight' => 2100,
            'starts_at' => $timestamp,
            'ends_at' => now()
        ]);

        $timestamp = $timestamp->addWeek();
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logOne->id,
            'final_weight' => 900,
            'ends_at' => $timestamp
        ]);
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logTwo->id,
            'final_weight' => 800,
            'ends_at' => $timestamp
        ]);

        $timestamp = $timestamp->addWeek();
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logOne->id,
            'final_weight' => 1100,
            'ends_at' => $timestamp
        ]);
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logTwo->id,
            'final_weight' => 1000,
            'ends_at' => $timestamp
        ]);

        $timestamp = $timestamp->addWeek();
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logOne->id,
            'final_weight' => 1400,
            'ends_at' => $timestamp
        ]);
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logTwo->id,
            'final_weight' => 1350,
            'ends_at' => $timestamp
        ]);

        $timestamp = $timestamp->addWeek();
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logOne->id,
            'final_weight' => 1500,
            'ends_at' => $timestamp
        ]);
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logTwo->id,
            'final_weight' => 1480,
            'ends_at' => $timestamp
        ]);

        $timestamp = $timestamp->addWeeks(2);
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logOne->id,
            'final_weight' => 1800,
            'ends_at' => $timestamp
        ]);
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logTwo->id,
            'final_weight' => 1600,
            'ends_at' => $timestamp
        ]);

        $timestamp = $timestamp->addWeeks(2);
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logOne->id,
            'final_weight' => 2000,
            'ends_at' => $timestamp
        ]);
        $dropboxTwo->dropboxLogs()->create([
            'activity' => 'inspection',
            'parent_id' => $logTwo->id,
            'final_weight' => 2100,
            'ends_at' => $timestamp
        ]);
    }
}
