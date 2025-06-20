@extends('products.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<div class="product-register">
    <div class="product-register_title">
        <h2>商品登録</h2>
    </div>

    <div class="product-register_form">
        <form action="/products/register" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="register-column">
                <div class="register-column_title">
                    <label>商品名 <span class="required">必須</span></label>

                </div>
                <div class="register-column_title">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
                </div>
                <div class="detail-column_error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-column">
                <div class="register-column_title">
                    <label>値段 <span class="required">必須</span></label>
                </div>
                <div class="register-column_title">
                    <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}">
                </div>
                <div class="detail-column_error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-column">
                <div class="register-column_title">
                    <label>商品画像 <span class="required">必須</span></label>
                </div>
                <div class="register-column_title">
                    <input type="file" name="image_path" value="{{ old('image') }}">
                </div>
                <div class="detail-column_error">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-column">
                <div class="register-column_title">
                    <label>季節 <span class="required">必須</span> <span class="required-sub">複数選択可</span></label>
                </div>
                <div class="register-column_title">
                    <label><input type="checkbox" name="seasons[]" value="春" value="{{ is_array(old('seasons')) && in_array('春', old('seasons')) ? 'checked' : '' }}">春</label>
                    <label><input type="checkbox" name="seasons[]" value="夏" value="{{ is_array(old('seasons')) && in_array('夏', old('seasons')) ? 'checked' : '' }}">夏</label>
                    <label><input type="checkbox" name="seasons[]" value="秋" value="{{ is_array(old('seasons')) && in_array('秋', old('seasons')) ? 'checked' : '' }}">秋</label>
                    <label><input type="checkbox" name="seasons[]" value="冬" value="{{ is_array(old('seasons')) && in_array('冬', old('seasons')) ? 'checked' : '' }}">冬</label>
                </div>
                <div class="detail-column_error">
                    @error('seasons')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-column">
                <div class="register-column_title">
                    <label>商品説明 <span class="required">必須</span></label>
                </div>
                <div class="register-column_title">
                    <textarea class="textarea" name="description" placeholder="商品の説明を入力" value="{{ old('description') }}"></textarea>
                </div>
                <div class="detail-column_error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="register-button">
                <a class="button-return" href="/products">戻る</a>
                <button class="button-register" type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection