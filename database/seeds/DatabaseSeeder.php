<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
        DB::table('users')->delete();
        DB::table('kinds')->delete();
        DB::table('units')->delete();
        DB::table('categories')->delete();
        DB::table('purposes')->delete();
        
		$this->call('UserSeeder');
        $this->call('KindsTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('UnitsTableSeeder');
        $this->call('PurposesTableSeeder');
                
	}

}
