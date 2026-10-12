<x-layout>
    <x-slot name="title">Halaman Daftar Task</x-slot>
    <x-slot name="page_heading">Daftar Task</x-slot>

    <div class="card">
        <div class="card-body">
            @include('utilities.alert')

            <div class="d-flex justify-content-end mb-3">
            
                {{-- Tombol Export PDF --}}
                @can('export task')
                    <a href="{{ route('tasks.export.pdf') }}" 
                       class="btn btn-success mr-2" 
                       target="_blank">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                @endcan
            
                {{-- Tombol Print --}}
                @can('print task')
                    <a href="{{ route('tasks.print') }}" 
                       class="btn btn-primary mr-2" 
                       target="_blank">
                        <i class="fas fa-print"></i> Print
                    </a>
                @endcan
            
                {{-- Tombol Upload Task --}}
                <button type="button" 
                        class="btn btn-primary" 
                        data-toggle="modal" 
                        data-target="#modalUploadTask">
                    <i class="fas fa-upload"></i> Upload Task
                </button>
            </div>

            {{-- Tabel Task --}}
            <div class="row">
                <div class="col-lg-12">
                    <x-datatable id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item</th>
                                <th>Jenis</th>
                                <th>Vendor PIC</th>
                                <th>Deadline</th>
                                <th>Sisa Hari</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                @php
                                    $sisa = $task->sisa_hari;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->item }}</td>
                                    <td>{{ $task->jenis }}</td>
                                    <td>{{ $task->vendor_pic ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($sisa > 30)
                                            <span class="badge badge-success">{{ $sisa }} Hari</span>
                                        @elseif($sisa > 0)
                                            <span class="badge badge-warning">{{ $sisa }} Hari</span>
                                        @else
                                            <span class="badge badge-danger">{{ $sisa }} Hari</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($sisa <= 0)
                                            <span class="badge badge-danger"><i class="fas fa-times"></i> Kadaluwarsa</span>
                                        @elseif($task->status === 'Selesai')
                                            <span class="badge badge-primary"><i class="fas fa-check-circle"></i> Selesai</span>
                                        @elseif($task->status === 'Proses')
                                            <span class="badge badge-warning"><i class="fas fa-spinner fa-spin"></i> Proses</span>
                                        @else
                                            <span class="badge badge-success"><i class="fas fa-check"></i> Aktif</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($task->keterangan, 50, '...') }}</td>
                                    <td class="text-center">
                                        <button 
                                            class="btn btn-sm btn-info show-task"
                                            data-id="{{ $task->id }}"
                                            data-item="{{ $task->item }}"
                                            data-jenis="{{ $task->jenis }}"
                                            data-vendor="{{ $task->vendor_pic ?? '-' }}"
                                            data-deadline="{{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}"
                                            data-sisa="{{ $sisa }}"
                                            data-status="{{ $task->status }}"
                                            data-keterangan="{{ $task->keterangan }}"
                                            data-toggle="modal" 
                                            data-target="#taskDetailModal"
                                        >
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Dinamis --}}
    @push('modal')
        @include('task.modal.show')
        @include('task.modal.import')
    @endpush

    {{-- Script --}}
    @push('js')
        @include('task._script')
    @endpush
</x-layout>
