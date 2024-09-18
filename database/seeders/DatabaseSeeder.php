<?php

namespace Database\Seeders;

use App\Enums\Permission as UserPermission;
use App\Enums\Role as UserRole;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Product::create([
            'name' => 'Product 1',
            'detail' => 'dkjdshfksdfjskdhfjdskf',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        Product::create([
            'name' => 'Product 2',
            'detail' => 'hksjdfh hflksdjf dsfhjklsdhf',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        Product::create([
            'name' => 'Product 3',
            'detail' => 'hello',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        error_log("Loading permissions");
        $role_super_admin = Role::create(['name' => UserRole::SUPER_ADMIN, 'guard_name' => 'api']);
        $role_customer = Role::create(['name' => UserRole::CUSTOMER, 'guard_name' => 'api']);
        $role_store_owner = Role::create(['name' => UserRole::STORE_OWNER, 'guard_name' => 'api']);
        $role_staff = Role::create(['name' => UserRole::STAFF, 'guard_name' => 'api']);

        $permission_super_admin = Permission::create(['name' => UserPermission::SUPER_ADMIN, 'guard_name' => 'api']);
        $permission_customer = Permission::create(['name' => UserPermission::CUSTOMER, 'guard_name' => 'api']);
        $permission_store_owner = Permission::create(['name' => UserPermission::STORE_OWNER, 'guard_name' => 'api']);
        $permission_staff = Permission::create(['name' => UserPermission::STAFF, 'guard_name' => 'api']);

        $user = User::create([
            'name' =>  'admin',
            'email' =>  'admin@gmail.com',
            'password' =>  Hash::make('admin'),
            'email_verified_at' => now()->timestamp
        ]);
        $user->save();
        $user->givePermissionTo(
            [
                UserPermission::SUPER_ADMIN,
                UserPermission::STORE_OWNER,
                UserPermission::CUSTOMER,
            ]
        );
//        $user->assignPermission([
//            UserPermission::SUPER_ADMIN,
//            UserPermission::STORE_OWNER,
//            UserPermission::CUSTOMER,
//        ]);
        $user->assignRole(UserRole::SUPER_ADMIN);


        $user1 = User::create([
            'name' =>  'Customer',
            'email' =>  'customer1@gmail.com',
            'password' =>  Hash::make('1234'),
            'email_verified_at' => now()->timestamp
        ]);
        $user1->save();
        $user1->givePermissionTo(
            [
                UserPermission::CUSTOMER,
            ]
        );
//        $user1->assignPermission([
//            UserPermission::CUSTOMER,
//        ]);
        $user1->assignRole(UserRole::CUSTOMER);
    }
}
