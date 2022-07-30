<?php

namespace App\Http\Controllers;

use App\Information;
use App\Review;
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
    public function joinPage(Request $request){
        $list = [];
        if($request->all()){
            $list = Information::where('email',$request['email'])->where('pw',$request['pw'])->get();
            if($list->count() === 0) return redirect('/restaurant/join')->with('이메일 또는 비밀번호가 틀렸습니다.');
        }
        return view('join',compact(['list']));
    }
    public function QAPage(){
        $list = Review::all();
        return view('QA',compact(['list']));
    }
    public function review(Request $request){
        $find = Information::where('email',$request['email'])->where('pw',$request['pw'])->get();
        if($find->count() === 0) return back()->with('msg','예약한 사람만 입력가능합니다.');
        $input = $request->only(['title','contents']);
        $input['information_id'] = $find[0]['id'];
        $input['restaurant'] = $find[0]['restaurant'];
        Review::create($input);

        return redirect('/restaurant/QA')->with('정상적으로 등록되었습니다.');
    }
    public function viewPage($id){
        $data = Review::find($id);
        return view('view',compact(['data']));
    }
}
