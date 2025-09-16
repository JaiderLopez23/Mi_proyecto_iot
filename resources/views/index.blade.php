@extends('layout.app')

@section('title', 'Home')

@section('content')

  <!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel — Tablas • Gráficas • Formulario • Registrar</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg:#0f1724; --card:#0b1220; --accent:#7c3aed; --muted:#94a3b8; --glass:rgba(255,255,255,0.03);
      --glass-strong:rgba(255,255,255,0.04);
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;background:linear-gradient(180deg,#071027 0%, var(--bg) 100%);color:#e6eef8}
    .container{max-width:1100px;margin:28px auto;padding:20px}
    .card{background:linear-gradient(180deg,var(--card), rgba(10,14,23,0.8));border-radius:12px;padding:18px;box-shadow:0 6px 18px rgba(2,6,23,0.6)}
    header{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px}
    .brand{display:flex;align-items:center;gap:12px}
    .logo{width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,var(--accent),#4c1d95);display:flex;align-items:center;justify-content:center;font-weight:700}
    .title{font-size:18px;font-weight:700}
    .subtitle{font-size:12px;color:var(--muted)}

    /* top buttons */
    .topbar{display:flex;gap:8px;flex-wrap:wrap}
    .btn{background:var(--glass);border:1px solid rgba(255,255,255,0.04);padding:10px 14px;border-radius:8px;cursor:pointer;color:inherit;font-weight:600}
    .btn.primary{background:linear-gradient(90deg,var(--accent),#5b21b6);box-shadow:0 6px 20px rgba(92,33,182,0.18)}
    .btn:active{transform:translateY(1px)}

    main{display:grid;grid-template-columns:1fr;gap:14px;margin-top:12px}

    /* sections */
    .section{display:none;padding:12px;border-radius:8px;background:var(--glass-strong)}
    .section.active{display:block}

    /* table */
    table{width:100%;border-collapse:collapse}
    th,td{padding:10px;text-align:left;border-bottom:1px dashed rgba(255,255,255,0.03);font-size:14px}
    th{color:var(--muted);font-weight:600}

    /* form */
    .form-row{display:flex;gap:10px;flex-wrap:wrap}
    .field{flex:1;min-width:160px}
    input,textarea,select{width:100%;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:inherit}
    label{display:block;font-size:13px;color:var(--muted);margin-bottom:6px}

    footer{margin-top:12px;color:var(--muted);font-size:13px;text-align:center}

    @media(min-width:900px){main{grid-template-columns:1fr 420px}}

    /* small helper */
    .small{font-size:13px;color:var(--muted)}
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <header>
        <div class="brand">
          <div class="logo">PD</div>
          <div>
            <div class="title">Panel de control</div>
            <div class="subtitle">Tablas • Gráficas • Formulario • Registrar datos</div>
          </div>
        </div>
        <div class="topbar">
          <button class="btn" data-view="table">Tablas</button>
          <button class="btn" data-view="charts">Gráficas</button>
          <button class="btn" data-view="form">Formulario</button>
          <button id="btn-registrar" class="btn primary" data-view="register">Registrar datos</button>
        </div>
      </header>

      <main>
        <!-- Left column: content that switches -->
        <div>
          <section id="section-table" class="section active">
            <h3>Tabla de registros</h3>
            <p class="small">Los datos guardados aparecen aquí. Usa el formulario para agregar registros.</p>
            <div style="overflow:auto;margin-top:12px">
              <table id="data-table">
                <thead>
                  <tr><th>Nombre</th><th>Email</th><th>Edad</th><th>Fecha</th><th>Acciones</th></tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </section>

          <section id="section-charts" class="section">
            <h3>Gráficas</h3>
            <p class="small">Gráficas básicas que se actualizan con los datos guardados.</p>
            <div style="display:grid;grid-template-columns:1fr;gap:12px;margin-top:12px">
              <canvas id="chart-age" height="160"></canvas>
              <canvas id="chart-count" height="160"></canvas>
            </div>
          </section>

          <section id="section-form" class="section">
            <h3>Formulario</h3>
            <p class="small">Completa y presiona "Registrar" para agregar el registro a la tabla y guardarlo en localStorage.</p>
            <div style="margin-top:12px">
              <div class="form-row">
                <div class="field">
                  <label for="name">Nombre</label>
                  <input id="name" placeholder="Juan Pérez" />
                </div>
                <div class="field">
                  <label for="email">Email</label>
                  <input id="email" type="email" placeholder="juan@ejemplo.com" />
                </div>
                <div class="field">
                  <label for="age">Edad</label>
                  <input id="age" type="number" min="0" placeholder="25" />
                </div>
              </div>
              <div style="margin-top:10px;display:flex;gap:8px">
                <button id="btn-save" class="btn primary">Registrar</button>
                <button id="btn-clear" class="btn">Limpiar formulario</button>
              </div>
            </div>
          </section>
        </div>

        <!-- Right column: quick info / help -->
        <aside>
          <section class="section active" style="display:block">
            <h4>Resumen</h4>
            <p class="small">Total registros: <span id="total-count">0</span></p>
            <p class="small" style="margin-top:10px">Último registro: <span id="last-record">—</span></p>
            <div style="margin-top:14px">
              <button id="export-csv" class="btn">Exportar CSV</button>
              <button id="clear-storage" class="btn">Borrar todo</button>
            </div>
          </section>
        </aside>
      </main>

      <footer>Panel simple • Datos guardados en <strong>localStorage</strong></footer>
    </div>
  </div>

  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // --- Utils for localStorage ---
    const STORAGE_KEY = 'panel.registros.v1';
    function loadData(){
      try{const raw = localStorage.getItem(STORAGE_KEY); return raw? JSON.parse(raw): []}catch(e){return []}
    }
    function saveData(data){localStorage.setItem(STORAGE_KEY, JSON.stringify(data))}

    // --- DOM ---
    const sections = document.querySelectorAll('.section');
    const buttons = document.querySelectorAll('.topbar .btn');
    buttons.forEach(b=>b.addEventListener('click', ()=>{
      const view = b.dataset.view;
      showSection(view);
    }));

    function showSection(name){
      document.querySelectorAll('.section').forEach(s=>s.classList.remove('active'));
      const el = document.getElementById('section-'+name);
      if(el) el.classList.add('active');
    }

    // Table handling
    const tbody = document.querySelector('#data-table tbody');
    function renderTable(){
      const data = loadData();
      tbody.innerHTML = '';
      data.forEach((r, i)=>{
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${escapeHtml(r.name)}</td><td>${escapeHtml(r.email)}</td><td>${r.age ?? ''}</td><td>${r.date}</td><td><button data-index="${i}" class="btn">Eliminar</button></td>`;
        tbody.appendChild(tr);
      });
      document.getElementById('total-count').textContent = data.length;
      document.getElementById('last-record').textContent = data.length? data[data.length-1].name + ' ('+data[data.length-1].date+')' : '—';
      // attach delete
      tbody.querySelectorAll('button[data-index]').forEach(btn=>btn.addEventListener('click', ()=>{
        const idx = Number(btn.dataset.index); deleteRecord(idx);
      }));
    }

    function deleteRecord(index){
      const arr = loadData(); arr.splice(index,1); saveData(arr); renderTable(); updateCharts();
    }

    // Form
    const inName = document.getElementById('name');
    const inEmail = document.getElementById('email');
    const inAge = document.getElementById('age');
    document.getElementById('btn-save').addEventListener('click', ()=>{
      const name = inName.value.trim(); const email = inEmail.value.trim(); const age = Number(inAge.value) || null;
      if(!name || !email){alert('Nombre y email son obligatorios'); return}
      const arr = loadData();
      const now = new Date();
      arr.push({name, email, age, date: now.toLocaleString()});
      saveData(arr); renderTable(); updateCharts(); clearForm();
      // switch to table view to show the new record
      showSection('table');
    });
    document.getElementById('btn-clear').addEventListener('click', clearForm);
    function clearForm(){ inName.value=''; inEmail.value=''; inAge.value=''; }

    // Export CSV
    document.getElementById('export-csv').addEventListener('click', ()=>{
      const data = loadData();
      if(!data.length){alert('No hay datos para exportar'); return}
      const csv = [ ['Nombre','Email','Edad','Fecha'].join(',') ].concat(data.map(r=>[escCsv(r.name),escCsv(r.email),r.age||'',escCsv(r.date)].join(','))).join('\n');
      const blob = new Blob([csv], {type:'text/csv;charset=utf-8;'});
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a'); a.href = url; a.download = 'registros.csv'; document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url);
    });

    // Clear storage
    document.getElementById('clear-storage').addEventListener('click', ()=>{
      if(confirm('¿Borrar todos los registros?')){ localStorage.removeItem(STORAGE_KEY); renderTable(); updateCharts(); }
    });

    // small helpers
    function escapeHtml(str){ return String(str).replace(/[&<>"']/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\'':'&#39;'}[c])); }
    function escCsv(s){ if(s==null) return ''; return '"' + String(s).replace(/"/g,'""') + '"'; }

    // --- Charts ---
    let chartAge = null, chartCount = null;
    function buildCharts(){
      const ctxA = document.getElementById('chart-age').getContext('2d');
      const ctxC = document.getElementById('chart-count').getContext('2d');
      chartAge = new Chart(ctxA, {type:'bar', data:{labels:[], datasets:[{label:'Distribución de edades', data:[]}]}, options:{responsive:true, maintainAspectRatio:false}});
      chartCount = new Chart(ctxC, {type:'line', data:{labels:[], datasets:[{label:'Registros en el tiempo', data:[], tension:0.3, fill:true}]}, options:{responsive:true, maintainAspectRatio:false}});
    }

    function updateCharts(){
      const data = loadData();
      // age distribution
      const ages = {};
      data.forEach(r=>{ const a = r.age==null? 'N/A': String(r.age); ages[a] = (ages[a]||0)+1 });
      const labels = Object.keys(ages);
      const values = labels.map(l=>ages[l]);
      if(chartAge){ chartAge.data.labels = labels; chartAge.data.datasets[0].data = values; chartAge.update(); }
      // count over time (by index)
      const labels2 = data.map((r,i)=>i+1);
      const values2 = data.map((r,i)=>i+1);
      if(chartCount){ chartCount.data.labels = labels2; chartCount.data.datasets[0].data = values2; chartCount.update(); }
    }

    // init
    buildCharts(); renderTable(); updateCharts();

    // helper to handle initial view selection for "register" button
    document.getElementById('btn-registrar').addEventListener('click', ()=>{
      showSection('form');
    });

    // small accessibility: allow switching via keyboard numbers 1-4
    window.addEventListener('keydown', (e)=>{
      if(e.key==='1') showSection('table');
      if(e.key==='2') showSection('charts');
      if(e.key==='3') showSection('form');
      if(e.key==='4') showSection('register');
    });
  </script>
</body>
</html>

@endsection