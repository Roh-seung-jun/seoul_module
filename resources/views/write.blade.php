@extends('header')
@section('script')
    <script>
        $(async ()=>{
            window.check = false;
            window.menu = (await fetch('{{asset('/public/menu.txt')}}').then(res=>res.text())).split(',');
            $(document)
            .on('change','#restaurant',function(){
                let txt = '';
                let idx = 1;
                if($(this).val() === '서동한식당'){
                    idx = 0;
                }else if($(this).val() === '서동한우'){
                    idx = 2;
                }
                window.menu[idx].split(' ').forEach((item)=>{
                    txt += `<option value="${item}">${item}</option>`;
                })

                $('#menu').html(txt);
            })
            .on('click','._btn',function (){
                let id = $(this).attr('data-id'),
                    cnt = id === 'm' ? -1 : 1,
                    value = parseInt($('#cnt').val()) + cnt;
                $('#cnt')[0].value = value;

                inputCheck();
            })
            .on('change','#date',function(){
                $('#time').attr('disabled',false);
                window.check = true;
            })
            .on('change','input,select',inputCheck)
        })

        function inputCheck(){
            if(!window.check) return;
            console.log('a');
            let cnt = $('#cnt').val();
            let menu = $('#menu').val();
            let people = $('#people').val();
            if(cnt <= 0 || menu === 'null' || people <= 0){
                $('.check').html(`<div class="cnt w-25" style="background-color: #ff2222;text-align: center">불가능</div>`);
                $('button').attr('type','button');
            }else{
                $('.check').html(`<div class="cnt w-25" style="background-color: #90e4ff;text-align: center">가능</div>`);
                $('.submit').attr('type',true);
            }
        }
    </script>
@endsection

@section('contents')
    <form class="justify-content-center d-flex align-items-center flex-column w-100" style="height: 100vh" action="{{route('check')}}">
        @csrf
        <h3>예약 정보 입력 페이지</h3>
        <div class="form-group">
            <p class="m-0">식당선택</p>
            <select name="restaurant" id="restaurant" class="custom-select">
                <option value="서동한식당">서동한식당</option>
                <option value="서동전통찻집">서동전통찻집</option>
                <option value="서동한우">서동한우</option>
            </select>
        </div>
        <div class="form-group">
            <p class="m-0">예약인원</p>
            <input type="number" class="form-control" name="people" id="people">
        </div>
        <div class="form-group">
            <p class="m-0">날짜</p>
            <input type="date" name="date" id="date" min="{{date('Y-m-d')}}" max="{{date('Y-m-d',strtotime("+1 months",strtotime(date('Y-m-d'))))}}" class="form-control">
        </div>
        <div class="form-group">
            <p class="m-0">시간</p>
            <select name="time" id="time" class="custom-select" disabled="disabled">
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="12:30">12:30</option>
                <option value="13:00">13:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00" disabled>15:00</option>
                <option value="15:30" disabled>15:30</option>
                <option value="16:00" disabled>16:00</option>
                <option value="16:30" disabled>16:30</option>
                <option value="17:00" disabled>17:00</option>
                <option value="17:30">17:30</option>
                <option value="18:00">18:00</option>
                <option value="18:30">18:30</option>
                <option value="19:00">19:00</option>
                <option value="19:30">19:30</option>
                <option value="20:00">20:00</option>
            </select>
        </div>
        <div class="form-group">
            <p class="m-0">메뉴</p>
            <select name="menu" id="menu" class="custom-select">
                <option value="null">식당을 선택해주세요</option>
            </select>
        </div>
        <div class="form-group">
            <p class="m-0">수량</p>
            <input type="number" class="form-control" id="cnt" name="cnt" value="1" min="1" readonly>
            <div class="d-flex flex-column">
                <button class="btn btn-outline-success _btn" data-id="p" type="button">∆</button>
                <button class="btn btn-outline-success _btn" data-id="m" type="button">∇</button>
            </div>
        </div>
        <div class="check w-100 d-flex justify-content-center">
        </div>
        <button class="submit btn btn-outline-success" type="button">다음 단계</button>
    </form>

@endsection
