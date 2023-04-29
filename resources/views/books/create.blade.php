@extends('layouts.app')
@section('content')
    <div class="border-slim">
        <h1>Create a Book</h1>

        <form method="post" action="{{ route('books.store') }}" enctype="multipart/form-data" id="form" class="flex-box">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <label>Name:</label>
            <input type="text" id="name" name="name" class="round-input"/>

            <label>ISBN:</label>
            <input  id="isbn" name="isbn" />

            <label>Value:</label>
            <input type="number" id="price" name="price" class="round-input"/>

            <div class="center">
                <button id="check" class="blue-confirm-btn">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection