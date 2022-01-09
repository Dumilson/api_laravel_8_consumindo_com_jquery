function returnAll(){
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/products",
        dataType: "json",
    })
    .done(function(status){
        let html = ''

        status.data.forEach(data => {
            change = '<tr> <td>'+data.nome_do_produto+'</td> <td>'+data.preco+'</td> <td>'+data.info+'</td><td class="table-action"><a href="javascript: void(0);" class="action-icon"> <i class="fa fa-trash"></i></a><a href="javascript: void(0);" class="action-icon"> <i class="fa fa-edit"></i></a></td></tr>'
            html += change
            $("#data_rows").html(html != "" ? html : "<th colspan='4'>Sem registros</th>")
        })
    })

    .fail(function(error){
        console.lo("error" + error)
    }) 
}

function addProduct(){
   $("#add-product").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/products",
            data: $("#add-product").serialize(),
            dataType: "json",
            beforeSend: function() {
                $("#insert-product").attr('disabled', true)
                $("#insert-product").html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Carregando...')
            }
        })
        .done(function(status){
            console.log(status)
            if(status.sucess == false){
                $("#message").attr('class','alert alert-danger')
                $("#message").html(status.message) 
                
             }
            if(status.sucess == true && status.status == 200){
                $("#message").attr('class','alert alert-success')
                $("#message").html(status.message) 
                $("form .form-control").val("")
                setInterval(returnAll, 1000)

            }

            $("#insert-product").attr('disabled', false)
            $("#insert-product").html('Adicionar produtos')
        })
        .fail(function(error){
            console.log(error)
        })
   })
}