@extends('layout')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex space-x-2 items-center mb-4">
            <a href="/menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold">Cart</h1>
        </div>
        @if (empty($cart))
            <div class="flex justify-center items-center h-64">
                <span class="text-gray-500 text-xl">Your cart is empty</span>
            </div>
        @else
            <form id="cart-form" action="/menu/submit_cart" method="POST">
                @csrf
                <ul class="space-y-4">
                    @foreach ($cart as $item)
                        <li class="bg-white shadow-md rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold">{{ $item['product']->name }}
                                    (x<span id="quantity-{{ $item['product']->id }}">{{ $item['quantity'] }}</span>)
                                </span>
                                <span class="text-gray-600">Rp. {{ $item['product']->price }}</span>
                                <div class="flex items-center space-x-2">
                                    <button type="button" class="bg-gray-200 px-2 py-1 rounded"
                                        onclick="updateQuantity({{ $item['product']->id }}, -1)">-</button>
                                    <button type="button" class="bg-gray-200 px-2 py-1 rounded"
                                        onclick="updateQuantity({{ $item['product']->id }}, 1)">+</button>
                                    <button type="button" class="text-red-500"
                                        onclick="removeFromCart({{ $item['product']->id }})">Delete</button>
                                </div>
                            </div>
                            @if (isset($item['items']))
                                <ul class="mt-2 space-y-2">
                                    @foreach ($item['items'] as $productItem)
                                        <li class="text-gray-700">- {{ $productItem->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <div class="mt-6 text-right">
                    <span class="text-xl font-bold">Total: Rp.
                        {{ array_sum(array_map(function ($item) {return is_array($item) ? $item['product']->price * $item['quantity'] : $item->price * $item->quantity;}, $cart)) }}</span>
                </div>
                <div class="mt-6 text-right">
                    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-lg"
                        onclick="openModal()">Submit</button>
                </div>
            </form>
            <form action="/menu/delete_cart" method="POST" class="mt-4 text-right">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete Cart</button>
            </form>
        @endif
    </div>

    <div id="payment-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <form id="payment-form" class="bg-white p-6 rounded-lg shadow-lg" method="POST" action="/menu/submit_cart">
            @csrf
            <h2 class="text-xl font-bold mb-4">Jumlah Bayar</h2>
            <input type="number" id="jumlah-bayar" name="jumlah_bayar" class="border p-2 w-full mb-4"
                placeholder="Masukkan jumlah bayar">
            <input type="number" id="nomor-meja" name="nomor_meja" class="border p-2 w-full mb-4"
                placeholder="Masukkan Nomor Meja">
            <div class="mb-4">
                <label for="tipe_pesanan" class="block text-sm font-medium text-gray-700">Order Type</label>
                <div class="relative">
                    <select name="tipe_pesanan" id="tipe_pesanan"
                        class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="Dine In">Dine In</option>
                        <option value="Take Away">Take Away</option>
                        <option value="Delivery">Delivery</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M7 10l5 5 5-5H7z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div id="error-message" class="text-red-500 mb-4 hidden">Jumlah bayar tidak cukup.</div>
            <div class="text-right">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2"
                    onclick="closeModal()">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
            </div>
        </form>
    </div>


    <script>
        function openModal() {
            document.getElementById('payment-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('payment-modal').classList.add('hidden');
        }

        function updateQuantity(productId, change) {
            const quantityElement = document.getElementById(`quantity-${productId}`);
            let quantity = parseInt(quantityElement.innerText);
            quantity += change;

            quantityElement.innerText = quantity;
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/menu/update_cart_quantity';
            form.innerHTML = `
                    @csrf
                    <input type="hidden" name="product_id" value="${productId}">
                    <input type="hidden" name="quantity" value="${quantity}">
                `;
            document.body.appendChild(form);
            form.submit();

        }

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

        document.getElementById('payment-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const jumlahBayar = document.getElementById('jumlah-bayar').value;
            const total =
                {{ !empty($cart)? array_sum(array_map(function ($item) {return is_array($item) ? $item['product']->price * $item['quantity'] : $item->price * $item->quantity;}, $cart)): 0 }};

            if (jumlahBayar < total) {
                document.getElementById('error-message').classList.remove('hidden');
                return;
            }

            document.getElementById('error-message').classList.add('hidden');
            this.submit();
        });
    </script>
@endsection
