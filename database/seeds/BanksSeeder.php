<?php

use Illuminate\Database\Seeder;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks=[
            ['name' => 'Zenith Bank Plc', 'alias' => 'zenith'],
            ['name' => 'First City Monument Bank', 'alias' => 'fcmb']    
        ];

        foreach ($banks as $key => $bank) {
            DB::table('banks')->insert([
                'name'=>$bank['name'],
                'alias'=>$bank['alias'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
