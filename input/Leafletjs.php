<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Kecamatan</title>
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #B0C4B1 0%, #4A5759 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        h1 {
            color: #F7E1D7;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .btn-back {
            background: #F7E1D7;
            color: #4A5759;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }
        
        .btn-back:hover {
            background: #EDAFB8;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
        
        #map {
            height: 500px;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            border: 3px solid #DEDBD2;
        }
        
        .table-container {
            background: #F7E1D7;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            height: 500px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        
        .table-container h2 {
            color: #4A5759;
            margin-bottom: 15px;
            flex-shrink: 0;
        }
        
        .table-wrapper {
            overflow-y: auto;
            overflow-x: hidden;
            flex: 1;
            max-height: calc(500px - 70px);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            display: table;
        }
        
        thead {
            background: linear-gradient(135deg, #EDAFB8 0%, #B0C4B1 100%);
            color: #4A5759;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        th {
            padding: 12px;
            text-align: center;
            font-weight: 600;
            border-bottom: 2px solid #DEDBD2;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #DEDBD2;
            color: #4A5759;
            text-align: center;
        }
        
        tbody tr {
            transition: all 0.3s;
            cursor: pointer;
        }
        
        tbody tr:hover {
            background: #EDAFB8;
            transform: scale(1.01);
        }
        
        tbody tr.active {
            background: #B0C4B1;
            font-weight: bold;
        }
        
        .info-box {
            background: #F7E1D7;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .info-box h2 {
            color: #4A5759;
            margin-bottom: 15px;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #EDAFB8 0%, #B0C4B1 100%);
            color: #4A5759;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .stat-card h3 {
            font-size: 0.9em;
            margin-bottom: 10px;
            opacity: 0.9;
            font-weight: 600;
        }
        
        .stat-card p {
            font-size: 1.8em;
            font-weight: bold;
        }
        
        /* Custom Popup Style */
        .leaflet-popup-content-wrapper {
            border-radius: 10px;
            padding: 5px;
            background: #F7E1D7;
        }
        
        .popup-content {
            padding: 10px;
            min-width: 200px;
        }
        
        .popup-content h3 {
            color: #4A5759;
            margin-bottom: 10px;
            border-bottom: 2px solid #EDAFB8;
            padding-bottom: 5px;
        }
        
        .popup-content p {
            margin: 5px 0;
            font-size: 0.9em;
            color: #4A5759;
        }
        
        .popup-content strong {
            color: #B0C4B1;
        }
        
        /* Scrollbar styling */
        .table-wrapper::-webkit-scrollbar {
            width: 8px;
        }
        
        .table-wrapper::-webkit-scrollbar-track {
            background: #DEDBD2;
            border-radius: 10px;
        }
        
        .table-wrapper::-webkit-scrollbar-thumb {
            background: #B0C4B1;
            border-radius: 10px;
        }
        
        .table-wrapper::-webkit-scrollbar-thumb:hover {
            background: #4A5759;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🗺️ Web GIS</h1>
            <h2 style="color: #F7E1D7; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Kabupaten Sleman</h2>
            <a href="../index.php" class="btn-back">← Kembali ke Data</a>
        </div>
        
        <div class="content-grid">
            <div id="map"></div>
            
            <div class="table-container">
                <h2>📋 Data Kecamatan</h2>
                <div class="table-wrapper">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kecamatan</th>
                                <th>Luas (km²)</th>
                                <th>Penduduk</th>
                                <th>Kepadatan</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="info-box">
            <h2>Statistik Data</h2>
            <div class="stats">
                <div class="stat-card">
                    <h3>Total Kecamatan</h3>
                    <p id="totalKecamatan">0</p>
                </div>
                <div class="stat-card">
                    <h3>Total Penduduk</h3>
                    <p id="totalPenduduk">0</p>
                </div>
                <div class="stat-card">
                    <h3>Total Luas (km²)</h3>
                    <p id="totalLuas">0</p>
                </div>
                <div class="stat-card">
                    <h3>Rata-rata Kepadatan</h3>
                    <p id="avgKepadatan">0</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        // Inisialisasi peta dengan center di Yogyakarta
        var map = L.map('map').setView([-7.7556, 110.3783], 11);
        
        // Tambahkan tile layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);
        
        // Data kecamatan dari PHP
        <?php
        // Koneksi Database (sesuaikan dengan setting MySQL Anda)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "latihan_8";

        // Membuat Koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek Koneksi
        if ($conn->connect_error) {
            die("Koneksi Gagal: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM data_kecamatan ORDER BY kecamatan ASC";
        $result = $conn->query($sql);
        
        $locations = array();
        $totalPenduduk = 0;
        $totalLuas = 0;
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $locations[] = $row;
                $totalPenduduk += $row['jumlah_penduduk'];
                $totalLuas += $row['luas'];
            }
        }
        
        echo "var locations = " . json_encode($locations) . ";\n";
        echo "var totalKecamatan = " . count($locations) . ";\n";
        echo "var totalPenduduk = " . $totalPenduduk . ";\n";
        echo "var totalLuas = " . number_format($totalLuas, 2, '.', '') . ";\n";
        
        $conn->close();
        ?>
        
        // Menyimpan marker dalam object untuk akses mudah
        var markers = {};
        
        // Icon marker custom
        var customIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        
        // Highlighted icon
        var highlightIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        
        // Tambahkan marker untuk setiap lokasi
        locations.forEach(function(location, index) {
            // Convert to number untuk memastikan koordinat valid
            var lat = parseFloat(location.latitude);
            var lng = parseFloat(location.longitude);
            
            if (!isNaN(lat) && !isNaN(lng)) {
                var marker = L.marker([lat, lng], {icon: customIcon}).addTo(map);
                
                // Simpan marker dengan ID
                markers[location.kecamatan] = marker;
                
                // Popup content
                var popupContent = `
                    <div class="popup-content">
                        <h3>${location.kecamatan}</h3>
                        <p><strong>📍 Koordinat:</strong><br>
                        Lat: ${lat}<br>
                        Long: ${lng}</p>
                        <p><strong>📏 Luas:</strong> ${location.luas} km²</p>
                        <p><strong>👥 Penduduk:</strong> ${parseInt(location.jumlah_penduduk).toLocaleString('id-ID')}</p>
                        <p><strong>📊 Kepadatan:</strong> ${Math.round(location.jumlah_penduduk / location.luas).toLocaleString('id-ID')} jiwa/km²</p>
                    </div>
                `;
                
                marker.bindPopup(popupContent);
            }
        });
        
        // Populate table
        var tableBody = document.getElementById('tableBody');
        locations.forEach(function(location, index) {
            var kepadatan = Math.round(location.jumlah_penduduk / location.luas);
            var row = document.createElement('tr');
            row.setAttribute('data-kecamatan', location.kecamatan);
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${location.kecamatan}</td>
                <td>${parseFloat(location.luas).toFixed(2)}</td>
                <td>${parseInt(location.jumlah_penduduk).toLocaleString('id-ID')}</td>
                <td>${kepadatan.toLocaleString('id-ID')}</td>
            `;
            
            // Add click event to row
            row.addEventListener('click', function() {
                var kecamatan = this.getAttribute('data-kecamatan');
                var marker = markers[kecamatan];
                
                // Remove active class from all rows
                document.querySelectorAll('tbody tr').forEach(function(r) {
                    r.classList.remove('active');
                });
                
                // Add active class to clicked row
                this.classList.add('active');
                
                // Reset all markers to default icon
                Object.keys(markers).forEach(function(key) {
                    markers[key].setIcon(customIcon);
                });
                
                // Highlight selected marker
                if (marker) {
                    marker.setIcon(highlightIcon);
                    map.setView(marker.getLatLng(), 13);
                    marker.openPopup();
                }
            });
            
            tableBody.appendChild(row);
        });
        
        // Update statistik
        document.getElementById('totalKecamatan').textContent = totalKecamatan;
        document.getElementById('totalPenduduk').textContent = totalPenduduk.toLocaleString('id-ID');
        document.getElementById('totalLuas').textContent = totalLuas.toFixed(2);
        
        // Hitung rata-rata kepadatan
        var avgKepadatan = Math.round(totalPenduduk / totalLuas);
        document.getElementById('avgKepadatan').textContent = avgKepadatan.toLocaleString('id-ID');
        
        // Fit bounds to show all markers
        if (locations.length > 0) {
            var bounds = L.latLngBounds(locations.map(loc => [parseFloat(loc.latitude), parseFloat(loc.longitude)]));
            map.fitBounds(bounds, {padding: [50, 50]});
        }
    </script>
</body>
</html>