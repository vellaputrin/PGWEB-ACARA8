<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kecamatan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 30%, #DEDBD2 60%, #B0C4B1 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(237, 175, 184, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(176, 196, 177, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(247, 225, 215, 0.3) 0%, transparent 50%);
            z-index: 0;
            animation: moveBackground 20s ease-in-out infinite;
        }
        
        @keyframes moveBackground {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(50px, 30px); }
        }
        
        .container {
            display: flex;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }
        
        /* Sidebar */
        .sidebar {
            width: 80px;
            background: rgba(74, 87, 89, 0.85);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(176, 196, 177, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            transition: all 0.3s ease;
        }
        
        .sidebar.expanded {
            width: 280px;
        }
        
        .logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(74, 87, 89, 0.3);
        }
        
        .logo i {
            font-size: 24px;
            color: #4A5759;
        }
        
        .menu-items {
            flex: 1;
            width: 100%;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }
        
        .menu-item:hover {
            background: rgba(176, 196, 177, 0.3);
        }
        
        .menu-item.active {
            background: rgba(237, 175, 184, 0.4);
        }
        
        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 4px;
            height: 100%;
            background: #EDAFB8;
        }
        
        .menu-item i {
            font-size: 20px;
            min-width: 40px;
            text-align: center;
        }
        
        .menu-item span {
            opacity: 0;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }
        
        .sidebar.expanded .menu-item span {
            opacity: 1;
        }
        
        .divider {
            width: 80%;
            height: 1px;
            background: rgba(176, 196, 177, 0.3);
            margin: 15px auto;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .header h2 {
            color: #4A5759;
            font-size: 2.5em;
            font-weight: 600;
        }
        
        .status-lights {
            display: flex;
            gap: 8px;
        }
        
        .status-light {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        
        .status-light.red { background: #EDAFB8; }
        .status-light.yellow { background: #F7E1D7; }
        .status-light.green { background: #B0C4B1; }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        /* Notification */
        .notification {
            padding: 15px 25px;
            border-radius: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            animation: slideInDown 0.5s ease;
        }
        
        @keyframes slideInDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .notification.success {
            background: rgba(176, 196, 177, 0.8);
            color: #4A5759;
            border: 2px solid #B0C4B1;
        }
        
        .notification.error {
            background: rgba(237, 175, 184, 0.8);
            color: #4A5759;
            border: 2px solid #EDAFB8;
        }
        
        .notification i {
            font-size: 24px;
        }
        
        .notification-close {
            margin-left: auto;
            cursor: pointer;
            font-size: 20px;
            opacity: 0.7;
            transition: opacity 0.3s;
        }
        
        .notification-close:hover {
            opacity: 1;
        }
        
        /* Glass Card */
        .glass-card {
            background: rgba(222, 219, 210, 0.4);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            border: 1px solid rgba(176, 196, 177, 0.4);
            padding: 30px;
            box-shadow: 0 8px 32px rgba(74, 87, 89, 0.15);
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .btn {
            padding: 15px 30px;
            border-radius: 15px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 100%);
            color: #4A5759;
            box-shadow: 0 4px 15px rgba(237, 175, 184, 0.4);
        }
        
        .btn-secondary {
            background: rgba(176, 196, 177, 0.5);
            color: #4A5759;
            border: 2px solid rgba(176, 196, 177, 0.6);
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(74, 87, 89, 0.25);
        }
        
        /* Table */
        .table-container {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        
        thead tr {
            background: rgba(74, 87, 89, 0.6);
        }
        
        th {
            color: white;
            font-weight: 600;
            padding: 15px;
            text-align: center;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        th:first-child {
            border-radius: 15px 0 0 15px;
        }
        
        th:last-child {
            border-radius: 0 15px 15px 0;
        }
        
        tbody tr {
            background: rgba(247, 225, 215, 0.4);
            transition: all 0.3s ease;
        }
        
        tbody tr:hover {
            background: rgba(237, 175, 184, 0.5);
            transform: scale(1.01);
        }
        
        td {
            padding: 20px 15px;
            color: #4A5759;
            text-align: center;
        }
        
        td:first-child {
            border-radius: 15px 0 0 15px;
            font-weight: 600;
            color: #4A5759;
        }
        
        td:last-child {
            border-radius: 0 15px 15px 0;
        }
        
        .action-btns {
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        
        .action-btn {
            padding: 8px 15px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.85em;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #B0C4B1 0%, #DEDBD2 100%);
            color: #4A5759;
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 100%);
            color: #4A5759;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 87, 89, 0.3);
        }
        
        /* User Profile */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            background: rgba(176, 196, 177, 0.3);
            border-radius: 15px;
            margin-top: auto;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .user-profile:hover {
            background: rgba(237, 175, 184, 0.4);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #EDAFB8 0%, #F7E1D7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4A5759;
            font-weight: 600;
        }
        
        .user-info {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .sidebar.expanded .user-info {
            opacity: 1;
        }
        
        .user-info h4 {
            color: white;
            font-size: 0.9em;
            margin-bottom: 2px;
        }
        
        .user-info p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.75em;
        }
        
        /* No Data Message */
        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: #4A5759;
        }
        
        .no-data i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .no-data h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        
        .no-data p {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="logo">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            
            <div class="menu-items">
                <a href="#" class="menu-item active">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="input/index.html" class="menu-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Input Data</span>
                </a>
                <a href="input/Leafletjs.php" class="menu-item">
                    <i class="fas fa-map"></i>
                    <span>Lihat Peta</span>
                </a>
                
                <div class="divider"></div>
                
                <div class="menu-item">
                    <i class="fas fa-info-circle"></i>
                    <span>Information</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </div>
            </div>
            
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <div class="user-info">
                    <h4>Admin</h4>
                    <p>Premium Account</p>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h2>Data Kecamatan</h2>
                <div class="status-lights">
                    <div class="status-light red"></div>
                    <div class="status-light yellow"></div>
                    <div class="status-light green"></div>
                </div>
            </div>
            
            <?php
            // Display notification based on URL parameter
            if (isset($_GET['message'])) {
                $message = $_GET['message'];
                if ($message == 'success') {
                    echo '<div class="notification success" id="notification">
                            <i class="fas fa-check-circle"></i>
                            <span>Data berhasil dihapus!</span>
                            <i class="fas fa-times notification-close" onclick="closeNotification()"></i>
                            </div>';
                } elseif ($message == 'error') {
                    echo '<div class="notification error" id="notification">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Gagal menghapus data. Silakan coba lagi.</span>
                            <i class="fas fa-times notification-close" onclick="closeNotification()"></i>
                            </div>';
                } elseif ($message == 'no_id') {
                    echo '<div class="notification error" id="notification">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>ID data tidak valid.</span>
                            <i class="fas fa-times notification-close" onclick="closeNotification()"></i>
                            </div>';
                }
            }
            ?>
            
            <div class="glass-card">
                <?php
                //Koneksi Database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "Latihan_8";

                //Membuat Koneksi
                $conn = new mysqli($servername, $username, $password, $dbname);

                //Cek Koneksi
                if ($conn->connect_error) {
                    die("Koneksi Gagal: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM data_kecamatan";
                $result = $conn->query($sql);
                ?>
                
                <div class="action-buttons">
                    <a href='input/index.html' class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Input Data Baru
                    </a>
                    <a href='input/Leafletjs.php' class="btn btn-secondary">
                        <i class="fas fa-map-marked-alt"></i>
                        Lihat Peta
                    </a>
                </div>
                
                <div class="table-container">
                    <?php
                    if ($result->num_rows > 0) {
                        echo "<table>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kecamatan</th>
                                        <th>Longitude</th>
                                        <th>Latitude</th>
                                        <th>Luas (km²)</th>
                                        <th>Jumlah Penduduk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>";

                        // output data of each row dengan nomor urut
                        $no = 1;
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row["kecamatan"] . "</td>";
                            echo "<td>" . $row["longitude"] . "</td>";
                            echo "<td>" . $row["latitude"] . "</td>";
                            echo "<td>" . $row["luas"] . "</td>";
                            echo "<td>" . number_format($row["jumlah_penduduk"]) . "</td>";
                            echo "<td>
                                    <div class='action-btns'>
                                        <a href='edit/index.php?id=" . $row["id"] . "' class='action-btn btn-edit'>
                                            <i class='fas fa-edit'></i> Edit
                                        </a>
                                        <a href='delete.php?id=" . $row["id"] . "' class='action-btn btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>
                                            <i class='fas fa-trash'></i> Hapus
                                        </a>
                                    </div>
                                    </td>";
                            echo "</tr>";
                            $no++;
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<div class='no-data'>
                                <i class='fas fa-inbox'></i>
                                <h3>Tidak ada data</h3>
                                <p>Silakan tambahkan data kecamatan baru</p>
                                </div>";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Toggle Sidebar
        const sidebar = document.getElementById('sidebar');
        
        sidebar.addEventListener('mouseenter', () => {
            sidebar.classList.add('expanded');
        });
        
        sidebar.addEventListener('mouseleave', () => {
            sidebar.classList.remove('expanded');
        });
        
        // Close notification
        function closeNotification() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.animation = 'slideInDown 0.5s ease reverse';
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }
        }
        
        // Auto close notification after 5 seconds
        if (document.getElementById('notification')) {
            setTimeout(() => {
                closeNotification();
            }, 5000);
        }
    </script>
</body>
</html>