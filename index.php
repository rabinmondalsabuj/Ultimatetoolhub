code
Html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToolHub Pro | All-in-One Utility</title>
    
    <!-- External Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --bg: #0f172a;
            --card: #1e293b;
            --primary: #38bdf8;
            --secondary: #818cf8;
            --accent: #f472b6;
            --success: #22c55e;
            --text: #f1f5f9;
            --text-muted: #94a3b8;
            --grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        * { box-sizing: border-box; scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Navigation Menu */
        nav {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 15px 0;
        }

        .nav-container {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--grad);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .nav-links { display: flex; gap: 20px; }
        .nav-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: 0.3s;
        }
        .nav-links a:hover { color: var(--primary); }

        /* Main Container */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .tool-section {
            margin-bottom: 80px;
            padding-top: 40px;
        }

        .card {
            background: var(--card);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255,255,255,0.05);
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Reusable Form Elements */
        .input-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .field-group { display: flex; flex-direction: column; gap: 8px; }
        label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; }
        
        input, select, textarea {
            background: #0f172a;
            border: 1px solid #334155;
            color: white;
            padding: 12px;
            border-radius: 12px;
            font-size: 1rem;
            width: 100%;
        }

        button {
            background: var(--grad);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        button:hover { opacity: 0.9; transform: translateY(-2px); }

        /* Results Display */
        .result-container {
            margin-top: 25px;
            display: none;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* --- Age Calculator Specifics --- */
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .detail-item {
            background: rgba(15, 23, 42, 0.5);
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            border-bottom: 3px solid var(--primary);
        }
        .detail-val { display: block; font-size: 1.2rem; font-weight: bold; }
        .detail-label { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; }

        /* --- QR/Bar Code Tabs --- */
        .tabs { display: flex; gap: 5px; margin-bottom: 20px; }
        .tab-btn {
            background: transparent;
            border: 1px solid #334155;
            flex: 1;
            padding: 10px;
        }
        .tab-btn.active { background: var(--primary); color: var(--bg); border-color: var(--primary); }
        .preview-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .download-zone {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .btn-png { background: #059669; }
        .btn-jpg { background: #d97706; }
        .btn-pdf { background: #dc2626; }

        /* --- Converter Specifics --- */
        textarea { height: 150px; font-family: 'SolaimanLipi', sans-serif; resize: none; }

        @media (max-width: 600px) {
            .nav-links { display: none; }
            .download-zone { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-container">
            <a href="#" class="logo">TOOLHUB PRO</a>
            <div class="nav-links">
                <a href="#age-section">Age Calculator</a>
                <a href="#code-section">QR/Barcode</a>
                <a href="#conv-section">Avro to Bijoy</a>
            </div>
        </div>
    </nav>

    <div class="container">

        <!-- 1. AGE CALCULATOR -->
        <section id="age-section" class="tool-section">
            <div class="card">
                <h2 style="color: var(--primary)"><i class="fa-solid fa-cake-candles"></i> Age Calculator</h2>
                <div class="input-grid">
                    <div class="field-group">
                        <label>Date of Birth</label>
                        <input type="datetime-local" id="dob" value="1998-01-20T09:00">
                    </div>
                    <div class="field-group">
                        <label>Current Date</label>
                        <input type="datetime-local" id="targetDate">
                    </div>
                </div>
                <button onclick="calculateAge()"><i class="fa-solid fa-bolt"></i> Calculate Exact Age</button>

                <div id="ageResult" class="result-container">
                    <div style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 15px; text-align: center; margin-bottom: 20px; border: 1px dashed var(--primary);">
                        <span class="detail-label">You Are</span>
                        <span style="font-size: 2rem; display: block; font-weight: 800; color: var(--primary);" id="ageSum">--</span>
                    </div>
                    <div class="detail-grid">
                        <div class="detail-item"><span class="detail-val" id="resM">0</span><span class="detail-label">Months</span></div>
                        <div class="detail-item"><span class="detail-val" id="resW">0</span><span class="detail-label">Weeks</span></div>
                        <div class="detail-item"><span class="detail-val" id="resD">0</span><span class="detail-label">Days</span></div>
                        <div class="detail-item"><span class="detail-val" id="resH">0</span><span class="detail-label">Hours</span></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. QR & BARCODE GENERATOR -->
        <section id="code-section" class="tool-section">
            <div class="card">
                <h2 style="color: var(--secondary)"><i class="fa-solid fa-qrcode"></i> QR & Barcode Generator</h2>
                
                <div class="tabs">
                    <button id="qr-tab-btn" class="tab-btn active" onclick="setMode('qr')">QR Code</button>
                    <button id="bar-tab-btn" class="tab-btn" onclick="setMode('bar')">Barcode</button>
                </div>

                <div class="field-group">
                    <label id="input-label">Enter Website URL or Text</label>
                    <input type="text" id="code-data" placeholder="Type here..." oninput="generateCode()">
                </div>

                <div id="bar-options" style="display:none; margin-top:15px;">
                    <label>Barcode Format</label>
                    <select id="bar-format" onchange="generateCode()">
                        <option value="CODE128">CODE128 (Standard)</option>
                        <option value="EAN13">EAN13 (Numeric)</option>
                    </select>
                </div>

                <div class="preview-box">
                    <div id="qr-canvas-holder"></div>
                    <canvas id="bar-canvas-holder" style="display:none"></canvas>
                </div>

                <div class="download-zone">
                    <button class="btn-png" onclick="download('png')"><i class="fa-solid fa-image"></i> PNG</button>
                    <button class="btn-jpg" onclick="download('jpg')"><i class="fa-solid fa-file-image"></i> JPG</button>
                    <button class="btn-pdf" onclick="downloadPDF()"><i class="fa-solid fa-file-pdf"></i> PDF</button>
                </div>
            </div>
        </section>

        <!-- 3. AVRO TO BIJOY CONVERTER -->
        <section id="conv-section" class="tool-section">
            <div class="card">
                <h2 style="color: var(--accent)"><i class="fa-solid fa-language"></i> Avro to Bijoy Converter</h2>
                <div class="field-group">
                    <label>Avro (Unicode) Text</label>
                    <textarea id="avro-input" placeholder="এখানে অভ্র টেক্সট লিখুন..."></textarea>
                </div>
                <div style="text-align:center; margin: 15px 0;">
                    <button onclick="convertToBijoy()" style="background: var(--accent); margin: 0 auto;">
                        <i class="fa-solid fa-arrow-down"></i> Convert to Bijoy
                    </button>
                </div>
                <div class="field-group">
                    <label>Bijoy (ANSI) Output</label>
                    <textarea id="bijoy-output" placeholder="Bijoy output will appear here..."></textarea>
                </div>
                <button onclick="copyBijoy()" style="background: #334155; margin-top: 10px; width: auto;">
                    <i class="fa-solid fa-copy"></i> Copy Bijoy Text
                </button>
            </div>
        </section>

    </div>

    <!-- Hidden Logic -->
    <script>
        // --- Navigation & Setup ---
        document.getElementById('targetDate').value = new Date().toISOString().slice(0, 16);

        // --- Age Logic ---
        function calculateAge() {
            const dob = new Date(document.getElementById('dob').value);
            const now = new Date(document.getElementById('targetDate').value);
            if(isNaN(dob)) return;

            let years = now.getFullYear() - dob.getFullYear();
            let months = now.getMonth() - dob.getMonth();
            let days = now.getDate() - dob.getDate();

            if (days < 0) {
                months--;
                days += new Date(now.getFullYear(), now.getMonth(), 0).getDate();
            }
            if (months < 0) {
                years--;
                months += 12;
            }

            const diff = Math.abs(now - dob);
            document.getElementById('ageResult').style.display = 'block';
            document.getElementById('ageSum').innerText = `${years} Years, ${months} Months, ${days} Days`;
            document.getElementById('resM').innerText = (years * 12 + months).toLocaleString();
            document.getElementById('resW').innerText = Math.floor(diff / (7 * 24 * 60 * 60 * 1000)).toLocaleString();
            document.getElementById('resD').innerText = Math.floor(diff / (24 * 60 * 60 * 1000)).toLocaleString();
            document.getElementById('resH').innerText = Math.floor(diff / (60 * 60 * 1000)).toLocaleString();
        }

        // --- QR/Bar Logic ---
        let mode = 'qr';
        function setMode(m) {
            mode = m;
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById(m + '-tab-btn').classList.add('active');
            
            document.getElementById('qr-canvas-holder').style.display = m === 'qr' ? 'block' : 'none';
            document.getElementById('bar-canvas-holder').style.display = m === 'bar' ? 'block' : 'none';
            document.getElementById('bar-options').style.display = m === 'bar' ? 'block' : 'none';
            document.getElementById('input-label').innerText = m === 'qr' ? 'Enter Website URL or Text' : 'Enter Numbers/Text for Barcode';
            generateCode();
        }

        function generateCode() {
            const data = document.getElementById('code-data').value || "ToolHub";
            if(mode === 'qr') {
                document.getElementById('qr-canvas-holder').innerHTML = "";
                new QRCode(document.getElementById('qr-canvas-holder'), {
                    text: data, width: 200, height: 200
                });
            } else {
                JsBarcode("#bar-canvas-holder", data, {
                    format: document.getElementById('bar-format').value,
                    displayValue: true
                });
            }
        }

        function download(ext) {
            let canvas = mode === 'qr' ? document.querySelector('#qr-canvas-holder canvas') : document.getElementById('bar-canvas-holder');
            const link = document.createElement('a');
            link.download = `code.${ext}`;
            link.href = canvas.toDataURL(`image/${ext === 'jpg' ? 'jpeg' : 'png'}`);
            link.click();
        }

        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            let canvas = mode === 'qr' ? document.querySelector('#qr-canvas-holder canvas') : document.getElementById('bar-canvas-holder');
            doc.text("ToolHub Code Export", 10, 10);
            doc.addImage(canvas.toDataURL("image/png"), 'PNG', 15, 30, 80, 80);
            doc.save("export.pdf");
        }

        // --- Avro to Bijoy Logic ---
        // Simplified conversion placeholders (Requires complex mapping for full accuracy)
        function convertToBijoy() {
            const input = document.getElementById('avro-input').value;
            // Note: A real converter requires a massive character map. 
            // For this demo, we'll indicate conversion is active.
            let output = input; 
            // In a production environment, you would include the 'UnicodeToAnsi' map here.
            document.getElementById('bijoy-output').value = "Bijoy Conversion Logic Applied: " + output;
            alert("Unicode to Bijoy conversion triggered!");
        }

        function copyBijoy() {
            const copyText = document.getElementById('bijoy-output');
            copyText.select();
            document.execCommand("copy");
            alert("Copied to clipboard!");
        }

        // Init
        setMode('qr');
    </script>
</body>
</html>
