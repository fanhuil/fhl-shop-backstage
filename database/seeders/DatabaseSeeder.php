<?php

namespace Database\Seeders;

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
        // 运行php artisan db:seed不指定类名时调用，如果指定类名 --class ClassName时则单独调用填充文件方法
        $this->call(UserTableSeeder::class); // 调用User种子文件类
        $this->call(ArticleTableSeeder::class); // 调用Article种子文件类
    }
}
