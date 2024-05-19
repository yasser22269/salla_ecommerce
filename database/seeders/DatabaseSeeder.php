<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\VendorProduct;
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
            SettingSeeder::class,
            AdminSeeder::class,
            VendorSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            AttributeSeeder::class,
            OptionSeeder::class,
            VendorProductSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
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
            AnalyticsSeeder::class,
            SubscriptionSeeder::class,
            FAQSeeder::class,
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
