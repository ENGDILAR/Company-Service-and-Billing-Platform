<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TestRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {
            // إنشاء الجدول أولاً
            $tableId = DB::table('tables')->insertGetId([
                'name' => 'جدول ' . $i,
                'total' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $rows = [];
            $totalCredit = 0;
            $totalDebit = 0;

            for ($j = 1; $j <= 200; $j++) {
                $credit = $faker->numberBetween(0, 1000);
                $debit  = $faker->numberBetween(0, 1000);

                $rows[] = [
                    'TableID'   => $tableId,
                    'statement' => $faker->sentence(6),
                    'credit'    => $credit,
                    'debit'     => $debit,
                    'details'   => $faker->optional()->sentence(10),
                    'date'      => now(),
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ];

                $totalCredit += $credit;
                $totalDebit  += $debit;
            }

            // إدراج كل الأسطر دفعة واحدة
            DB::table('rows')->insert($rows);

            // تحديث إجمالي الجدول
            DB::table('tables')->where('id', $tableId)->update([
                'total' => $totalCredit - $totalDebit
            ]);
        }
    }

}
