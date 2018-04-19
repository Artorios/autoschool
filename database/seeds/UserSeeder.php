<?php

use App\Models\User\User;
use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( ! User::count()) {
            $admin_data = [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => 'adminadmin',
                'role' => 'admin',
                'last_name' => 'Adminskiy',
                'phone' => '0777777777',
                'activated' => 1,
                'image' => '',
                'sms_notice' => '0',
                'email_notice' => '0',
            ];

            $user = User::create($admin_data);
        }
    }
}
