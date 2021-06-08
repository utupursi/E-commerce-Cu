<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\PaymentType;
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

        $paymentTypes = [
            [
                'title' => 'Credit Card',
                'status' => true,
                'banks' => [
                    [
                        'title' => 'TBC',
                        'config_path' => ''
                    ],
                    [
                        'title' => 'Georgian Bank',
                        'config_path' => ''
                    ]
                ]
            ],

            [
                'title' => 'cash',
                'status' => true,
                'banks' => [

                ]
            ],
            [
                'title' => 'Loan',
                'status' => true,
                'banks' => [
                    [
                        'title' => 'TBC',
                        'config_path' => ''
                    ],
                    [
                        'title' => 'Credo Bank',
                        'config_path' => ''
                    ],
                    [
                        'title' => 'Volta Loan',
                        'config_path' => ''
                    ]
                ]
            ],
        ];


        foreach ($paymentTypes as $type) {
            $model = new PaymentType([
                'title' => $type['title'],
                'status' => $type['status'],
            ]);
            $model->save();

            foreach ($type['banks'] as $bank) {
                $bank = new Bank([
                    'title' => $bank['title'],
                    'config_path' => $bank['config_path'],
                    'payment_type_id'=>$model->id
                ]);
                $bank->save();
            }
        }
    }
}
