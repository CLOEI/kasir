@extends('layout')

@section('content')
    <div class="flex justify-center h-screen overflow-hidden bg-gray-600 items-center">
        <div>
            <h1 class="text-3xl font-bold mb-2">ID. Kasir</h1>
            <form action="/login_or_register" method="POST">
                @csrf
                <input name="kasirID" type="text" class="rounded-md p-2" required>
                <button class="block py-2 px-3 rounded-md bg-gray-400 ml-auto mt-2 active:scale-95">Login</button>
            </form>
        </div>
    </div>
@endsection
