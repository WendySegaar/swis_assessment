@extends('layouts.app')


@section('title')
    Selecteer een schooljaar
@endsection

@section('content')
    <ul>
        @foreach($schoolyears as $schoolyear)
            <li>
                <a href="{{ route('show_school_holidays', $schoolyear['schoolyear'] ) }}">{{ $schoolyear['displaySchoolyear'] }}</a>
            </li>
        @endforeach
    </ul>
@endsection
