<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('roles')->insert([
            'name' => 'Administrador',
        ],
        [
            'name' => 'Profesor' ,
        ]);

        DB::table('categories')->insert([
            'name' => 'Nombrado',
            'hours' => 35,
        ],
        [
            'name' => 'No nombrado',
            'hours' => 20,
        ]);

        DB::table('faculties')->insert([
            'name' => 'Sistemas e informática',
        ]);

        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'role_id' => 1,
            'password' => bcrypt('12345678')
        ]);

        DB::table('schools')->insert([
            'name' => 'Ingenieria de sistemas',
            'faculty_id' => 1,
        ],
        [
            'name' => 'Ingenieria de software',
            'faculty_id' => 1
        ]);
    }
}
