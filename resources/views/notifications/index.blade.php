@extends('layouts.template')

@section('title', 'Notifikasi')

@section('content')

<div class="row">
    <div class="col-12 flex px-md-0 pt-sm-0 w-100">
        <div class="col-12 col-md-4 flex card border-0 mt-4 py-2" style="border-radius:0.75em">
            <h2 class="text-secondary font-weight-bold">NOTIFICATION</h2>
        </div>
    </div>
</div>
<div class="mt-4 d-flex-column">
    <div class="flex card border-0 px-4 py-4" style="border-radius:0.75em">
        <div class="d-flex">
            <h4 class="text-dark font-weight-bold my-auto">
                NOTIFICATION
            </h4>
        </div>
        <hr style="border-bottom: 2px solid #c4c4c4;">
        <div class="custom-control custom-switch">
            <form id="form-is-unread" action="{{ route('notification.index')  }}" method="GET">
                <div class="input-group mb-4">
                    <input
                        type="checkbox"
                        class="custom-control-input"
                        id="is_unread"
                        name="is_unread"
                        value="true"
                        @if (request('is_unread'))
                            checked
                        @endif
                        onchange="this.form.submit()"
                    >
                    <label class="custom-control-label text-secondary" for="is_unread">Tampilkan hanya notifikasi yang belum dibaca.</label>
                </div>
            </form>
        </div>
        <div>
            @if ($notifications->count())
                @foreach ($notifications as $notification)
                    <hr class="my-0">
                    <a
                        class="dropdown-item px-2 {{ $notification->read_at ? 'notification-unread' : 'notification-read' }}"
                        href="{{ route('notification.show', ['notification' => $notification->id])  }}"
                    >
                        <div class="d-flex">
                            <span class="iconify text-secondary my-auto mr-2" data-icon="{{ $notification->data['icon'] }}" data-inline="false" style="font-size: 36px"></span>
                            <div>
                                <div class="text-secondary font-weight-bold">
                                    {{ $notification->data['title'] }}
                                </div>
                                <div class="text-muted">
                                    {{ $notification->data['body'] }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</div>


@endsection
