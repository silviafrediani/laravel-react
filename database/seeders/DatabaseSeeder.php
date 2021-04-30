<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Category;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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

			DB::statement('SET FOREIGN_KEY_CHECKS=0;');
			User::truncate();
			Post::truncate();
			Category::truncate();
			Role::truncate();

			// users and roles
			User::factory(10)->create();
			User::create([
				'name' => 'silvia',
				'email' => 'silvia.frediani@tiscali.it',
				'email_verified_at' => now(),
				//'password' => bcrypt('silvia310878'),
				'password' => Hash::make('silvia310878'),
				'remember_token' => Str::random(10),
			]);
			$roles = ['admin', 'user', 'editor', 'author'];
			foreach ($roles as $role) {
				Role::create([
					'name' => $role,
				]);
			}
			RoleUser::create([
				'role_id' => 1,
				'user_id' => 11
			]);
			// posts and categories
			$categories = ['Animals', 'Art', 'Culture', 'Christmas', 'Kitten', 'Dog', 'Information', 'Learning'];
			foreach ($categories as $cat) {
				Category::create(['name' => $cat]);
			}
			Post::factory(300)->create()->each(function ($post) {
				$categories = Category::inRandomOrder()->take(2)->pluck('id');
				foreach ($categories as $cat_id) {
					PostCategory::create([
						'post_id' => $post->id,
						'category_id' => $cat_id
					]);
				}
				//$$categories->each(function ($cat_id) use ($album) {
				//AlbumCategory::create(['album_id' => $album->id, 'category_id' => $cat_id]);
				//});
			});

        // \App\Models\User::factory(10)->create();
    }
}
