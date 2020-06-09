<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'google_id' => null,
        'user_type'=>'seeker',//make all seeker for time being
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

//Factory for Company database using faker
$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,//we get user_id from our Users Model this lines get a random user id from users table
        'cname' => $name = $faker->company,
        'slug' => str_slug($name),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'website' => $faker->domainName,
        'logo' =>'man.jpg',
        'cover_photo' =>'tumblr-image-sizes-banner.png',
        'slogan' =>'learn-earn and grow',
        'description' => $faker->paragraph(rand(2,10))//it gives 2 to 10 radomly paragraphs
    ];
});

//Factory for Jobs database using faker
$factory->define(App\Job::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,//we get user_id from our Users Model this lines get a random user id from users table
        'company_id' => App\Company::all()->random()->id,
        'title' => $title = $faker->text,
        'slug' => str_slug($title),
        'position' => $faker->jobTitle,
        'address' => $faker->address,
        'category_id' => rand(1,5),
        'type' =>  $faker->randomElement(['fulltime','parttime','casual']),
        'status' => rand(0,1),//0->pending and 1->live
        'description' => $faker->paragraph(rand(2,10)),
        'roles' => $faker->text,
        'last_date' => $faker->DateTime,
        'number_of_vacancy' => rand(1,10),
        'experience' => rand(1,10),
        'gender' => $faker->randomElement(['male','female']),
        'salary' => rand(10000,50000),

    ];
});

//Factory for Testimonies database using faker
$factory->define(App\Testimonial::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph(rand(40,100)),
        'name' => 'kumar_Pawan',
        'profession' => 'Mindfire Intern',
        'video_id' => 407694202

    ];
});

//Factory for Testimonies database using faker
$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->text,
        'slug' => str_slug($title),
        'content' => $faker->paragraph(rand(40,100)),
        'status' => rand(0,1),//0->pending and 1->live
        'image' => 'man.jpg'

    ];
});