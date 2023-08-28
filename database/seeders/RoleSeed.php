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


        Permission::create(['name' => 'program.index']); /*1*/
        Permission::create(['name' => 'program.store']);/*2*/
        Permission::create(['name' => 'program.update']);/*3*/
        Permission::create(['name' => 'program.destroy']);/*4*/

        Permission::create(['name' => 'ficha.index']);/*5*/
        Permission::create(['name' => 'ficha.store']);/*6*/
        Permission::create(['name' => 'ficha.update']);/*7*/
        Permission::create(['name' => 'ficha.destroy']);/*8*/
        Permission::create(['name' => 'ficha.addAprendiz']);/*9*/
        Permission::create(['name' => 'ficha.index_members']);/*10*/
        Permission::create(['name' => 'ficha.export.excel']);/*11*/

        Permission::create(['name' => 'timeTable.index']);/*12*/
        Permission::create(['name' => 'timeTable.store']);/*13*/
        Permission::create(['name' => 'timeTable.update']);/*14*/
        Permission::create(['name' => 'timeTable.destroy']);/*15*/


        Permission::create(['name' => 'user.index']);/*16*/
        Permission::create(['name' => 'user.store']);/*17*/
        Permission::create(['name' => 'user.update']);/*18*/
        Permission::create(['name' => 'user.destroy']);/*19*/
        Permission::create(['name' => 'user.profile']);/*20*/
        Permission::create(['name' => 'profile.update']);/*21*/

        Permission::create(['name' => 'excuse.index']);/*22*/
        Permission::create(['name' => 'excuse.store']);/*23*/
        Permission::create(['name' => 'excuse.update']);/*24*/
        Permission::create(['name' => 'excuse.destroy']);/*25*/


        Permission::create(['name' => 'competence.index']);/*26*/
        Permission::create(['name' => 'competence.store']);/*27*/
        Permission::create(['name' => 'competence.update']);/*28*/
        Permission::create(['name' => 'competence.destroy']);/*29*/


        Permission::create(['name' => 'attendance.index']);/*30*/
        Permission::create(['name' => 'attendance.store']);/*31*/
        Permission::create(['name' => 'attendance.update']);/*32*/
        Permission::create(['name' => 'attendance.destroy']);/*33*/


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
