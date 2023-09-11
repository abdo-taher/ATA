<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class AdminModel extends Authenticatable
{
    use HasFactory,Notifiable,HasRoles;
    protected $guarded = 'admin';
    protected $table = 'admins';
    protected $fillable = [
        'username', 'email', 'password', 'image', 'role_as', 'company_code', 'remember_token', 'is_active', 'created_at', 'updated_at'
    ];

    public function role_as(){
        $superAdmin = $this::all()->where('role_as',0);
        $normalAdmin = $this::all()->where('role_as',1);
        $employee = $this::all()->where('role_as',2);
        if (isset($superAdmin)){
            return 'Super Admin';
        }
        if (isset($normalAdmin)){
            return 'Normal Admin';
        }
        if (isset($employee)){
            return 'Employee';
        }
    }
}
