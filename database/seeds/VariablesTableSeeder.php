<?php

use Illuminate\Database\Seeder;
use App\Variable;
class VariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_encode([
            [
              'colors' => json_encode(['#4ac0ed','#1f1b3d']),
              'percent' => 90,
              'text' => 'Ps',
              'id' => 'id-' . uniqid(),
            ],
            [
              'colors' => json_encode(['#ee7a38','#1b0e08']),
              'percent' => 90,
              'text' => 'Ai',
              'id' => 'id-' . uniqid(),
            ],
            [
              'colors' => json_encode(['#e8458f','#200811']),
              'percent' => 60,
              'text' => 'Id',
              'id' => 'id-' . uniqid(),
            ],
            [
              'colors' => json_encode(['#b78bbe','#1d0f25']),
              'percent' => 70,
              'text' => 'Pr',
              'id' => 'id-' . uniqid(),
            ],
            [
              'colors' => json_encode(['#d6a8ff','#17002a']),
              'percent' => 40,
              'text' => 'Ae',
              'id' => 'id-' . uniqid(),
            ],
        ]);

        $variable = new Variable();
        $variable->title = 'skills';
        $variable->data = $data;
        $variable->save();
    }
}
