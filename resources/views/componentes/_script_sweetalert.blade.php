<!-- *** SweetAlert2 *** -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>

<script>
  // Exclusão
  $('.sa-warning').click(function(){
    let id  = $(this).data('id');
    let obj = {'_id': id};
    let deleteIt = swal2_warning("Essa ação é irreversível!");

    deleteIt.then(resolvedValue => {
      ajaxMethod('DELETE', "{{ URL::route($route) }}" , obj).then(response => {
        console.log(response);
        if(response.response === 'success') {
          swalWithReload("Sucesso!", "O registro foi removido com sucesso.", "success");
        } else {
          if( response.code == '23503' ) {
            swalWithReload("Ops!", "Essa opção está vinculada com um registro. Por favor, desfaça o vínculo antes de excluí-la!", "warning");
          } else {
            swalWithReload("Ops!", "Tivemos um problema ao remover o registro. Por favor, contate o suporte!", "error");
          }
        }
      }, error => {
        console.log(error);
      });
    },
    error => {
      swal.close();
    });
  });
</script>