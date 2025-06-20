@extends('products.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
<div class="product-detail">
    <div class="product-detail_information">
        <form action="{{ url('/products/' . $product->id . '/update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class=" detail-column">
                <div class="detail-column_sub">
                    <label>商品名</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}">
                </div>
                <div class="detail-column_error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="detail-column">
                <div class="detail-column_sub">
                    <label>値段</label>
                    <input type="text" name="price" value="{{ old('price', $product->price) }}">
                </div>
                <div class="detail-column_error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="detail-column">
                <div class="detail-column_sub">
                    <label>季節</label>
                    @foreach ($allSeasons as $season)
                    <label>
                        <input type="checkbox" name="seasons[]" value="{{ ('$season->id') }}" {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                    @endforeach

                </div>
                <div class="detail-column_error">
                    @error('season')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="detail-column">
                <div class="detail-column_sub">
                    <label>商品説明</label>
                    <textarea class="textarea" type="text" name="description">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="detail-column_error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="detail-img">
                @if ($product->image_path)
                <div class="product-image">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                </div>
                @endif

                <label for="image_path">ファイルを選択</label>
                <input type="file" name="image_path" id="image_path">
            </div>
            <button class="detail-submit" type="submit">変更を保存</button>
        </form>
        <a class="detail-return" href="{{ url('/products') }}">← 戻る</a>
    </div>
</div>
@endsection