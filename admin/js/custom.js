window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    const datatablesSimple2 = document.getElementById('datatablesSimple2');

    
    if (datatablesSimple && datatablesSimple2) {
        new simpleDatatables.DataTable(datatablesSimple);
        new simpleDatatables.DataTable(datatablesSimple2);
    }
});