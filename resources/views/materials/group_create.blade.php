@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">N-RET GroupCreate</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                
                <div class="card-body">
                    <form method="post" action="{{ route('group_store') }}">
                        @csrf
                        <input type="text" name="group_name" value=""/>
                        <button type="submit">作成</button>
                    </form>
                </div>

            </div>
            <a href="{{ route('material.index') }}">一覧へ戻る</a>
        </div>
    </div>
</div>
@endsection
