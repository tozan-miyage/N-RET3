@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $group -> group_name }} New Material</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="card-body d-flex">
                    <form action="{{ route('material.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">main_word</span>
                                    </div>
                                        <input type="text" name="main_word" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">english</span>
                                    </div>
                                        <input type="text" name="english" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">japanese</span>
                                    </div>
                                        <input type="text" name="japanese" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Photo file</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="photo" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01"></label>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <button type="submit" class="btn btn-primary">CreateMaterial</button>
                            </li>
                        </ul>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
