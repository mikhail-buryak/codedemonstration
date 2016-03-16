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

class AutorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('autors')->delete();

        DB::table('autors')->insert([
            ['name' => 'George Orwell'],
            ['name' => 'Franz Kafka'],
            ['name' => 'Jules Gabriel Verne'],
            ['name' => 'Alexander Duma'],
            ['name' => 'Carl Philipp Gottlieb von Clausewitz']
        ]);
    }
}

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->delete();

        DB::table('books')->insert([
            ['title' => 'Vingt mille lieues sous les mers', 'write_at' => '1970', 'autor_id' => 3, 'preview' => 'mille.jpg', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['title' => 'Nineteen Eighty-Four', 'write_at' => '1949', 'autor_id' => 1, 'preview' => 'ss.jpg', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['title' => 'Die Verwandlung', 'write_at' => '1912', 'autor_id' => 2, 'preview' => '', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['title' => 'Vom Kriege', 'write_at' => '1832', 'autor_id' => 5, 'preview' => 'vomkriege.jpg', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")],
            ['title' => 'Les trois mousquetaires', 'write_at' => '1844', 'autor_id' => 4, 'preview' => '', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]
        ]);
    }
}