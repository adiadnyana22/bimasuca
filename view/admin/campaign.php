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
                        <a class="btn btn-danger del" data-gambar="<?=$campaign_fetch['gambar'];?>" data-id="<?=$campaign_fetch['id'];?>">Hapus</a>
                        <button type="button" class="btn btn-primary detail" value="<?php echo $campaign_fetch['id']; ?>"><span class="glyphicon glyphicon-detail"></span>Detail</button>
                    </td>
                    <span hidden id="deskripsi<?=$campaign_fetch['id'];?>"><?=$campaign_fetch['deskripsi'];?></span>
                    <span hidden id="gambar<?=$campaign_fetch['id'];?>"><?=$campaign_fetch['gambar'];?></span>
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

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="m_nama_campaign">Nama Campaign</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="../../assets/upload_images/campaign/kertas.png" alt="" class="w-100 mb-3" id="m_gambar">
                <p id="m_deskripsi">
                    Ini Deskripsi
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aperiam nihil in ducimus laudantium incidunt officiis beatae iure adipisci! Veniam, explicabo dignissimos. Vitae exercitationem laborum vel adipisci esse labore quam dolorum! Blanditiis ducimus amet at fuga nam, nobis id animi? Quam dolores nemo deserunt recusandae dolor beatae consequuntur, cum modi odio.
                </p>
                <p>
                    Tanggal Post : <span id="m_tanggal_post">24/11/2001</span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal Add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Campaign</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../controller/route.php?aksi=add_campaign" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama_campaign" name="nama_campaign" placeholder="Menanam Pohon Bersama" maxlength="25">
                        <label for="floatingNama">Nama Event</label>
                    </div>
                    <div class="mb-3">
                        <label for="floatingDeskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Ini adalah acara tahunan dari Binus@Malang ..." maxlength="150"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control add-image" id="files[]" name="files[]" accept="image/*">
                        <div class="text-danger" id="add-feedback" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 5mb)</div>
                    </div>
                    <hr class="mt-3">
                    <div class="flex-right my-1">
                        <button type="submit" class="btn btn-primary" id="add-btn">Tambah Campaign</button>
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
                <form action="../../controller/route.php?aksi=update_campaign" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_namacampaign" name="edit_namacampaign" placeholder="Menanam Pohon Bersama" maxlength="25">
                        <label for="floatingNama">Nama Campaign</label>
                    </div>
                    <div class="mb-3">
                        <label for="floatingDeskripsi" class="form-label">Deskripsi</label>
                        <textarea name="edit_deskripsi" id="edit_deskripsi" class="form-control" placeholder="Ini adalah acara tahunan dari Binus@Malang ..." maxlength="150"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Lama : </label>
                        <a class="btn btn-primary" href = "../../assets/upload_images/campaign/" target="_blank" id="edit_gambar_l">Preview</a>
                        <input type="hidden" id="m_gambar_lama" name="m_gambar_lama">
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Baru</label>
                        <input type="file" class="form-control edit-image" id="files[]" name="files[]" accept="image/*">
                        <div class="text-danger" id="edit-feedback" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 5mb)</div>
                    </div>
                    <input type="hidden" id="m_id" name="m_id">
                    <hr class="mt-3">
                    <div class="flex-right my-1">
                        <button class="btn btn-primary" id="edit-btn">Edit Campaign</button>
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
        $(".edit-image").change(function() {
            if(!this.files[0]) {
                $("#edit-btn").prop("disabled", false);
                $("#edit-feedback").hide();
            } else if(this.files[0].size > 5 * 1024 * 1024) {
                $("#edit-feedback").show();
                $("#edit-btn").prop("disabled", true);
            } else {
                $("#edit-feedback").hide();
                $("#edit-btn").prop("disabled", false);
            }
        })

        $("button.edit").click(() => {
            $("#edit-feedback").hide();
            $("#edit-btn").prop("disabled", false);
            $(".edit-image").val(null)
        })

        $(".add-image").change(function() {
            if(!this.files[0]) {
                $("#add-btn").prop("disabled", false);
                $("#add-feedback").hide();
            } else if(this.files[0].size > 2097152) {
                $("#add-feedback").show();
                $("#add-btn").prop("disabled", true);
            } else {
                $("#add-feedback").hide();
                $("#add-btn").prop("disabled", false);
            }
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "url": "../../assets/plugin/datatable/indonesia.json"
                }
            });
        } );
    </script>
    <!-- Scipt detail -->
    <script>
       $(document).ready(function(){
        $('.detail').on('click', function(){
            var id=$(this).val();
            var nama_campaign=$('#nama_campaign'+id).text();
            var tanggal_post=$('#tanggal_post'+id).text();
            var deskripsi=$('#deskripsi'+id).text();
            var gambar=$('#gambar'+id).text();
            
            const nama_cpgn = document.getElementById('m_nama_campaign');
            const tgl_post = document.getElementById('m_tanggal_post');
            const desc = document.getElementById('m_deskripsi');
            const pic = document.getElementById('m_gambar');
            
            $('#detailModal').modal('show');
            nama_cpgn.textContent = nama_campaign;
            tgl_post.textContent = tanggal_post;
            desc.textContent = deskripsi;
            pic.src='../../assets/upload_images/campaign/'+gambar;

        });
    });
    </script>
    <!-- Script edit -->
    <script>
       $(document).ready(function(){
        $('.edit').on('click', function(){
            var id=$(this).val();
            var nama_campaign2=$('#nama_campaign'+id).text();
            var deskripsi2=$('#deskripsi'+id).text();
            var gambar2=$('#gambar'+id).text();
            
            const edit_cpgn = document.getElementById('edit_namacampaign');
            const edit_desc = document.getElementById('edit_deskripsi');
            const edit_pic = document.getElementById('edit_gambar_l');
            
            $('#editModal').modal('show');
            $('#edit_namacampaign').val(nama_campaign2);
            edit_desc.textContent = deskripsi2;
            $('#m_gambar_lama').val(gambar2);
            edit_pic.href='../../assets/upload_images/campaign/'+gambar2;
            $('#m_id').val(id);
        });
    });
    </script>
    <!-- Script delete -->
    <script>
        $(document).ready(function(){
            $('.del').on('click', function () {
                id = $(this).data('id');
                gambar = $(this).data('gambar');
                Swal.fire({
                    title: "Anda yakin ?",
                    text: "Apa anda yakin ingin menghapus data ini ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        window.location.href = '../../controller/route.php?aksi=delete_campaign&id='+id+'&gambar='+gambar;
                    }
                });
            })
        });
    </script>
<?php
    include "fragment/bottomTemplate.php";
?>