$(document).ready(function () {

});

$("#btnCupom").click(function () {
    var valorCupom = $("#cupom").val();
    if (valorCupom == "") {
        swal(
            'Alerta',
            'Por favor, digite um cupom válido',
            'error'
        )
    } else {
        $.ajax({
            type: 'GET',
            url: "/validarCupom",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                valorCupom: valorCupom
            }, success: function (data, textStatus, jqXHR) {
                swal(
                    'Mensagem',
                    data.mensagem,
                    data.tipoMensagem
                )
                var refreshIntervalId = setInterval(function () {
                    location.reload();
                }, 2000);
            }
        });
    }


});

$("#paymentVirtual").click(function () {
    $(".offsetmenu__close__btn").trigger('click');
    $.ajax({
        type: 'GET',
        url: "/paymentVirtual",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {

        }, success: function (data, textStatus, jqXHR) {
            swal(
                'Mensagem',
                data.mensagem,
                data.tipoMensagem
            )
            var refreshIntervalId = setInterval(function () {
                location.reload();
            }, 2000);
        }
    });

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