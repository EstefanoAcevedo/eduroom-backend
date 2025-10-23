<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions (if needed, but for this case, roles are enough)
        // Example: Permission::create(['name' => 'create carreras']);

        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $teacherRole = Role::firstOrCreate(['name' => 'Teacher']);
        $studentRole = Role::firstOrCreate(['name' => 'Student']);

        // Create Admin User
        $admin = User::firstOrCreate(
            ['user_email' => 'admin@example.com'],
            [
                'user_cuil' => '20436319739',
                'user_pass' => Hash::make('admin1234'),
                'user_lastname' => 'Acevedo',
                'user_name' => 'Estéfano Marcial',
                'user_tel' => '3435458494',
                'user_address' => 'Alfredo Palacios 1001',
                'user_location' => 'Nogoyá, Entre Ríos. Argentina',
            ]
        );
        $admin->assignRole($adminRole);

        // Create an example Profesor user
        $teacher = User::firstOrCreate(
            ['user_email' => 'teacher@example.com'],
            [
                'user_cuil' => '20365168882',
                'user_pass' => Hash::make('teacher1234'),
                'user_lastname' => 'Bracamonte',
                'user_name' => 'Adrián Alejandro',
                'user_tel' => '3436575198',
                'user_address' => 'Ángel Balbi 304',
                'user_location' => 'Victoria, Entre Ríos. Argentina',
            ]
        );
        $teacher->assignRole($teacherRole);

        // Create an example Estudiante user
        $student = User::firstOrCreate(
            ['user_email' => 'student@example.com'],
            [
                'user_cuil' => '20564528802',
                'user_pass' => Hash::make('student1234'),
                'user_lastname' => 'Alfáro',
                'user_name' => 'Thiago Valentino',
                'user_tel' => '3435454222',
                'user_address' => 'Camino del Rey 24',
                'user_location' => 'Nogoyá, Entre Ríos. Argentina',
            ]
        );
        $student->assignRole($studentRole);

        $this->command->info('Roles and initial users created successfully!');
    }
}
