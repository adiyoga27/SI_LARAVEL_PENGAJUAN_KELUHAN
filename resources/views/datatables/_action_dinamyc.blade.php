<style>
    .flex-item {
        margin-left: 2px;
        margin-right: 2px;
    }
</style>
<div class="d-flex flex-row">
    @if (isset($delete))
        <div class="flex-item">
            <form action="{{ isset($delete) ? $delete : '/' }}" method="POST" data-confirm="{{ $confirm_message ?? '' }}"
                style="margin-bottom: 5px" onsubmit="event.preventDefault(); return confirmDelete(this)">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Product"><i
                        class="mdi mdi-delete-sweep"></i>
                    Hapus</button>
            </form>
        </div>
    @endif

    @if (isset($edit))
        <div class="flex-item">
            <a class="btn btn-warning  btn-sm" title="Edit Data" data-id="{{ $model->id }}" id="edit"
                data-bs-toggle="modal" data-bs-target="#modal_edit"><i class="mdi mdi-pencil"></i>
                Edit</a>
        </div>
    @endif
    @if (isset($view))
        <div class="flex-item">
            <a class="btn btn-secondary  btn-sm" title="Lihat" href="{{ $view }}"><i
                    class="mdi mdi-file-find"></i>
                View</a>
        </div>
    @endif

    @if (isset($approve))
        <div class="flex-item">
            <a class="btn btn-success  btn-sm" title="Terima Pengajuan" data-id="{{ $model->id }}" id="approve"
                data-bs-toggle="modal" data-bs-target="#modal_approve"><i class="mdi mdi-file-find"></i>
                Terima</a>
        </div>
    @endif

    @if (isset($reject))
        <div class="flex-item">
            <a class="btn btn-danger  btn-sm" title="Tolak Pengajuan" data-id="{{ $model->id }}" id="reject"
                data-bs-toggle="modal" data-bs-target="#modal_reject"><i class="mdi mdi-file-find"></i>
                Tolak</a>
        </div>
    @endif

    @if (isset($done))
        <div class="flex-item">
            <form action="{{ isset($done) ? $done : '/' }}" method="POST" data-confirm="{{ $confirm_message ?? '' }}"
                style="margin-bottom: 5px" onsubmit="event.preventDefault(); return confirmDelete(this)" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" title="Selesaikan Task"><i
                        class="mdi mdi-calendar-check"></i>
                    Finish</button>
            </form>
        </div>
    @endif
</div>
