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
                'second_name' => 'Adminskiy',
                'phone' => '0777777777',
                'activated' => 1,
                'image' => '',
                'sms_notice' => '0',
                'email_notice' => '0',
            ];

            $investor_data = [
                'name' => 'investor',
                'email' => 'investor@gmail.com',
                'password' => 'investorinvestor',
                'role' => 'investor',
                'last_name' => 'investor',
                'second_name' => 'investor',
                'phone' => '0777777777',
                'activated' => 1,
                'image' => '',
                'sms_notice' => '0',
                'email_notice' => '0',
            ];

            $auto_school_data = [
                'name' => 'autoschool',
                'email' => 'autoschool@gmail.com',
                'password' => 'autoschoolautoschool',
                'role' => 'autoschool',
                'last_name' => 'autoschool',
                'second_name' => 'autoschool',
                'phone' => '0777777777',
                'activated' => 1,
                'image' => '',
                'sms_notice' => '0',
                'email_notice' => '0',
            ];

            User::create($admin_data);
            User::create($investor_data);
            User::create($auto_school_data);
        }
    }
}
