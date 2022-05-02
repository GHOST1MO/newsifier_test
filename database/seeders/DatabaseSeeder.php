<?php
namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		Image::factory(1)->create();
		$collectionToInsert = collect([]);

		$numberOfEntries = 100000;
		$faker = Faker\Factory::create();
		for ($i = 1; $i <= $numberOfEntries; $i++) {
			$collectionToInsert->push([
				'username' => $faker->unique()->userName,
				'karma_score' => $faker->numberBetween(0, 10000),
				'image_id' => 1,
			]);
		}

		$chunks = $collectionToInsert->chunk(500);

		foreach ($chunks as $chunk) {
			User::insert($chunk->toArray());
		}
	}
}
