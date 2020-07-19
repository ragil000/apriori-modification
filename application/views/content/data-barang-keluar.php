<?php
    $CI =& get_instance();
    $RMY = $CI->LibraryRMYModel;
?>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Barang</h3>
                                </div>
                                <div class="card-header">
                                    <!-- <button class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Barang Keluar</button> -->
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div id="accordion">
                                            <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                        Tambah Data Barang Keluar
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse in collapse">
                                                    <div class="card-body">
                                                        
                                                        <div class="col-md-12">
                                                            <!-- general form elements disabled -->
                                                            <div class="card card-warning">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Form Input Barang Keluar</h3>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">
                                                                    <form id="form" role="form" method="POST" action="<?=base_url()?>admin/post-barang-keluar">
                                                                        <!-- input states -->
                                                                        <input type="hidden" id="keluar_id" name="keluar_id">
                                                                        <div class="form-group">
                                                                            <label>Nama Barang</label>
                                                                            <select class="form-control" name="barang_id" id="barang_id">
                                                                                <option value="0">---Pilih Barang---</option>
                                                                                <?php
                                                                                    foreach($resultBarang as $barang):
                                                                                ?>
                                                                                <option value="<?=$barang['barang_id']?>"><?=$barang['barang_nama']?></option>
                                                                                <?php
                                                                                    endforeach;
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-form-label" for="inputSuccess"><i class="fas fa-sort-numeric-up-alt"></i> Jumlah Keluar</label>
                                                                            <input type="text" class="form-control pl-3" id="keluar_jumlah" name="keluar_jumlah" placeholder="0">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-form-label"><i class="far fa-clock"></i> Tanggal Keluar</label>
                                                                            <input type="text" class="form-control datepicker pl-3" id="keluar_tanggal" name="keluar_tanggal" data-provide="datepicker" placeholder="yyy-mm-dd">
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                        <button type="button" id="btn-batal" onclick="window.location.reload()" class="btn btn-danger">Batal</button>
                                                                    </form>
                                                                </div>
                                                                <!-- /.card-body -->
                                                            </div>
                                                            <!-- /.card -->
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                              
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table-barang" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30">No</th>
                                                <th width="200">Nama Barang</th>
                                                <th width="150">Jumlah Terjual</th>
                                                <th>Tanggal</th>
                                                <th class="text-center" width="100">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($result as $data):
                                            ?>
                                            <tr>
                                                <td><?=$no?></td>
                                                <td><?=$data['barang_nama']?></td>
                                                <td><?=$data['keluar_jumlah']?></td>
                                                <td><?=$RMY->_dateIND($data['keluar_tanggal'])?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" onclick="edit(this)" data-id="<?=$data['keluar_id']?>" class="btn btn-success"><i class="fas fa-edit"></i></button>
                                                        <a href="<?=base_url('admin/delete-barang-keluar/').$data['keluar_id']?>" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                                    $no++;
                                                endforeach;
                                            ?>
                                        </tbody>
                                        <!-- <tfoot>
                                           
                                        </tfoot> -->
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->

                <script>
                    $('.btn-delete').click(function(e){
                        e.preventDefault()
                        Swal.fire({
                            title: 'Peringatan!',
                            text: "Anda tidak dapat mengembalikan data.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, tetap hapus!'
                            }).then((result) => {
                            if (result.value) {
                                let link = $(this).attr('href')
                                window.location.href = link
                            }
                        })
                    })

                    $('#btn-batal').hide()
                    function edit(element) {
                        let id = $(element).data('id')
                        $.post("<?=base_url('admin/getDataKeluarById/')?>"+id, function(results){
                            results = JSON.parse(results)
                            let option = '<option value="'+(results[0].barang_id)+'" selected>'+(results[0].barang_nama)+'</option>'
                            $('#collapseOne').addClass(' show')
                            $('#barang_id').append(option)
                            $('#keluar_id').val(results[0].keluar_id)
                            $('#keluar_jumlah').val(results[0].keluar_jumlah)
                            $('#keluar_tanggal').val(results[0].keluar_tanggal)
                        })
                        $('#btn-batal').show()
                        $('#form').attr('action', '<?=base_url()?>admin/edit-barang-keluar')
                    }
                </script>