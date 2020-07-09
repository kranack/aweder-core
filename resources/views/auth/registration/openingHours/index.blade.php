@extends('global.app')
@section('content')
    <section class="auth">
        <div class="row">
            <div class="content">
                <header class="auth__header col-span-6 col-start-4 m-col-span-10 m-col-start-2 sm-col-span-6 sm-col-start-1">
                    <h1 class="header-one color-carnation">Opening Hours</h1>
                    <p>Please select the times which you are open. These can be modified at any time from your Merchant Dashboard after setup is complete.</p>
                </header>
                <form class="col-span-6 col-start-4 m-col-span-10 m-col-start-2 sm-col-span-6 sm-col-start-1"
                      id="openingHoursForm"
                      name="openingHoursForm"
                      autocomplete="off"
                      action="{{ route('registration.opening-hours.post') }}"
                      method="POST">
                    @csrf
                    <div class="form-inline panel inline-grid grid-cols-6 m-grid-cols-10 sm-grid-cols-6 width-full background-off-white">
                        <div class="field field--select opening-time col-span-3 m-col-span-5 sm-col-span-6">
                            <span class="label opening-time__day">Monday</span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="monday-opening-hour" name="monday[opening][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                    <option value="{{ $i }}"
                                    @if (old('monday.opening.hour', 9) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="monday-opening-minute" name="monday[opening][minute]">
                                    <option value="00" @if (old('monday.opening.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('monday.opening.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('monday.opening.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('monday.opening.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                            <span class="separator separator--small"></span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="monday-closing-hour" name="monday[closing][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                    <option value="{{ $i }}"
                                    @if (old('monday.closing.hour', 17) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="monday-closing-minute" name="monday[closing][minute]">
                                    <option value="00" @if (old('monday.closing.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('monday.closing.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('monday.closing.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('monday.closing.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                        </div>
                        <div class="field field--select opening-time col-span-3 m-col-span-5 sm-col-span-6 row-start-2">
                            <span class="label opening-time__day">Tuesday</span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="tuesday-opening-hour" name="tuesday[opening][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('tuesday.opening.hour', 9) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="tuesday-opening-minute" name="tuesday[opening][minute]">
                                    <option value="00" @if (old('tuesday.opening.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('tuesday.opening.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('tuesday.opening.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('tuesday.opening.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                            <span class="separator separator--small"></span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="tuesday-closing-hour" name="tuesday[closing][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('tuesday.closing.hour', 17) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="tuesday-closing-minute" name="tuesday[closing][minute]">
                                    <option value="00" @if (old('tuesday.closing.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('tuesday.closing.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('tuesday.closing.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('tuesday.closing.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                        </div>
                        <div class="field field--select opening-time col-span-3 m-col-span-5 sm-col-span-6 row-start-3">
                            <span class="label opening-time__day">Wednesday</span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="wednesday-opening-hour" name="wednesday[opening][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('wednesday.opening.hour', 9) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="wednesday-opening-minute" name="wednesday[opening][minute]">
                                    <option value="00" @if (old('wednesday.opening.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('wednesday.opening.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('wednesday.opening.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('wednesday.opening.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                            <span class="separator separator--small"></span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="wednesday-closing-hour" name="wednesday[closing][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('wednesday.closing.hour', 17) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="wednesday-closing-minute" name="wednesday[closing][minute]">
                                    <option value="00" @if (old('wednesday.closing.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('wednesday.closing.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('wednesday.closing.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('wednesday.closing.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                        </div>
                        <div class="field field--select opening-time col-span-3 m-col-span-5 sm-col-span-6 row-start-4">
                            <span class="label opening-time__day">Thursday</span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="thursday-opening-hour" name="thursday[opening][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('thursday.opening.hour', 9) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="thursday-opening-minute" name="thursday[opening][minute]">
                                    <option value="00" @if (old('thursday.opening.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('thursday.opening.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('thursday.opening.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('thursday.opening.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                            <span class="separator separator--small"></span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="thursday-closing-hour" name="thursday[closing][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('thursday.closing.hour', 17) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="thursday-closing-minute" name="thursday[closing][minute]">
                                    <option value="00" @if (old('thursday.closing.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('thursday.closing.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('thursday.closing.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('thursday.closing.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                        </div>
                        <div class="field field--select opening-time col-span-3 m-col-span-5 sm-col-span-6">
                            <span class="label opening-time__day">Friday</span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="friday-opening-hour" name="friday[opening][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('friday.opening.hour', 9) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="friday-opening-minute" name="friday[opening][minute]">
                                    <option value="00" @if (old('friday.opening.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('friday.opening.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('friday.opening.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('friday.opening.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                            <span class="separator separator--small"></span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="friday-closing-hour" name="friday[closing][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('friday.closing.hour', 17) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="friday-closing-minute" name="friday[closing][minute]">
                                    <option value="00" @if (old('friday.closing.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('friday.closing.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('friday.closing.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('friday.closing.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                        </div>
                        <div class="field field--select opening-time col-span-3 m-col-span-5 sm-col-span-6">
                            <span class="label opening-time__day">Saturday</span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="saturday-opening-hour" name="saturday[opening][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('saturday.opening.hour', 9) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="saturday-opening-minute" name="saturday[opening][minute]">
                                    <option value="00" @if (old('saturday.opening.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('saturday.opening.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('saturday.opening.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('saturday.opening.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                            <span class="separator separator--small"></span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="saturday-closing-hour" name="saturday[closing][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('saturday.closing.hour', 17) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="saturday-closing-minute" name="saturday[closing][minute]">
                                    <option value="00" @if (old('saturday.closing.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('saturday.closing.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('saturday.closing.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('saturday.closing.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                        </div>
                        <div class="field field--select opening-time col-span-3 m-col-span-5 sm-col-span-6">
                            <span class="label opening-time__day">Sunday</span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="sunday-opening-hour" name="sunday[opening][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('sunday.opening.hour', 9) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="sunday-opening-minute" name="sunday[opening][minute]">
                                    <option value="00" @if (old('sunday.opening.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('sunday.opening.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('sunday.opening.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('sunday.opening.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                            <span class="separator separator--small"></span>
                            <div class="opening-time__group">
                                <select class="select-input opening-time__select" id="sunday-closing-hour" name="sunday[closing][hour]">
                                    @for ($i = 0; $i <= 23; $i++)
                                        <option value="{{ $i }}"
                                                @if (old('sunday.closing.hour', 17) === $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select class="select-input opening-time__select" id="sunday-closing-minute" name="sunday[closing][minute]">
                                    <option value="00" @if (old('sunday.closing.minute') === 00) selected @endif>00</option>
                                    <option value="15" @if (old('sunday.closing.minute') === 15) selected @endif>15</option>
                                    <option value="30" @if (old('sunday.closing.minute') === 30) selected @endif>30</option>
                                    <option value="45" @if (old('sunday.closing.minute') === 45) selected @endif>45</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field field--buttons col-span-6 m-col-span-10 sm-col-span-6 align-items-start s-align-items-stretch margin-top-50">
                        <button type="submit" class="button button-solid--carnation s-width-full">
                            <span class="button__content">Next</span>
                            <span class="button__icon button__icon--right">@svg('arrow-right', 'fill-ecru-white')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
