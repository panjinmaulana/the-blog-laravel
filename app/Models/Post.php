<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    
    // mass assignment
    // bisa digunakan di create & update
    // example keyword di tinker
    // Post::create([
    //     'title' => 'Judul Kedua',
    //     'category_id' => 3,
    //     'slug' => 'judul-kedua',
    //     'excerpt' => 'Lorem ipsum kedua',
    //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa consequatur at, quae excepturi quo similique cumque dolorum! Fugiat necessitatibus rerum eos delectus officiis, molestias id dolorem numquam deleniti fuga eum quis et quo iste odit perspiciatis repellat ex similique quas quisquam molestiae sapiente. Molestias ipsa aperiam quae excepturi ratione!</p><p>Necessitatibus placeat illo doloremque nulla soluta perspiciatis at minus, voluptatem quidem reiciendis in veritatis laudantium ipsum atque velit unde consequuntur deserunt rem molestiae. Ipsum labore et culpa, porro mollitia tempore, consequatur iusto ullam voluptate consectetur, quasi beatae quis earum dolore molestias expedita consequuntur tenetur!</p><p>Maiores modi aut alias corrupti odio autem facilis, veritatis blanditiis ea dolorem soluta asperiores dolores nam hic quis in esse iste minus totam distinctio et. Perferendis possimus consectetur quo delectus? Ad vel at non laborum? Ab doloribus error veritatis minima ratione culpa, magni optio consectetur sequi similique dolore quo officiis eos inventore ex dolorem excepturi praesentium. Possimus at beatae consequuntur voluptatibus quisquam architecto autem velit et quidem temporibus natus repellendus, voluptas debitis. Assumenda maxime, commodi illo maiores distinctio totam magni dolorum doloribus qui saepe eveniet suscipit repellat neque tenetur repellendus quae dolorem reprehenderit! Rerum mollitia laudantium, ducimus provident nobis optio commodi voluptatem error non fugiat neque iusto?</p>'
    // ]);

    // protected $fillable = ['title', 'excerpt', 'body']; supaya dapat ngasih tau ke laravelnya field mana aja yang boleh diisi
    protected $guarded = ['id']; // supaya dapat ngasih tau ke laravelnya field mana aja yang tidak boleh diisi kebalikan dari $fillable (kecuali $fillable)

    // jika kita ingin menhubungkan relationship, nama method harus sama dengan nama modelnya
    public function category()
    {
        // 1 post hanya memilik 1 category
        return $this->belongsTo(Category::class);
    }

    public function user() {
        // 1 post hanya memiliki 1 user
        return $this->belongsTo(User::class);
    }
}
