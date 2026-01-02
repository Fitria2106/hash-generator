<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hash Generator</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* RESET */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Courier New', monospace;
            background: black;
            overflow: hidden;
        }

        /* CANVAS MATRIX */
        #matrix {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 0;
        }

        /* OVERLAY CONTENT */
        .content {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #00ff9c;
            padding: 20px;
        }

        .card-matrix {
            background: rgba(0, 0, 0, 0.95);
            border: 1px solid #00ff9c;
            box-shadow: 0 0 25px rgba(0, 255, 156, 0.4);
            border-radius: 12px;
            padding: 30px;
            max-width: 480px;
            width: 100%;
        }

        h1 {
            font-weight: bold;
            text-shadow: 0 0 10px #00ff9c;
        }

        p {
            opacity: 0.85;
        }

        /* MATRIX BUTTON */
        .btn-matrix {
            color: #00ff9c;
            border: 1px solid #00ff9c;
            background: transparent;
            box-shadow: 0 0 10px rgba(0, 255, 156, 0.4);
            transition: 0.3s;
        }

        .btn-matrix:hover {
            background: #00ff9c;
            color: black;
            box-shadow: 0 0 25px rgba(0, 255, 156, 0.8);
        }

        footer {
            margin-top: 20px;
            font-size: 0.85rem;
            opacity: 0.6;
        }
    </style>
</head>
<body>

<!-- MATRIX CANVAS -->
<canvas id="matrix"></canvas>

<!-- CONTENT -->
<div class="content">
    <div class="card-matrix">
        <h1>HASH GENERATOR</h1>
        <p class="mt-3">
            Aplikasi sederhana untuk menghasilkan dan melihat daftar hash.
        </p>

        <div class="d-grid gap-3 mt-4">
            <a href="form_input.php" class="btn btn-matrix btn-lg">
                Generate Hash
            </a>
            <a href="list.php" class="btn btn-matrix btn-lg">
                Hash List
            </a>
        </div>

        <footer class="mt-4">
            Matrix Mode &bull; Teknologi Cloud
        </footer>
    </div>
</div>

<!-- MATRIX SCRIPT -->
<script>
    const canvas = document.getElementById("matrix");
    const ctx = canvas.getContext("2d");

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    window.addEventListener("resize", resizeCanvas);
    resizeCanvas();

    const chars = "01ABCDEFGHIJKLMNOPQRSTUVWXYZアカサタナ";
    const fontSize = 16;
    let columns = Math.floor(canvas.width / fontSize);
    let drops = Array(columns).fill(1);

    function drawMatrix() {
        ctx.fillStyle = "rgba(0,0,0,0.08)"; // lebih redup
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = "rgba(0,255,156,0.3)"; // huruf redup
        ctx.font = fontSize + "px monospace";

        for (let i = 0; i < drops.length; i++) {
            const text = chars.charAt(Math.floor(Math.random() * chars.length));
            ctx.fillText(text, i * fontSize, drops[i] * fontSize);

            if (drops[i] * fontSize > canvas.height && Math.random() > 0.98) {
                drops[i] = 0;
            }
            drops[i]++;
        }
    }

    setInterval(drawMatrix, 60);
</script>

</body>
</html>
