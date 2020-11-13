@extends('layouts.app')


@section('title')
    {{ $content->title }} in {{ $content->location }}
@endsection

@section('content')
    <table>
        <caption>{{$content->title}}</caption>
        <thead>
            <tr>
                <th></th>
                <th>Regio Noord</th>
                <th>Regio Midden</th>
                <th>Regio Zuid</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">* {{ $content->notice }}</td>
            </tr>
        </tfoot>
    </table>
@endsection

@section('footer')
    Licentie: {{ $content->license }} | {{ $content->authorities }} | {{ $content->rightsholders }}
@endsection