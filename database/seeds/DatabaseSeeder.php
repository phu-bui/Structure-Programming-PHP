<?php

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
//        $this->call(UsersTableSeeder::class);
//        $this->call(AdminTableSeeder::class);
//        $this->call(CategoryTableSeeder::class);
//        $this->call(BannerTableSeeder::class);
//        $this->call(BrandTableSeeder::class);
//        $this->call(OrderDetailTableSeeder::class);
//        $this->call(OrderTableSeeder::class);
//        $this->call(PaymentTypeTableSeeder::class);
//        $this->call(ProductImageTableSeeder::class);
//        $this->call(ProductTableSeeder::class);
//        $this->call(ProductImageTableSeeder::class);
//        $this->call(PropertyTypeTableSeeder::class);
//        $this->call(PropertyTableSeeder::class);
//        $this->call(ShippingTypeTableSeeder::class);
        $this->call(WarehouseTableSeeder::class);

    }
}
