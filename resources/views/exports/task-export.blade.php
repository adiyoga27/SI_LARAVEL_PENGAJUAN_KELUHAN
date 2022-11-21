<table style="border: 1px" border="1px">
    <thead>
        <tr>
            <th><strong>No Pengajuan</strong></th>
            <th><strong>NIK</strong></th>
            <th><strong>Nama</strong></th>
            <th><strong>HP</strong></th>
            <th><strong>Desa</strong></th>
            <th><strong>Latitude</strong></th>
            <th><strong>Longtitude</strong></th>
            <th><strong>Judul</strong></th>
            <th><strong>Deskripsi</strong></th>
            <th><strong>Tgl Mulai</strong></th>
            <th><strong>Tgl Selesai</strong></th>
            <th><strong>Teknisi</strong></th>
            <th><strong>Catatan</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->task_number }}</td>
                <td>{{ $task->nik }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->hp }}</td>
                <td>{{ $task->complaint_village }}</td>
                <td>{{ $task->latitude }}</td>
                <td>{{ $task->longtitude }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->start_at }}</td>
                <td>{{ $task->end_at }}</td>
                <td>
                    @foreach ($task->technician as $tech)
                        {{ $tech->technician->name }},
                    @endforeach
                </td>
                <td>{{ $task->finish_note }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
