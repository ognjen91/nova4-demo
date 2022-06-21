<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, ActivityCategory, Activity, City};

class DatabaseSeeder extends Seeder
{

    private $parent_categories_ids = [];
    private $cities_data;
    private $cities;
    private $categories;



    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        require __DIR__ . '/cities_data.php';
        $this->cities_data = $cities_data;



        $this->categories = ActivityCategory::factory(5)->create();

        $this->cities = collect([]);
        foreach ($this->cities_data as $city_data){
            $city = City::factory()->create([
                'name' => $city_data['name'],
                'lat' => $city_data['lat'],
                'lng' => $city_data['lng'],
            ]);
            $this->cities->push($city);

            foreach ($city_data['activities'] as $activity) {
                Activity::factory()->create([
                    'city_id' => $city->id,
                    'title' => $activity['title'],
                    'lat' => $activity['lat'],
                    'lng' => $activity['lng']
                ])->each(function($activity){
                    $shuffled_categories = $this->categories->shuffle();
                    $activity->categories()->attach($shuffled_categories->first()->id);
                });
            }
        }


        User::factory()->create([
            'name' => 'Pph Srbija Admin',
            'email' => 'ognjen+admin@systemstudio.co',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'city_id' => $this->cities->shuffle()->first()->id
        ]);

        User::factory()->create([
            'name' => 'Pph Srbija Admin',
            'email' => 'ognjen+moderator@systemstudio.co',
            'password' => bcrypt('123456'),
            'role' => 'moderator',
            'city_id' => $this->cities->shuffle()->first()->id
        ]);

        User::factory()->create([
            'name' => 'Pph Srbija Admin',
            'email' => 'ognjen+user@systemstudio.co',
            'password' => bcrypt('123456'),
            'role' => 'regular_user',
            'city_id' => $this->cities->shuffle()->first()->id
        ]);


        
    }
}
