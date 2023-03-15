<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::create(['title'=>'Edzés cikkek', 'description'=>'Cikkek az edzéssel kapcsolatban']);
        Topic::create(['title'=>'Táplálkozás', 'description'=>'Cikkek a helyes táplálkozással kapcsolatban']);
        Topic::create(['title'=>'Edzőtermek', 'description'=>'Az oldalon elérhető edzőtermek listája']);
    }
}
