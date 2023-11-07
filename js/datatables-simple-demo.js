window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});

// $(document).ready(function () {
//     $('#example').DataTable({
//         scrollY: '200px',
//         scrollCollapse: true,
//         paging: false,
//     });
// });

// window.addEventListener('DOMContentLoaded', event => {
//     // Simple-DataTables
//     // https://github.com/fiduswriter/Simple-DataTables/wiki

//     const datatablesSimple2 = document.getElementById('datatablesSimple2');
//     if (datatablesSimple2) {
//         new simpleDatatables.DataTable(datatablesSimple2);
//     }
// });
