<div>
    @forelse ($notifications as $notification)
        <hr class="my-0">
        <a
            class="dropdown-item px-2"
            href="{{ route('notification.show', ['notification' => $notification->id])  }}"
        >
            <div class="d-flex">
                <span class="mdi {{ $notification->data['icon'] }} text-secondary my-auto mr-2" style="font-size: 28px !important"></span>
                <div>
                    <div class="text-secondary font-weight-bold">
                        {{ $notification->data['title'] }}
                    </div>
                    <div class="text-muted">
                        {!! Str::words($notification->data['body'], 8, ' ...') !!} <br>
                        {{ $notification->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </a>
    @empty
        <div class="text-center py-4 px-2">
            <span class="text-muted">Tidak ada notifikasi baru</span>
        </div>
    @endforelse
        <hr class="my-0">
        <a
            class="dropdown-item text-center py-2 px-2 text-primary"
            href="{{ route('notification.index') }}"
        >
            Lihat Semua
        </a>
</div>
