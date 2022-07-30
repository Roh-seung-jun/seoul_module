<?php

namespace App\Http\Controllers;

use App\Information;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function writePage(){
        return view('write');
    }

    public function checkPage(Request $request){
        $data = $request;

        return view('check',compact(['data']));
    }

    public function application(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required','email'],
            'phone1'=> ['required'],
            'phone2'=> ['required'],
            'phone3'=> ['required'],
            'pw' => ['required'],
        ],[
            'name' => '이름을 입력해주세요',
            'email.required' => '메일 주소를 입력해주세요.',
            'email.email' => '메일 주소 형식을 갖추어 주세요.',
            'phone1.required' => '전화번호를 입력해주세요.',
            'phone2.required' => '전화번호를 입력해주세요.',
            'phone3.required' => '전화번호를 입력해주세요.',
            'pw.required' => '비밀번호를 입력해주세요.',
        ]);
        $input = $request->only(['name','email','pw']);
        $input['phone'] = $request['phone1'].'-'.$request['phone2'].'-'.$request['phone3'];
        $input['restaurant'] = $request['restaurant'];
        $input['time'] = $request['time'];
        $input['date'] = $request['date'];
        $input['menu'] = $request['menu'];
        $input['cnt'] = $request['cnt'];
        $input['people'] = $request['people'];
        Information::create($input);
        return redirect('/restaurant')->with('msg','정상적으로 예약되었습니다.');
    }
}
