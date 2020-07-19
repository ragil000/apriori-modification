                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Barang</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                        <div id="accordion">
                                            <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                        Tambah Data Barang
                                                        </a>
                                                    </h4>
                                                </div>
                                             <div id="collapseOne" class="panel-collapse in collapse">
                                            <div class="card-body">
                                                                      
                                            <div class="col-md-12">
                                                            <!-- general form elements disabled -->
                                                            <div class="card card-warning">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Form Input Data Barang</h3>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">
                                                                    <form role="form" id="form" method="POST" action="<?=base_url()?>admin/post-data-barang">
                                                                        <!-- input states -->
                                                                        <input type="hidden" id="barang_id" name="barang_id">
                                                                        <div class="form-group">
                                                                            <label>Nama Barang</label>
                                                                            <input type="text" class="form-control pl-3" id="barang_nama" name="barang_nama" placeholder="Nama Barang">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-form-label" for="inputSuccess"> Kategori </label> 
                                                                            <input type="text" class="form-control pl-3" id="barang_kategori" name="barang_kategori" placeholder="Kategori">
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
                                                        
                                <div class="card-body">
                                    <table id="table-barang" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Harga Barang</th>
                                                <th class="text-center" width="150">Aksi</th>
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
                                                <td><?=$data['barang_kategori']?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" onclick="edit(this)" data-id="<?=$data['barang_id']?>" class="btn btn-success"><i class="fas fa-edit"></i></button>
                                                        <a href="<?=base_url('admin/delete-barang/').$data['barang_id']?>" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                                    $no++;
                                                endforeach;
                                            ?>
                                        </tbody>
                                        <!-- <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Harga Barang</th>
                                                <th class="text-center" width="150">Aksi</th>
                                            </tr>
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
                        $.post("<?=base_url('admin/getDataById/')?>"+id, function(results){
                            results = JSON.parse(results)
                            $('#collapseOne').addClass(' show')
                            $('#barang_id').val(results[0].barang_id)
                            $('#barang_nama').val(results[0].barang_nama)
                            $('#barang_kategori').val(results[0].barang_kategori)
                        })
                        $('#btn-batal').show()
                        $('#form').attr('action', '<?=base_url()?>admin/edit-data-barang')
                    }
                </script>