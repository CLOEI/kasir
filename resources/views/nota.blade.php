@extends('layout')

@section('content')
    <div class="bg-gray-600 min-h-screen p-4">
        <div class="bg-white p-4 rounded-md max-w-sm mx-auto text-center">
            <h1 class="font-semibold text-3xl">B0{{ $transaksi->id }}</h1>
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
                <p>TIPE PESANAN</p>
                <p>: {{ $transaksi->tipe_pesanan }}</p>
            </div>
            <div class="border-b-4 border-dotted my-4"></div>
            <div class="text-left">
                @foreach ($transaksi->transactionDetails as $item)
                    <div>
                        <p>{{ $item->product->name }}</p>
                        <div class="grid grid-cols-2">
                            <p>1 x Rp. {{ number_format($item->product->price) }}</p>
                            <p>: Rp. {{ number_format($item->product->price) }}</p>
                        </div>
                        @foreach ($item->product->productItems as $productItem)
                            <p class="ml-2">- 1 x {{ $productItem->name }}</p>
                        @endforeach
                    </div>
                    <div class="border-b-4 border-dotted my-4"></div>
                @endforeach
            </div>
            <div class="text-right">
                <p>TOTAL (Termasuk Pajak) : Rp. {{ number_format($transaksi->total) }}</p>
                <p>JUMLAH BAYAR : Rp. {{ number_format($transaksi->bayar) }}</p>
                <p>KEMBALIAN : Rp. {{ number_format($transaksi->kembali) }}</p>
                <p>MTD BAYAR : Tunai</p>
                <p>STATUS BAYAR : Lunas</p>
            </div>
            <div class="mt-8 grid grid-cols-2">
                <p>NET SALES</p>
                <p>: Rp. {{ number_format($transaksi->total) }}</p>
                <p>PBI</p>
                <p>: Rp. 0</p>
            </div>
            <div class="flex items-center justify-center my-4">
                <div class="flex-grow border-b-4 border-dotted"></div>
                <p class="mx-4">Terimakasih</p>
                <div class="flex-grow border-b-4 border-dotted"></div>
            </div>
        </div>
    </div>
@endsection
