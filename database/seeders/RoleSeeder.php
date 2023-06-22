<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Admin;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $basicAdminRole = Role::factory()->state(["role" => "basicAdmin"])->create();
        $superAdminRole = Role::factory()->state(["role" => "superAdmin"])->create();

        $basicAdmin = Admin::factory()->state(["name" => "basicAdmin", "email" => "admin@iaw.com", "password" => "$2a$12$7knpvvkRVOwNLVIkAZmk4OlSjB9CcSQc7oOViTM.hf63/fexSrT.G"])->create();
        $superAdmin = Admin::factory()->state(["name" => "superAdmin", "email" => "superAdmin@iaw.com", "password" => "$2a$12$7knpvvkRVOwNLVIkAZmk4OlSjB9CcSQc7oOViTM.hf63/fexSrT.G"])->create();
    
        $basicAdminRole->admins()->save($basicAdmin);
        $superAdminRole->admins()->save($superAdmin);
    }
}
