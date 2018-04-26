<?php

use Illuminate\Database\Seeder;
use App\User;

class seed_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u=new User();
        $u->name='Shakthi Senavirathna';
        $u->username='shakthi';
        $u->password='password';
        $u->mobile='0774045797';
        $u->api_token=str_random(50);
        $u->save();
    }
}
