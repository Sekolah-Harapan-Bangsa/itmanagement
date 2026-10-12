<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Task IT SHB</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333; }
        h3 { text-align: center; margin-bottom: 15px; color: #1a73e8; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 8px 10px; text-align: left; }
        
        th { 
            background-color: #1a73e8; 
            color: white; 
            font-weight: bold; 
            text-transform: uppercase; 
            font-size: 11px;
        }

        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:nth-child(odd) { background-color: #ffffff; }

        td { border-bottom: 1px solid #ddd; font-size: 11px; }

        .expired { background-color: #ffebee; color: #c62828; font-weight: bold; }
    </style>
</head>
<body>
    <h3>Data Task IT SHB</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Jenis</th>
                <th>Vendor PIC</th>
                <th>Tanggal Deadline</th>
                <th>Sisa Hari</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Dibuat Pada</th>
                <th>Diperbarui Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            @php
                $isExpired = \Carbon\Carbon::parse($task->deadline)->isPast();
            @endphp
            <tr class="{{ $isExpired ? 'expired' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $task->item }}</td>
                <td>{{ $task->jenis }}</td>
                <td>{{ $task->vendor_pic }}</td>
                <td>{{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') }}</td>
                <td>{{ $task->sisa_hari }}</td>
                <td>{{ ucfirst($task->status) }}</td>
                <td>{{ $task->keterangan }}</td>
                <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d-m-Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($task->updated_at)->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
