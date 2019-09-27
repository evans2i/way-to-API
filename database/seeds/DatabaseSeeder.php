<?php

use App\Models\Buyer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Transaction;
use App\Models\User;
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Seller::truncate();
        Buyer::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        // DB::table('user_role')->truncate();
        DB::table('category_product')->truncate();

        $userno = 200;
        $sellerno = 800;
        $buyerno = 150;
        $products = 100;
        $category = 400;
        $transaction = 2000;

        $this->call(LaratrustSeeder::class);
        factory(User::class, $userno)->create();
        factory(Seller::class, $sellerno)->create();
        factory(Buyer::class, $buyerno)->create();
        factory(Category::class, $category)->create();

        factory(Product::class, $products)->create()->each(
            function ($product) {
                $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
                $product->categories()->attach($categories);
            }
        );
        factory(Transaction::class, $transaction)->create();
    }
}
