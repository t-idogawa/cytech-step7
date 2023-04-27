@extends('layouts.app')

@section('content')
<div class="container">

  <!-- 検索フォーム -->
   <!-- 検索テキスト部分 -->
  <div class="row">
    <div class="col-sm">
      <form action="{{ route('list') }}" method="GET">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">商品名</label>
            <div class="col-sm-5">
              @csrf
              <input type="text" class="form-control" name="keyword">
            </div>
            <div class="col-sm-auto">
                <input type="submit" class="btn btn-primary" value="検索">
            </div>
        </div>
        <!-- 検索セレクトボックス -->
        <div class="form-group row">
            <label class="col-sm-2">メーカー名</label>
            <div class="col-sm-3">
                <select name="companyId" class="form-control">
                    <option value="">未選択</option>
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
      </form>
    </div>
  </div>

  <!-- 新規登録ボタン -->

  <a href="{{ route('create') }}"><button style="margin:20px;" class="btn btn-primary">新規登録</button></a>

  <!-- 商品テーブル一覧 -->

  <table class="table">
    <tr class="table-info">
        <th>ID</th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
        <th>メーカー</th>
        <th>詳細表示</th>
        <th>編集</th>
        <th>削除</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <!--<td>{{ $product->image_path }}</td> -->
        <td><img src="{{ asset('storage'. mb_substr($product->image_path,6)) }}" class="imgsize"></td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->company->name }}</td>
        <td><a href="{{ route('show', $product->id) }}"><button class="btn btn-success">詳細</button></a></td>
        <td><a href="{{ route('edit', $product->id) }}"><button class="btn btn-primary">編集</button></a></td>
        <td>
           <form action="{{ route('destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary" onclick='return confirm("削除しますか？")'>削除</button>
        </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection