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
        <div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCategory">Konfigurasi Kategori</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Event</button>
        </div>
    </div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <?php
                $event = $koneksi->prepare("SELECT event.id, ident, nama_event, tempat, tanggal_post, 
                tanggal, deskripsi, gambar_cover, kategori.kategori AS nama_kategori, 
                event.kategori AS id_kategori FROM event 
                INNER JOIN kategori ON event.kategori = kategori.id");
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
                    <td><span  id="tempat<?=$event_fetch['id'];?>"><?=$event_fetch['tempat'];?></span></td>
                    <span hidden id="tanggal<?=$event_fetch['id'];?>"><?=$tanggal_hari_event.' '.$bulan_hari_event.' '.$tahun_hari_event ?></span>
                    <td><span id="kategori<?=$event_fetch['id'];?>"><?=$event_fetch['nama_kategori'];?></span></td>
                    <td><span id="tanggal_post<?=$event_fetch['id'];?>"><?=$tanggal_hari.' '.$bulan_hari.' '.$tahun_hari ?></span></td>
                    <span hidden id="deskripsi<?= $event_fetch['id'];?>"><?= $event_fetch['deskripsi'];?></span>
                    <td>
                        <button type="button" class="btn btn-warning edit" value="<?php echo $event_fetch['id']; ?>"><span class="glyphicon glyphicon-edit"></span>Edit</button>
                        <a class="btn btn-danger del" data-gambar="<?=$event_fetch['gambar_cover'];?>" data-id="<?=$event_fetch['id'];?>" data-ident="<?=$event_fetch['ident'];?>">Hapus</a>
                        <a href="../detailEvent.php?id=<?=$event_fetch['id'];?>" class="btn btn-primary" target="_blank">Detail</a>
                    </td>
                    <span hidden id="gambar<?=$event_fetch['id'];?>"><?=$event_fetch['gambar_cover'];?></span>
                    <span hidden id="id_kategori<?=$event_fetch['id'];?>"><?=$event_fetch['id_kategori'];?></span>
                    <span hidden id="tanggal_asli<?=$event_fetch['id'];?>"><?=$event_fetch['tanggal'];?></span>
                    <span hidden id="ident<?=$event_fetch['id'];?>"><?=$event_fetch['ident'];?></span>
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

    <!-- Modal Category Table -->
    <div class="modal fade" id="exampleModalCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfigurasi Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="admin-judul">
                        <h2>Kategori Event</h2>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2">Tambah Kategori</button>
                    </div>
                    <table id="example2" class="table table-striped" style="width:100%">
                        <thead>
                            <?php
                                $kategori = $koneksi->prepare("SELECT * FROM kategori");
                                $kategori->execute();
                                $kategori_res = $kategori->get_result();
                            ?>
                            <tr>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($kategori_fetch = $kategori_res->fetch_assoc()) { ?>
                                <tr>
                                    <td><span id="kategori_<?=$kategori_fetch['id'];?>"><?=$kategori_fetch['kategori'];?></span></td>
                                    <td>
                                        <button type="button" class="btn btn-warning edit-category" value="<?php echo $kategori_fetch['id']; ?>"><span class="glyphicon glyphicon-edit"></span>Edit</button>
                                        <a class="btn btn-danger del" data-id="<?= $kategori_fetch['id'];?>">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add (Category) -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controller/route.php?aksi=add_kategori" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingKategori" name="floatingKategori" placeholder="Menanam Pohon Bersama" maxlength="30">
                            <label for="floatingKategori">Nama Kategori</label>
                        </div>
                        <hr class="mt-3">
                        <div class="flex-right my-1">
                            <button type="button" class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#exampleModalCategory">Kembali</button>
                            <button type="submit" class="btn btn-primary" id="add-btn">Tambah Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit (Category) -->
    <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controller/route.php?aksi=edit_kategori" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingKategoriEdit" name="floatingKategori" placeholder="Menanam Pohon Bersama" maxlength="30">
                            <label for="floatingKategoriEdit">Nama Kategori</label>
                        </div>
                        <hr class="mt-3">
                        <input type="hidden" id="m_id_category" name="m_id_category">
                        <div class="flex-right my-1">
                            <button type="button" class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#exampleModalCategory">Kembali</button>
                            <button type="submit" class="btn btn-primary" id="add-btn">Edit Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add (Event) -->
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
                        <label for="floatingGambar" class="form-label">Gambar Cover</label>
                        <input type="file" class="form-control add-image-cover" id="files[]" name="files[]" accept="image/*">
                        <div class="text-danger" id="add-feedback-cover" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 2mb)</div>
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Carousel 1 (Opsional)</label>
                        <input type="file" class="form-control add-image1" id="carousels[]" name="carousels[]" accept="image/*">
                        <div class="text-danger" id="add-feedback1" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 2mb)</div>
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Carousel 2 (Opsional)</label>
                        <input type="file" class="form-control add-image2" id="carousels[]" name="carousels[]" accept="image/*">
                        <div class="text-danger" id="add-feedback2" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 2mb)</div>
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Carousel 3 (Opsional)</label>
                        <input type="file" class="form-control add-image3" id="carousels[]" name="carousels[]" accept="image/*">
                        <div class="text-danger" id="add-feedback3" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 2mb)</div>
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

    <!-- Modal Edit (Event) -->
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
                        <label for="floatingGambar" class="form-label">Gambar Cover Lama : </label>
                        <a class="btn btn-primary" href = "../../assets/upload_images/event/" target="_blank" id="edit_gambar_l">Preview</a>
                        <input type="hidden" id="m_gambar_lama" name="m_gambar_lama">
                    </div>
                    <div id="target"></div>
                    <!-- Sampe Sni -->
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Cover : </label>
                        <input type="file" class="form-control edit-image-cover" id="files[]" name="files[]" accept="image/*">
                        <div class="text-danger" id="edit-feedback-cover" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 2mb)</div>
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Carousel 1 (Opsional)</label>
                        <input type="file" class="form-control edit-image1" id="carousels[]" name="carousels[]" accept="image/*">
                        <div class="text-danger" id="edit-feedback1" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 2mb)</div>
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Carousel 2 (Opsional)</label>
                        <input type="file" class="form-control edit-image2" id="carousels[]" name="carousels[]" accept="image/*">
                        <div class="text-danger" id="edit-feedback2" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 2mb)</div>
                    </div>
                    <div class="mb-3">
                        <label for="floatingGambar" class="form-label">Gambar Carousel 3 (Opsional)</label>
                        <input type="file" class="form-control edit-image3" id="carousels[]" name="carousels[]" accept="image/*">
                        <div class="text-danger" id="edit-feedback3" style="display: none">Ukuran File Terlalu Besar (Ukuran file maksimal 2mb)</div>
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
        $(".edit-image-cover").change(function() {
            if(!this.files[0]) {
                $("#edit-feedback-cover").hide();
            } else if(this.files[0].size > 2097152) {
                $("#edit-feedback-cover").show();
            } else {
                $("#edit-feedback-cover").hide();
            }
        })

        $(".edit-image1").change(function() {
            if(!this.files[0]) {
                $("#edit-feedback1").hide();
            } else if(this.files[0].size > 2 * 1024 * 1024) {
                $("#edit-feedback1").show();
            } else {
                $("#edit-feedback1").hide();
            }
        })

        $(".edit-image2").change(function() {
            if(!this.files[0]) {
                $("#edit-feedback2").hide();
            } else if(this.files[0].size > 2 * 1024 * 1024) {
                $("#edit-feedback2").show();
            } else {
                $("#edit-feedback2").hide();
            }
        })

        $(".edit-image3").change(function() {
            if(!this.files[0]) {
                $("#edit-feedback3").hide();
            } else if(this.files[0].size > 2 * 1024 * 1024) {
                $("#edit-feedback3").show();
            } else {
                $("#edit-feedback3").hide();
            }
        })

        $("button.edit").click(() => {
            $("#edit-feedback-cover").hide();
            $("#edit-feedback1").hide();
            $("#edit-feedback2").hide();
            $("#edit-feedback3").hide();
            $(".edit-image-cover").val(null);
            $(".edit-image1").val(null);
            $(".edit-image2").val(null);
            $(".edit-image3").val(null);
        })

        $(".add-image-cover").change(function() {
            if(!this.files[0]) {
                $("#add-feedback-cover").hide();
            } else if(this.files[0].size > 2 * 1024 * 1024) {
                $("#add-feedback-cover").show();
            } else {
                $("#add-feedback-cover").hide();
            }
        })

        $(".add-image1").change(function() {
            if(!this.files[0]) {
                $("#add-feedback1").hide();
            } else if(this.files[0].size > 2 * 1024 * 1024) {
                $("#add-feedback1").show();
            } else {
                $("#add-feedback1").hide();
            }
        })

        $(".add-image2").change(function() {
            if(!this.files[0]) {
                $("#add-feedback2").hide();
            } else if(this.files[0].size > 2 * 1024 * 1024) {
                $("#add-feedback2").show();
            } else {
                $("#add-feedback2").hide();
            }
        })

        $(".add-image3").change(function() {
            if(!this.files[0]) {
                $("#add-feedback3").hide();
            } else if(this.files[0].size > 2 * 1024 * 1024) {
                $("#add-feedback3").show();
            } else {
                $("#add-feedback3").hide();
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

            $('#example2').DataTable({
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
            var ident = $('#ident'+id).text();

            $.ajax({
                type: "GET",
                url: `getimage.php?id=${ident}`,
                success: function(data){
                    let dataHasil = data.substring(1, data.length - 2).split(",");
                    dataHasil = dataHasil.map((h) => {
                        return h.substring(1, h.length);
                    })
                    console.log(data);
                    console.log(dataHasil);
                    let counter = 1;
                    let tumbal = "";
                    dataHasil.forEach((el) => {
                        tumbal += `<div class="mb-3">
                                        <label for="floatingGambar" class="form-label">Gambar Carousel ${counter} Lama : </label>
                                        <a class="btn btn-primary" href = "../../assets/upload_images/event/carousel/${el}" target="_blank" id="edit_gambar_l">Preview</a>
                                        <input type="hidden" id="m_gambar_lama${counter} name="m_gambar_lama${counter}">
                                    </div>`;
                        counter++;
                    })
                    $("#target").html(tumbal)
                }
            });
            
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

        $('.edit-category').on('click', function(){
            var id=$(this).val();
            var nama_kategori=$('#kategori_'+id).text();
            
            $('#editKategoriModal').modal('show');
            $('#exampleModalCategory').modal('hide');
            $('#floatingKategoriEdit').val(nama_kategori);
            $('#m_id_category').val(id);
        });
    });
    </script>
    <!-- Script delete -->
    <script>
        $(document).ready(function(){
            $('.del').on('click', function () {
                id = $(this).data('id');
                gambar = $(this).data('gambar');
                ident = $(this).data('ident');
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
                        window.location.href = '../../controller/route.php?aksi=delete_event&id='+id+'&gambar='+gambar+'&ident='+ident;
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