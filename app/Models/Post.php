<?php

namespace App\Models;

// php artisan tinker pada terminal u/ mengisi data ke database menggunakan orm eloquent

// ketika pake elogquent ORM, ketika ingin mengakses data dari db-nya otomatis data tersebut menjadi collect()
// sehingga kita bisa langsung menggunakan function sakti laravelnya tanpa keyword collect() terlebih dahulu

class Post
{
    private static $blog_posts = [
        [
            'title' => 'Judul Post Pertama',
            'slug' => 'judul-post-pertama',
            'author' => 'Panji Maulana',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates veniam impedit quidem labore distinctio cumque cum illo odit eos officia, repellendus quos, excepturi eum laboriosam natus, nulla beatae! Possimus mollitia ipsum deserunt ratione? Nostrum iste veritatis voluptas autem accusamus, assumenda, rerum quos cupiditate, quasi excepturi iure consectetur incidunt dolor possimus adipisci rem nemo. Repellat natus quam dolores optio impedit quas autem fugit labore? Et consequuntur repudiandae ratione nulla, neque fugit ea omnis error exercitationem quam repellendus. Laborum maiores sint minima.'
        ],
        [
            'title' => 'Judul Post Kedua',
            'slug' => 'judul-post-kedua',
            'author' => 'Mila Nur Fadilah',
            'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam ea, tempore beatae repudiandae ab placeat fugit molestiae vero praesentium accusantium asperiores? Explicabo non porro debitis accusantium ipsum fugit numquam, earum quisquam cumque veritatis perferendis ad corrupti officia nemo fugiat blanditiis magnam necessitatibus commodi iure, tempora hic quas nesciunt sequi atque? Ipsam rem magnam facere, voluptatibus impedit mollitia ipsum! Sit sunt obcaecati sint perspiciatis aperiam exercitationem eos deleniti dolore delectus magni accusamus, molestias laudantium quaerat sed nulla eveniet quibusdam eius possimus!'
        ],
    ];

    public static function all()
    {
        // karena modifier $blog_posts adalah private jadi kita harus menggunakan keyword 'self', '::' (static) u/ mengaksesnya, jika modifier biasa public/protected kita bisa menggunakan $this->blog_posts.

        // collect() adalah method dari laravel u/ merubah array menjadi array yang lebih sakti karena dapat diakses oleh function yang dibikin oleh si laravelnya. ex: filter(), map(), first(), firstWhere()

        return collect(self::$blog_posts); 
    }

    public static function find($slug)
    {
        // self khusus u/ property static
        // static u/ memanggil method static di dalam class
        $posts = static::all();

        // $post = [];
        // foreach($posts as $p) {
        //     if ($p['slug'] == $slug) {
        //         $post = $p;
        //     };
        // };

        // firstWhere() bisa menggantikan logic diatas hanya dengan menyimpan array ke collect() terlebih dahulu, lalu gunakan method laravelnya seperti firstWhere().

        return $posts->firstWhere('slug', $slug);
    }
}
