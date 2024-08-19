@extends('layout')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex space-x-2 items-center mb-4">
            <a href="/menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
            </a>
            <h1 class="text-2xl font-bold">Cart</h1>
        </div>
        @if (empty($cart))
            <div class="flex justify-center items-center h-64">
                <span class="text-gray-500 text-xl">Your cart is empty</span>
            </div>
        @else
            <form action="/menu/submit_cart" method="POST">
                @csrf
                <ul class="space-y-4">
                    @foreach ($cart as $item)
                        @if (is_array($item))
                            <li class="bg-white shadow-md rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold">{{ $item['product']->name }} (x{{ $item['quantity'] }})</span>
                                    <span class="text-gray-600">Rp. {{ $item['product']->price }}</span>
                                    <button type="button" class="text-red-500" onclick="removeFromCart({{ $item['product']->id }})">Delete</button>
                                </div>
                                @if (isset($item['items']))
                                    <ul class="mt-2 space-y-2">
                                        @foreach ($item['items'] as $productItem)
                                            <li class="text-gray-700">- {{ $productItem->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @else
                            <li class="bg-white shadow-md rounded-lg p-4 flex justify-between items-center">
                                <span class="font-semibold">{{ $item->name }} (x{{ $item->quantity }})</span>
                                <span class="text-gray-600">Rp. {{ $item->price }}</span>
                                <button type="button" class="text-red-500" onclick="removeFromCart({{ $item->id }})">Delete</button>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="mt-6 text-right">
                    <span class="text-xl font-bold">Total: Rp. {{ array_sum(array_map(function($item) { return is_array($item) ? $item['product']->price * $item['quantity'] : $item->price * $item->quantity; }, $cart)) }}</span>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
                </div>
            </form>
            <form action="/menu/delete_cart" method="POST" class="mt-4 text-right">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete Cart</button>
            </form>
        @endif
    </div>

    <script>
        function removeFromCart(productId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('remove_from_cart') }}';
            form.innerHTML = `
                @csrf
            <input type="hidden" name="product_id" value="${productId}">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    </script>
@endsection
