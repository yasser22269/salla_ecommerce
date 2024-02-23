<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders for each model
        $this->call([
            VendorSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            OrderSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class,
            PaymentSeeder::class,
            ReviewSeeder::class,
            CouponSeeder::class,
            AddressSeeder::class,
            ShippingSeeder::class,
            ImageSeeder::class,
            WishlistSeeder::class,
            NotificationSeeder::class,
            ReturnProductSeeder::class,
            AnalyticsSeeder::class,
            DiscountSeeder::class,
            SubscriptionSeeder::class,
            FAQSeeder::class,
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
