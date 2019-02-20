@component('mail::message')
Добрый день!

поступила новая заявка

<div id="new-event">
    <div class="form-group">
        <label for="name">Имя:</label>
        <input type="text" name="name" class="form-control" value="{{$eventer->name}}">
    </div>
    <div class="form-group">
        <label for="surname">Фамилия:</label>
        <input type="text" name="surname" class="form-control" value="{{$eventer->surname}}">
    </div>
    <div class="form-group">
        <label for="phone">Телефон</label>
        <input type="text" name="phone" class="form-control" value="{{$eventer->phone}}">
    </div>
    <div class="form-group">
        <label for="email">Имеил</label>
        <input type="email" name="email" class="form-control" value="{{$eventer->email}}">
    </div>
    <div class="form-group">
        <label for="email">Образование</label>
        <input type="email" name="email" class="form-control" value="{{$eventer->education}}">
    </div>

</div>
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

С уважением,<br>
{{ config('app.name') }}
@endcomponent
