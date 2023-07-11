@if($message)
    <div class="alert alert-icon-{{$type}}">
        <i data-feather="check"></i>
        {{ $message }}
    </div>
@endif
