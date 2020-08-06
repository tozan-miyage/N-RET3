@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">N-RET Materials</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                @foreach($materials as $material)
                <div class="card-body d-flex ">
                    <div class="ml-3">
                        <form method="GET" action="{{ route('material.show',$group) }}">
                            <button type="submit" class="btn btn-primary">{{ $group -> group_name }}一覧へ</button>
                        </form>
                    </div>
                    <div class="ml-3">
                        <form method="GET" action="{{ route('group_edit',$group) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning">group_name編集</button>
                        </form>
                    </div>
                    <div class="ml-3">
                        <form action="{{ route('group_destroy',['id' => $group -> id ]) }}" method="POST" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else { return false };">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button type="submit" class="btn btn-danger">Group削除</button>
                        </form>
                    </div>
                </div>
                @endforeach
                
            </div>
            <a href="{{ route('group_create') }}"  class="m-5 mt-5">New Group</a>
        </div>
    </div>
</div>
@endsection
