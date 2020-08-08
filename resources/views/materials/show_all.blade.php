@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $main_word }} Materials</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                @foreach($materials as $material)
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $material -> english }}</li>
                        <li class="list-group-item">{{ $material -> japanese }}</li>
                        <li class="list-group-item">{{ $material -> photo }}</li>
                        <li class="list-group-item d-flex">
                            <form action="{{ route('material.edit',$material) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-warning m-1" />Edit</button>
                            </form>
                            <form action="{{ route('material.destroy',$material) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger m-1" />Delete</button>
                            </form>
                        </li>
                    </ul>    
                </div>
                @endforeach
                <a href="/material/" class="ml-4">Group一覧へ</a>
            </div>
        </div>
    </div>
</div>
@endsection
