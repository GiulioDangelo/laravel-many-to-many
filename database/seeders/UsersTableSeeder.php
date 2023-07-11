<?php

namespace Database\Seeders;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'asdf',
                'email' => 'asdf@asdf.asdf',
                'password' => Hash::make('asdfasdf'),
            ],
            [
                'name' => 'qwer',
                'email' => 'qwer@qwer.qwer',
                'password' => Hash::make('qwer'),
            ],
            [
                'name' => 'zxcv',
                'email' => 'zxcv@zxcv.zxcv',
                'password' => Hash::make('zxcv'),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@admin.admin',
                'password' => Hash::make('asdf'),
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
