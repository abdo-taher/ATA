<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Abdurhman Taher',
            'username' => 'abdoTaher24',
            'email' => 'abdotaher093@yahoo.com',
            'password' => bcrypt('123456'),
            'image'=>'admin.png',
            'role_name' => ["Owner"],
            'Status' => true,
        ]);

        $role = Role::create(['name' => 'Owner']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);


    }
}
