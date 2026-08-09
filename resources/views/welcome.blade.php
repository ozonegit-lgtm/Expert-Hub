<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expert-Hub</title>
    <style>
        :root { color-scheme: dark; font-family: ui-sans-serif, system-ui, sans-serif; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; color: #e7eefb; background: radial-gradient(circle at 20% 10%, #243b72, transparent 35%), #09111f; }
        main { width: min(760px, calc(100% - 32px)); padding: 48px; border: 1px solid #31436a; border-radius: 24px; background: rgba(15, 27, 48, .86); box-shadow: 0 24px 80px rgba(0,0,0,.35); }
        .badge { display: inline-block; padding: 7px 12px; border-radius: 999px; color: #8dd8ff; background: #102f4b; font-size: 14px; }
        h1 { margin: 20px 0 12px; font-size: clamp(42px, 8vw, 76px); line-height: .95; letter-spacing: -.05em; }
        p { margin: 0; max-width: 580px; color: #aebbd2; font-size: 18px; line-height: 1.7; }
        dl { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin: 36px 0 0; }
        dl div { padding: 16px; border-radius: 14px; background: #101d33; }
        dt { color: #7787a6; font-size: 12px; text-transform: uppercase; letter-spacing: .12em; }
        dd { margin: 6px 0 0; font-weight: 700; }
        @media (max-width: 640px) { main { padding: 30px; } dl { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<main>
    <span class="badge">พร้อมเริ่มพัฒนา</span>
    <h1>Expert-Hub</h1>
    <p>พื้นที่สำหรับสร้างและแบ่งปันความเชี่ยวชาญ ระบบ Laravel ทำงานผ่าน Docker พร้อม MySQL และ phpMyAdmin แล้ว</p>
    <dl>
        <div><dt>Framework</dt><dd>Laravel 12</dd></div>
        <div><dt>Runtime</dt><dd>PHP 8.3</dd></div>
        <div><dt>Database</dt><dd>MySQL 8.4</dd></div>
    </dl>
</main>
</body>
</html>
