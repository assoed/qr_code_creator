



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
                        <div class="download_buttons_block">
                            <button onclick="downloadConvertedFile('svg')" >Download SVG</button>
                            <button onclick="downloadConvertedFile('png')">Download PNG</button>
                            <button onclick="downloadConvertedFile('pdf')">Download PDF</button>
                        </div>
                    </div>
                </div>

            </div>
        </section>
   </body>
@endsection


