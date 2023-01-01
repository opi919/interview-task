<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Momen Khandoker',
            'email' => 'khandokermomen919@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        Product::factory(9)->create();
        Voucher::create([
            'code' => 'Discount5',
            'value' => '5%'
        ]);
        Voucher::create([
            'code' => 'Discount10',
            'value' => '10%'
        ]);
        Voucher::create([
            'code' => 'Winter-300',
            'value' => '300'
        ]);
    }
}
