<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir los roles
        $admin = Role::create(['name' => 'administrador']);
        $instruct = Role::create(['name' => 'instructor']);
        $aprendiz = Role::create(['name' => 'aprendiz']);


        Permission::create(['name' => 'program.index']);
        Permission::create(['name' => 'program.store']);
        Permission::create(['name' => 'program.update']);
        Permission::create(['name' => 'program.destroy']);

        Permission::create(['name' => 'ficha.index']);
        Permission::create(['name' => 'ficha.store']);
        Permission::create(['name' => 'ficha.update']);
        Permission::create(['name' => 'ficha.destroy']);
        Permission::create(['name' => 'ficha.addAprendiz']);
        Permission::create(['name' => 'ficha.index_members']);
        Permission::create(['name' => 'ficha.export.excel']);

        Permission::create(['name' => 'timeTable.index']);
        Permission::create(['name' => 'timeTable.store']);
        Permission::create(['name' => 'timeTable.update']);
        Permission::create(['name' => 'timeTable.destroy']);


        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.store']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'user.destroy']);
        Permission::create(['name' => 'user.profile']);
        Permission::create(['name' => 'profile.update']);

        Permission::create(['name' => 'excuse.index']);
        Permission::create(['name' => 'excuse.store']);
        Permission::create(['name' => 'excuse.update']);
        Permission::create(['name' => 'excuse.destroy']);


        Permission::create(['name' => 'competence.index']);
        Permission::create(['name' => 'competence.store']);
        Permission::create(['name' => 'competence.update']);
        Permission::create(['name' => 'competence.destroy']);


        Permission::create(['name' => 'attendance.index']);
        Permission::create(['name' => 'attendance.store']);
        Permission::create(['name' => 'attendance.update']);
        Permission::create(['name' => 'attendance.destroy']);


        $admin->permissions()->attach([
            1,2,3,4,5,6,7,8,9,10,11,12,13,14,
            15,16,17,18,19,20,21,22,23,24,25,
            26,27,28,29,30,31,32,33
        ]);

        $instruct->permissions()->attach([
            1,5,11,12,20,22,26,30
        ]);

        $aprendiz->permissions()->attach([
            1, 5, 12, 21, 22, 23, 30
        ]);

    }
}
