<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Surat IT SHB</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h3>Data Surat IT SHB</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Tanggal Surat</th>
                <th>Dibuat Pada</th>
                <th>Diperbarui Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surats as $surat)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $surat->nomor_surat }}</td>
                <td>{{ $surat->nama }}</td>
                <td>{{ $surat->keterangan }}</td>
                <td>{{ \Carbon\Carbon::parse($surat->tanggal)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($surat->created_at)->format('d-m-Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($surat->updated_at)->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
