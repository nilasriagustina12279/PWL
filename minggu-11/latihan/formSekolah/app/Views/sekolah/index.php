<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h3>Daftar Sekolah di Semarang</h3>
        </div>
        <div class="card-body">
            <a href="../models/add.php" class="btn btn-success">✍️Masukkan data baru</a>
            <div class="table-responsive">
                <table id="data-table" class="table table-primary table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="material-icons-outlined number-list">
                                    format_list_numbered
                                </span>
                                Nomer
                            </th>
                            <th>
                                <span class="material-icons-outlined home">
                                    school
                                </span>
                                Nama Sekolah
                            </th>
                            <th>
                                <span class="material-icons-outlined place">
                                    place
                                </span>
                                Alamat Sekolah
                            </th>
                            <th>
                                <span class="material-icons-outlined settings">
                                    settings
                                </span>
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (! empty($sekolah_terdekat) && is_array($sekolah_terdekat)) : ?>

                            <?php foreach ($sekolah_terdekat as $data): ?>
                                <tr>
                                    <td><?= esc($data['id_sekolah']) ?> </td>
                                    <td><?= esc($data['nama']) ?> </td>
                                    <td><?= esc($data['alamat']) ?> </td>
                                    <td></td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <h3>Tidak Ada Sekolah</h3>

                            <p>Tidak dapat menemukan sekolah.</p>

                        <?php endif ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
