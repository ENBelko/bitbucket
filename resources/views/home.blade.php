@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>

                @if(auth()->check() && auth()->user()->isEventer())

                    @php
                        if(auth()->user()->isEventer(1)) $numb = 1;
                        if(auth()->user()->isEventer(2)) $numb = 2;
                    @endphp
                    <h1>Заявки на ваше мероприятие</h1>
                    <div style="display: flex;flex-wrap: wrap">
                        @foreach(DB::table('events')->where('event_numb',$numb)->get() as $event)
                            <div class="card" style="width: 33%">
                                <div class="card-header">Заявка от {{$event->name}}</div>
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
                                <div class="card-footer text-center">
                                    <form action="" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$event->id}}">
                                        <input type="submit" class="btn btn-danger" value="Удалить">
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
