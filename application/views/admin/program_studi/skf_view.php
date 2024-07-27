<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CPL</title>

    <!-- Custom fonts -->
    <link href="assets/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles -->
    <link href="assets/sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <style>
        .rounded_btn {
            border-radius: 6px;
            padding-right: 14px;
            padding-left: 14px;
        }

        .text-center {
            text-align: center;
        }

        .aksi-col {
            width: 150px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .table thead th {
            vertical-align: middle;
        }

        .table tbody td {
            vertical-align: middle;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('admin/partials/sidebar'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('admin/partials/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Program Studi</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow-sm h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Program Studi</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Program Studi Table -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header py-3 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Program Studi</h6>
                            <a href="#" class="btn btn-sm btn-primary mt-2 mt-sm-0 rounded_btn" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="fas fa-plus mr-2"></i>Tambah Program Studi
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Universitas</th>
                                            <th>Fakultas</th>
                                            <th>Program Studi</th>
                                            <th>Jenjang</th>
                                            <th class="aksi-col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($program_studi)) : ?>
                                            <?php foreach ($program_studi as $skf) : ?>
                                                <tr>
                                                    <td><?php echo $skf['kde_skf']; ?></td>
                                                    <td><?php echo $skf['jns_ipt']; ?> <?php echo $skf['nma_ipt']; ?></td>
                                                    <td><?php echo $skf['kde_sfk']; ?> <?php echo $skf['nma_sfk']; ?></td>
                                                    <td><?php echo $skf['jr2_skf']; ?></td>
                                                    <td><?php echo $skf['jjg_skf']; ?></td>
                                                    <td class="aksi-col">
                                                        <a href="<?php echo site_url('program_studi/edit/' . $skf['idx_skf']); ?>" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="<?php echo site_url('program_studi/delete/' . $skf['idx_skf']); ?>" data-name="<?php echo $skf['jr2_skf']; ?>">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4">No program studi found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Add -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Tambah Program Studi</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addForm" action="<?php echo site_url('program_studi/add'); ?>" method="post">

                                    <input type="hidden" id="idx_sfk" name="idx_sfk" class="form-control" autocomplete="off" value="<?= isset($program_studi[0]['idx_sfk']) ? $program_studi[0]['idx_sfk'] : '' ?>" required>

                                    <div class="form-group">
                                        <label for="addKode">Kode</label>
                                        <input type="text" class="form-control" id="addKode" name="kde_skf" placeholder="Masukkan Kode" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addNama">Program Studi</label>
                                        <input type="text" class="form-control" id="addNama" name="jr2_skf" placeholder="Masukkan Program Studi" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="addJenjang">Jenjang</label>
                                        <select class="form-control" id="addJenjang" name="jjg_skf" required>
                                            <option value="" disabled selected>Pilih jenjang program studi</option>
                                            <option value="S-1">S-1</option>
                                            <option value="S-2">S-2</option>
                                            <option value="S-3">S-3</option>
                                            <option value="D-3">D-3</option>
                                            <option value="D-4">D-4</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="button" id="saveAddBtn" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Program Studi</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm" action="<?php echo site_url('program_studi/update'); ?>" method="post">
                                    <input type="hidden" name="idx_skf" id="editIdxSkf">
                                    <div class="form-group">
                                        <label for="editKode">Kode</label>
                                        <input type="text" class="form-control" id="editKode" name="kde_skf" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editNama">Program Studi</label>
                                        <input type="text" class="form-control" id="editNama" name="jr2_skf" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editJenjang">Jenjang</label>
                                        <select class="form-control" id="editJenjang" name="jjg_skf" required>
                                            <option value="" disabled selected>Pilih jenjang program studi</option>
                                            <option value="S-1">S-1</option>
                                            <option value="S-2">S-2</option>
                                            <option value="S-3">S-3</option>
                                            <option value="D-3">D-3</option>
                                            <option value="D-4">D-4</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="button" id="saveChangesBtn" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus Program Studi <span id="programName"></span>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <?php $this->load->view('admin/partials/footer'); ?>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            // Add
            $(document).ready(function() {
                $('#myTable').DataTable();

                $('#saveAddBtn').on('click', function() {
                    var idx_sfk = $('#idx_sfk').val();
                    var kode = $('#addKode').val();
                    var nama = $('#addNama').val();
                    var jenjang = $('#addJenjang').val();

                    if (kode === '' || nama === '' || jenjang === '' || idx_sfk === '') {
                        alert('Harap lengkapi semua field.');
                        return;
                    }

                    $.ajax({
                        url: $('#addForm').attr('action'),
                        type: 'POST',
                        data: $('#addForm').serialize(),
                        success: function(response) {
                            if (response.success) {
                                alert('Program Studi berhasil ditambahkan.');
                                location.reload();
                            } else {
                                alert('Terjadi kesalahan: ' + response.error);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('AJAX Error: ' + textStatus + ': ' + errorThrown);
                            alert('Terjadi kesalahan saat menghubungi server. Cek console untuk detail.');
                        }
                    });
                });
            });

            // Edit
            $(document).ready(function() {
                $('.btn-warning').on('click', function(event) {
                    event.preventDefault(); // Mencegah navigasi default

                    var url = $(this).attr('href'); // Ambil URL dari atribut href tombol
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            // Response berisi data JSON dengan informasi program studi
                            $('#editIdxSkf').val(response.idx_skf);
                            $('#editKode').val(response.kde_skf);
                            $('#editNama').val(response.jr2_skf);
                            $('#editJenjang').val(response.jjg_skf);

                            // Tampilkan modal
                            $('#editModal').modal('show');
                        },
                        error: function() {
                            alert('Error retrieving data.');
                        }
                    });
                });

                // Simpan Program Studi
                $('#saveChangesBtn').on('click', function(event) {
                    event.preventDefault(); // Mencegah navigasi default

                    var form = $('#editForm');
                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            // Tangani respons sukses jika perlu
                            alert('Data updated successfully!');
                            $('#editModal').modal('hide');
                        },
                        error: function() {
                            alert('Error updating data.');
                        }
                    });
                });
            });

            // Delete Program Studi
            document.addEventListener('DOMContentLoaded', function() {
                var deleteModal = document.getElementById('deleteModal');
                var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
                var programName = document.getElementById('programName');

                deleteModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var url = button.getAttribute('data-url');
                    var name = button.getAttribute('data-name')

                    confirmDeleteBtn.setAttribute('href', url);
                    programName.textContent = name;
                });
            });
        </script>

        <!-- Bootstrap core JavaScript-->
        <script src="assets/sb-admin/vendor/jquery/jquery.min.js"></script>
        <script src="assets/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>

        <script src="assets/sb-admin/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/sb-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/sb-admin/js/sb-admin-2.min.js"></script>
</body>

</html>