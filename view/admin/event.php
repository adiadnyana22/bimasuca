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
        <h1>Event</h1>
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Event</button>
    </div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <?php
                $event = $koneksi->prepare("SELECT event.id, nama_event, tempat, tanggal_post, tanggal, deskripsi, gambar, kategori.kategori AS nama_kategori, event.kategori AS id_kategori FROM event INNER JOIN kategori ON event.kategori = kategori.id");
                $event->execute();
                $event_res = $event->get_result();
            ?>
            <tr>
                <th>Nama</th>
                <th>Tempat</th>
                <th>Kategori</th>
                <th>Tanggal Post</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($event_fetch = $event_res->fetch_assoc()) { ?>
                <?php
                    // Tanggal Post
                    $date = $event_fetch['tanggal_post'];
                    $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                    $tanggal_hari = (int)date('d', strtotime($date));
                    $bulan_hari = $month[((int)date('m', strtotime($date))) - 1];
                    $tahun_hari = (int)date('Y', strtotime($date));
                    // Tanggal Event
                    $date_event = $event_fetch['tanggal'];
                    $month_event = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                    $tanggal_hari_event = (int)date('d', strtotime($date_event));
                    $bulan_hari_event = $month_event[((int)date('m', strtotime($date_event))) - 1];
                    $tahun_hari_event = (int)date('Y', strtotime($date_event));
                ?>
                <tr>
                    <td><span id="nama_event<?=$event_fetch['id'];?>"><?=$event_fetch['nama_event'];?></span></td>
                    <span hidden id="tempat<?=$event_fetch['id'];?>"><?=$event_fetch['tempat'];?></span>
                    <td><span id="tanggal<?=$event_fetch['id'];?>"><?=$tanggal_hari_event.' '.$bulan_hari_event.' '.$tahun_hari_event ?></span></td>
                    <td><span id="kategori<?=$event_fetch['id'];?>"><?=$event_fetch['nama_kategori'];?></span></td>
                    <td><span id="tanggal_post<?=$event_fetch['id'];?>"><?=$tanggal_hari.' '.$bulan_hari.' '.$tahun_hari ?></span></td>
                    <span hidden id="deskripsi<?= $event_fetch['id'];?>"><?= $event_fetch['deskripsi'];?></span>
                    <td>
                        <button type="button" class="btn btn-warning edit" value="<?php echo $event_fetch['id']; ?>"><span class="glyphicon glyphicon-edit"></span>Edit</button>
                        <a class="btn btn-danger del" data-gambar="<?=$event_fetch['gambar'];?>" data-id="<?=$event_fetch['id'];?>">Hapus</a>
                        <a href="../detailEvent.php?id=<?=$event_fetch['id'];?>" class="btn btn-primary" target="_blank">Detail</a>
                    </td>
                    <span hidden id="gambar<?=$event_fetch['id'];?>"><?=$event_fetch['gambar'];?></span>
                    <span hidden id="id_kategori<?=$event_fetch['id'];?>"><?=$event_fetch['id_kategori'];?></span>
                    <span hidden id="tanggal_asli<?=$event_fetch['id'];?>"><?=$event_fetch['tanggal'];?></span>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Nama</th>
                <th>Tempat</th>
                <th>Kategori</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../controller/route.php?aksi=add_event" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingNama" name="floatingNama" placeholder="Menanam Pohon Bersama" maxlength="30">
                        <label for="floatingNama">Nama Event</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingTempat" name="floatingTempat" placeholder="Binus@Malang" maxlength="50">
                        <label for="floatingTempat">Tempat</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="m_deskripsi" id="m_deskripsi" placeholder="Apa aje dah"></textarea>
                        <label for="floatingDeskripsi">Deskripsi</label>
                    </div>
                    <div class="mb-3">
                        <label for="floatingTanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="floatingTanggal" name="floatingTanggal">
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control add-image" id="files[]" name="files[]" accept="image/*">
                        <div class="text-danger" id="add-feedback" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 2mb)</div>
                    </div>
                    <div class="mb-3">
                        <?php
                            $kategori = $koneksi->prepare("SELECT * FROM kategori");
                            $kategori->execute();
                            $kategori_res = $kategori->get_result();
                        ?>
                        <label for="floatingKategori" class="form-label">Kategori</label>
                        <select class="form-select" aria-label="Default select example" id="floatingKategori" name="floatingKategori">
                            <?php while($kategori_fetch = $kategori_res->fetch_assoc()) { ?>
                                <option value="<?php echo $kategori_fetch['id'];?>"><?php echo $kategori_fetch['kategori'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <hr class="mt-3">
                    <div class="flex-right my-1">
                        <button type="submit" class="btn btn-primary" id="add-btn">Tambah Event</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../controller/route.php?aksi=update_event" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="m_nama_edit" name="m_nama_edit" placeholder="Menanam Pohon Bersama" maxlength="30">
                        <label for="floatingNama">Nama Event</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="m_tempat_edit" name="m_tempat_edit" placeholder="Binus@Malang" maxlength="50">
                        <label for="floatingTempat">Tempat</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="ubah_desc" id="ubah_desc" class="form-control" placeholder="Apa aje dah"></textarea>
                        <label for="floatingDeskripsi">Deskripsi</label>
                    </div>
                    <div class="mb-3">
                        <label for="floatingTanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="m_tanggal" name="m_tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Lama : </label>
                        <a class="btn btn-primary" href = "../../assets/upload_images/event/" target="_blank" id="edit_gambar_l">Preview</a>
                        <input type="hidden" id="m_gambar_lama" name="m_gambar_lama">
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control edit-image" id="files[]" name="files[]" accept="image/*">
                        <div class="text-danger" id="edit-feedback" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 2mb)</div>
                    </div>
                    <div class="mb-3">
                        <?php
                            $kategori = $koneksi->prepare("SELECT * FROM kategori");
                            $kategori->execute();
                            $kategori_res = $kategori->get_result();
                        ?>
                        <label for="floatingKategori" class="form-label">Kategori</label>
                        <select class="form-select" aria-label="Default select example" id="m_kategori" name="m_kategori">
                            <?php while($kategori_fetch = $kategori_res->fetch_assoc()) { ?>
                                <option value="<?php echo $kategori_fetch['id'];?>"><?php echo $kategori_fetch['kategori'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="hidden" id="m_id" name="m_id">
                    <hr class="mt-3">
                    <div class="flex-right my-1">
                        <button type="submit" class="btn btn-primary" id="edit-btn">Edit Event</button>
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
            } else if(this.files[0].size > 2097152) {
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
            } else if(this.files[0].size > 2 * 1024 * 1024) {
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
    <!-- Script edit -->
    <script>
       $(document).ready(function(){
        // Prevent Bootstrap dialog from blocking focusin
        document.addEventListener('focusin', (e) => {
        if (e.target.closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
            e.stopImmediatePropagation();
        }
        });

        tinymce.init({
            selector: '#ubah_desc',
            language: 'id',
            plugins: 'a11ychecker code advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table tableofcontents',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            forced_root_block : 'div',
            setup: function (editor) {
            editor.on('init', function (e) {
                editor.setContent('Helo');
            });
            }
        });
        $('.edit').on('click', function(){
            var id=$(this).val();
            var nama_event=$('#nama_event'+id).text();
            var tempat=$('#tempat'+id).text();
            var deskripsi=$('#deskripsi'+id).html();
            var tanggal=$('#tanggal_asli'+id).text();
            var gambar_l=$('#gambar'+id).text();
            var kategori_val=$('#id_kategori'+id).text();
            
            tinymce.get("ubah_desc").setContent(deskripsi);

            const edit_pic = document.getElementById('edit_gambar_l');
            const edit_tgl = document.getElementById('m_tanggal');
            
            $('#editModal').modal('show');
            $('#m_nama_edit').val(nama_event);
            $('#m_tempat_edit').val(tempat);
            
            $('#m_tanggal').val(tanggal);
            $('#m_gambar_lama').val(gambar_l);
            edit_pic.href='../../assets/upload_images/event/'+gambar_l;
            $('#m_kategori').val(kategori_val);
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
                        window.location.href = '../../controller/route.php?aksi=delete_event&id='+id+'&gambar='+gambar;
                    }
                });
            })
        });
    </script>
    <!-- TinyMCE -->
    <script>
        tinymce.init({
            selector: '#m_deskripsi',
            language: 'id',
            plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table tableofcontents',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>
<?php
    include "fragment/bottomTemplate.php";
?>