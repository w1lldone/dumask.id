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
                <div class="d-flex mt-4">
                    <button
                        class="btn btn-secondary shadow ml-auto"
                        data-toggle="modal" 
                        data-target="#read-all"
                    >
                    MARK ALL AS READ
                    </button>
                </div>
                <div
                    class="modal fade"
                    id="read-all"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="modal-id"
                    aria-hidden="true"
                >
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header mx-4">
                                <h5
                                class="modal-title font-weight-bold text-muted"
                                style="text-transform: uppercase"
                                >
                                MARK ALL AS READ
                                </h5>
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close"
                                >
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left mx-4">
                                <div>
                                    Apakah Anda yakin akan menandai semua notifikasi sudah dibaca?
                                </div>
                                <div class="mt-4 text-right">
                                    <form id="form-read-all">
                                        <button type="button" class="btn btn-primary mx-2 shadow" data-dismiss="modal">TIDAK</button>
                                        <button
                                            class="btn btn-secondary shadow"
                                            onclick="doSubmit()"
                                            data-dismiss="modal"
                                        >
                                            YA
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h5 class="text-secondary text-center">Semua notifikasi sudah dibaca</h5>
            @endif
        </div>
    </div>
</div>

@endsection

<script>
    async function doSubmit() {
        try {
            let response = await axios.put("notification/readAll")
            location.reload()
        } catch (error) {
            alert(error.response.data)
        }
    }
</script>