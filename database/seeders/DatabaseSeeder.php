<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;

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
            'name' => 'Panji Maulana',
            'username' => 'panjinmaulana',
            'email' => 'panjinmaulana@gmail.com',
            'password' => bcrypt('password'),
        ]);
            
        User::create([
            'name' => 'Mila Nur Fadilah',
            'username' => 'milanfadilah',
            'email' => 'milfadiilah@gmail.com',
            'password' => bcrypt('password'),
        ]);
                
        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming',
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'category_id' => 1,
        //     'user_id' => 1,
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum pertama',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa consequatur at, quae excepturi quo similique cumque dolorum! Fugiat necessitatibus rerum eos delectus officiis, molestias id dolorem numquam deleniti fuga eum quis et quo iste odit perspiciatis repellat ex similique quas quisquam molestiae sapiente. Molestias ipsa aperiam quae excepturi ratione!</p><p>Necessitatibus placeat illo doloremque nulla soluta perspiciatis at minus, voluptatem quidem reiciendis in veritatis laudantium ipsum atque velit unde consequuntur deserunt rem molestiae. Ipsum labore et culpa, porro mollitia tempore, consequatur iusto ullam voluptate consectetur, quasi beatae quis earum dolore molestias expedita consequuntur tenetur!</p><p>Maiores modi aut alias corrupti odio autem facilis, veritatis blanditiis ea dolorem soluta asperiores dolores nam hic quis in esse iste minus totam distinctio et. Perferendis possimus consectetur quo delectus? Ad vel at non laborum? Ab doloribus error veritatis minima ratione culpa, magni optio consectetur sequi similique dolore quo officiis eos inventore ex dolorem excepturi praesentium. Possimus at beatae consequuntur voluptatibus quisquam architecto autem velit et quidem temporibus natus repellendus, voluptas debitis. Assumenda maxime, commodi illo maiores distinctio totam magni dolorum doloribus qui saepe eveniet suscipit repellat neque tenetur repellendus quae dolorem reprehenderit! Rerum mollitia laudantium, ducimus provident nobis optio commodi voluptatem error non fugiat neque iusto?</p>'
        // ]);
    }
}
