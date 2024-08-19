@extends('layout')

@section('content')
    <div>
        <h1>Cart</h1>
        <ul>
            @foreach ($cart as $item)
                @if (is_array($item))
                    <li>{{ $item['product']->name }} - {{ $item['product']->price }}</li>
                    <ul>
                        @foreach ($item['items'] as $productItem)
                            <li>{{ $productItem->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <li>{{ $item->name }} - {{ $item->price }}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endsection
