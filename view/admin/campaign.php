<?php
    include "fragment/topTemplate.php";
    include '../../koneksi.php';
?>
    <?php
        if(isset($_GET['sukses']) == '1'){             
                echo    "<script type = 'text/javascript'>
                            Swal.fire(
                                'Sukses !',
                                'Berhasil !',
                                'success'
                            )
                        </script>";
        }else if(isset($_GET['gagal']) == '1'){
                echo    "<script type = 'text/javascript'>
                            Swal.fire(
                                'Gagal !',
                                'Silahkan coba kembali',
                                'error'
                            )
                        </script>";
        }
    ?>
    <div class="admin-judul">
        <h1>Campaign</h1>
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Campaign</button>
    </div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <?php
                $campaign = $koneksi->prepare("SELECT * FROM campaign");
                $campaign->execute();
                $campaign_res = $campaign->get_result();
            ?>
            <tr>
                <th>Nama</th>
                <th>Tanggal Post</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($campaign_fetch = $campaign_res->fetch_assoc()) { ?>
                <?php
                    $date = $campaign_fetch['tanggal_post'];
                    $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                    $tanggal_hari = (int)date('d', strtotime($date));
                    $bulan_hari = $month[((int)date('m', strtotime($date))) - 1];
                    $tahun_hari = (int)date('Y', strtotime($date));
                ?>
                <tr>
                    <td><span id="nama_campaign<?=$campaign_fetch['id'];?>"><?=$campaign_fetch['nama_campaign'];?></span></td>
                    <td><span id="tanggal_post<?=$campaign_fetch['id'];?>"><?=$tanggal_hari.' '.$bulan_hari.' '.$tahun_hari ?></span></td>
                    <td>
                        <button type="button" class="btn btn-warning edit" value="<?php echo $campaign_fetch['id']; ?>"><span class="glyphicon glyphicon-edit"></span>Edit</button>
                        <a href="../../controller/route.php?aksi=delete_campaign&id=<?=$campaign_fetch['id'];?>">
                            <button class="btn btn-danger" type="button">Hapus</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Nama</th>
                <th>Tanggal Post</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>

    <!-- Modal Add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Campaign</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingNama" placeholder="Menanam Pohon Bersama">
                        <label for="floatingNama">Nama Event</label>
                    </div>
                    <div class="mb-3">
                        <label for="floatingDeskripsi" class="form-label">Deskripsi</label>
                        <textarea name="" id="floatingDeskripsi" class="form-control" placeholder="Ini adalah acara tahunan dari Binus@Malang ..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="floatingGambar">
                    </div>
                    <hr class="mt-3">
                    <div class="flex-right my-1">
                        <button class="btn btn-primary">Add New Campaign</button>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Campaign</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="m_namacampaign" placeholder="Menanam Pohon Bersama">
                        <label for="floatingNama">Nama Event</label>
                    </div>
                    <div class="mb-3">
                        <label for="floatingDeskripsi" class="form-label">Deskripsi</label>
                        <textarea name="" id="m_deskripsi" class="form-control" placeholder="Ini adalah acara tahunan dari Binus@Malang ..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Lama</label>
                        <a href = "../../assets/upload_images/campaign/" target="_blank" id="m_gambar">
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Baru</label>
                        <a href = "../../assets/upload_images/campaign/" target="_blank" id="upload_gambar">
                    </div>
                    <hr class="mt-3">
                    <div class="flex-right my-1">
                        <button class="btn btn-primary">Add New Campaign</button>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "url": "../../assets/plugin/datatable/indonesia.json"
                }
            });
        } );
    </script>
    <script>
       $(document).ready(function(){
        $('.edit').on('click', function(){
            var id=$(this).val();
            var nama_campaign=$('#nama'+id).text();
            var tanggal_post=$('#email'+id).text();
            var deskripsi=$('#super'+id).text();
            
            
            $('#editModal').modal('show');
            $('#m_nama').val(nama);
            $('#m_email').val(email);
            $('#m_super').val(supers);
        });
    });
    </script>
<?php
    include "fragment/bottomTemplate.php";
?>