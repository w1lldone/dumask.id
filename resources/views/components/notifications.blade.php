<div>
    <?php $count = 0; ?>
    @foreach ($notifications as $notification)
        <?php if($count == 5) break; ?>
        <hr class="my-0">
        <a
            class="dropdown-item px-2"
            href="{{ $notification->data['action'] }}"
        >
            <div class="d-flex">
                <span class="iconify text-secondary my-auto mr-2" data-icon="{{ $notification->data['icon'] }}" data-inline="false" style="font-size: 36px"></span>
                <div>
                    <div class="text-primary font-weight-bold">
                        {{ $notification->data['title'] }}
                    </div>
                    <div class="text-dark">
                        {{ $notification->data['body'] }}
                    </div>
                </div>
            </div>
        </a>
        <?php $count++; ?>
    @endforeach
        @if ($notifications->count() > 5)
        <hr class="my-0">
        <div class="dropdown-item text-center py-2 px-2 text-primary">
            + {{ $notifications->count() - 5 }} Lainnya
        </div>
        @endif
        <hr class="my-0">
        <a
            class="dropdown-item text-center py-2 px-2 text-primary"
            href="{{ route('notification.index') }}"
        >
            Lihat Semua
        </a>
</div>