@extends('layout.base')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-3"><a href="week.php?year={{$week->getYear()}}&month={{$week->getMonth()}}&week={{$week->getWeek() -1 }}"><span class="glyphicon glyphicon-chevron-left"></span></a> {{$week->getStart()->format('d-m-Y')}}</div>
            <div class="col-md-6 text-center bold">
                    {{translate('Week')}} {{$week->getWeek()}} -
                    <a href="month.php?year={{$week->getYear()}}&month={{$week->getMonth()}}">{{ucwords($week->getMonth(true)->getMonthName())}}</a>
                    <a href="year.php?year={{$week->getYear()}}">{{$week->getYear()}}</a>
            </div>
            <div class="col-md-3 text-right">{{$week->getEnd()->format('d-m-Y')}} <a href="week.php?year={{$week->getYear()}}&month={{$week->getMonth()}}&week={{$week->getWeek() +1 }}"><span class="glyphicon glyphicon-chevron-right"></span></a></div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
        @foreach ($week->getDays(true) as $day)
            @if ($day != null)
            <div class="col-md-12 thumbnail">
                @include('show_day')
            </div>
            @endif
        @endforeach
        </div>
    </div>
</div>
@endsection
