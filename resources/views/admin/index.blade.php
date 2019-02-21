@extends('layouts.app')

@section('content')
    <h1>Yes, you are admin!</h1>

    <h3>Редактор контента</h3>

    <div id="content-edit">
        <form name="contentForm" action="" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" class="form-control"

                       value="{{!empty($content) ? $content->title : null}}">
            </div>
            <div class="form-group">
                <label for="content">Рандомный контент</label>
                <textarea name="content" id="" cols="30" rows="10"
                          class="form-control">{!! !empty($content) ? $content->content : null !!}</textarea>
            </div>
            <div class="form-group text-center">
                <input type="submit" value="жмахайСохранить" class="btn btn-primary">
            </div>
        </form>
    </div>
    <h1>Заявки на мероприятия</h1>
    <div id="events" style="display: flex;flex-wrap: wrap">
        @foreach(DB::table('events')->get() as $event)
            <div id="ev_{{$event->id}}" class="card" style="width: 33%">
                <div class="card-header">Заявка от {{$event->name}}, мероприятие №{{$event->event_numb}}</div>
                <div class="card-body">
                    <div class="form-group">
                        <span>{{$event->email}}</span>
                    </div>
                    <div class="form-group">
                        <span>{{$event->phone}}</span>
                    </div>
                    <div class="form-group">
                        <span>{{$event->ip}}</span>
                    </div>
                </div>
                <div class="card-footer">
                    <form id="eventDelete" action="" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$event->id}}">
                        <input type="submit" class="btn btn-danger" value="Удалить">
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('content');
    </script>

    <script>
        /*удаление события*/
        $(document).on('submit', '#eventDelete', (event) => {
            event.preventDefault();
            let data = new FormData(event.currentTarget);

            //alert(data.title)
            $.ajax({
                method: 'POST',
                url: '{{route('admin.event.delete')}}',
                data: data,
                contentType: false,
                processData: false,
                success: (result) => {
                    $('#ev_'+result.id).remove();
                    showMsg(result.success);
                },
                error: (jqHXR, exception) => {
                    console.log(jqHXR.responseText);
                }
            })

        })
        /*редачим контент*/
        $(document).on('submit', 'form[name="contentForm"]', (event) => {
            event.preventDefault();
            let data = new FormData(event.currentTarget);

            //alert(data.title)
            $.ajax({
                method: 'POST',
                url: '{{route('admin.edit')}}',
                data: data,
                contentType: false,
                processData: false,
                success: (result) => {
                    showMsg(result.success);
                },
                error: (jqHXR, exception) => {
                    console.log(jqHXR.responseText);
                }
            })

        })
    </script>
@endsection