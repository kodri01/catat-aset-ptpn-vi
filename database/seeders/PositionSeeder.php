<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            '1' => ['dashboards'],
            '2' =>  [
                'users-list',
                'users-create',
                'users-edit',
                'users-delete'
            ],
            '3' =>  [
                'kategori-list',
                'kategori-create',
                'kategori-edit',
                'kategori-delete'
            ],
            '4' =>  [
                'lokasi-list',
                'lokasi-create',
                'lokasi-edit',
                'lokasi-delete'
            ],
            '5' =>  [
                'aset-list',
                'aset-create',
                'aset-edit',
                'aset-delete'
            ],
            '6' =>  [
                'penyusutan-list',
                'penyusutan-create',
                'penyusutan-edit',
                'penyusutan-delete'
            ],
        ];

        foreach ($permissions as $permission => $values) {
            foreach ($values as $value) {
                Permission::create(['parent' => $permission, 'name' => $value]);
            }
        }
    }
}