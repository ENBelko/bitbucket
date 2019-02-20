@extends('layouts.app')

@section('content')
    <h1>@if(!empty($content)){{$content->title}}@else Добро пожаловать! @endif</h1>
    <div>
        @if(!empty($content)) {!! $content->content !!} @else
            <div class="50">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium ad at aut
                consequatur, delectus exercitationem iusto mollitia obcaecati quas qui repudiandae tempora unde vero
                voluptates! Dignissimos molestias nisi pariatur!
            </div> @endif
    </div>

    <div style="display: flex;flex-wrap: wrap">
        @php
            $pic = [
            'https://images.pexels.com/photos/1146708/pexels-photo-1146708.jpeg?cs=srgb&dl=4k-wallpaper-agriculture-android-wallpaper-1146708.jpg&fm=jpg',
            'http://pozitivni-zpravy.cz/wp-content/uploads/2017/10/pexels-photo-378442.jpeg',
            'https://cdn.themefoxx.com/wp-content/uploads/2017/04/4k-3840-x-2160-wallpapers-themefoxx-556.jpg',
            'https://img11.postila.ru/data/65/25/02/38/65250238ec2172dda88dea621a99d0e4904a27a48e217fff02db49a4c597c7ba.jpg',
            'https://static.datart.cz/Sony-KD-49XF7596/media_3577949.png',
            'https://www.mykonosgrand.gr/wp-content/uploads/2014/05/Beautiful-Nature-Wallpapers-for-Background-HD-Wallpaper.jpg']
        @endphp

        @for($i = 0;$i < count($pic);$i++)

            <div style="width: 33%;height: 300px" class="card">
                <div class="card-body">
                    <a href="#" data-toggle="modal" data-target="#exampleModal">
                        <img style="width: 100%;height: auto" src="{{$pic[$i]}}"
                             alt="">
                    </a>
                </div>
            </div>

        @endfor
    </div>

    <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" style="padding-right: 0 !important;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="img-display">
                        <img style="width: 100%;height: auto" src="" alt="">
                    </div>
                    <div id="event" class="hide">
                        <form id="eventForm" action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Имя:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="surname">Фамилия:</label>
                                <input type="text" name="surname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="middle-name">Отчество:</label>
                                <input type="text" name="middle-name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Телефон</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Имеил</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Образование</label>
                                <select name="education" id="edu-select" class="form-control">
                                    @php $edu = ['Bachelor','Master','PhD'] @endphp

                                    @for($i = 0 ;$i < count($edu);$i++)
                                        <option value="{{$edu[$i]}}">{{$edu[$i]}}</option>
                                    @endfor

                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="event" class="form-control">
                            </div>
                            <input type="submit" value="Отправить" class="btn btn-primary float-right">
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('submit', '#eventForm', (event) => {
            //alert('dfsfs');
            event.preventDefault();
            let data = new FormData(event.currentTarget);

            $.ajax({
                method: 'POST',
                url: '{{route('event.store')}}',
                data: data,
                contentType: false,
                processData: false,
                success: (result) => {
                    showMsg(result.success);
                },
                error: (jqXHR, exception) => {
                    let verrors = '';
                    $.each(jqXHR.responseJSON.errors, function (key, value) {
                        verrors += value;
                    });
                    showMsg(verrors, 'error');

                }
            })

        })
    </script>
@endsection