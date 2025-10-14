@extends('layouts.app')

@section('title', '🌐 IoT Dashboard — Smart Monitoring')

@section('content')
<style>
  /* === Estilo General (Glass + Neon) === */
  body {
    font-family: 'Poppins', sans-serif;
    background: radial-gradient(circle at 20% 20%, #0f172a, #020617);
    color: #e2e8f0;
    overflow-x: hidden;
  }

  .glass {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    backdrop-filter: blur(20px);
  }

  .dashboard-header {
    text-align: center;
    padding: 3rem 1rem;
    color: #fff;
    animation: fadeIn 1.2s ease;
  }

  .dashboard-header h1 {
    font-weight: 700;
    font-size: 2.3rem;
    margin-bottom: 0.5rem;
    background: linear-gradient(90deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .dashboard-header p {
    color: #a5b4fc;
    font-size: 1rem;
    opacity: 0.9;
  }

  /* === Botones modernos === */
  .btn-glow {
    background: linear-gradient(90deg, #06b6d4, #3b82f6);
    color: white;
    border: none;
    padding: 0.8rem 1.4rem;
    border-radius: 30px;
    font-weight: 600;
    box-shadow: 0 0 20px rgba(59,130,246,0.4);
    transition: all 0.25s ease;
  }
  .btn-glow:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 30px rgba(6,182,212,0.6);
  }

  /* === Tarjetas de estadísticas === */
  .stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
  }

  .stat-card {
    @apply glass;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
  }

  .stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 0 25px rgba(14,165,233,0.3);
  }

  .stat-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
  }

  .stat-title {
    font-weight: 600;
    color: #bae6fd;
  }

  .stat-value {
    font-size: 1.4rem;
    font-weight: 700;
    color: #38bdf8;
  }

  /* === Módulos === */
  .modules {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
  }

  .module-card {
    @apply glass;
    padding: 1.5rem;
    border-left: 4px solid #38bdf8;
    transition: all 0.3s ease;
  }

  .module-card:hover {
    transform: scale(1.02);
    border-left-color: #818cf8;
  }

  .module-card h4 {
    color: #f0f9ff;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .module-card p {
    color: #94a3b8;
    font-size: 0.9rem;
  }

  /* === Gráfico === */
  #telemetryChart {
    background: rgba(255,255,255,0.05);
    border-radius: 15px;
    padding: 1rem;
    backdrop-filter: blur(10px);
    box-shadow: 0 0 20px rgba(59,130,246,0.15);
  }

  /* === Animaciones === */
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>

<div class="container py-5">

  <div class="dashboard-header">
    <h1>🌐 IoT Smart Dashboard</h1>
    <p>Supervisa sensores, estaciones y datos de telemetría en tiempo real</p>
    <div class="mt-4">
      <a href="{{ route('stations.index') }}" class="btn-glow mx-1">🔭 Estaciones</a>
      <a href="{{ route('sensors.index') }}" class="btn-glow mx-1">🌡️ Sensores</a>
      <a href="{{ route('sensors.create') }}" class="btn-glow mx-1">➕ Nuevo Sensor</a>
    </div>
  </div>

  <div class="stats">
    <div class="stat-card glass">
      <div class="stat-icon">🛰️</div>
      <div class="stat-title">Sensores activos</div>
      <div class="stat-value">3</div>
    </div>

    <div class="stat-card glass">
      <div class="stat-icon">⏱️</div>
      <div class="stat-title">Última sincronización</div>
      <div class="stat-value">Hace 2 min</div>
    </div>

    <div class="stat-card glass">
      <div class="stat-icon">🧠</div>
      <div class="stat-title">Motor de datos</div>
      <div class="stat-value">MySQL</div>
    </div>
  </div>

  <h3 class="text-center mb-4 text-light fw-bold">📈 Telemetría en tiempo real</h3>
  <canvas id="telemetryChart" height="120"></canvas>

  <h3 class="text-center mt-5 mb-4 text-light fw-bold">🧩 Módulos IoT</h3>
  <div class="modules">
    <div class="module-card glass">
      <h4>📋 Gestión de registros</h4>
      <p>Administra registros de estaciones y sensores IoT con precisión.</p>
      <a href="{{ route('stations.index') }}" class="btn-glow mt-2">Abrir módulo</a>
    </div>

    <div class="module-card glass">
      <h4>⚙️ Dispositivos IoT</h4>
      <p>Configura tus ESP32, LTE o SIM7670G y supervisa su conexión.</p>
      <a href="{{ route('sensors.create') }}" class="btn-glow mt-2">Registrar dispositivo</a>
    </div>

    <div class="module-card glass">
      <h4>🔗 API Telemetría</h4>
      <p>Consulta lecturas IoT en formato JSON desde tu endpoint Laravel.</p>
      <a href="{{ route('api.telemetry') }}" target="_blank" class="btn-glow mt-2">Abrir API</a>
    </div>
  </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('telemetryChart').getContext('2d');
  const telemetryChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [
        {
          label: 'Temperatura (°C)',
          borderColor: '#f59e0b',
          backgroundColor: 'rgba(245,158,11,0.3)',
          data: [],
          tension: 0.4,
          fill: true
        },
        {
          label: 'Humedad (%)',
          borderColor: '#3b82f6',
          backgroundColor: 'rgba(59,130,246,0.3)',
          data: [],
          tension: 0.4,
          fill: true
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { labels: { color: '#e2e8f0' } }
      },
      scales: {
        x: { ticks: { color: '#e2e8f0' }, title: { display: true, text: 'Tiempo', color: '#94a3b8' }},
        y: { ticks: { color: '#e2e8f0' }, title: { display: true, text: 'Valor', color: '#94a3b8' }}
      }
    }
  });

  async function fetchTelemetry() {
    try {
      const response = await fetch('{{ route('api.telemetry') }}');
      const data = await response.json();

      telemetryChart.data.labels = data.map(d => d.timestamp);
      telemetryChart.data.datasets[0].data = data.map(d => d.temperature);
      telemetryChart.data.datasets[1].data = data.map(d => d.humidity);
      telemetryChart.update();
    } catch (error) {
      console.error('Error al cargar telemetría:', error);
    }
  }

  fetchTelemetry();
  setInterval(fetchTelemetry, 10000);
</script>
@endpush
@endsection
