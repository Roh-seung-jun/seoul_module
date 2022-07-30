@extends('header')


@section('contents')
    <div class="justify-content-center d-flex align-items-center w-100 flex-column" style="height: 100vh">
        <h3>{{$data->title}}</h3>
        <p>{{$data->restaurant}}</p>
        <p>{{$data->contents}}</p>
    </div>
@endsection
