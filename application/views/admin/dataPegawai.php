<div class="container-flluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>
    <a href="<?php echo base_url('admin/dataPegawai/tambah_data') ?>" class='mb-2 mt-2 btn btn-sm btn-success'><i class='fas fa-plus'></i> Tambah Pegawai</a>

    <table class='table table-striped table-bordered'>
        <tr>
            <th class='text-center'>No</th>
            <th class='text-center'>NIK</th>
            <th class='text-center'>Nama Pegawai</th>
            <th class='text-center'>Jenis Kelamin</th>
            <th class='text-center'>Jabatan</th>
            <th class='text-center'>Tanggal Masuk</th>
            <th class='text-center'>Status</th>
            <th class='text-center'>Photo</th>
            <th class='text-center'>Action</th>
        </tr>
        <?php $no=1; foreach($pegawai as $p): ?>
            <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $p->nik ?></td>
            <td><?php echo $p->nama_pegawai ?></td>
            <td><?php echo $p->jenis_kelamin ?></td>
            <td><?php echo $p->jabatan ?></td>
            <td><?php echo $p->tanggal_masuk ?></td>
            <td><?php echo $p->status ?></td>
            <td><img src="<?php echo base_url('assets/img/undraw_profile.svg') ?>" /></td>
            <td>
                <center>
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/DataPegawai/update_data/'.$p->id_pegawai) ?>"><i class="fas fa-edit"></i></a>
                    <a onclick="return confirm('Yakin Hapus')"class="btn btn-sm btn-primary" href="<?php echo base_url('admin/DataPegawai/delete_data/'.$p->id_pegawai) ?>"><i class="fas fa-trash"></i></a>
                </center>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
    
</div>