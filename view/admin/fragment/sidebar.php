<div class="sidebar">
    <nav class="p-3">
        <div class="sidebar-head">
            <h1>Bimasuca</h1>
            <button class="text-danger" id="closeSidebar">X</button>
        </div>
        <ul>
            <li><a href="#"><i class="fas fa-layer-group"></i><span>Dashboard</span></a></li>
            <li><a href="#"><i class="fas fa-calendar"></i><span>Event</span></a></li>
            <li><a href="#"><i class="fas fa-images"></i><span>Campaign</span></a></li>
            <li><a href="#"><i class="fas fa-comment"></i><span>Suggestion</span></a></li>
            <li><a href="#"><i class="fas fa-user-check"></i><span>Admin</span></a></li>
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