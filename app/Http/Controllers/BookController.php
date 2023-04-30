<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {   
        $token = request()->bearerToken();

        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return [
                'success' => false,
                'message' => 'User not found.'
            ];
        }
        
        $keyword = request()->query('keyword');

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
        $token = $req->bearerToken();

        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return [
                'success' => false,
                'message' => 'User not found.'
            ];
        }

        $req->validate([
            'name' => 'required',
        ]);

        $book = new Book;
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

        $token = request()->bearerToken();

        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return [
                'success' => false,
                'message' => 'User not found.'
            ];
        }

        try {
            $book = Book::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [
                'success' => false,
                'message' => 'Book not found.'
            ];
        }

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
        $token = request()->bearerToken();

        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return [
                'success' => false,
                'message' => 'User not found.'
            ];
        }

        try {
            $book = Book::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [
                'success' => false,
                'message' => 'Book not found.'
            ];
        }

        $book->delete();
        return [
            'success' => true,
            'message' => 'Book deleted successfully.',
        ];
    }

    public function frontIndex() {
        return view('books.index');
    }
}
