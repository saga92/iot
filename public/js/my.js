$(document).ready(function(){
	$("#confi").click(function(){
		if($("#fpwd").val() == $("#spwd").val()){
			console.log('same');
			$.ajax({
				url: "/index/changepwd",
				type: "POST",
				data: $('#chpwdform').serialize(),
				success: function(data){
					$("#chpwdstatus").html("change password success");
				}
			});
		}else{
			console.log("not same");
			$("#chpwdstatus").html("password you input are different, try again");
		}
	});

});