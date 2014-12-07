<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        // clear table
        //Users::truncate();
        DB::table('users')->delete();;

        // add superuser
        DB::table('users')->insert( [
            'name' => 'Denis' ,
            'email' => 'admin@mysite.com' ,
            //Encripted with function bcrypt('some password') ,
            'password' => '$2y$10$2TZwpZyNG9Ae7RwsQozzUeosGKrWjjkj/cLH2zK7QQrZlrucArX/u' ,
        ] );


    }

}
