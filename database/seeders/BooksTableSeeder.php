<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        $books = [
            [
                'bookId' => "qwertyuiop",
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'genre' => 'Classic',
                'publisher' => 'Scribner',
                'description' => 'A story of wealth, love, and the American Dream in the 1920s.',
                'rating' => 8.5,
                // 'year' => '1925-04-10 00:00:00',
            ],
            [
                'bookId' => "asdfghjkl",
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'genre' => 'Fiction',
                'publisher' => 'J. B. Lippincott & Co.',
                'description' => 'A powerful story of racial injustice and moral growth in the American South.',
                'rating' => 4.2,
                // 'year' => '1960-07-11 00:00:00',
            ],
            [
                'bookId' => "zxcvbnm",
                'title' => 'Twenty Thousand Leagues Under The Sea',
                'author' => 'Jules Verne',
                'genre' => 'Science-fiction',
                'publisher' => 'J. B. Lippincott & Co.',
                'description' => 'A powerful story of survival and moral growth in the American South.',
                'rating' => 4.0,
                // 'year' => '1960-07-11 00:00:00',
            ],
            [
                'bookId' => "euikhgfds",
                'title' => 'The Treasure island',
                'author' => 'Jules Verne',
                'genre' => 'Science-fiction',
                'publisher' => 'J. B. Lippincott & Co.',
                'description' => 'A powerful story of survival and moral growth in the American South.',
                'rating' => 4.5,
                // 'year' => '1960-07-11 00:00:00',
            ],
            [
                'bookId' => "book1abcde",
                'title' => '1984',
                'author' => 'George Orwell',
                'genre' => 'Dystopian',
                'publisher' => 'Secker & Warburg',
                'description' => 'A chilling depiction of perpetual war, omnipresent government surveillance, and public manipulation.',
                'rating' => 4.0,
                // 'year' => '1949-06-08 00:00:00',
            ],
            [
                'bookId' => "book2abcde",
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'genre' => 'Southern Gothic',
                'publisher' => 'J.B. Lippincott & Co.',
                'description' => 'A novel about racial injustice and childhood innocence in the Deep South.',
                'rating' => 4.3,
                // 'year' => '1960-07-11 00:00:00',
            ],
            [
                'bookId' => "book3abcde",
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'genre' => 'Romance',
                'publisher' => 'T. Egerton',
                'description' => 'A romantic novel that also critiques the British landed gentry of the early 19th century.',
                'rating' => 3.8,
                // 'year' => '1813-01-28 00:00:00',
            ],
            [
                'bookId' => "book4abcde",
                'title' => 'Moby-Dick',
                'author' => 'Herman Melville',
                'genre' => 'Adventure',
                'publisher' => 'Harper & Brothers',
                'description' => 'The narrative of Captain Ahab’s obsessive quest to kill the white whale.',
                'rating' => 4.2,
                // 'year' => '1851-10-18 00:00:00',
            ],
            [
                'bookId' => "book5abcde",
                'title' => 'Brave New World',
                'author' => 'Aldous Huxley',
                'genre' => 'Science Fiction',
                'publisher' => 'Chatto & Windus',
                'description' => 'A vision of a future where society is controlled by technology and conditioning.',
                'rating' => 3.7,
                // 'year' => '1932-08-01 00:00:00',
            ],
            [
                'bookId' => "book6abcde",
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'genre' => 'Realism',
                'publisher' => 'Little, Brown and Company',
                'description' => 'The story of teenage angst and alienation as told by Holden Caulfield.',
                'rating' => 3.0,
                // 'year' => '1951-07-16 00:00:00',
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}