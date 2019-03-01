<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<255; $i++)
        {
            DB::table('ip')->insert([
                'ip_type' => 'static',
                'ip_address' => $i
            ]);
        }

        for($i=1; $i<255; $i++)
        {
            DB::table('ip')->insert([
                'ip_type' => 'homis',
                'ip_address' => $i
            ]);
        }
    }
}
