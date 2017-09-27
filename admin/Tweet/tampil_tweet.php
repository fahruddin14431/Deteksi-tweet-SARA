<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h3 style="margin-bottom:15px" class="col-deep-orange">
                    <b>DAFTAR TWEET</b>                 
                </h3>
            </div>
            <div class="body" id="table_kata_sara">
                <table class="table table-bordered table-striped table-hover js-exportable dataTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Tweet</th>                            
                            <th>Preprocessing</th>
                            <th>Kata SARA</th>
                            <th>Bobot IDF(W)</th>
                            <th>Bobot VSM</th>
                        </tr>
                    </thead>                    
                    <tbody>
                    <?php 

                    $crud   = new Crud();
                    $sql    = "SELECT * FROM tb_tweet ORDER BY id_tweet DESC";
                    $result = $crud->fetchData($sql);
                    $no     = "1";

                    foreach ($result as $value) { ?>
                    
                        <tr>
                            <td><?= $no++."."; ?></td>
                            <td><?= $value['tweet'];?></td>
                            <td><?= $value['after_preprocessing'];?></td>
                            <td><?= $value['kata_SARA'];?></td>
                            <td><?= $value['W'];?></td>
                            <td><?= $value['VSM']; ?></td>

                        </tr> 
                    <?php } ?>            
                    </tbody>
                </table>
                <?php   if (!empty($result)) { ?>
                    <a href="index.php?p=hapus_tweet" onClick="return confirm('Semua Tweet Akan Dihapus !')" class="btn btn-lg btn-danger waves-effect">HAPUS SEMUA</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>