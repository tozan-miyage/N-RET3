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
                    <ul>
                        <li>{{ $material -> english }}</li>
                        <li>{{ $material -> japanese }}</li>
                        <li>{{ $material -> photo }}</li>
                    </ul>    
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
</div>
@endsection
