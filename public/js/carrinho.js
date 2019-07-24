$(document).ready(function () {

});

function removerItem(carrinhoId, pedidoId, nomeProduto) {
    $(".offsetmenu__close__btn").trigger('click');
    swal({
        title: 'Você tem certeza que deseja excluir ' + nomeProduto + ' do seu carrinho?',
        text: "Essa ação não poderá ser desfeita!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, eu desejo!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: "/removerItem",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    carrinhoId: carrinhoId,
                    pedidoId: pedidoId
                }, success: function (data, textStatus, jqXHR) {
                    swal(
                        'Deletado!',
                        'O item foi deletado!',
                        'success'
                    )
                    var refreshIntervalId = setInterval(function () {
                        location.reload();
                    }, 2000);
                }
            });

        }
    })
}