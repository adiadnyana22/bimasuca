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
        <h1>Admin</h1>
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Admin</button>
    </div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Super Admin</th>
                <?php if($_SESSION['super'] == '1'){ ?>
                    <th>Aksi</th>
                <?php } else { ?>

                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php 
                $admin = $koneksi->prepare("SELECT * FROM admin");
                $admin->execute();
                $admin_res = $admin->get_result();
            ?>
            <?php while($fetch_admin = $admin_res->fetch_assoc()) {?>
            <tr>
                <td><span id="nama<?=$fetch_admin['id'];?>"><?=$fetch_admin['nama'];?></span></td>
                <td><span id="email<?=$fetch_admin['id'];?>"><?=$fetch_admin['email'];?></span></td>
                <td>
                    <span id="super<?=$fetch_admin['id'];?>">
                        <?php if($fetch_admin['super'] == '1'){?>
                            <?php echo 'Ya' ?>
                        <?php } else { ?>
                            <?php echo 'Tidak' ?>
                        <?php } ?>
                    </span>
                </td>
                <?php if($_SESSION['super'] == '1'){ ?>
                    <td>
                        <button type="button" class="btn btn-warning edit" value="<?php echo $fetch_admin['id']; ?>"><span class="glyphicon glyphicon-edit"></span>Edit</button>
                        <a class="btn btn-danger del" data-id="<?=$fetch_admin['id'];?>">Hapus</a>
                    </td>
                <?php } else { ?>

                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Super Admin</th>
                <?php if($_SESSION['super'] == '1'){ ?>
                    <th>Aksi</th>
                <?php } else { ?>

                <?php } ?>
            </tr>
        </tfoot>
    </table>

    <!-- Modal Add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../controller/route.php?aksi=add_user" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingNama" name="floatingNama" placeholder="Hanustavira Guru">
                        <label for="floatingNama">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingEmail" name="floatingEmail" placeholder="hanpir@gmail.com">
                        <label for="floatingEmail">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" name="floatingPassword" placeholder="apahayo123">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" id="floatingSuper" name="floatingSuper">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                        <label for="floatingSuper">Super Admin ?</label>
                    </div>
                    <hr class="mt-3">
                    <div class="flex-right my-1">
                        <button class="btn btn-primary">Tambah Admin</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../../controller/route.php?aksi=update_user" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="m_nama" name="m_nama" placeholder="Hanustavira Guru">
                        <label for="floatingNama">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="m_email" name="m_email" placeholder="hanpir@gmail.com">
                        <label for="floatingEmail">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="m_password" name="m_password" placeholder="apahayo123">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" id="m_super" name="m_super">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                        <label for="floatingSuper">Super Admin ?</label>
                    </div>
                    <input type="hidden" id="m_id" name="m_id">
                    <hr class="mt-3">
                    <div class="flex-right my-1">
                        <button class="btn btn-primary">Edit Admin</button>
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
    <!-- Edit -->
    <script>
       $(document).ready(function(){
        $('.edit').on('click', function(){
            var id=$(this).val();
            var nama=$('#nama'+id).text();
            var email=$('#email'+id).text();
            var supers=$('#super'+id).text();
            
            $('#editModal').modal('show');
            $('#m_nama').val(nama);
            $('#m_email').val(email);
            $('#m_super').val(supers);
            $('#m_id').val(id);
        });
    });
    </script>
    <!-- Delete -->
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
                        window.location.href = '../../controller/route.php?aksi=delete_user&id='+id;
                    }
                });
            })
        });
    </script>
<?php
    include "fragment/bottomTemplate.php";
?>