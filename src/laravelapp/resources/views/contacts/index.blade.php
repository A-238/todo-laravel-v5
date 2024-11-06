@extends('layout')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">お問い合わせ</div>
                    <div class="panel-body">
                        {{-- エラーの表示 --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('contact/confirm') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-sm-2 control-label">お問い合わせカテゴリ：<br>(複数選択可)</label>
                                <div class="col-sm-10">

                                    @foreach($categories as $key => $value)
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="category[]" value="{{ $value }}" {{ is_array(old('category')) && in_array($value, old('category')) ? 'checked' : '' }}>
                                            {{ $value }}
                                        </label>
                                    @endforeach
                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">お名前：</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-2 control-label">メールアドレス：</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('pref') ? ' has-error' : '' }}">
                                <label for="pref" class="col-sm-2 control-label">お住まい：</label>
                                <div class="col-sm-10">
                                    <select name="pref">
                                        @foreach($prefs as $key => $value)
                                            <option value="{{ $value }}" {{ old('pref') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('pref'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('pref') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-sm-2 control-label">性別：</label>
                                <div class="col-sm-10">
                                    @foreach($genders as $key => $value)
                                        <label class="checkbox-inline">
                                            <input type="radio" name="gender" value="{{ $value }}" {{ old('gender') == $value ? 'checked' : '' }}>
                                            {{ $value }}
                                        </label>

                                    @endforeach
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body" class="col-sm-2 control-label">メッセージ：</label>
                                <div class="col-sm-10">
                                    <textarea name="body" class="form-control">{{ old('body') }}</textarea>
                                    @if ($errors->has('body'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-sm-2 control-label">添付ファイル：</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" accept="image/*">
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary">送信</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

