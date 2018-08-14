<?php

use Illuminate\Database\Seeder;

class JobSkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\JobSkill', 55000)->create();
    }
}
