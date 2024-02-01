<?php

namespace Database\Seeders;

use App\Models\PermissionsModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = PermissionsModel::whereIn('id', range(1, 21))->get(); // Ambil permissions dengan ID 1 sampai 21

        foreach ($permissions as $permission) {
            if ($permission->id === 1 || ($permission->id >= 6 && $permission->id <= 21)) {
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission->id,
                    'role_id' => 3 // Masukkan ke role_id 3 jika permission id 1, 10-21
                ]);
            }

            if ($permission->id === 1 || ($permission->id >= 10 && $permission->id <= 21)) {
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission->id,
                    'role_id' => 2 // Masukkan ke role_id 3 jika permission id 1, 10-21
                ]);
            }

            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission->id,
                'role_id' => 1 // Masukkan ke role_id 1 untuk semua permission (ID 1-21)
            ]);
        }
    }
}
