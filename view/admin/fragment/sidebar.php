<div class="sidebar">
    <nav class="p-3">
        <div class="sidebar-head">
            <h1>Bimasuca</h1>
            <button class="text-danger" id="closeSidebar">X</button>
        </div>
        <ul>
            <li><a href="#"><i class="fas fa-layer-group"></i><span>Category</span></a></li>
            <li><a href="#"><i class="fas fa-box-open"></i><span>Product</span></a></li>
            <li><a href="#"><i class="fas fa-cart-arrow-down"></i><span>Transaction</span></a></li>
            <li><a href="#"><i class="fas fa-user-check"></i><span>User</span></a></li>
        </ul>
        <div class="navbar">
            <div class="user-data">
                <span>Hi, <strong><?php echo $_SESSION['nama'];?></strong></span>
            </div>
        </div>
    </nav>
    <div class="logout p-3">
        <form action="../../controller/route.php?aksi=logout" method="post">
            <button type="submit" id="logout" name="logout" class="text-danger btn btn-transparent" value="logout"><i class="fas fa-angle-left"></i><span>&nbsp;&nbsp;Logout</span></button>
        </form>
    </div>
</div>