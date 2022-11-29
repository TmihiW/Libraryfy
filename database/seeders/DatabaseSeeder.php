<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\AuthorOwn;
use App\Models\Book;
use App\Models\BookBarcode;
use App\Models\BookCategory;
use App\Models\Category;
use App\Models\Rent;
use App\Models\User;
use App\Models\Listing;
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
        // runs  php artisan db:Seed
        // comes from database\factories\UserFactory.php or
        // comes from  Database\Seeders\UserSeeder.php
        // uncolumn this  create 10 dummy users

        //User::factory(5)->create();



        // Listing::create([
        //     'title' => 'Laravel Senior Developer', 
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Boston, MA',
        //     'email' => 'email1@email.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
        // ]);

        // Listing::create([
        //     'title' => 'Full-Stack Engineer',
        //     'tags' => 'laravel, backend ,api',
        //     'company' => 'Stark Industries',
        //     'location' => 'New York, NY',
        //     'email' => 'email2@email.com',
        //     'website' => 'https://www.starkindustries.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
        //   ]);

        //run
        //php artisan migrate:refresh --seed

        //php artisan db:seed
        Listing::factory(6)->create();

        //Class "Database\Seeders\Users" not found
        User::factory(5)->create();
        $user1 = User::factory()->create([
            'name_' => 'Abdulkadir',
            'surname_' => 'Fındık',
            'name_surname_' => 'Abdulkadir Fındık',
            'username_' => 'TmihiW',
            'email' => 'kadirfindik3871@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => 1,
        ]);
        $user2 = User::factory()->create([
            'name_' => 'Ahmet',
            'surname_' => 'Yıldız',
            'name_surname_' => 'Ahmet Yıldız',
            'username_' => 'Ayyıldız',
            'email' => 'ayyıldız@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => 0,
        ]);

        $listing1 = Listing::factory()->create([
            'user_id' => $user1->id,
            'title' => 'Youtube Content Creator',
            'tags' => 'Php, Laravel',
            'company' => 'Traversy Media',
            'location' => 'Remote',
            'email' => 'traversymedia@gmail.com',
            'website' => 'https://www.traversymedia.com',
            'description' => 'Teach tech',
            'logoPath'=>'logos/XZMlLpZs0tEjNz0lS3qnIOPNqyVwD4ujKygBvv7d.png'
        ]);
        Listing::factory(6)->create([
            'user_id' => $user2->id,
        ]);
        //create 5 dummy books with category,  author,barcode
        Book::factory(5)->create()->each(function ($book) {
            $book->book_category()->save(BookCategory::factory()->make([
                'id_book' => $book->id,
                'id_category' => Category::factory()->create()->c_id,
            ]));
            $book->book_barcode()->save(BookBarcode::factory()->make([
                'id_book' => $book->id,
            ]));            
            $book->book_author_own()->save(AuthorOwn::factory()->make([
                'id_book' => $book->id,
                'id_author' => Author::factory()->create()->a_id,
            ]));
            
        });
        Book::factory(3)->create()->each(function ($book) {
            $book->book_category()->save(BookCategory::factory()->make([
                'id_book' => $book->id,
                'id_category' => 2,
            ]));
            $book->book_barcode()->save(BookBarcode::factory()->make([
                'id_book' => $book->id,
            ]));            
            $book->book_author_own()->save(AuthorOwn::factory()->make([
                'id_book' => $book->id,
                'id_author' => 1,
            ]));
            
        });

         BookBarcode::factory(10)->create([
            'id_book' => 1,
         ]);
        
        //create 5 dummy rents
        // Rent::factory(5)->create([
        //     'id_book' => 1,
        //     'id_user' => 1,
        // ]);

        Rent::factory()->create()->each(function($rent){
            $user3=User::factory()->create();
            $user3_id=$user3->id;
            $rent->user()->associate($user3_id);
            $rent->save();
            $book3=Book::factory(1)->create()->each(function ($book) {
                $book->book_category()->save(BookCategory::factory()->make([
                    'id_book' => $book->id,
                    'id_category' => 2,
                ]));
                $book->book_barcode()->save(BookBarcode::factory()->make([
                    'id_book' => $book->id,
                ]));            
                $book->book_author_own()->save(AuthorOwn::factory()->make([
                    'id_book' => $book->id,
                    'id_author' => 1,
                ]));           
            });
            $book3_id=$book3->first()->b_id;
            $rent->book()->associate($book3_id);
            $rent->save();
        });  
        
        // Rent::factory()->create()->each(function ($rent) {            
        //     User::factory()->create()->each(function($user){
        //         $user->rentUser()->save(Rent::factory()->make([
        //             'id_user'=>$user->id,
        //         ]));
        //     });
        //     Book::factory()->create()->each(function ($book) {
        //         $book->book_category()->save(BookCategory::factory()->make([
        //             'id_book' => $book->id,
        //             'id_category' => 2,
        //         ]));
        //         $book->book_barcode()->save(BookBarcode::factory()->make([
        //             'id_book' => $book->id,
        //         ]));            
        //         $book->book_author_own()->save(AuthorOwn::factory()->make([
        //             'id_book' => $book->id,
        //             'id_author' => 1,
        //         ]));
        //         $book->rentBook()->save(Rent::factory()->make([
        //             'id_book'=>$book->id,
        //         ]));   
        //     });
                                     
        // });


        //Change factory name to UserFactory->UsersFactory that works
        //Users::factory(5)->create();
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
