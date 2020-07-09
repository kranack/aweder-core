@if (session()->has('error'))
<div class="notification notification--error">
    <div class="row">
        <div class="content">
            <div class="notification__message col-span-10 col-start-2 m-col-span-12 m-col-start-1 sm-col-span-6 sm-col-start-1">
                <p>{{ session()->get('error') }}</p>
                {{session()->forget('error')}}
            </div>
        </div>
    </div>
</div>
@endif
@if (session()->has('success'))
    <div class="notification notification--success">
        <div class="row">
            <div class="content">
                <div class="notification__message col-span-10 col-start-2 m-col-span-12 m-col-start-1 sm-col-span-6 sm-col-start-1">
                    <p>{{ session()->get('success') }}</p>
                    {{session()->forget('success')}}
                </div>
            </div>
        </div>
    </div>
@endif
