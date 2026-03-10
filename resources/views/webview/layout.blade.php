<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>@yield('title', 'MEEM Gold') | MEEM Gold</title>
  <style>
    :root{--bg:#f5f7fb;--card:#fff;--text:#172033;--muted:#6f7a8a;--line:#e8edf4;--gold:#c9a54c;--gold-dark:#9e7b27;--primary:#173153;--primary-dark:#10233b;--shadow:0 10px 30px rgba(23,49,83,.08);--radius:22px;}
    *{box-sizing:border-box;}
    html,body{margin:0;padding:0;font-family:Inter,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Arial,sans-serif;background:var(--bg);color:var(--text);}
    body{min-height:100vh;overflow-x:hidden;background:radial-gradient(circle at top right,rgba(201,165,76,.18),transparent 28%),linear-gradient(180deg,#f8fafc 0%,#f3f6fb 100%);}
    a{color:inherit;text-decoration:none;}
    .app-shell{min-height:100vh;padding:env(safe-area-inset-top) 0 env(safe-area-inset-bottom);}
    .topbar{position:sticky;top:0;z-index:20;padding:14px 16px 12px;backdrop-filter:blur(14px);background:rgba(245,247,251,.86);border-bottom:1px solid rgba(232,237,244,.8);}
    .topbar-row{max-width:760px;margin:0 auto;display:flex;align-items:center;gap:12px;}
    .back-btn{cursor:pointer;color:var(--primary);font-weight:600;font-size:14px;padding:6px 12px;background:rgba(23,49,83,.08);border-radius:999px;}
    .brand{display:flex;align-items:center;gap:10px;}
    .brand-badge{width:38px;height:38px;border-radius:12px;border:1px solid #f0d17d;display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;}
    .brand-badge img{width:30px;}
    .brand-text small{display:block;color:var(--muted);font-size:11px;}
    .brand-text strong{display:block;font-size:15px;line-height:1.2;}
    .screen{width:100%;max-width:760px;margin:0 auto;padding:16px 16px 32px;}
    .hero{position:relative;overflow:hidden;border-radius:28px;padding:22px 18px 18px;background:linear-gradient(160deg,#18365b 0%,#10233b 100%);color:#fff;box-shadow:var(--shadow);}
    .hero::after{content:"";position:absolute;width:220px;height:220px;border-radius:999px;background:radial-gradient(circle,rgba(201,165,76,.45) 0%,rgba(201,165,76,0) 72%);right:-56px;top:-56px;}
    .hero>*{position:relative;z-index:1;}
    .hero h1{margin:10px 0 0;font-size:26px;line-height:1.15;}
    .hero p{margin:8px 0 0;color:rgba(255,255,255,.82);font-size:14px;line-height:1.6;}
    .card{background:var(--card);border:1px solid rgba(232,237,244,.84);border-radius:var(--radius);box-shadow:var(--shadow);padding:18px;margin-top:16px;}
    .section-head{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:14px;}
    .section-head h2{margin:0;font-size:19px;}
    .section-tag{display:inline-flex;align-items:center;padding:5px 10px;border-radius:999px;font-size:12px;font-weight:700;color:var(--gold-dark);background:#f9f2df;}
    .body-copy{margin:6px 0 0;color:var(--muted);font-size:14px;line-height:1.65;}
    .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:44px;padding:0 16px;border-radius:999px;border:0;font-size:14px;font-weight:700;cursor:pointer;text-decoration:none;}
    .btn-primary{color:#fff;background:linear-gradient(135deg,var(--gold-dark),var(--gold));}
    .btn-secondary{color:var(--primary);background:rgba(23,49,83,.08);}
  </style>
</head>
<body>
<main class="app-shell">
  <header class="topbar">
    <div class="topbar-row">
      <div class="back-btn" onclick="close_webview_back_to_dashboard();">← Back</div>
      <div class="brand">
        <div class="brand-badge"><img src="{{ asset('icons/logo-transparent-192x192.png') }}" alt="MEEM"></div>
        <div class="brand-text"><small>MEEM GOLD</small><strong>@yield('page_title', 'Page')</strong></div>
      </div>
    </div>
  </header>
  <section class="screen">
    @yield('body')
  </section>
</main>
<script src="{{ asset('js/flutter.js') }}"></script>
</body>
</html>
