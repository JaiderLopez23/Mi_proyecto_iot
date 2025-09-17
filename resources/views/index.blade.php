@extends('layout.app')

@section('title', 'Home')

@section('content')

 <!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel — Tabla • Gráficas • Formulario • Registrar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f4f6f9;
      color: #333;
    }
    nav {
      display: flex;
      background: #2c3e50;
      padding: 10px;
      justify-content: center;
    }
    nav button {
      background: #34495e;
      border: none;
      color: #fff;
      padding: 10px 20px;
      margin: 0 5px;
      cursor: pointer;
      border-radius: 5px;
      transition: background 0.3s;
    }
    nav button:hover {
      background: #1abc9c;
    }
    section {
      display: none;
      padding: 20px;
    }
    section.active {
      display: block;
    }
    form input, form button {
      display: block;
      margin: 10px 0;
      padding: 8px;
    }
    canvas {
      max-width: 600px;
      margin: 20px auto;
      display: block;
    }
    #limpiarBtn {
      background: #e74c3c;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 15px;
    }
    #limpiarBtn:hover {
      background: #c0392b;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

  <nav>
    <button onclick="mostrar('tabla')">Tabla</button>
    <button onclick="mostrar('graficas')">Gráficas</button>
    <button onclick="mostrar('formulario')">Formulario</button>
    <button onclick="mostrar('registrar')">Registrar Datos</button>
  </nav>

  <main>
    <section id="tabla">
      <h2>Tabla de Datos</h2>
      <table border="1" cellpadding="8">
        <thead>
          <tr><th>Categoría</th><th>Valor</th></tr>
        </thead>
        <tbody id="tabla-body"></tbody>
      </table>
      <button id="limpiarBtn" onclick="limpiarDatos()">🗑 Limpiar Datos</button>
    </section>

    <section id="graficas">
      <h2>Gráficas</h2>
      <canvas id="graficoBarras"></canvas>
      <canvas id="graficoLineas"></canvas>
      <canvas id="graficoPastel"></canvas>
    </section>

    <section id="formulario">
      <h2>Formulario</h2>
      <form id="dataForm">
        <input type="text" id="categoria" placeholder="Categoría" required>
        <input type="number" id="valor" placeholder="Valor" required>
        <button type="submit">Agregar</button>
      </form>
    </section>

    <section id="registrar">
      <h2>Registrar Datos Guardados</h2>
      <p>Los datos ya se guardan automáticamente en <strong>localStorage</strong>.</p>
    </section>
  </main>

<script>
  let datos = JSON.parse(localStorage.getItem("datos")) || [];

  const tablaBody = document.getElementById("tabla-body");
  const form = document.getElementById("dataForm");

  const ctxBarras = document.getElementById("graficoBarras").getContext("2d");
  const ctxLineas = document.getElementById("graficoLineas").getContext("2d");
  const ctxPastel = document.getElementById("graficoPastel").getContext("2d");

  let chartBarras, chartLineas, chartPastel;

  function mostrar(id) {
    document.querySelectorAll("section").forEach(sec => sec.classList.remove("active"));
    document.getElementById(id).classList.add("active");
    if(id === "graficas") actualizarGraficas();
    if(id === "tabla") actualizarTabla();
  }

  function actualizarTabla() {
    tablaBody.innerHTML = "";
    datos.forEach(d => {
      const fila = `<tr><td>${d.categoria}</td><td>${d.valor}</td></tr>`;
      tablaBody.innerHTML += fila;
    });
  }

  function actualizarGraficas() {
    const labels = datos.map(d => d.categoria);
    const valores = datos.map(d => d.valor);

    if(chartBarras) chartBarras.destroy();
    if(chartLineas) chartLineas.destroy();
    if(chartPastel) chartPastel.destroy();

    chartBarras = new Chart(ctxBarras, {
      type: 'bar',
      data: { labels, datasets: [{ label: 'Valores', data: valores, backgroundColor: 'rgba(52, 152, 219,0.7)' }] }
    });

    chartLineas = new Chart(ctxLineas, {
      type: 'line',
      data: { labels, datasets: [{ label: 'Tendencia', data: valores, borderColor: 'rgba(231, 76, 60,1)', fill: false }] }
    });

    chartPastel = new Chart(ctxPastel, {
      type: 'pie',
      data: { labels, datasets: [{ data: valores, backgroundColor: ['#1abc9c','#e74c3c','#9b59b6','#f1c40f','#3498db'] }] }
    });
  }

  form.addEventListener("submit", e => {
    e.preventDefault();
    const categoria = document.getElementById("categoria").value;
    const valor = parseFloat(document.getElementById("valor").value);

    datos.push({ categoria, valor });
    localStorage.setItem("datos", JSON.stringify(datos));

    form.reset();
    actualizarTabla();
    actualizarGraficas();
  });

  function limpiarDatos() {
    if(confirm("¿Seguro que quieres borrar todos los datos?")) {
      datos = [];
      localStorage.removeItem("datos");
      actualizarTabla();
      actualizarGraficas();
    }
  }

  mostrar("tabla");
  actualizarTabla();
</script>

</body>
</html>

@endsection