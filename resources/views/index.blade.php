@extends('layout.app')

@section('title', 'Home')

@section('content')

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel IoT — Monitoreo & Registros</title>
  <style>
    :root {
      --bg:#f6f8fb;
      --card:#ffffff;
      --muted:#6b7280;
      --primary:#2563eb;
      --primary-hover:#1d4ed8;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: var(--bg);
      margin: 0;
      padding: 0;
    }
    header {
      background-color: var(--card);
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      font-size: 1.2rem;
      margin: 0;
    }
    nav a {
      margin-left: 1rem;
      text-decoration: none;
      color: var(--muted);
      font-weight: bold;
    }
    nav a:hover {
      color: var(--primary);
    }
    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 1rem;
    }
    .panel {
      background: var(--card);
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      margin-bottom: 2rem;
    }
    .panel h2 {
      margin-top: 0;
      margin-bottom: .5rem;
    }
    .panel p {
      margin-top: 0;
      color: var(--muted);
    }
    .btns {
      display: flex;
      gap: 1rem;
      margin-top: 1rem;
    }
    .btn {
      background: var(--primary);
      color: #fff;
      border: none;
      padding: .7rem 1.5rem;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      font-weight: bold;
      display:inline-block;
    }
    .btn:hover {
      background: var(--primary-hover);
    }
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px,1fr));
      gap: 1rem;
      margin-bottom: 2rem;
    }
    .card {
      background: var(--card);
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 1px 2px rgba(0,0,0,0.1);
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
      transform: scale(1.03);
      box-shadow: 0 3px 6px rgba(0,0,0,0.15);
    }
    .card h3 {
      margin-top: 0;
      margin-bottom: .2rem;
    }
    .modules {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
      gap: 1rem;
    }
    .module {
      background: var(--card);
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    .module h4 {
      margin-top: 0;
      margin-bottom: .5rem;
    }
    .muted {
      color: var(--muted);
    }
    .module .btns {
      margin-top:10px;
    }
  </style>
</head>
<body>

<header>
  <h1>🌸 IOT</h1>
  <nav>
    <a href="index.html">Inicio</a>
    <a href="tabla.html">Tabla</a>
    <a href="formulario.html">Formulario</a>
  </nav>
</header>

<div class="container">
  <div class="panel">
    <small>ESP32 - LTE (SIM7670G) · PostgreSQL</small>
    <h2>Panel IoT — Monitoreo & Registros</h2>
    <p>Captura datos, visualízalos en tabla y prepara el entorno para conectar SENSORES de dispositivos IoT.</p>
    <div class="btns">
      <a class="btn" href="formulario.html">+ Registrar dato</a>
      <a class="btn" href="tabla.html">Ver tabla</a>
    </div>
  </div>

  <div class="cards">
    <div class="card" onclick="location.href='sensores.html'">
      <h3>Sensores en línea</h3>
      <p><strong>3</strong><br><span class="muted">Demo (mock) • Ajustable</span></p>
    </div>
    <div class="card" onclick="location.href='sincronizacion.html'">
      <h3>Última sincronización</h3>
      <p><strong>hace 2 min</strong><br><span class="muted">Simulada para la demo</span></p>
    </div>
    <div class="card" onclick="location.href='basedatos.html'">
      <h3>Base de datos</h3>
      <p><strong>MYSQL</strong><br><span class="muted">Conectado vía MYSQL</span></p>
    </div>
  </div>

  <h3>Módulos</h3>
  <div class="modules">
    <div class="module">
      <h4>Gestión de registros</h4>
      <p class="muted">Crea y lista registros (base para actores, pacientes o dispositivos).</p>
      <div class="btns">
        <a class="btn" href="formulario.html">Nuevo</a>
        <a class="btn" href="tabla.html">Ver</a>
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