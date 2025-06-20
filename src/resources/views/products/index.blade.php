@extends('products.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="product-page">
    <div class="product-form">
        <form class="product-form_select" action="/products" method="get">
            @csrf
            <div class="select-title">
                <h2>商品一覧</h2>
            </div>
            <div class="select-form">
                <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}" />
            </div>
            <div class="select-button">
                <button class="select-search" type="submit">検索</button>
            </div>
            <div class="product-form_price">
                <p>価格順で表示</p>
                <select class="product-form_category" name="price_order" onchange="this.form.submit()">
                    <option value="">価格で並べ替え</option>
                    <option value=" asc" {{ request('price_order') == 'asc' ? 'selected' : '' }}>価格が安い順</option>
                    <option value="desc" {{ request('price_order') == 'desc' ? 'selected' : '' }}>価格が高い順</option>
                </select>
            </div>
            <div class="product-add">
                <a href="{{ url('/products/register') }}" class="product-add_button">＋商品を追加</a>
            </div>
        </form>
    </div>

    <div class="grid-container">
        @foreach ($products as $product)
        <div class="product-card">
            <a href="{{ route('products.show', ['productId' => $product->id]) }}">
                <img src="{{ asset('storage/fruit-img/'. $product->image) }}" alt="{{ $product->name }}">
                <div class="product-info">
                    <p class="product-name">{{ $product->name }}</p>
                    <p class="product-price">{{ $product->price }}円</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="product-page">
        {{ $products->appends(request()->query())->links() }}
    </div>

</div>
@endsection