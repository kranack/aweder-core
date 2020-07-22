<div class="hero__merchant-times col-span-4 col-start-2 l-col-span-5 l-col-start-1 m-col-span-7 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
    <p class="merchant-times__status">We're {{$storeOpenStatus}}</p>
    @if (!$openingHours->isEmpty())
        <span class="separator separator--large"></span>
        <div id="merchant-times__current" class="merchant-times__current flex align-items-center">
            @if (!$openingHours->isEmpty())
                {{--@TODO COULD WE ADD THE CURRENT DAY OPENING TIMES BELOW--}}
                <span class="merchant-times__hours merchant-times__hours--open">12:00</span>
                <span class="separator separator--small"></span>
                <span class="merchant-times__hours merchant-times__hours--open">22:00</span>
                {{-- --}}
                <span class="merchant-times__icon">@svg('arrow-down-narrow', 'fill-cloud-burst')</span>
                <ul id="merchant-times__timetable" class="merchant-times__timetable">
                    @foreach($openingHours as $openingTime)
                        <li class="timetable__hours grid grid-cols-2">
                            <span class="timetable__day">{{$dayOfWeek[$openingTime->day_of_week]}}</span>
                            @if($openingTime->open_time->toTimeString() === '00:00:00' && $openingTime->close_time->toTimeString() === '00:00:00')
                                <span class="timetable__time">Closed</span>
                            @else
                                <span class="timetable__time">
                            {{$openingTime->open_time->format('H:i')}}
                            <span class="separator separator--small"></span>
                            {{$openingTime->close_time->format('H:i')}}
                            </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
</div>
