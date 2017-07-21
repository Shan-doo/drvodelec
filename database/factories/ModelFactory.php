<?php

use App\Classes\ConversationToken;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\File;

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

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
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

        'likes' => rand(33, 55)
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    
    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Subscriber::class, function (Faker\Generator $faker) {
    
    return [
        'email' => $faker->email,
        'status' => rand(0,1)
    ];
});
