@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    <div><h2>{{ $group -> group_name }}</h2></div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>    
                <div class="card-body d-flex flex-wrap">
                    <form action="{{ route('material.create') }}" method="GET">
                        @csrf
                        <input type="hidden" name = "id" value = "{{ $group -> id }}">
                        <button type="submit" class="btn btn-primary m-2">New Create</button>
                    </form>  
                    @foreach($materials as $material)
                    <div class="m-2">
                        <form method="GET" action="{{ route('material.show_all',$material) }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary">{{ $material -> main_word }}</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            <div>
                <a href="/material" class="ml-5">Group一覧へ</a>
            </div>
        </div>
    </div>
</div>
@endsection
