<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('pages')->insert([
          [
            'title' => 'About',
            'body' => 'About page',
          ],
          [
            'title' => 'Contact',
            'body' => 'Contact page',
          ],
      ]);
    }
}
