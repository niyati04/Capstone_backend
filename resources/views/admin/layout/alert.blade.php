@if ($message = Session::get('success'))
    <div class="alert alert-dismissible fade show alert-success m-4 text-center" style="padding: 5px 10px;">
        <p class="p-0">{{ $message }}</p>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-dismissible fade show alert-danger m-4 text-center" style="padding: 5px 10px;">
        <p class="m-0">{{ $message }}</p>
    </div>
@endif
@if ($message = Session::get('warning'))
    <div class="alert alert-dismissible fade show alert-warning m-4 text-center" style="padding: 5px 10px;">
        <p class="m-0">{{ $message }}</p>
    </div>
@endif

<div class="messages">

</div>
