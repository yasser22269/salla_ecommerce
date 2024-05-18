<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Site Settings
            [
                'key' => 'site_name',
                'value' => 'My E-Commerce Site',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'maintenance_mode',
                'value' => 'off',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'default_language',
                'value' => 'en',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'support@ecommerce.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'phone_number',
                'value' => '+1-800-123-4567',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'address',
                'value' => '123 E-commerce St, Shopsville, USA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Financial Settings
            [
                'key' => 'currency',
                'value' => 'USD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'tax_rate',
                'value' => '7.5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Time and Date Settings
            [
                'key' => 'timezone',
                'value' => 'America/New_York',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Branding
            [
                'key' => 'logo_url',
                'value' => 'https://www.yoursite.com/logo.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Social Media
            [
                'key' => 'facebook_link',
                'value' => 'https://www.facebook.com/yourpage',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'twitter_link',
                'value' => 'https://www.twitter.com/yourprofile',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'instagram_link',
                'value' => 'https://www.instagram.com/yourprofile',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Shipping Settings
            [
                'key' => 'flat_rate_shipping',
                'value' => '5.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'free_shipping_minimum',
                'value' => '50.00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // User Roles
            [
                'key' => 'default_user_role',
                'value' => 'customer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Email Notifications
            [
                'key' => 'notify_admin_on_new_order',
                'value' => 'true',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'order_confirmation_email_subject',
                'value' => 'Your Order Confirmation',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'order_confirmation_email_body',
                'value' => 'Thank you for your order! Your order number is {order_number}.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Additional Settings
            [
                'key' => 'allow_guest_checkout',
                'value' => 'true',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'enable_reviews',
                'value' => 'true',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('settings')->insert($settings);
    }
}
