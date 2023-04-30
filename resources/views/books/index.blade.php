@extends('layouts.app')
@section('content')

<div class="border-slim">
    <h1>Auth</h1>
    <div class="flex-box">
        <label>Username:</label>
        <input type="text" id="username" name="username" class="round-input"/>
    
        <label>Password:</label>
        <input type="password" id="password" name="password" class="round-input"/>
    
        <label>Email:</label>
        <input type="text" id="email" name="email" class="round-input"/>

    </div>

    <div class="center">
        <button id="login" class="blue-confirm-btn">
            Login
        </button>
        <button id="register" class="blue-confirm-btn">
            Register
        </button>
        <button id="logout" class="blue-confirm-btn">
            Logout
        </button>
    </div>
</div>

<div class="border-slim">
    <h1>Search for Books</h1>
    <div class="flex-box">
        <label>Keyword:</label>
        <input type="text" id="searchInput" name="search" class="round-input"/>

        <div class="center">
            <button id="search" class="blue-confirm-btn">
                Search
            </button>
        </div>

        <pre><code id="code-search"></code></pre>
    </div>
</div>

<div class="border-slim">
    <h1>Create a Book</h1>

    <div id="form" class="flex-box">
    
        <label>Name:</label>
        <input type="text" id="name" name="name" class="round-input"/>

        <label>ISBN:</label>
        <input  id="isbn" name="isbn" />

        <label>Value:</label>
        <input type="number" id="price" name="price" class="round-input"/>

        <div class="center">
            <button id="create" class="blue-confirm-btn">
                Create
            </button>
        </div>
    </div>

    <pre><code id="code-create"></code></pre>
</div>

<div class="border-slim">
    <h1>Update a Book</h1>

    <div id="form" class="flex-box">

        <label>Book ID:</label>
        <input type="number" id="update-id" name="id" class="round-input"/>
    
        <label>Name:</label>
        <input type="text" id="update-name" name="name" class="round-input"/>

        <label>ISBN:</label>
        <input  id="update-isbn" name="isbn" />

        <label>Value:</label>
        <input type="number" id="update-price" name="price" class="round-input"/>

        <div class="center">
            <button id="update" class="blue-confirm-btn">
                Update
            </button>
        </div>
    </div>

    <pre><code id="code-update"></code></pre>
</div>

<div class="border-slim">
    <h1>Delete a Book</h1>

    <div id="form" class="flex-box">

        <label>Book ID:</label>
        <input type="number" id="delete-id" name="id" class="round-input"/>

        <div class="center">
            <button id="delete" class="blue-confirm-btn">
                Delete
            </button>
        </div>
    </div>

    <pre><code id="code-delete"></code></pre>
</div>
@endsection