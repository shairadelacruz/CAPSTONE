<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	        DB::table('users')->insert([
	        	'id' => 1,
	        	'is_active' => 1,
	            'name' => 'Yuuri Katsuki',
	            'email' => 'yuuri@yahoo.com',
	            'password' => bcrypt('123456')
	        ]);

	        DB::table('roles')->insert([
	        	'id' => 1,
	            'name' => 'administrator',
	            'label' => 'System Administrator'
	        ]);

	       	DB::table('roles')->insert([
	        	'id' => 2,
	            'name' => 'leader',
	            'label' => 'Team Leader'
	        ]);

	        DB::table('roles')->insert([
	        	'id' => 3,
	            'name' => 'user',
	            'label' => 'Employee'
	        ]);

	        DB::table('roles')->insert([
	        	'id' => 4,
	            'name' => 'receptionist',
	            'label' => 'Receptionist'
	        ]);

	        DB::table('role_user')->insert([
	        	'role_id' => 1,
	        	'user_id' => 1
	        	
	        ]);

	        DB::table('coacategories')->insert([
	        	'id' => 1,
	            'name' => 'Asset',
	        ]);

	        DB::table('coacategories')->insert([
	        	'id' => 2,
	            'name' => 'Liability',
	        ]);


			DB::table('coacategories')->insert([
	        	'id' => 3,
	            'name' => 'Expense',
	        ]);

			DB::table('coacategories')->insert([
	        	'id' => 4,
	            'name' => 'Revenue',
	        ]);


			DB::table('coacategories')->insert([
	        	'id' => 5,
	            'name' => 'Equity',
	        ]);


    	
    }
}
