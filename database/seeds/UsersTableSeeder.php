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
	            'name' => 'manager',
	            'label' => 'Manager'
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

	        DB::table('coacategories')->insert([
	        	'id' => 6,
	            'name' => 'Cost of Sales',
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 1,
	            'name' => 'Cash and Cash Equivalent',
	            'coacategory_id' => 1,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 2,
	            'name' => 'Accounts Receivable',
	            'coacategory_id' => 1,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 3,
	            'name' => 'Inventories',
	            'coacategory_id' => 1,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 4,
	            'name' => 'Property, Plant, Equipment',
	            'coacategory_id' => 1,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 5,
	            'name' => 'Intangible Assets',
	            'coacategory_id' => 1,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 6,
	            'name' => 'Investments',
	            'coacategory_id' => 1,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 7,
	            'name' => 'Biological Assets',
	            'coacategory_id' => 1,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 8,
	            'name' => 'Accounts Payable',
	            'coacategory_id' => 2,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 9,
	            'name' => 'Current Liabilities',
	            'coacategory_id' => 2,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 10,
	            'name' => 'Provisions',
	            'coacategory_id' => 2,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 11,
	            'name' => 'Non-Current Liabilities',
	            'coacategory_id' => 2,
	            'is_generic' => 0,
	        ]);

    		DB::table('coas')->insert([
	        	'id' => 12,
	            'name' => 'Sales',
	            'coacategory_id' => 4,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 13,
	            'name' => 'Sales Discount',
	            'coacategory_id' => 4,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 14,
	            'name' => 'Sale Allowance',
	            'coacategory_id' => 4,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 15,
	            'name' => 'Capital',
	            'coacategory_id' => 5,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 16,
	            'name' => 'Drawing',
	            'coacategory_id' => 5,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 17,
	            'name' => 'Retained Earnings',
	            'coacategory_id' => 5,
	            'is_generic' => 0,
	        ]);

	       	DB::table('coas')->insert([
	        	'id' => 18,
	            'name' => 'Operating Expense',
	            'coacategory_id' => 3,
	            'is_generic' => 0,
	        ]);

	       	DB::table('coas')->insert([
	        	'id' => 19,
	            'name' => 'Rental',
	            'coacategory_id' => 3,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 20,
	            'name' => 'Miscellaneous Expense',
	            'coacategory_id' => 3,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 21,
	            'name' => 'Cost of Sales',
	            'coacategory_id' => 6,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 22,
	            'name' => 'Cost of Goods Sold',
	            'coacategory_id' => 6,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 23,
	            'name' => 'Cost of Goods Manufactured & Sold',
	            'coacategory_id' => 6,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 24,
	            'name' => 'Cost of Services Rendered',
	            'coacategory_id' => 6,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 25,
	            'name' => 'DC - Salaries, Wages & Benefits',
	            'coacategory_id' => 6,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 26,
	            'name' => 'DC - Materials, Supplies & Facilities',
	            'coacategory_id' => 6,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 27,
	            'name' => 'DC - Depreciation',
	            'coacategory_id' => 6,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 28,
	            'name' => 'DC - Rental',
	            'coacategory_id' => 6,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 29,
	            'name' => 'DC - Outside Services',
	            'coacategory_id' => 6,
	            'is_generic' => 0,
	        ]);

	        DB::table('coas')->insert([
	        	'id' => 30,
	            'name' => 'DC - Others',
	            'coacategory_id' => 6,
	            'is_generic' => 0,
	        ]);


	       	DB::table('vats')->insert([
	        	'id' => 1,
	            'vat_code' => 'OV Sales',
	            'rate' => 12,
	            'description' => 'Output VAT on Sales',
	        ]);

	        DB::table('vats')->insert([
	        	'id' => 2,
	            'vat_code' => 'OV Ex',
	            'rate' => 0,
	            'description' => 'Output VAT on Exempt Sales',
	        ]);

	        DB::table('vats')->insert([
	        	'id' => 3,
	            'vat_code' => 'OV Zero',
	            'rate' => 0,
	            'description' => 'Output VAT on Zero Rated Sales',
	        ]);

	        DB::table('vats')->insert([
	        	'id' => 4,
	            'vat_code' => 'IV Services',
	            'rate' => 12,
	            'description' => 'Input VAT on Services',
	        ]);

	        DB::table('vats')->insert([
	        	'id' => 5,
	            'vat_code' => 'IV Capital',
	            'rate' => 12,
	            'description' => 'Input VAT on Capital Goods',
	        ]);

	        DB::table('vats')->insert([
	        	'id' => 6,
	            'vat_code' => 'IV Goods',
	            'rate' => 12,
	            'description' => 'Input VAT on Other Goods',
	        ]);

	        DB::table('vats')->insert([
	        	'id' => 7,
	            'vat_code' => 'IV Zero',
	            'rate' => 0,
	            'description' => 'Input VAT on Zero Rated Purchases',
	        ]);

	        DB::table('vats')->insert([
	        	'id' => 8,
	            'vat_code' => 'IV Ex',
	            'rate' => 0,
	            'description' => 'Input VAT on Exempt Purchases',
	        ]);

	        DB::table('businesses')->insert([
	        	'id' => 1,
	            'name' => 'Food'
	        ]);

			DB::table('businesses')->insert([
	        	'id' => 2,
	            'name' => 'Education'
	        ]);

	        DB::table('businesses')->insert([
	        	'id' => 3,
	            'name' => 'Accounting'
	        ]);

	        DB::table('businesses')->insert([
	        	'id' => 4,
	            'name' => 'Photography'
	        ]);

	        DB::table('businesses')->insert([
	        	'id' => 5,
	            'name' => 'Recreation'
	        ]);

	        DB::table('document_types')->insert([
	        	'id' => 1,
	            'name' => 'Bills'
	        ]);

	        DB::table('document_types')->insert([
	        	'id' => 2,
	            'name' => 'Expenses/Receipts'
	        ]);

	        DB::table('document_types')->insert([
	        	'id' => 3,
	            'name' => 'Sales/OR Cash Sales'
	        ]);

	        DB::table('document_types')->insert([
	        	'id' => 4,
	            'name' => 'Invoices'
	        ]);

	        DB::table('document_types')->insert([
	        	'id' => 5,
	            'name' => 'Payments(AR)'
	        ]);

	        DB::table('document_types')->insert([
	        	'id' => 6,
	            'name' => 'Payments(AP)'
	        ]);

	        DB::table('document_types')->insert([
	        	'id' => 7,
	            'name' => 'Others'
	        ]);





    }
}
