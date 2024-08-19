@extends('layout')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gray-600">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4 text-center">ID. Kasir</h1>
            <form action="/login_or_register" method="POST">
                @csrf
                <input name="kasirID" type="text" class="w-full p-3 mb-4 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your ID" required>
                <button class="w-full py-3 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 active:scale-95 transition-transform">Login</button>
            </form>
        </div>
    </div>
@endsection
