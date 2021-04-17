<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MadrasahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/sql_dumps/madrasah.sql');

        DB::statement($sql);
        //
        // $madrasahs = [
        //     [
        //         'nama' => 'KB. PAUD AL FIRDAUS BAHRUL ULUM',
        //         'kepala' => 'Hj. Zumrotus Sholichah, S.Pd.',
        //         'ttd' => null,
        //         'stempel' => null,
        //         'nip' => null,
        //     ],
        //     [
        //         'nama' => 'TK MUSLIMAT 2 BAHRUL ULUM',
        //         'kepala' => 'Uswatun Arifah, S.Psi.',
        //         'ttd' => null,
        //         'stempel' => null,
        //         'nip' => null,
        //     ],
        //     [
        //         'nama' => 'MI BAHRUL ULUM',
        //         'kepala' => 'H. Nuril Hida, B.S',
        //         'ttd' => null,
        //         'stempel' => null,
        //         'nip' => null,
        //     ],
        //     [
        //         'nama' => 'MADRASAH MU\'ALLIMIN MU\'ALIMAT',
        //         'kepala' => 'KH. Abdul Nashir Fattah',
        //         'ttd' => null,
        //         'stempel' => null,
        //         'nip' => null,
        //     ],
        //     [
        //         'nama' => 'MTsN 3 JOMBANG',
        //         'kepala' => 'H. Moch. Syuaib, S.Ag., M.Pd.I',
        //         'ttd' => null,
        //         'stempel' => null,
        //         'nip' => null,
        //     ],
        //     [
        //         'nama' => '',
        //         'kepala' => '',
        //         'ttd' => null,
        //         'stempel' => null,
        //         'nip' => null,
        //     ],
        //     [
        //         'nama' => '',
        //         'kepala' => '',
        //         'ttd' => null,
        //         'stempel' => null,
        //         'nip' => null,
        //     ],
        // ];

        // foreach ($madrasahs as $key => $value) {
        //     \App\Models\Madrasah::create($value);
        // }
    }
}
