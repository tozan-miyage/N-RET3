@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $material -> main_word }} Materials</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="d-flex">
                @foreach($materials as $material)
                    <div class="card" style="width: 15rem;">
                        <img src="{{ $material -> photo }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $material -> english }}</h5>
                            <p class="card-text">{{ $material -> japanese }}</p>
                            <div class="d-flex">
                                <form action="{{ route('material.edit',$material) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-warning m-1" />Edit</button>
                                </form>
                                <form action="{{ route('material.destroy',$material) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger m-1" />Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <a href="/material/{{ $material->group_id }}"　class="m-3">Main_words一覧に戻る</a>
            <a href="/material" class="m-3">Group一覧に戻る</a>
            
        </div>
    </div>
</div>
@endsection
