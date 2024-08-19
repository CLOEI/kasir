@extends('layout')

@section('content')
    <div class="p-4 bg-gray-600 min-h-screen">
        <a href="/menu/cart" class="block ml-auto w-max cursor-pointer active:scale-95 relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full px-1 text-xs">
                {{ session('cart') ? count(session('cart')) : 0 }}
            </span>
        </a>
        <div class="mt-8">
            @foreach($products as $product)
                <div class="bg-white p-4 rounded-lg mb-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold">{{ $product->name }}</h2>
                        <form action="/menu/add_to_cart" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add to cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
