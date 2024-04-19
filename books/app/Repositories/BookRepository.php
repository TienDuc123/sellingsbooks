<?php
namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function all()
    {
        return Book::all();
    }

    public function find($id)
    {
        return Book::find($id);
    }

    public function create($data)
    {
        return Book::create($data);
    }

    public function update($id, $data)
    {
        $Book = Book::find($id);
        if ($Book) {
            $Book->update($data);
            return $Book;
        }
        return null;
    }

    public function delete($id)
    {
        $Book = Book::find($id);
        if ($Book) {
            $Book->delete();
            return true;
        }
        return false;
    }
}
