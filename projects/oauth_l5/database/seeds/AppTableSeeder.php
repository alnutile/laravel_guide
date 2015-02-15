<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AppTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->createAdminUser();

	}

	public function createAdminUser()
	{
		User::create(
			[
				"email" => "admin@foo.com",
				"password" => Hash::make(getenv('ADMIN_PASS')),
				"dmp_id"  => '',
			]
		);
	}

}
