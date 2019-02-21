<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\{
    Request, Response
};
use Illuminate\Support\Facades\{
    DB, View
};

//use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('Admin');
        /*расшариваем на весь контроллер*/
        $content = DB::table('content');
        View::share('content', $content);

    }

    public function index()
    {
        $content = \view()->shared('content')->first();

        return view('admin.index', compact('content'));
    }

    public function edit(Request $request, Response $response)
    {
        $content = \view()->shared('content');

        if ($content) {
            $content->update(['title' => $request->get('title'),
                'content' => $request->get('content')]);
        } else {
            $content->insert(['title' => $request->get('title'),
                'content' => $request->get('content')]);
        }

        return $response->setContent(['success' => 'Данные обновлены']);

    }

    public function eventDelete(Request $request, Response $response)
    {
        $event = Event::find($request->get('id'));
        $event->delete();

        return $response->setContent(['success' => 'Мероприятие удалено!',
            'id' => $request->get('id')]);
    }
}
