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
@endsection

@section('scripts')
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('content');
    </script>

    <script>
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