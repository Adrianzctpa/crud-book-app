<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {   
        $keyword = request()->get('search');
        if (!empty($keyword)) {
            $book = Book::where('name', 'LIKE', "%$keyword%")->orWhere('price', 'LIKE', "%$keyword%")->latest()->paginate(5);
        } else {
            $book = Book::latest()->paginate(5);
        }

        return [
            'success' => true,
            'data' => $book
        ];
    }

    public function store(Request $req) {
        $req->validate([
            'name' => 'required',
        ]);

        $book = new Book();
        $book->name = $req->name;
        $book->isbn = $req->isbn;
        $book->price = $req->price;
        $book->save();
        return [
            'success' => true,
            'message' => 'Book created successfully.',
            'data' => $book
        ];
    }

    public function update(Request $req, $id) {
        $book = Book::findOrFail($id);

        if ($req->name != null) {
            $book->name = $req->name;
        }

        if ($req->isbn != null) {
            $book->isbn = $req->isbn;
        }

        if ($req->price != null) {
            $book->price = $req->price;
        }

        $book->save();
        return [
            'success' => true,
            'message' => 'Book updated successfully.',
            'data' => $book
        ];
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();
        return [
            'success' => true,
            'message' => 'Book deleted successfully.',
        ];
    }
}
