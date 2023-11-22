<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  

        $users = [
            ['newton','newton@email.com',password_hash('senha123',PASSWORD_BCRYPT),'61996715125','1'],
            ['admin','admin@coffee.com',password_hash('senha321',PASSWORD_BCRYPT),'','2']
        ];

        foreach($users as $user){
            $db = new User();
            $db->name = $user[0];
            $db->email = $user[1];
            $db->password = $user[2];
            $db->phone = $user[3];
            $db->tier = $user[4];
            $db->save();
        }
        
    }
}
