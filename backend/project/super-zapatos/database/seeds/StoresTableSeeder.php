<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$stores = [];
    	for(int $i=1; $i<=10; $i++){
    		$stores[] = [
    			'name' => 'Store '.$i,
    			'address' => 'Address of the Store '.$i,
    		];
    	}
        DB::table('stores')->insert($stores);
    }
}
