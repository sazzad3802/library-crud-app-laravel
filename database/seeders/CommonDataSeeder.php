<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommonDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $path = database_path('seeders/data/StandingData.csv');
        $handle = fopen($path, 'r'); // reads/opens the file 

        if ($handle === false) {
            throw new \Exception("Could not open the CSV file.");
        }

        $header = fgetcsv($handle); // first row is header


        // fgetcsv helps to get the row based on the handle cursor
        while (($row = fgetcsv($handle)) !== false) {

            try {
                // pad in case some rows are shorter
                $row = array_pad($row, 10, null);

                DB::table('common_data')->insert([
                    'pid'         => $row[0] ?? null,
                    'type'         => $row[1] ?? null,
                    'name'         => $row[2] ?? null,
                    'description'  => ($row[3] !== 'NULL') ? $row[3] : null,
                    'is_active'    => ($row[4] !== 'NULL') ? $row[4] : null,
                    'int_value'    => ($row[5] !== 'NULL') ? $row[5] : null,
                    'string_value' => ($row[6] !== 'NULL') ? $row[6] : null,
                    'latitude'     => ($row[7] !== 'NULL') ? $row[7] : null,
                    'longitude'    => ($row[8] !== 'NULL') ? $row[8] : null,
                    'parent_id'    => ($row[9] !== 'NULL') ? $row[9] : null,
                ]);
            } catch (\Exception $e) {
                dump($e->getMessage(), $row);
            }
            
        }

        fclose($handle);
    }
}
