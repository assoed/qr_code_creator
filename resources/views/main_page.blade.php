



@extends('layouts.app')
@section('title', 'Главная')
@section('content')
<section>
    <div>Введите Вашу ссылку и получите QR-код</div>
    <div>
        <form>
            <label for="message"></label>
            <input type="text" id="message" name="message" placeholder="Введи2те вашу ссылку">
            <button type="submit">Отправить</button>
        </form>
    </div>
</section>
@endsection
