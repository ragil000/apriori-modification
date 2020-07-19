<?php
    $CI =& get_instance();
    $RMY = $CI->LibraryRMYModel;
?>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                        <form role="form" method="POST" action="<?=base_url()?>admin/post-data-barang">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- <label class="col-form-label" for="inputSuccess"> Kategori </label>  -->
                                        <input type="number" id="kelipatan" class="form-control pl-3" placeholder="Isi dengan kelipatan (1, 2, 3, 4, ...)">
                                    </div>
                                    <div class="col-6">
                                        <a href="" id="link" class="btn btn-primary">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        
                        </form>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Prediksi Barang Paling Laku (kelipatan 7 x <?=$this->uri->segment(3) != null ? $this->uri->segment(3) : 1?>)</h3>
                                </div>                          
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table-barang" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30">No</th>
                                                <th width="200">Nama Barang</th>
                                                <th width="150">Support</th>
                                                <th width="150">Total Terjual</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($result as $data):
                                            ?>
                                            <tr>
                                                <td><?=$no?></td>
                                                <td><?=$data['item']?></td>
                                                <td><?=$data['support']?></td>
                                                <td><?=number_format($data['total'])?></td>
                                            </tr>
                                            <?php
                                                    $no++;
                                                endforeach;
                                            ?>
                                        </tbody>
                                        <tfoot>
                                           
                                        </tfoot>
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
                    $('#kelipatan').on('keyup', function(){
                        let val = $('#kelipatan').val().trim()
                        if(val != null || val != '') {
                            $('#link').attr('href', '<?=base_url('admin/barang-terlaku/')?>'+val)
                        }
                    })
                </script>