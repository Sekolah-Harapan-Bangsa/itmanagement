{{-- resources/views/surat/index.blade.php --}}
<x-layout>
    <x-slot name="title">Halaman Daftar Surat</x-slot>
    <x-slot name="page_heading">Daftar Surat</x-slot>

<div class="card">
    <div class="card-body">
        @include('utilities.alert')

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-end mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#modalTambahSurat">
                    <i class="fas fa-plus"></i> Tambah Surat
                </button>
                <!--
                <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#modalImportSurat">
                    <i class="fas fa-upload"></i> Import Excel
                </button>
                -->
                <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#modalExportSurat">
                    <i class="fas fa-download"></i> Export Surat
                </button>
            </div>
        </div>

        {{-- Tabel Surat --}}
        <div class="row">
            <div class="col-lg-12">
                <x-datatable id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Nama</th>
                            <th>File</th>
                            <th>Dibuat</th>
                            <th>Diperbarui</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surats as $surat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $surat->nomor_surat }}</td>
                                <td>{{ $surat->nama }}</td>
                                <td>
                                    @php
                                        $fileUrl = $surat->foto ? asset('storage/' . $surat->foto) : null;
                                        $extension = $surat->foto ? strtolower(pathinfo($surat->foto, PATHINFO_EXTENSION)) : null;
                                    @endphp
                                    @if ($fileUrl)
                                            <a href="{{ $fileUrl }}"
                                               class="preview-file d-inline-block text-center"
                                               data-foto="{{ $fileUrl }}"
                                               data-ext="{{ $extension }}"
                                               target="_blank">
                                        
                                                @if ($extension === 'pdf')
                                                    {{-- Ikon PDF --}}
                                                    <i class="fas fa-file-pdf text-danger"
                                                       style="font-size: 28px;"></i>
                                        
                                                @elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                                    {{-- Ikon Gambar --}}
                                                    <i class="fas fa-file-image text-primary"
                                                       style="font-size: 28px;"></i>
                                        
                                                @else
                                                    {{-- Ikon File Umum --}}
                                                    <i class="fas fa-file text-secondary"
                                                       style="font-size: 28px;"></i>
                                                @endif
                                        
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif

                                <td>{{ \Carbon\Carbon::parse($surat->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $surat->updated_at->format('d/m/Y H:i') }}</td>
                                <td>{{ Str::limit($surat->keterangan, 50, '...') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Surat Aksi">
                                        <a class="btn btn-sm btn-info text-white show-modal mr-2" data-id="{{ $surat->id }}" data-toggle="modal" data-target="#show_surat">
                                            <i class="fas fa-fw fa-search"></i>
                                        </a>
                                        <a class="btn btn-sm btn-success text-white edit-modal mr-2" data-id="{{ $surat->id }}" data-toggle="modal" data-target="#edit_surat">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </a>
                                        
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-datatable>
            </div>
        </div>
    </div>
</div>





    {{-- Modal dinamis --}}
    @push('modal')
    @include('surat.modal.create')
    @include('surat.modal.import')
    @include('surat.modal.export')
    @include('surat.modal.show')
    @include('surat.modal.edit')

    <!-- Modal Preview File -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Preview File</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
            </button>
        </div>
        <div class="modal-body text-center" id="previewContent">
            <!-- Konten file akan di-render di sini -->
        </div>
        </div>
    </div>
    </div>

    @endpush

    {{-- Script --}}
    @push('js')
        @include('surat._script')
    @endpush
</x-layout>
