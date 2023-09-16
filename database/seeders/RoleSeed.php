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

     

        Permission::create(['name' => 'program.index'])->syncRoles([$admin, $instruct]);
        Permission::create(['name' => 'program.store'])->syncRoles([$admin]);/*2*/
        Permission::create(['name' => 'program.update'])->syncRoles([$admin]);/*3*/
        Permission::create(['name' => 'program.destroy'])->syncRoles([$admin]);/*4*/

        Permission::create(['name' => 'ficha.index'])->syncRoles([$admin, $instruct, $aprendiz]);/*5*/
        Permission::create(['name' => 'ficha.store'])->syncRoles([$admin]);/*6*/
        Permission::create(['name' => 'ficha.update'])->syncRoles([$admin]);/*7*/
        Permission::create(['name' => 'ficha.destroy'])->syncRoles([$admin]);/*8*/
        Permission::create(['name' => 'ficha.addAprendiz'])->syncRoles([$admin]);/*9*/
        Permission::create(['name' => 'ficha.index_members'])->syncRoles([$admin]);/*10*/
        Permission::create(['name' => 'ficha.export.excel'])->syncRoles([$admin, $instruct]);;/*11*/

        Permission::create(['name' => 'timeTable.index'])->syncRoles([$admin, $instruct]);;/*12*/
        Permission::create(['name' => 'timeTable.store'])->syncRoles([$admin]);/*13*/
        Permission::create(['name' => 'timeTable.update'])->syncRoles([$admin]);/*14*/
        Permission::create(['name' => 'timeTable.destroy'])->syncRoles([$admin]);/*15*/


        Permission::create(['name' => 'user.index'])->syncRoles([$admin]);/*16*/
        Permission::create(['name' => 'user.store'])->syncRoles([$admin]);/*17*/
        Permission::create(['name' => 'user.update'])->syncRoles([$admin]);/*18*/
        Permission::create(['name' => 'user.destroy'])->syncRoles([$admin]);/*19*/
        Permission::create(['name' => 'user.profile'])->syncRoles([$admin, $instruct, $aprendiz]);/*20*/
        Permission::create(['name' => 'profile.update'])->syncRoles([$admin]);/*21*/

        Permission::create(['name' => 'excuse.index'])->syncRoles([$admin, $instruct, $aprendiz]);;/*22*/
        Permission::create(['name' => 'excuse.store'])->syncRoles([$admin, $aprendiz]);/*23*/
        Permission::create(['name' => 'excuse.update'])->syncRoles([$admin]);/*24*/
        Permission::create(['name' => 'excuse.destroy'])->syncRoles([$admin]);/*25*/


        Permission::create(['name' => 'competence.index'])->syncRoles([$admin, $instruct]);/*26*/
        Permission::create(['name' => 'competence.store'])->syncRoles([$admin]);/*27*/
        Permission::create(['name' => 'competence.update'])->syncRoles([$admin]);/*28*/
        Permission::create(['name' => 'competence.destroy'])->syncRoles([$admin]);/*29*/


        Permission::create(['name' => 'attendance.index'])->syncRoles([$admin, $instruct, $aprendiz]);/*30*/
        Permission::create(['name' => 'attendance.store'])->syncRoles([$admin]);/*31*/
        Permission::create(['name' => 'attendance.update'])->syncRoles([$admin]);/*32*/
        Permission::create(['name' => 'attendance.destroy'])->syncRoles([$admin]);/*33*/


        /*$admin->permissions()->attach([
            1,2,3,4,5,6,7,8,9,10,11,12,13,14,
            15,16,17,18,19,20,21,22,23,24,25,
            26,27,28,29,30,31,32,33
        ]);

        $instruct->permissions()->attach([
            5,11,12,20,22,26,30
        ]);

        $aprendiz->permissions()->attach([
            0
        ]);*/

    }
}
