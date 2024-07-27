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
                        <h1 class="h3 mb-0 text-gray-800">Capaian Pembelajaran Lulusan</h1>
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
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total CPL</div>
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

                    <!-- Capaian Pembelajaran Lulusan Table -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header py-3 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Capaian Pembelajaran Lulusan</h6>
                            <a href="#" class="btn btn-sm btn-primary mt-2 mt-sm-0 rounded_btn" data-bs-toggle="modal" data-bs-target="#addCplModal">
                                <i class="fas fa-plus mr-2"></i>Tambah CPL
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Program Studi</th>
                                            <th>Deskripsi Indonesia</th>
                                            <th>Deskripsi Inggris</th>
                                            <th class="aksi-col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($cpl)) : ?>
                                            <?php foreach ($cpl as $cpl_item) : ?>
                                                <tr>
                                                    <td><?php echo $cpl_item['nmr_cpl']; ?></td>
                                                    <td><?php echo $cpl_item['jr2_skf']; ?></td>
                                                    <td><?php echo $cpl_item['ina_cpl']; ?></td>
                                                    <td><?php echo $cpl_item['eng_cpl']; ?></td>
                                                    <td class="aksi-col">
                                                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCplModal" data-id="<?php echo $cpl_item['skf_cpl']; ?>">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-sm delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="<?php echo site_url('cpl/delete/' . $cpl_item['idx_cpl']); ?>" data-name="<?php echo $cpl_item['ina_cpl']; ?>">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5">No CPL data found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Add -->
                <div class="modal fade" id="addCplModal" tabindex="-1" role="dialog" aria-labelledby="addCplModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCplModalLabel"><strong>Tambah CPL</strong></h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addCplForm" action="<?php echo site_url('cpl/add'); ?>" method="post">

                                    <div class="form-group">
                                        <label for="addProgramStudi">Program Studi</label>
                                        <select class="form-control" id="addProgramStudi" name="skf_cpl" required>
                                            <option value="" disabled selected>Pilih Program Studi</option>
                                            <?php foreach ($program_studi as $ps) : ?>
                                                <option value="<?php echo $ps['idx_skf']; ?>">
                                                    <?php echo $ps['jr2_skf'] . ', ' . $ps['jjg_skf'] . ', ' . $ps['kde_skf']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="addDeskripsiID">Deskripsi Indonesia</label>
                                        <textarea class="form-control" id="addDeskripsiID" name="ina_cpl" rows="3" placeholder="Masukkan deskripsi dalam bahasa Indonesia" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="addDeskripsiEN">Deskripsi Inggris</label>
                                        <textarea class="form-control" id="addDeskripsiEN" name="eng_cpl" rows="3" placeholder="Masukkan deskripsi dalam bahasa Inggris" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="addNomor">Nomor</label>
                                        <input type="number" class="form-control" id="addNomor" name="nmr_cpl" placeholder="Masukkan nomor" required>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="button" id="saveCplBtn" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="editCplModal" tabindex="-1" role="dialog" aria-labelledby="editCplModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCplModalLabel"><strong>Edit CPL</strong></h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editCplForm" action="<?php echo site_url('cpl/update'); ?>" method="post">
                                    <input type="hidden" name="id" id="editCplId" value="">
                                    <div class="form-group">
                                        <label for="addProgramStudi">Program Studi</label>
                                        <select class="form-control" id="addProgramStudi" name="skf_cpl" required>
                                            <option value="" disabled>Pilih Program Studi</option>
                                            <?php foreach ($program_studi as $ps) : ?>
                                                <option value="<?php echo $ps['idx_skf']; ?>">
                                                    <?php echo $ps['jr2_skf'] . ', ' . $ps['jjg_skf'] . ', ' . $ps['kde_skf']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="editDeskripsiID">Deskripsi Indonesia</label>
                                        <textarea class="form-control" id="editDeskripsiID" name="ina_cpl" rows="3" placeholder="Masukkan deskripsi dalam bahasa Indonesia" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="editDeskripsiEN">Deskripsi Inggris</label>
                                        <textarea class="form-control" id="editDeskripsiEN" name="eng_cpl" rows="3" placeholder="Masukkan deskripsi dalam bahasa Inggris" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="editNomor">Nomor</label>
                                        <input type="number" class="form-control" id="editNomor" name="nmr_cpl" placeholder="Masukkan nomor" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="button" id="saveEditCplBtn" class="btn btn-primary">Simpan</button>
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
                // Event handler for opening the modal
                $(document).on('click', '[data-bs-target="#editCplModal"]', function() {
                    var id = $(this).data('id'); // Get ID from button's data-id attribute

                    $.ajax({
                        url: '<?php echo site_url('cpl/edit/'); ?>' + id,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                // Fill modal form with data
                                $('#editCplId').val(data.skf_cpl); // Set hidden ID
                                $('#editDeskripsiID').val(data.ina_cpl); // Set Indonesian description
                                $('#editDeskripsiEN').val(data.eng_cpl); // Set English description
                                $('#editNomor').val(data.nmr_cpl); // Set number

                                // Set the selected value for Program Studi dropdown
                                $('#addProgramStudi').val(data.skf_cpl);

                                // Show the modal
                                $('#editCplModal').modal('show');
                            } else {
                                alert('Data not found.');
                            }
                        },
                        error: function() {
                            alert('Error fetching data.');
                        }
                    });
                });

                // Submit form
                $('#editCplForm').submit(function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.success) {
                                alert('Data updated successfully.');
                                $('#editCplModal').modal('hide');
                                location.reload();
                            } else {
                                alert('Failed to update data.');
                            }
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