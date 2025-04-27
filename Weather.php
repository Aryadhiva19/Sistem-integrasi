<?php
// Ambil data dari Open-Meteo API
$apiUrl = "https://api.open-meteo.com/v1/forecast?latitude=-7.973&longitude=112.6087&daily=temperature_2m_max,temperature_2m_min,precipitation_sum&timezone=Asia%2FBangkok&forecast_days=3";
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

// Ambil data harian
$dates = $data['daily']['time'];
$temp_max = $data['daily']['temperature_2m_max'];
$temp_min = $data['daily']['temperature_2m_min'];
$precipitation = $data['daily']['precipitation_sum'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Prakiraan Cuaca Klojen - 3 Hari</title>
    <script>
        function showWeather() {
            const weatherData = <?php echo json_encode(value: $data['daily']); ?>;
            let output = "";

            for (let i = 0; i < weatherData.time.length; i++) {
                output += `
                    <div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; border-radius: 8px;">
                        <h3>Tanggal: ${weatherData.time[i]}</h3>
                        <p><strong>Max Temperature:</strong> ${weatherData.temperature_2m_max[i]} °C</p>
                        <p><strong>Min Temperature:</strong> ${weatherData.temperature_2m_min[i]} °C</p>
                        <p><strong>Precipitation:</strong> ${weatherData.precipitation_sum[i]} mm</p>
                    </div>
                `;
            }

            document.getElementById('weather').innerHTML = output;
        }
    </script>
</head>
<body onload="showWeather()" style="font-family: Arial, sans-serif; margin: 40px;">
    <h1>Prakiraan Cuaca 3 Hari - Kecamatan Klojen</h1>
    <div id="weather"></div>
</body>
</html>
