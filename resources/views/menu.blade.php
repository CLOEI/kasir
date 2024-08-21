@extends('layout')

@section('content')
    <div class="p-4 bg-gray-600 min-h-screen flex flex-col items-center">
        <a href="/menu/cart" class="block ml-auto w-max cursor-pointer active:scale-95 relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-shopping-cart">
                <circle cx="8" cy="21" r="1" />
                <circle cx="19" cy="21" r="1" />
                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
            </svg>
            <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full px-1 text-xs">
                {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
            </span>
        </a>
        <input type="text" id="search" placeholder="Search products..." class="mt-4 p-2 rounded-lg w-full max-w-2xl">
        <div class="mt-8 w-full max-w-2xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="product-list">
            @foreach ($products as $product)
                <div
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col product-item">
                    <div class="flex flex-col items-center flex-grow">
                        <img src="{{ $product->photo_url }}" alt="{{ $product->name }}"
                            class="w-32 h-32 object-cover rounded-lg mb-4">
                        <h2 class="text-lg font-bold mb-2 text-center product-name">{{ $product->name }}</h2>
                    </div>
                    <form action="/menu/add_to_cart" method="post" class="w-full mt-auto">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit"
                            class="bg-blue-500 text-white w-full py-2 rounded-lg hover:bg-blue-600 active:scale-95 transition-transform">Add
                            to cart</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const productItems = document.querySelectorAll('.product-item');

            productItems.forEach(function(item) {
                const productName = item.querySelector('.product-name').textContent.toLowerCase();
                if (productName.includes(searchValue)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
@endsection
