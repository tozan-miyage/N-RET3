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
                    <form action="{{ route('material.update',$material) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                        <img class="card-img-top" src="{{ $material->photo }}" alt="Card image cap">
                        <!--group選択-->
                        <div class="card-body">
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
                        </div>
                        
                        <!--main_word選択-->
                        <div class="card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">main_word</span>
                            </div>
                                <input type="text" name="main_word" value="{{ $material->main_word }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        
                        <!--english選択-->
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">english</span>
                                </div>
                                    <input type="text" name="english" value="{{ $material->english }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <!--japanese選択-->
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">japanese</span>
                                </div>
                                    <input type="text" name="japanese" value="{{ $material->japanese }}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        
                        <!--img-file選択-->
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Photo file</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="photo" value="{{ $material->photo }}"class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept='image/*' onchange="loadImage(this);">
                                        <label class="custom-file-label" for="inputGroupFile01"></label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <button type="submit" class="btn btn-warning">送信</button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="preview_area">
                  <p id="preview"></p>
                </div>
        </div>
    </div>
    
@endsection