<?php

use App\Classes\ConversationToken;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\File;

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $now = Carbon::now();

    return [
        'username' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'role_id' => rand(1, 2),
        'remember_token' => str_random(10),
        'created_at' => $created = $now->subMonths(rand(1, 36))->subDays(rand(1, 30)),
        'updated_at' => $created->addMonths(rand(1, 6))->addDays(rand(1, 30)),
        'last_login' => $created->addMonths(rand(1, 6))->addDays(rand(1, 30)),
    ];
});

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    

    return [
        'owner' => 0,
        'body' => $faker->text(),
        'conversation_id' => factory(App\Conversation::class)->make()->id
    ];
});

$factory->define(App\Conversation::class, function (Faker\Generator $faker) {
    

    return [
        'sender' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'subject' => $faker->sentence(5),
        'token' => (new ConversationToken(26))
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    

    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Image::class, function (Faker\Generator $faker) {
    
    $dummyImages = Storage::allFiles('public/dummyImages');

    $randomImagePath = 'app/' . $dummyImages[rand(0, (count($dummyImages) - 1))];

    $randomImage = new File(storage_path($randomImagePath));
    
    Storage::disk('local')->put('public/images/', $randomImage);

    Storage::disk('local')->put('public/images/thumbnails', $randomImage);

    return [
        'name' => $randomImage->hashName(),

        'description' => $faker->sentence(),

        'views' => rand(55, 111),

        'likes' => rand(33, 55),

        'user_id' => rand(1, 3),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    
    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Subscriber::class, function (Faker\Generator $faker) {

    $now = Carbon::now();
    
    return [
        'email' => $faker->email,
        'status' => rand(0,1),
        'created_at' => $created = $now->subMonths(rand(1, 36))->subDays(rand(1, 30)),
        'updated_at' => $created->addMonths(rand(1, 6))->addDays(rand(1, 30)),
    ];
});