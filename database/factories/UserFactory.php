<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->word,
        'verified' => $verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
        'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
        'email_verified_at' => $verified == User::UNVERIFIED_USER ? null : $faker->date('Y-m-d H:i:s'),
        'password' => $password ?: $password = bcrypt('password'),
        'remember_token' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s')
    ];
});


$factory->define(Seller::class, function (Faker\Generator $faker) {

    return [
        'lat' => $faker->word,
        'lang' => $faker->word,
        'city' => $faker->city,
        'street' => $faker->city,
        'Block' => $faker->numberBetween(1, 5),
        'user_id' => User::all()->random()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
    ];
});



$factory->define(Buyer::class, function (Faker\Generator $faker) {
    $seller = User::has('sellers')->get()->random();
    $buyer = User::all()->except($seller->id)->random();
    return [
        'lat' => $faker->word,
        'lang' => $faker->word,
        'city' => $faker->city,
        'street' => $faker->city,
        'Block' => $faker->numberBetween(1, 5),
        'user_id' => $buyer->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
    ];
});

$factory->define(Product::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'description' => $faker->paragraph(),
        'quantity' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
        'image' => $faker->randomElement(['1.png', '2.png', '3.png', '4.png']),
        'seller_id' => Seller::all()->random()->id, // User::inRandomOrder()->first()->id
        'created_at' => $faker->date('Y-m-d H:i:s')
    ];
});



$factory->define(Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'description' => $faker->paragraph(),
        'created_at' => $faker->date('Y-m-d H:i:s')
    ];
});





// Transaction

$factory->define(Transaction::class, function (Faker\Generator $faker) {

    $seller = Seller::has('products')->get()->random();
    $buyer = Buyer::all()->random();

    return [
        'quantity' => $faker->numberBetween(1, 3),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
