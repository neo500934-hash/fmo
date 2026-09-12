<!DOCTYPE html>
<html>

<head>
    <title>GPS Sender</title>
</head>

<body style="font-family: sans-serif; padding: 20px;">
    <h2>GPS Test Sender</h2>
    <p id="status">Not sending yet</p>
    <button onclick="startSending()">Start Sending Location</button>

    <script>
        const TOKEN = '2|RksbWoDoZIq5AdRlxokqgYGfTT55whRNWFfmufk7889b2d49'; // the one you generated in tinker

        function startSending() {
            document.getElementById('status').innerText = 'Started, waiting for GPS...';
            setInterval(() => {
                navigator.geolocation.getCurrentPosition(async (pos) => {
                    document.getElementById('status').innerText = 'Got GPS, sending...';
                    try {
                        const res = await fetch('/fmo/public/api/driver/location', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': `Bearer ${TOKEN}`
                            },
                            body: JSON.stringify({
                                lat: pos.coords.latitude,
                                lng: pos.coords.longitude
                            })
                        });
                        const text = await res.text();
                        document.getElementById('status').innerText =
                            `Status ${res.status}: ${text}`;
                    } catch (err) {
                        document.getElementById('status').innerText = 'Fetch error: ' + err.message;
                    }
                }, (err) => {
                    document.getElementById('status').innerText = 'GPS error ' + err.code + ': ' + err
                        .message;
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000
                });
            }, 5000);
        }
    </script>
</body>

</html>
