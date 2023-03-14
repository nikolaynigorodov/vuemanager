@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-none" id="user-id" data-user-id="{{
            \App\Services\UserEncodeDecode::encode(Auth::user()->id)
            }}">

        </div>
        <router-view></router-view>
    </div>
</div>
@endsection
