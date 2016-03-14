<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('AutorsTableSeeder');
        $this->command->info('Autor seed successful');

        $this->call('BooksTableSeeder');
        $this->command->info('Book seed successful');
    }
}

class AutorsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('autors')->delete();

        DB::table('autors')->insert([
            ['name' => 'George Orwell'],
            ['name' => 'Franz Fafka'],
            ['name' => 'Jules Gabriel Verne'],
            ['name' => 'Alexander Duma'],
            ['name' => 'Carl Philipp Gottlieb von Clausewitz']
        ]);
    }
}

class BooksTableSeeder extends Seeder {

    public function run()
    {
        DB::table('books')->delete();

        DB::table('books')->insert([
            ['name' => 'Vingt mille lieues sous les mers', 'write_at' => '1970'],
            ['name' => 'Nineteen Eighty-Four', 'write_at' => '1949'],
            ['name' => 'Die Verwandlung', 'write_at' => '1912'],
            ['name' => 'Vom Kriege', 'write_at' => '1832'],
            ['name' => 'Les trois mousquetaires', 'write_at' => '1844']
        ]);
    }
}