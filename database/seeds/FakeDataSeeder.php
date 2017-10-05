<?php

use Illuminate\Database\Seeder;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1,15) as $index)
        {
        	$client = App\Client::create([
        		'company_name' => $faker->company,
        		'legal_name' => $faker->company,
        		'code' => str_random(3),
                'business_id' =>$faker->numberBetween($min = 1, $max = 5),
        		'tin_number' => rand(100000000, 999999999),
        		'address' => $faker->address,
        		'financial_year' => $faker->date($format = 'Y-m-d', $max = 'now'),
        		'contact_name' => $faker->name,
        		'email' => $faker->email,
        		'phone' => $faker->tollFreePhoneNumber,
        		'mobile' => $faker->tollFreePhoneNumber
        	]);

        //Assign admin

        $client->assignAdmin();

        $client_id = $client->id;

        //Attach Generic COA

        $client->coas()->sync([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17]);

        //Add Closing

        $closing1 = new App\Closing;

        $closing1->client_id = $client_id;

        $closing1->save();

        }


        foreach (range(1,50) as $index)
        {
        	$vendor = App\Vendor::create([
        		'client_id' =>$faker->numberBetween($min = 1, $max = 15),
        		'name' => $faker->company,
        		'first_name' => $faker->firstName,
        		'middle_name' => $faker->lastName,
        		'last_name' => $faker->lastName,
        		'email' => $faker->email,
        		'phone' => $faker->tollFreePhoneNumber
        	]);

        }

        foreach (range(1,50) as $index)
        {
        	$customer = App\Customer::create([
        		'client_id' =>$faker->numberBetween($min = 1, $max = 15),
        		'name' => $faker->company,
        		'first_name' => $faker->firstName,
        		'middle_name' => $faker->lastName,
        		'last_name' => $faker->lastName,
        		'email' => $faker->email,
        		'phone' => $faker->tollFreePhoneNumber
        	]);

        }

        foreach (range(1,50) as $index)
        {
        	$item = App\Item::create([
        		'client_id' =>$faker->numberBetween($min = 1, $max = 15),
        		'name' => $faker->word ,
        		'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        		'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 999999),
        		'coa_id' => $faker->numberBetween($min = 1, $max = 17),
        		'vat_id' => $faker->numberBetween($min = 1, $max = 8)
        	]);

        }
    }
}
