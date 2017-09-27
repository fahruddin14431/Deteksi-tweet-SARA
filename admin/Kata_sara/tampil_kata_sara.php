<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h3 style="margin-bottom:15px" class="col-deep-orange">
                    <b>DAFTAR KATA SARA</b>                 
                </h3>
                <button type="button" name="modal_tambah1" id="modal_tambah2" data-toggle="modal" data-target="#dataModal" class="btn btn-success waves-effect">
                    TAMBAH
                </button>
            </div>
            <div class="body" id="table_kata_sara">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Kata Sara</th>
                            <th>Status</th>
                            <th>IDF</th>
                            <th>VSM_KK</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>                    
                    <tbody>
                    <?php 

                    $crud   = new Crud();
                    $sql    = "SELECT * FROM tb_kata_sara";
                    $result = $crud->fetchData($sql);
                    $no     = "1";

                    foreach ($result as $value) {

                    ?>
                        <tr>
                            <td><?= $no++."."; ?></td>
                            <td><?= $value['kata_sara']; ?></td>
                            <td>
                                <span class="label <?= $value['status']=='Y'?'bg-green':'bg-red' ?>">
                                    <?= $value['status']=='Y'?"YA":"TIDAK" ?>                                        
                                </span>                                    
                            </td>
                            <td><?= $value['IDF']; ?></td>
                            <td><?= $value['VSM_KK']; ?></td>
                            <td>
                                <a onclick="return confirm('Kata <?= $value['kata_sara'] ?> akan Dihapus ?')" href="index.php?p=kata_sara&id_kata_sara=<?= $value['id_kata_sara']; ?>" class="btn bg-red waves-effect">HAPUS</a>
                            </td>
                        </tr> 
                    <?php } ?>            
                    </tbody>
                </table>
                <?php if (!empty($result)) { ?>
                    <a href="index.php?p=kata_sara&hapus_kata_sara" onclick="return confirm('Semua kata SARA selain kata kunci akan Dihapus !')" class="btn btn-lg btn-danger waves-effect">HAPUS SEMUA</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php 

// hapus kata sara 
@$id = $_GET['id_kata_sara'];
if (isset($id)) {
    $res = $crud->deleteDatas("tb_kata_sara","id_kata_sara = ".$id);
    if ($res) {
       echo "<script> location.replace('index.php?p=kata_sara'); </script>";
    }
}

// hapus semua kata sara where N
@$del_all_kata_sara = $_GET['hapus_kata_sara'];
if (isset($del_all_kata_sara)) {
    $res = $crud->deleteDatas("tb_kata_sara", "status='N'");
    if ($res) {
       echo "<script> location.replace('index.php?p=kata_sara'); </script>";
    }
}


 ?>

<!-- modal -->
<div id="dataModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>TAMBAH KATA SARA</h4>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_tambah_kata_sara">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Kata SARA</label>
                            <input type="text" name="kata_sara1" id="kata_sara2" placeholder="Kata SARA" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label>Status</label>
                            <select name="status1" id="status2" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Y">Y</option>
                                <option value="N">N</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" name="submit_kata_sara1" id="submit_kata_sara2" value="SIMPAN" class="btn btn-success waves-effect"/>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">BATAL</button>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>            
    </div>    
</div>


<script type="text/javascript">
$(document).ready(function(){
    
    $('#form_tambah_kata_sara').on('submit', function(){
        
        var kata_sara = $('#kata_sara2').val();
        var status = $('#status2').val();

        $.ajax({
            url:"Kata_sara/tambah_kata_sara.php",
            type:"POST",
            data:"kata_sara="+kata_sara+"&status="+status,
            success:function(data){
                // $('#table_kata_sara').load("index.php?p=kata_sara");
                console.log("sukses "+data);
            },
            error:function(data){
                // $('#table_kata_sara').load("index.php?p=kata_sara");
                console.log("error "+data);
            }
        });  

    }); 
}); 
</script>