@extends('master')

@section('styles')
<style>
    /* Basic styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f3f4f6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-container {
      width: 100%;
      max-width: 500px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #4a90e2;
      margin-bottom: 20px;
    }

    .form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .form input[type="text"],
    .form input[type="number"],
    .form select {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .form button {
      padding: 10px;
      font-size: 16px;
      color: #fff;
      background-color: #4a90e2;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .form button:hover {
      background-color: #357abd;
    }
  </style>
@endsection

@section('body')
<div class="form-container">
    @if ($title)
    <h2>{{ $title }}</h2>
    @endif
    <form class="form" action="{!! route('products.store') !!}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Product Name" required />
        <input type="number" name="price" placeholder="Price" required />
        <select name="tags[]" required multiple>
            <option value="" disabled selected>Select Tag</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        <button type="submit">Save Product</button>
    </form>
</div>
@endsection