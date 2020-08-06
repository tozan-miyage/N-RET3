@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Material</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="card-body">
                    <form action="{{ route('material.update',$material) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Group_name</label>
                                    </div>
                                    <select name="group_id" class="custom-select" id="inputGroupSelect01">
                                        @foreach($groups as $group)
                                            @if( $group->id == $material->group_id )
                                                <option value="{{ $group->id }}" selected>{{ $group -> group_name }}</option>
                                            @else
                                                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">main_word</span>
                                    </div>
                                        <input type="text" name="main_word" value="{{ $material->main_word }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">english</span>
                                    </div>
                                        <input type="text" name="english" value="{{ $material->english }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">japanese</span>
                                    </div>
                                        <input type="text" name="japanese" value="{{ $material->japanese }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Photo file</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="photo" value="{{ $material->photo }}"class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01"></label>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <button type="submit" class="btn btn-warning">送信</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection