@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel IoT — Monitoreo & Registros</title>
  <!-- Fuente moderna -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      /* colores futuristas */
      --bg: #0f172a;
      --card: #1e293b;
      --muted: #94a3b8;
      --primary: #38bdf8;
      --primary-hover: #0ea5e9;
      --gradient: linear-gradient(135deg,#0ea5e9,#38bdf8);
      --radius: 12px;
      --shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    *{box-sizing:border-box;}
    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg);
      margin: 0;
      color: #e2e8f0;
    }

    header {
      background: var(--card);
      box-shadow: var(--shadow);
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 10;
    }
    header h1 {
      font-size: 1.3rem;
      margin: 0;
      display: flex;
      align-items: center;
      gap: .5rem;
    }
    header h1::before {
      content: "📡";
    }
    nav a {
      margin-left: 1.2rem;
      text-decoration: none;
      color: var(--muted);
      font-weight: 600;
      transition: color .2s ease;
    }
    nav a:hover { color: var(--primary); }

    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 0 1rem;
    }
    .panel {
      background: var(--card);
      padding: 2rem;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      margin-bottom: 2rem;
    }
    .panel small { color: var(--muted); font-size:.85rem; }
    .panel h2 {
      margin-top: .5rem;
      margin-bottom: .5rem;
      font-size: 1.5rem;
    }
    .panel p { margin-top: 0; color: var(--muted); }

    .btns {
      display:flex;
      flex-wrap:wrap;
      gap:1rem;
      margin-top:1.5rem;
    }
    .btn {
      background: var(--gradient);
      color:#fff;
      border:none;
      padding:.75rem 1.5rem;
      border-radius:var(--radius);
      cursor:pointer;
      text-decoration:none;
      font-weight:600;
      display:inline-block;
      transition:transform .15s ease,box-shadow .15s ease;
      box-shadow:0 2px 6px rgba(14,165,233,0.4);
    }
    .btn:hover {
      transform:translateY(-2px);
      box-shadow:0 4px 10px rgba(14,165,233,0.5);
    }

    .cards {
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
      gap:1.5rem;
      margin-bottom:2rem;
    }
    .card {
      background:var(--card);
      padding:1.5rem;
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      cursor:pointer;
      transition:transform .2s ease, box-shadow .2s ease;
    }
    .card:hover {
      transform:translateY(-3px);
      box-shadow:0 6px 14px rgba(0,0,0,0.3);
    }
    .card h3 {
      margin-top:0;
      margin-bottom:.3rem;
      font-size:1.1rem;
    }

    .modules {
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
      gap:1.5rem;
    }
    .module {
      background:var(--card);
      padding:1.5rem;
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      display:flex;
      flex-direction:column;
      justify-content:space-between;
    }
    .module h4 {
      margin-top:0;
      margin-bottom:.5rem;
      font-size:1.1rem;
    }
    .muted { color:var(--muted); }
    .module .btns{margin-top:1rem;}
  </style>
</head>
<body>
  <header>
  <h1>Panel IoT</h1>
  <nav>
    <a href="index.html">Inicio</a>
    <a href="/html/tabla.html">Tabla</a>
    <a href="/html/formulario.html">Formulario</a>
  </nav>
</header>

<div class="container">
  <div class="panel">
    <small>ESP32 - LTE (SIM7670G) · PostgreSQL</small>
    <h2>Monitoreo & Registros</h2>
    <p>Captura datos, visualízalos en tabla y prepara el entorno para conectar sensores IoT.</p>
    <div class="btns">
      <a class="btn" href="formulario.html">+ Registrar dato</a>
      <!-- nuevo botón directo -->
      <a class="btn" href="tabla.html" target="_blank">Ver tabla</a>
    </div>
  </div>

  <div class="cards">
    <div class="card" onclick="location.href='sensores.html'">
      <h3 style="color: #fff;">Sensores en línea</h3>
      <p><strong class="muted">3</strong><br><span class="muted">Demo (mock) • Ajustable</span></p>
    </div>
    <div class="card" onclick="location.href='sincronizacion.html'">
      <h3 style="color: #fff;">Última sincronización</h3>
      <p><strong class="muted">hace 2 min</strong><br><span class="muted">Simulada para la demo</span></p>
    </div>
    <div class="card" onclick="location.href='basedatos.html'">
      <h3 style="color: #fff;">Base de datos</h3>
      <p><strong class="muted">MYSQL</strong><br><span class="muted">Conectado vía MYSQL</span></p>
    </div>
  </div>

  <h3>Módulos</h3>
  <div class="modules">
    <div class="module">
      <h4>Gestión de registros</h4>
      <p class="muted">Crea y lista registros (base para actores, pacientes o dispositivos).</p>
      <div class="btns">
        <a class="btn" href="formulario.html">Nuevo</a>
        <a class="btn" href="tabla.html" target="_blank">Ver</a>
      </div>
    </div>
    <div class="module">
      <h4>Dispositivos IoT</h4>
      <p class="muted">Registro de dispositivos ESP32/SIM7670G, asignación y estado (pendiente).</p>
      <div class="btns">
        <button class="btn" onclick="alert('Funcionalidad próximamente');">Próximamente</button>
      </div>
    </div>
    <div class="module">
      <h4>Panel tiempo real</h4>
      <p class="muted">Gráficas de telemetría (SpO₂, pulso, temperatura) con WebSockets (pendiente).</p>
      <div class="btns">
        <button class="btn" onclick="alert('Funcionalidad próximamente');">Próximamente</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>


@endsection