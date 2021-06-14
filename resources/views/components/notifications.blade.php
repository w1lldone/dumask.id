<div>
    @foreach ($notifications as $notification)
        <hr class="my-0">
        <a
            class="dropdown-item px-2"
            href="{{ route('notification.show', ['notification' => $notification->id])  }}"
        >
            <div class="d-flex">
                {{-- <span class="iconify text-secondary my-auto mr-2" data-icon="{{ $notification->data['icon'] }}" data-inline="false" style="font-size: 36px"></span> --}}
                <span class="mdi {{ $notification->data['icon'] }} text-secondary my-auto mr-2" style="font-size: 28px !important"></span>
                <div>
                    <div class="text-secondary font-weight-bold">
                        {{ $notification->data['title'] }}
                    </div>
                    <div class="text-muted">
                        {!! Str::words($notification->data['body'], 8, ' ...') !!}
                    </div>
                </div>
            </div>
        </a>
    @endforeach
        <hr class="my-0">
        <a
            class="dropdown-item text-center py-2 px-2 text-primary"
            href="{{ route('notification.index') }}"
        >
            Lihat Semua
        </a>
</div>