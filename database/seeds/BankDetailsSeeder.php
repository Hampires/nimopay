<?php

use Illuminate\Database\Seeder;

class BankDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks=[
            ['account_number' => '2410279658',
             'account_name' => 'ABRAHAM OYETUNJI OYELAYO',
             'bvn' => 3854859949,
             'bank_id' => 1,
             'user_id' => 2,
            ]
        ];

        foreach ($banks as $key => $bank) {
            DB::table('bank_details')->insert([
                'account_number'=>$bank['account_number'],
                'account_name'=>$bank['account_name'],
                'bvn'=>$bank['bvn'],
                'bank_id'=>$bank['bank_id'],
                'user_id'=>$bank['user_id'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
