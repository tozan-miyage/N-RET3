@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">N-RET Group Edit</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="card-body">
                    <form action="{{ route('group_update',[ 'id' => $group->id ]) }}" method = "POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT"/>
                        <input type="text" name="group_name" placeholder="{{ $group -> group_name }}"/>
                        <button type="submit" class="btn btn-outline-success"/>送信</button>
                    </form>
                </div>
            </div>
            <a href="{{ route('material.index') }}">Group一覧へ戻る</a>
        </div>
    </div>
</div>
@endsection
