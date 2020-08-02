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
                
                <div class="card-body d-flex">
                    @foreach($materials as $material)
                    <div class="m-2">
                        <form method="POST" action="/material/all/">
                            @csrf
                            <input type="hidden" name="main_word" value="{{ $material -> main_word }}"/>
                            <button type="submit">{{ $material -> main_word }}</button>
                        </form>
                    </div>
                    @endforeach
                </div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection
