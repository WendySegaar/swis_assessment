<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <header>
        <h1>{{ $content->title }} in {{ $content->location }}</h1>
    </header>

    <table>
        <caption>{{$content->title}}</caption>
        <tr>
            <th></th>
            <th>Regio Noord</th>
            <th>Regio Midden</th>
            <th>Regio Zuid</th>

        </tr>
        @foreach($school_holidays as $school_holiday)
            <tr>
                <td>
                    {{ $school_holiday->type }}
                    @if(!$school_holiday->compulsory_dates)
                        *
                    @endif
                </td>
                @foreach($school_holiday->regions as $region)
                    @if($region->region == 'heel Nederland')
                        @for ($i = 0; $i < 3; $i++)
                            <td>
                                {{$region->formatted_date}}
                            </td>
                        @endfor
                    @else
                        <td>
                            {{$region->formatted_date}}
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        <tr>
            <td colspan="4">* {{ $content->notice }}</td>
        </tr>
    </table>

    <footer>
        Licentie: {{ $content->license }} <br/>
        {{ $content->authorities }}<br/>
        {{ $content->rightsholders }}
    </footer>
</body>
</html>