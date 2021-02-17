<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            "name" => "Giovanni",
            "lastname" => "Rossi",
            "email" => "giovannirossi@gmail.com",
            "vat_number" => "10256578104",
            'password' => bcrypt('password1'),
        ]);
        DB::table('users')->insert([
            "name" => "Paola",
            "lastname" => "Bianchi",
            "email" => "paolabianchi@gmail.com",
            "vat_number" => "78968598413",
            'password' => bcrypt('password2'),
        ]);
        DB::table('users')->insert([
            "name" => "Annalisa",
            "lastname" => "De Santis",
            "email" => "annalisadesantis@gmail.com",
            "vat_number" => "63968978415",
            'password' => bcrypt('password3'),
        ]);
        DB::table('users')->insert([
            "name" => "Sabrina",
            "lastname" => "Cunsolo",
            "email" => "sabrinacunsolo@gmail.com",
            "vat_number" => "89416356897",
            'password' => bcrypt('password4'),
        ]);
        DB::table('users')->insert([
            "name" => "Patrizia",
            "lastname" => "Crimi",
            "email" => "patriziacrimi@gmail.com",
            "vat_number" => "89124563997",
            'password' => bcrypt('password5'),
        ]);
        DB::table('users')->insert([
            "name" => "Marco",
            "lastname" => "Caputo",
            "email" => "marcocaputo@gmail.com",
            "vat_number" => "40236778709",
            'password' => bcrypt('password6'),
        ]);
        DB::table('users')->insert([
            "name" => "Maurizio",
            "lastname" => "Faedda",
            "email" => "mauriziofaedda@gmail.com",
            "vat_number" => "58968898013",
            'password' => bcrypt('password7'),
        ]);
        DB::table('users')->insert([
            "name" => "Maria",
            "lastname" => "Bruni",
            "email" => "mariabruni@gmail.com",
            "vat_number" => "83973478483",
            'password' => bcrypt('password8'),
        ]);
        DB::table('users')->insert([
            "name" => "Carlo",
            "lastname" => "Verdi",
            "email" => "carloverdi@gmail.com",
            "vat_number" => "18426356027",
            'password' => bcrypt('password9'),
        ]);
        DB::table('users')->insert([
            "name" => "Paolo",
            "lastname" => "Neri",
            "email" => "paoloneri@gmail.com",
            "vat_number" => "59174563490",
            'password' => bcrypt('password10'),
        ]);
    }
}
