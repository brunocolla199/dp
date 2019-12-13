<!-- *** DataTable *** -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>

<!-- start - This is for export functionality only -->
<script src="{{ asset('js/dataTables/dataTables-1.2.2.buttons.min.js') }}"></script>
<script src="{{ asset('js/dataTables/buttons-1.2.2.flash.min.js') }}"></script>
<script src="{{ asset('js/dataTables/jszip-2.5.0.min.js') }}"></script>
<script src="{{ asset('js/dataTables/pdfmake-0.1.18.min.js') }}"></script>
<script src="{{ asset('js/dataTables/vfs_fonts-0.1.18.js') }}"></script>
<script src="{{ asset('js/dataTables/buttons-1.2.2.html5.min.js') }}"></script>
<script src="{{ asset('js/dataTables/buttons-1.2.2.print.min.js') }}"></script>
<!-- end - This is for export functionality only -->

<script>
  let tableId = "{{ $tableId }}";
  let reportTitle = "{{ $reportTitle ?? env('APP_NAME')}}";

  $(document).ready(function() {
    $("#" + tableId).DataTable({
      "pageLength": 30,
      "language": {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Nenhum registro encontrado",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
          "sNext": "Próximo",
          "sPrevious": "Anterior",
          "sFirst": "Primeiro",
          "sLast": "Último"
        },
        "oAria": {
          "sSortAscending": ": Ordenar colunas de forma ascendente",
          "sSortDescending": ": Ordenar colunas de forma descendente"
        }
      },
      dom: 'Bfrtip',
      buttons: [
        { 
          extend: 'excel',  
          text: 'Excel',
          title: reportTitle,
          exportOptions: {
            columns: "thead th:not(.noExport)"
          }  
        },
        { 
          extend: 'pdf',
          text: 'PDF',
          title: reportTitle,
          exportOptions: {
            // columns: [ 0, 1]
            columns: "thead th:not(.noExport)"
          } 
        },
        { 
          extend: 'print',  
          text: 'Imprimir',
          title: reportTitle,
          exportOptions: {
            columns: "thead th:not(.noExport)"
          } 
        }
      ]
    });
  });
</script>