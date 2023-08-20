



@extends('layouts.app')
@section('title', 'Главная')
@section('content')

   <body>
        <section >

            <div class="main_block">
                <div class="input_block">
                    <form id="qr_code_creator_form" method="POST" action="{{route('process.form')}}">
                        @csrf
                        <label for="qr_code_link"></label>
                        <input type="text" id="qr_code_link" name="qr_code_link" placeholder="Введите вашу ссылку">
                        <div>
                            <p>Выбрать цвет</p>

                            <div>
                                <label for="qr_code_color">Цвет QR кода</label>
                                <input type="color" id="qr_code_color" name="qr_code_color" value="#black" />

                            </div>

                        </div>
                        <button id="get_qr_button" class="get_qr_button" type="submit" >Создать QR</button>

                    </form>
                </div>
                <div class="qr_code_show_block">
                    <div id="qr_code_result"></div>
                    <div class="download_buttons_block">
                        <button data-format="png">Download PNG</button>
                        <button data-format="pdf">PDF</button>
                        <button data-format="svg">SVG</button>
                        <button data-format="eps">EPS</button>
                    </div>
                </div>

            </div>
        </section>
   </body>
@endsection


