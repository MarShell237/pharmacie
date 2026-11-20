<?php

namespace Database\Seeders;

use App\Models\Batche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatcheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batches = Batche::factory(48)->create();
        foreach($batches as $b){
            $b->batch_number = "PHARMACIE-".$b->expiration_date->format('d-m-y').'-'.$b->id;
            $b->save();
        }
    }
}
