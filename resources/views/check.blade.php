@extends('header')


@section('script')
    <script>
        $(()=>{
            $(document)
            .on('keyup','.phone',function(){
                let reg = /^[0-9]+$/;
                let val = $(this).val();
                if(!reg.test(val) && val !== ''){
                    $(this).val('');
                    return alert('숫자만 입력가능합니다.');
                }
                if(val.length > 3){
                    this.value =
                        this.value.substr(0,$(this).attr('data-length'));
                }
            })
            .on('keyup','#name',function(){
                let val = $(this).val().split(' ');
                if(val.length >= 2) {
                    $(this).val('');
                    return alert('공백을 사용 불가능합니다.')
                }
            })
            .on('keyup','#pw',function(){
                let val = $(this).val();
                if(val.length > 4){
                    this.value =
                        this.value.substr(0,4);
                    return alert('비밀번호는 4자리여야 합니다.');
                }
                let reg = /^[A-Za-z0-9]*$/;
                if(!reg.test(val) && val !== ''){
                    $(this).val('');
                    return alert('영어와 숫자만 입력가능합니다.');
                }
            })
        })

        function check(){
            let check = confirm('정말로 삭제하시겠습니까?');
            if(check) return location.href = '/restaurant';
        }

    </script>
@endsection

@section('contents')
    <form class="justify-content-center d-flex align-items-center flex-column w-100" style="height: 100vh" method="post" action="{{route('application')}}">
        @csrf
        <div class="form-group">
            <h3>예약정보 : {{$data['date'] .' '. $data['time'] .' '.$data['restaurant'].' 성인'.$data['people'].'명 '.$data['menu'].' ' . $data['cnt'].'인분'}}</h3>
        </div>
        <input type="text" class="d-none" name="date" value="{{$data['date']}}">
        <input type="text" class="d-none" name="time" value="{{$data['time']}}">
        <input type="text" class="d-none" name="people" value="{{$data['people']}}">
        <input type="text" class="d-none" name="cnt" value="{{$data['cnt']}}">
        <input type="text" class="d-none" name="menu" value="{{$data['menu']}}">
        <input type="text" class="d-none" name="restaurant" value="{{$data['restaurant']}}">
        <div class="form-group">
            <p class="m-0">예약자 명</p>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <p class="m-0">메일 주소</p>
            <input type="text" name="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <p class="m-0">전화번호</p>
            <div class="d-flex justify-content-center">
            <input type="text" name="phone1" class="form-control phone" placeholder="010" data-length="3">
                <p class="m-0">-</p>
            <input type="text" name="phone2" class="form-control phone" placeholder="1111" data-length="4">
                <p class="m-0">-</p>
            <input type="text" name="phone3" class="form-control phone" placeholder="2222" data-length="4">
            </div>
        </div>
        <div class="form-group">
            <p class="m-0">비밀번호</p>
            <input type="text" name="pw" class="form-control" id="pw">
        </div>
        <button class="btn btn-outline-success" onclick="check()" type="button">취소</button>
        <button class="btn btn-outline-success" onclick="history.back()" type="button">수정</button>
        <button class="btn btn-outline-success">신청</button>
    </form>
@endsection
