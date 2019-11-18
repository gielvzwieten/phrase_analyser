<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Phrase Analyser
                </div>

                <form action="/" method="post">
                    @csrf
                    <input type="text" name="phrase" id="phrase" value="{{old('phrase')}}" placeholder="Enter Phrase..">
                    <br>
                    <button type="submit">Analyse Phrase!</button>
                    <br>
                    @error('phrase')
                    {{$message}}
                    @enderror
                </form>

                <h1>{{$nonTrimmedPhrase}}</h1>

                @if(session()->has('phrase'))
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Symbol</th>
                            <th scope="col">Count</th>
                            <th scope="col">Sibling Character Info</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $uniqueCharsPushedToArray = [];

                        for($i = 0; $i < strlen($phrase); $i++)
                        //for($i = strlen($phrase)-1; $i >0 ; $i--)
                        {
                            for($j = 0; $j < strlen($uniqueCharsInPhrase); $j++) {
                                if($phrase[$i] == $uniqueCharsInPhrase[$j] && !in_array($phrase[$i], $uniqueCharsPushedToArray)){
                                array_push($uniqueCharsPushedToArray, $phrase[$i]);
                                }
                            }
                        }
                        @endphp

                        @for($index = 0; $index < count($uniqueCharsPushedToArray); $index++)
                        <tr>
                            <td>{{$uniqueCharsPushedToArray[$index]}}</td>
                            <td>{{substr_count($phrase, $uniqueCharsPushedToArray[$index])}}</td>


                            @php
                                $symbol = $uniqueCharsPushedToArray[$index];
                                $count = (substr_count($phrase, $uniqueCharsPushedToArray[$index]));
                            @endphp

                            <td>before:
                                {{(Helper::characterInfoBefore($phrase, $symbol, $count))}}

                                after:
                                {{(Helper::characterInfoAfter($phrase, $symbol, $count))}}

                                {{--Substract index of last occurence of a char in the phrase of the index of the first occurence to get the max distance--}}
                                @if(substr_count($phrase, $uniqueCharsPushedToArray[$index]) >= 2)
                                    max-distance: {{strrpos($phrase, $uniqueCharsPushedToArray[$index]) - strpos($phrase, $uniqueCharsPushedToArray[$index])}} chars
                                @endif

                            </td>
                        </tr>
                        @endfor
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </body>
</html>
