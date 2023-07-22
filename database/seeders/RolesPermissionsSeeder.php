<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'service' => [],
            'administrator' => [
                'view any users',
            ],
            'therapist' => [],
            'patient' => [],
        ];

        foreach($roles as $role => $permissions){
        
            $r = Role::findOrCreate($role);

            foreach($permissions as $permission){
                $p = Permission::findOrCreate($permission);
                $r->hasPermissionTo($permission) ?: $r->permissions()->attach($p);
            }
        }
    }
}
