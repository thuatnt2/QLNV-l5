<?php

use Illuminate\Database\Seeder;

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
        DB::table('networks')->delete();
        
		$this->call(UserSeeder::class);
        $this->call(KindsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(PurposesTableSeeder::class);
        $this->call(NetworkTableSeeder::class);
                
	}

}
