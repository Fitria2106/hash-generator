/* =========================
   MATRIX BACKGROUND SCRIPT
   (Disesuaikan dengan list.php)
========================= */

const canvas = document.getElementById("matrix");
const ctx = canvas.getContext("2d");

/* Resize canvas mengikuti layar */
function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
window.addEventListener("resize", resizeCanvas);
resizeCanvas();

/* Karakter Matrix */
const chars = "01ABCDEFGHIJKLMNOPQRSTUVWXYZアカサタナハマヤラワ";
const fontSize = 16;

/* Hitung kolom */
let columns = Math.floor(canvas.width / fontSize);
let drops = Array(columns).fill(1);

/* Render Matrix */
function drawMatrix() {
    /* trail lebih pekat = matrix lebih redup */
    ctx.fillStyle = "rgba(0, 0, 0, 0.08)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    /* huruf lebih redup */
    ctx.fillStyle = "rgba(0, 255, 156, 0.2)";
    ctx.font = fontSize + "px monospace";

    for (let i = 0; i < drops.length; i++) {
        const text = chars.charAt(Math.floor(Math.random() * chars.length));
        ctx.fillText(text, i * fontSize, drops[i] * fontSize);

        if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
            drops[i] = 0;
        }
        drops[i]++;
    }
}


/* Interval render */
setInterval(drawMatrix, 50);
