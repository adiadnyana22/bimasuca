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
        <h1>Saran & Pendapat</h1>
    </div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <?php
                $suggestion = $koneksi->prepare("SELECT * FROM suggestion");
                $suggestion->execute();
                $suggestion_res = $suggestion->get_result();
            ?>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fetch_suggestion = $suggestion_res->fetch_assoc()) { ?>
                <tr>
                    <td><span id="nama<?=$fetch_suggestion['id'];?>"><?=$fetch_suggestion['nama'];?></span></td>
                    <td><span id="email<?=$fetch_suggestion['id'];?>"><?=$fetch_suggestion['email'];?></span></td>
                    <?php
                        $date = $fetch_suggestion['tanggal'];
                        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                        $tanggal_hari = (int)date('d', strtotime($date));
                        $bulan_hari = $month[((int)date('m', strtotime($date))) - 1];
                        $tahun_hari = (int)date('Y', strtotime($date));
                    ?>
                    <td><span id="tanggal<?=$fetch_suggestion['id'];?>"><?=$tanggal_hari.' '.$bulan_hari.' '.$tahun_hari ?></span></td>
                    <span hidden id="isi<?=$fetch_suggestion['id'];?>"><?=$fetch_suggestion['isi'];?></span>
                    <td>
                        <button type="button" class="btn btn-primary detail" value="<?php echo $fetch_suggestion['id']; ?>"><span class="glyphicon glyphicon-detail"></span>Detail</button>
                        <?php if($_SESSION['super'] == '1'){ ?>
                            <a class="btn btn-danger del" data-id="<?=$fetch_suggestion['id'];?>">Hapus</a>
                        <?php } else { ?>

                <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Saran & Pendapat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-2">
                        <b>Nama</b>
                    </div>
                    <div class="col-1">
                        <span>:</span>
                    </div>
                    <div class="col-9">
                        <span id="m_nama">Lorem</span>
                    </div>
                    <div class="col-2">
                        <b>Email</b>
                    </div>
                    <div class="col-1">
                        <span>:</span>
                    </div>
                    <div class="col-9">
                        <span id="m_email">Lorem</span>
                    </div>
                    <div class="col-2">
                        <b>Tanggal</b>
                    </div>
                    <div class="col-1">
                        <span>:</span>
                    </div>
                    <div class="col-9">
                        <span id="m_tanggal">Lorem</span>
                    </div>
                </div>
                <p id="m_isi">
                    Ini Isi
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro libero odio aliquam vitae architecto ex necessitatibus eaque esse qui molestias recusandae voluptatibus non exercitationem totam magnam, autem at nam, nisi veniam? Voluptatum minus perspiciatis veritatis neque, libero vitae eveniet, quod labore ut ratione sint ipsa velit natus fugit consectetur adipisci saepe incidunt? Alias nobis eius ratione, autem et, excepturi maxime saepe animi nisi suscipit harum nihil, quasi atque id? Vitae aspernatur iure sed voluptatum ullam iusto minima magnam totam amet ad, vero esse porro consequuntur dolorum, soluta quo, saepe rerum? Libero in, commodi impedit minus ullam, debitis est adipisci nulla blanditiis quas quis, quos obcaecati! Rerum ad tempora officia distinctio accusamus, ea dicta eaque libero, exercitationem velit quas sit dolorum cupiditate assumenda? Quae odio consequatur expedita commodi repudiandae! Atque, dolorem perspiciatis repudiandae facere esse quasi earum. Similique sapiente, magnam quia animi odit omnis impedit voluptatem aperiam, voluptates itaque quae nulla.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
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
        $('.detail').on('click', function(){
            var id=$(this).val();
            var nama=$('#nama'+id).text();
            var email=$('#email'+id).text();
            var isi=$('#isi'+id).text();
            var tanggal=$('#tanggal'+id).text();
            
            const span_nama = document.getElementById('m_nama');
            const span_email = document.getElementById('m_email');
            const span_tanggal = document.getElementById('m_tanggal');
            const p_isi = document.getElementById('m_isi');

            $('#detailModal').modal('show');
            span_nama.textContent = nama;
            span_email.textContent = email;
            span_tanggal.textContent = tanggal;
            p_isi.textContent = isi;
        });
    });
    </script>
    <script>
        $(document).ready(function(){
            $('.del').on('click', function () {
                id = $(this).data('id');
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
                        window.location.href = '../../controller/route.php?aksi=delete_suggestion&id='+id;
                    }
                });
            })
        });
    </script>
<?php
    include "fragment/bottomTemplate.php";
?>