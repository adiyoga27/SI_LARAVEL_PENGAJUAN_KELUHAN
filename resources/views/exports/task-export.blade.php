<table border="1">
    <thead>
        <tr>
            <th>No Pengajuan</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>HP</th>
            <th>Desa</th>
            <th>Latitude</th>
            <th>Longtitude</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tgl Mulai</th>
            <th>Tgl Selesai</th>
            <th>Teknisi</th>
            <th>Catatan</th>
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
