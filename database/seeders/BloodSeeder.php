<?php

namespace Database\Seeders;

use App\Models\Type_Blode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodSeeder extends Seeder
{
      /**
       * Run the database seeds.
       */
      public function run(): void
      {
            DB::table('type__blodes')->delete();

            $bgs = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];

            foreach($bgs as  $bg){
                  Type_Blode::create(['Name' => $bg]);
            }
      }
}
