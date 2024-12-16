<table>
    <thead>
        <tr>
            <th>Ranking</th>
            <th>Nama Lengkap</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listQuizAttempt as $index => $list)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $list->nama_lengkap }}</td>
                <td>{{ $list->score }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
