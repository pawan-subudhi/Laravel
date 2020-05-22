<?php

use App\Role;
use App\User;
use App\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //to avoid seeding again of category we used truncate
        //Category::truncate();
        // $this->call(UsersTableSeeder::class);
        factory('App\User',20)->create();//create 20 users
        factory('App\Company',30)->create();//create 30 companies
        factory('App\Job',40)->create();//create 40 jobs

        $categories = [
            'Technology',
            'Engineering',
            'Government',
            'Medical',
            'Construction',
            'Software',
        ];
        foreach($categories as $category){
            Category::create(['name'=>$category]);
        }

        //create a role in rols table
        $adminRole = Role::create([
            'name' =>'admin'
        ]);

        //create record in users table for admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
            'email_verified_at' =>NOW(),
        ]);

        //insert record in role_user for admin with user_id and role_id
        //attach is used because we can attach role_id
        //calling roles() generally targets the role_user table
        //from $admin we get admin user_id and from $adminRole we get role_id 
        $admin->roles()->attach($adminRole);
    }
}
