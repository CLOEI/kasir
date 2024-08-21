@extends('layout')

@section('content')
    @php
        $total = 0;
        foreach ($transaksi->transactionDetails as $item) {
            $total += $item->quantity * $item->product->price;
        }
        $totalIncludingTax = $total;
    @endphp
    <div class="bg-gray-600 min-h-screen p-4">
        <a href="/menu" class="fixed top-2 p-2 rounded-md bg-white shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-arrow-left">
                <path d="m12 19-7-7 7-7" />
                <path d="M19 12H5" />
            </svg>
        </a>
        <div class="bg-white p-4 rounded-md max-w-sm mx-auto text-center">
            <h1 class="font-semibold text-3xl">B{{ $transaksi->nomor_meja }}</h1>
            <p>Mr. Blitz Basuki</p>
            <p>Daftar pesanan : Printer Kasir Lantai 2</p>
            <div class="border-b-4 border-dotted my-4"></div>
            <div class="grid grid-cols-2 text-left">
                <p>TANGGAL / WAKTU</p>
                <p>: {{ $transaksi->tgl_transaksi }}</p>
                <p>WAITER</p>
                <p>: MRB Waiter {{ $transaksi->cashier->id }}</p>
                <p>CASHIER</p>
                <p>: MRB Kasir {{ $transaksi->cashier->name }}</p>
                <p>NOMOR PESANAN</p>
                <p>: @if ($transaksi->tipe_pesanan == 'Dine In')
                        1{{ $transaksi->id }}
                    @elseif ($transaksi->tipe_pesanan == 'Delivery')
                        2{{ $transaksi->id }}
                    @elseif ($transaksi->tipe_pesanan == 'Take Away')
                        3{{ $transaksi->id }}
                    @endif
                </p>
                <p>TIPE PESANAN</p>
                <p>: {{ $transaksi->tipe_pesanan }}</p>
            </div>
            <div class="border-b-4 border-dotted my-4"></div>
            <div class="text-left">
                @foreach ($transaksi->transactionDetails as $item)
                    <div>
                        <p>{{ $item->product->name }}</p>
                        <div class="grid grid-cols-2">
                            <p>{{ $item->quantity }} x Rp. {{ number_format($item->product->price) }}</p>
                            <p>: Rp. {{ number_format($item->product->price * $item->quantity) }}</p>
                        </div>
                        @foreach ($item->product->productItems as $productItem)
                            <p class="ml-2">- {{ $item->quantity }} x {{ $productItem->name }}</p>
                        @endforeach
                    </div>
                    <div class="border-b-4 border-dotted my-4"></div>
                @endforeach
            </div>
            <div class="text-right">
                <p>TOTAL (Termasuk Pajak) : Rp. {{ number_format($totalIncludingTax) }}</p>
                <p>JUMLAH BAYAR : Rp. {{ number_format($transaksi->jumlah_bayar) }}</p>
                <p>KEMBALIAN : Rp. {{ number_format($transaksi->jumlah_bayar - $totalIncludingTax) }}</p>
                <p>MTD BAYAR : Tunai</p>
                <p>STATUS BAYAR : Lunas</p>
            </div>
            <div class="mt-8 grid grid-cols-2">
                <p>NET SALES</p>
                <p>: Rp. {{ number_format($totalIncludingTax - $totalIncludingTax * 0.1) }}</p>
                <p>PB1</p>
                <p>: Rp. {{ number_format($totalIncludingTax * 0.0909) }}</p>
            </div>
            <div class="flex items-center justify-center my-4">
                <div class="flex-grow border-b-4 border-dotted"></div>
                <p class="mx-4">Terimakasih</p>
                <div class="flex-grow border-b-4 border-dotted"></div>
            </div>
        </div>
    </div>
@endsection
