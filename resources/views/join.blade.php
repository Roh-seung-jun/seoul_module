@extends('header')
@section('script')
    <script>
        $(()=>{
            $(document)
                .on('click','.print',function (){
                    let canvas = $('<canvas width="300" height="800"></canvas>')[0];
                    let ctx = canvas.getContext('2d');

                    ctx.fillStyle = '#fff';
                    ctx.fillRect(0,0,300,800);
                    ctx.fillStyle = '#000';
                    ctx.fillText('대충 가격은 이 정도',50,200);

                    $(`<a href="${canvas.toDataURL('image/png')}" download></a>`)[0].click();
                })
        })
    </script>
@endsection
@section('contents')
    <form class="justify-content-center d-flex align-items-center w-100 flex-column" style="height: 100vh" action="{{route('join')}}">
        @csrf
        <div class="form-group">
            <p class="m-0">이메일</p>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <p class="m-0">비밀번호</p>
            <input type="text" class="form-control" id="pw" name="pw">
        </div>
        <button class="btn btn-outline-success">검색</button>
        <div class="list d-flex w-75">
            @foreach($list as $item)
                <button class="btn btn-outline-success print" type="button" data-price="{{$item['price']}}">{{$item['date']}} {{$item['time']}} 영수증 출력</button>
            @endforeach
        </div>
    </form>
@endsection
