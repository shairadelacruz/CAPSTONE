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
        //Admin
	        DB::table('users')->insert([
	        	'id' => 1,
	        	'is_active' => 1,
	            'name' => 'Yuuri Katsuki',
	            'email' => 'yuuri@yahoo.com',
	            'password' => bcrypt('123456')
	        ]);

	        DB::table('users')->insert([
	        	'id' => 2,
	        	'is_active' => 1,
	            'name' => 'Viktor Nikiforov',
	            'email' => 'viktor@yahoo.com',
	            'password' => bcrypt('123456')
	        ]);

	        DB::table('users')->insert([
	        	'id' => 4,
	        	'is_active' => 1,
	            'name' => 'Yuri Plisetsky',
	            'email' => 'yuri@gmail.com',
	            'password' => bcrypt('123456')
	        ]);

	       	DB::table('users')->insert([
	        	'id' => 3,
	        	'is_active' => 1,
	            'name' => 'Otabek Altin',
	            'email' => 'otabek@gmail.com',
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

	        DB::table('role_user')->insert([
	        	'role_id' => 2,
	        	'user_id' => 2
	        	
	        ]);

	        DB::table('role_user')->insert([
	        	'role_id' => 3,
	        	'user_id' => 3
	        	
	        ]);

	        DB::table('role_user')->insert([
	        	'role_id' => 4,
	        	'user_id' => 4
	        	
	        ]);

	        //Permissions
	        DB::table('permissions')->insert([
	        	'id' => 1,
	            'name' => 'menu_admin',
	            'label' => 'Can see admin menu'
	        ]);

	        DB::table('permissions')->insert([
	        	'id' => 2,
	            'name' => 'menu_user',
	            'label' => 'Can see user menu'
	        ]);

	        DB::table('permissions')->insert([
	        	'id' => 3,
	            'name' => 'menu_manager',
	            'label' => 'Can see manager menu'
	        ]);

	        DB::table('permissions')->insert([
	        	'id' => 4,
	            'name' => 'menu_receptionist',
	            'label' => 'Can see receptionist menu'
	        ]);

	        DB::table('permission_role')->insert([
	        	'permission_id' => 1,
	        	'role_id' => 1	
	        ]);

	        DB::table('permission_role')->insert([
	        	'permission_id' => 2,
	        	'role_id' => 1	
	        ]);

	        DB::table('permission_role')->insert([
	        	'permission_id' => 2,
	        	'role_id' => 2	
	        ]);

	        DB::table('permission_role')->insert([
	        	'permission_id' => 2,
	        	'role_id' => 3	
	        ]);

	        DB::table('permission_role')->insert([
	        	'permission_id' => 3,
	        	'role_id' => 1	
	        ]);

	        DB::table('permission_role')->insert([
	        	'permission_id' => 3,
	        	'role_id' => 2	
	        ]);

	        DB::table('permission_role')->insert([
	        	'permission_id' => 4,
	        	'role_id' => 1	
	        ]);

	    //COA

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

	        DB::table('coas')->insert([
	        	'id' => 1,
	            'name' => 'Cash and Cash Equipment',
	            'coacategory_id' => 1,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 2,
	            'name' => 'Accounts Receivable',
	            'coacategory_id' => 1,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 3,
	            'name' => 'Inventories',
	            'coacategory_id' => 1,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 4,
	            'name' => 'Property, Plant, Equipment',
	            'coacategory_id' => 1,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 5,
	            'name' => 'Intangible Assets',
	            'coacategory_id' => 1,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 6,
	            'name' => 'Investments',
	            'coacategory_id' => 1,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 7,
	            'name' => 'Biological Assets',
	            'coacategory_id' => 1,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 8,
	            'name' => 'Accounts Payable',
	            'coacategory_id' => 2,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 9,
	            'name' => 'Current Liabilities',
	            'coacategory_id' => 2,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 10,
	            'name' => 'Provisions',
	            'coacategory_id' => 2,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 11,
	            'name' => 'Non-Current Liabilities',
	            'coacategory_id' => 2,
	        ]);

    		DB::table('coas')->insert([
	        	'id' => 12,
	            'name' => 'Sales',
	            'coacategory_id' => 4,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 13,
	            'name' => 'Sales Discount',
	            'coacategory_id' => 4,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 14,
	            'name' => 'Sale Allowance',
	            'coacategory_id' => 4,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 15,
	            'name' => 'Capital',
	            'coacategory_id' => 5,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 16,
	            'name' => 'Drawing',
	            'coacategory_id' => 5,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 17,
	            'name' => 'Retained Earnings',
	            'coacategory_id' => 5,
	        ]);


	        //Delete when system is implemented

	       	//Clients

	       	//Admin
	        DB::table('clients')->insert([
	        	'id' => 1,
	        	'company_name' => "Yurio's Piroshki",
	        	'legal_name' => "Yurio's Piroshki",
	        	'address' => "Moscow, Russia",
	        	'contact_name' => "Yuri Plisetsky",
	        ]);
    }
}
