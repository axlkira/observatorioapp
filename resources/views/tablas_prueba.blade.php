@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Prueba de Tablas Dinámicas Alternativas</h2>
    <p>Ejemplo usando los mismos datos de usuarios gestionados (simulados para demo):</p>
    <hr>

    <h4>Tabulator</h4>
    <div id="tabulator-table"></div>
    <hr>

    <h4>Grid.js</h4>
    <div id="gridjs-table"></div>
    <hr>

    <h4>Bootstrap Table</h4>
    <table id="bootstrap-table" class="table table-bordered table-hover"></table>
    <hr>

    <h4>Simple-DataTables</h4>
    <table id="simple-datatables-table" class="table table-bordered table-hover"></table>
    <hr>

    <h4>AG Grid (Community)</h4>
    <div id="aggrid-table" class="ag-theme-alpine" style="height: 300px; width: 100%"></div>
    <hr>

    <h4>Handsontable (tipo Excel)</h4>
    <div id="handsontable-table" style="width: 100%; max-width: 600px;"></div>
</div>
@endsection

@section('scripts')
<!-- TABULATOR -->
<link href="https://unpkg.com/tabulator-tables@5.5.2/dist/css/tabulator.min.css" rel="stylesheet">
<script src="https://unpkg.com/tabulator-tables@5.5.2/dist/js/tabulator.min.js"></script>

<!-- GRID.JS -->
<link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
<script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>

<!-- BOOTSTRAP TABLE -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>

<!-- SIMPLE-DATATABLES -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" />
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" ></script>

<!-- AG GRID -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community/styles/ag-grid.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community/styles/ag-theme-alpine.css" />
<script src="https://cdn.jsdelivr.net/npm/ag-grid-community/dist/ag-grid-community.min.noStyle.js"></script>

<!-- HANDSONTABLE -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css" />
<script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

<script>
// Datos de ejemplo (puedes reemplazar por datos reales si lo deseas)
const usuarios = [
    { tipo_documento: '3', numero_documento: '111' },
    { tipo_documento: '3', numero_documento: '222' },
    { tipo_documento: '3', numero_documento: '555' },
    { tipo_documento: '4', numero_documento: '111' }
];

// TABULATOR
new Tabulator("#tabulator-table", {
    data: usuarios,
    layout: "fitColumns",
    responsiveLayout: "collapse",
    columns: [
        {title: "Tipo de documento", field: "tipo_documento"},
        {title: "Número de documento", field: "numero_documento"},
    ],
    pagination: "local",
    paginationSize: 5,
    movableColumns: true,
    langs: {
        "es-es": {
            "pagination": {"first": "Primero", "last": "Último", "prev": "Anterior", "next": "Siguiente"},
            "groups": {"item": "elemento", "items": "elementos"},
            "columns": {"showAll": "Mostrar Todo"}
        }
    },
    locale: "es-es"
});

// GRID.JS
new gridjs.Grid({
    columns: ["Tipo de documento", "Número de documento"],
    data: usuarios.map(u => [u.tipo_documento, u.numero_documento]),
    search: true,
    pagination: { limit: 5 },
    sort: true,
    language: {
        'search': { 'placeholder': 'Buscar...' },
        'pagination': {
            'previous': 'Anterior',
            'next': 'Siguiente',
            'showing': 'Mostrando',
            'results': () => 'registros'
        }
    }
}).render(document.getElementById("gridjs-table"));

// BOOTSTRAP TABLE
$('#bootstrap-table').bootstrapTable({
    columns: [
        { field: 'tipo_documento', title: 'Tipo de documento' },
        { field: 'numero_documento', title: 'Número de documento' }
    ],
    data: usuarios,
    search: true,
    pagination: true,
    pageSize: 5,
    locale: 'es-ES'
});

// SIMPLE-DATATABLES
const simpleTable = document.querySelector('#simple-datatables-table');
simpleTable.innerHTML = `<thead><tr><th>Tipo de documento</th><th>Número de documento</th></tr></thead><tbody>${usuarios.map(u => `<tr><td>${u.tipo_documento}</td><td>${u.numero_documento}</td></tr>`).join('')}</tbody>`;
new simpleDatatables.DataTable(simpleTable, { labels: { placeholder: 'Buscar...', perPage: 'Registros por página', noRows: 'Sin resultados', info: 'Mostrando {start} a {end} de {rows} registros' } });

// AG GRID
const agGridOptions = {
    columnDefs: [
        { headerName: 'Tipo de documento', field: 'tipo_documento', sortable: true, filter: true },
        { headerName: 'Número de documento', field: 'numero_documento', sortable: true, filter: true }
    ],
    rowData: usuarios,
    pagination: true,
    paginationPageSize: 5,
    domLayout: 'normal',
    localeText: {
        page: 'Página',
        more: 'más',
        to: 'a',
        of: 'de',
        next: 'Siguiente',
        last: 'Último',
        first: 'Primero',
        previous: 'Anterior',
        loadingOoo: 'Cargando...',
    }
};
setTimeout(() => {
  new agGrid.Grid(document.getElementById('aggrid-table'), agGridOptions);
}, 100);

// HANDSONTABLE
const hotContainer = document.getElementById('handsontable-table');
setTimeout(() => {
  new Handsontable(hotContainer, {
      data: usuarios.map(u => [u.tipo_documento, u.numero_documento]),
      colHeaders: ['Tipo de documento', 'Número de documento'],
      rowHeaders: true,
      filters: true,
      dropdownMenu: true,
      licenseKey: 'non-commercial-and-evaluation',
      language: 'es-MX',
      height: 200,
      width: 600
  });
}, 100);
</script>
@endsection
