<?php

namespace Modules\Debit\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Debit\Entities\Debit;

class DebitDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Debit::factory(10000)->create();
        // $this->call("OthersTableSeeder");
    }
}
