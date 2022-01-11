function returnAll() {
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/products",
        dataType: "json",
    })
        .done(function (status) {
            let html = ''
            status.data.forEach(data => {
                change = '<tr> <td>' + data.nome_do_produto + '</td> <td>' + data.preco + '</td> <td>' + data.info + '</td><td class="table-action"><a href="javascript: void(0);" onclick="deletar(' + data.id + ')" class="action-icon" data-toggle="modal" data-target="#delete"> <i class="fa fa-trash"></i></a><a href="javascript: void(0);" class="action-icon" onclick="editar(' + data.id + ')" data-toggle="modal" data-target="#edit"> <i class="fa fa-edit"></i></a></td></tr>'
                html += change
            })
            $("#data_rows").html(html != "" ? html : "<th colspan='4' class='text-center'>Sem registros</th>")
        })
        .fail(function (error) {
            console.lo("error" + error)
        })
}
function deletar(id) {
    $("#id_product").val(id)
}

function editar(id) {
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/products/get-data/" + id,
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                $("#name_product_edit").val(response.data.nome_do_produto)
                $("#id_edit").val(response.data.id)
                $("#preco_edit").val(response.data.preco)
                $("#info_edit").html(response.data.info)
                $("#info_edit").val(response.data.info)
            }

        }
    });
}

function updateProduct() {
    $("#update_product").submit(function (e) {
        e.preventDefault()
        $.ajax({
            type: "PUT",
            url: "http://127.0.0.1:8000/api/products",
            data: $("#update_product").serialize(),
            dataType: "json",
            beforeSend: function () {
                $("#update-product").attr('disabled', true)
                $("#update-product").html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Carregando...')
            }
          })
            .done(function (status) {
                if (status.sucess == false) {
                    $("#message_update").attr('class', 'alert alert-danger')
                    $("#message_update").html(status.message)

                }
                if (status.sucess == true && status.status == 200) {
                    $("#message_old").attr('class', 'alert alert-success')
                    $("#message_old").html(status.message)
                    $("form .form-control").val("")
                    $("#edit").modal('hide')
                    setInterval(returnAll, 1000)
                }
                $("#update-product").attr('disabled', false)
                $("#update-product").html('Atualizar produtos')
            })
            .fail(function (error) {
                console.log(error)
            })
    })
}

function deleteProduct() {
    $("#delete_product").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "DELETE",
            data: $("#delete_product").serialize(),
            url: "http://127.0.0.1:8000/api/products",
            dataType: "json",
        })
        .done(function (status) {
            if (status.status == 200) {
                $("#delete").modal('hide')
                $("#message_old").attr('class', 'alert alert-success')
                $("#message_old").html("Deletado com sucesso")
                setInterval(returnAll, 1000)
            }
            if (status.sucess == false) {
                alert("Alert Error")
            }
        })
        .fail(function (error) {
            console.log(error)
        })
    })
}
function addProduct() {
    $("#add-product").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/products",
            data: $("#add-product").serialize(),
            dataType: "json",
            beforeSend: function () {
                $("#insert-product").attr('disabled', true)
                $("#insert-product").html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Carregando...')
            }
          })
            .done(function (status) {
                if (status.sucess == false) {
                    $("#message").attr('class', 'alert alert-danger')
                    $("#message").html(status.message)

                }
                if (status.sucess == true && status.status == 200) {
                    $("#message_old").attr('class', 'alert alert-success')
                    $("#message_old").html(status.message)
                    $("#add-product-send").modal('hide')
                    $("form .form-control").val("")
                    setInterval(returnAll, 1000)

                }

                $("#insert-product").attr('disabled', false)
                $("#insert-product").html('Adicionar produtos')
            })
            .fail(function (error) {
                console.log(error)
            })
    })

}


