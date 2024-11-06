@extends('layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">お問い合わせ</div>
                    <div class="panel-body">
                        <p>誤りがないことを確認のうえ送信ボタンをクリックしてください。</p>

                        <table class="table">
                            <tr>
                                <th>お問い合わせカテゴリ</th>
                                <td>{{ $category }}</td>
                            </tr>
                            <tr>
                                <th>お名前</th>
                                <td>{{ $contact->name }}</td>
                            </tr>
                            <tr>
                                <th>メールアドレス</th>
                                <td>{{ $contact->email }}</td>
                            </tr>
                            <tr>
                                <th>お住まい</th>
                                <td>{{ $contact->pref }}</td>
                            </tr>
                            <tr>
                                <th>性別</th>
                                <td>{{ $contact->gender }}</td>
                            </tr>
                            <tr>
                                <th>メッセージ</th>
                                <td>{!! nl2br(e($contact->body)) !!}</td>
                            </tr>
                            <tr>
                                <th>添付ファイル</th>
                                <td>
                                    @if(!empty(session('tmp_path')))
                                        <img src="{{ asset('storage/' . session('tmp_path')) }}">
                                    @else
                                        画像選択なし
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <form action="{{ url('contact/complete') }}" method="POST" class="form-horizontal" id="post-input">
                            @csrf

                            @foreach($contact->getAttributes() as $key => $value)
                                @if(isset($value))
                                    @if(is_array($value))
                                        @foreach($value as $subValue)
                                            <input name="{{ $key }}[]" type="hidden" value="{{ $subValue }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endif
                            @endforeach
                            <button type="submit" name='action' value="back" class="btn btn-secondary">戻る</button>
                            <button type="submit" name="action" class="btn btn-primary">送信</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
