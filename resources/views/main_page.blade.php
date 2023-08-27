



@extends('layouts.app')
@section('title', 'Главная')

@section('content')

   <body>
        <section >

            <div class="main_block">
                <div class="input_block">
                    <form id="qr_code_creator_form" method="POST" action="{{route('process.form')}}">
                        @csrf
                        <label for="qr_code_link">Введите ваш URL</label>
                        <input type="text" id="qr_code_link" name="qr_code_link"  value="https://gitlab.com/assoed2">
                        <div>


                            <div style="margin-top: 25px;">
                                <label for="qr_code_color">Цвет QR кода</label>
                                <input type="color" id="qr_code_color" name="qr_code_color" value="#black" />

                            </div>

                        </div>
                        <button id="get_qr_button" class="get_qr_button" type="submit" >Создать QR</button>

                    </form>
                    <div class="download_buttons_block">
                        <button class="download_qr_button" onclick="downloadConvertedFile('svg')" >Загрузить SVG</button>
                        <button class="download_qr_button" onclick="downloadConvertedFile('png')">Загрузить  PNG</button>
                        <button class="download_qr_button" onclick="downloadConvertedFile('pdf')">Загрузить PDF</button>
                        <button class="download_qr_button" onclick="downloadConvertedFile('eps')">Загрузить EPS</button>
                    </div>
                </div>
                <div class="qr_code_show_block">
                    <div id="qr_code_result"></div>
                    <div class="download_buttons_block">

                    </div>
                </div>

            </div>
        </section>
   </body>
@endsection


