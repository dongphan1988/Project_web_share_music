<?php

use App\Mode;
use Illuminate\Database\Seeder;

class ModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mode = new Mode();
        $mode->id = 1;
        $mode->name = 'Công khai';
        $mode->save();

        $mode = new Mode();
        $mode->id = 2;
        $mode->name = 'Riêng tư';
        $mode->save();
    }
}
