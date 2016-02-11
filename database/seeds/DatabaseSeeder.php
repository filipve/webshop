<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');

		DB::table('orders')->delete();
		DB::table('products')->delete();
		DB::table('users')->delete();
    	$this->call('ProductTableSeeder');
    	$this->call('UserTableSeeder');

	}

}
