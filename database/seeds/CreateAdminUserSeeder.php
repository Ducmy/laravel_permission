<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create super admin 
        // Can managament all user
        $user1 = User::create([
            'name' => 'Super Admin',
            'email' => 'super@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $role1 = Role::create(['name' => 'super-admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role1->syncPermissions($permissions);
        $user1->assignRole([$role1->id]);

        // Create admin
        // Can managament accepting admin & super-admin
        $user2 = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $role2 = Role::create(['name' => 'admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role2->syncPermissions($permissions);
        $user2->assignRole([$role2->id]);

        // Create teacher
        // * Create/Update/List of post (No delete) - Any update can send via email...
        $user3 = User::create([
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $role3 = Role::create(['name' => 'teacher']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role3->syncPermissions($permissions);
        $user3->assignRole([$role3->id]);

        // Create normal user
        // * Show post only
        $user4 = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $role4 = Role::create(['name' => 'user']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role4->syncPermissions($permissions);
        $user4->assignRole([$role4->id]);

        //  Create normal user
        // * Show post only
        $user4 = User::create([
            'name' => 'User 01',
            'email' => 'user01@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $user4->assignRole([$role4->id]);
    }
}
