<?php
    include "fragment/topTemplate.php";
    include '../../koneksi.php';
    // Jumlah Admin
    $admin = $koneksi->prepare("SELECT COUNT(id) AS jumlah_admin FROM admin");
    $admin->execute();
    $admin_res = $admin->get_result();
    $admin_jumlah = $admin_res->fetch_assoc();
    // Jumlah Event
    $event = $koneksi->prepare("SELECT COUNT(id) AS jumlah_event FROM event");
    $event->execute();
    $event_res = $event->get_result();
    $event_jumlah = $event_res->fetch_assoc();
    // Jumlah Campaign
    $campaign = $koneksi->prepare("SELECT COUNT(id) AS jumlah_campaign FROM campaign");
    $campaign->execute();
    $campaign_res = $campaign->get_result();
    $campaign_jumlah = $campaign_res->fetch_assoc();
    // Jumlah Suggestion
    $suggestion = $koneksi->prepare("SELECT COUNT(id) AS jumlah_suggestion FROM suggestion");
    $suggestion->execute();
    $suggestion_res = $suggestion->get_result();
    $suggestion_jumlah = $suggestion_res->fetch_assoc();
?>

    <h1>Ini Dashboard</h1>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-card">
                    <span>Total Admin</span>
                    <h2><?= $admin_jumlah['jumlah_admin'];?></h2>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-card">
                    <span>Total Event</span>
                    <h2><?= $event_jumlah['jumlah_event'];?></h2>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-card">
                    <span>Total Campaign</span>
                    <h2><?= $campaign_jumlah['jumlah_campaign'];?></h2>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="dashboard-card">
                    <span>Total Saran & Pendapat</span>
                    <h2><?= $suggestion_jumlah['jumlah_suggestion'];?></h2>
                </div>
            </div>
            <div class="col-12 mt-5">
                <canvas id="myChart" width="100%" height="50"></canvas>
            </div>
        </div>
    </div>
    <!-- Datatables -->
    
<?php
    include "fragment/bottomTemplate.php";
?>