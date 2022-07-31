// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable({
    order: [
      [0, 'desc']
    ],

  });

  $('#laporan').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'pdfHtml5',
        orientation: 'landscape',
        pageSize: 'TABLOID',
      }
    ]

  });

});
