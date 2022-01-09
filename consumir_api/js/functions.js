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
   $("#add.product").submit(function(){
       
   })
}