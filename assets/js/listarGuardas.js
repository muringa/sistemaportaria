$(document).ready(function(){
	$.ajax({
		url:"guardas.php",
		data:{acao:'listar'},
		type:"POST",
		success: function(data){
			$("#divLista").html(data);
		}
	});
});

$(document).on("click",".excluir",function(){
	if(confirm("Tem certeza de que deseja excluir o guarda?")){
		var id = $(this).attr("id");
		$.ajax({
			url:"guardas.php",
			data:{acao:'excluir',rg:id},
			type:"POST",
			success: function(data){
				$("#divLista").html(data);
			}
		});
	}
});