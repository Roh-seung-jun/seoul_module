@extends('header')


@section('contents')
<div class="justify-content-center d-flex align-items-center w-100" style="height: 100vh">
    <button class="btn btn-outline-success m-1" onclick="location.href='{{route('write')}}'">예약정보 입력</button>
    <button class="btn btn-outline-success m-1" onclick="location.href='{{route('join')}}'">예약 조회</button>
    <button class="btn btn-outline-success m-1" onclick="location.href='{{route('QA')}}'">Q & A</button>
</div>

@endsection
