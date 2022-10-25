@php
$notifications = App\Models\Notification::where('user_id',Auth::user()->id)->latest()->limit(5)->get();

@endphp

<div data-simplebar style="max-height: 230px;">
    @if(Auth::user()->notifications->count() == 0)
    <p class="text-muted font-size-12 text-center">You have no new notifications.</p>
    @endif
    @foreach ($notifications as $notif)
    <a href="{{ route('notifications.view' , $notif->code) }}" class="text-reset notification-item">
        <div class="d-flex">
            <div class="avatar-xs me-3">
                <span class="avatar-title bg-{{$notif->color}} rounded-circle font-size-16">
                    <i class="{{$notif->icon}}"></i>
                </span>
            </div>
            <div class="flex-1">
                <h6 class="mb-1">{{$notif->subject}} @if($notif->read_status == 'unread')<span class="badge bg-danger">NEW</span>@endif</h6>
                <div class="font-size-12 text-muted">
                    <p class="mb-1">{{Str::limit($notif->message, 75)}}</p>
                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{Carbon\Carbon::parse($notif->created_at)->diffForHumans()}}</p>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>