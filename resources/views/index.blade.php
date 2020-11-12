<!DOCTYPE html>
<html>
<head>

</head>
<body>

    <h1>Selecteer een schooljaar</h1>
    <ul>
        @foreach($schoolyears as $schoolyear)
            <li><a href="{{ route('show_school_holidays', $schoolyear['schoolyear'] ) }}">{{ $schoolyear['displaySchoolyear'] }}</a></li>
        @endforeach
    </ul>

</body>
</html>