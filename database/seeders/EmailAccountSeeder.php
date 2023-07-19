<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmailAccount;

class EmailAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emails = [
            'test@test.com',
            'agence@agence.com',
            'ates@ates.com',
            'laratest@laratest.com',
        ];

        foreach ($emails as $email) {
            EmailAccount::create(['email' => $email]);
        }
    }
}
