function test(){
	$.ajax({
		type:'POST',
		url:'controllor/test',
		data:{
			id:"123"
		},
		success:function(data){
			alert(data);
		}
	});
	return ;
}