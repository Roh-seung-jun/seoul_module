@extends('header')


@section('contents')
    <div class="justify-content-center d-flex align-items-center flex-column w-100" style="margin-top: 100px;">
        <div class="d-flex w-50 justify-content-between">
            <button class="btn btn-outline-success" data-toggle="modal" data-target="#write">업로드</button>
            <select name="" id="" class="custom-select w-25">
                <option value="">서동전통찻집</option>
                <option value="">서동한식당</option>
                <option value="">서동한우</option>
            </select>
        </div>
        <table class="w-50 table mt-5">
            <thead>
            <tr>
                <th>식당</th>
                <th>제목</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $item)
                <tr onclick="location.href='{{route('view',$item['id'])}}'">
                    <td>{{$item['restaurant']}}</td>
                    @if(strlen($item['title']) > 25)
                    <td>{{substr($item['title'],0,25)}}...</td>
                        @else
                        <td>{{$item['title']}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="write">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('review')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title">작성</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p class="m-0">글 제목</p>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <p class="m-0">글 내용</p>
                        <textarea name="contents" id="contents" cols="30" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <p class="m-0">이메일</p>
                        <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <p class="m-0">패스워드</p>
                        <input type="text" class="form-control" name="pw" required>
                    </div>
                    <div class="form-group">
                        <p class="m-0">파일 첨부</p>
                        <input type="file" class="form-control-file" name="file[]" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-success">등록</button>
                </div>
            </form>
        </div>
    </div>
@endsection
