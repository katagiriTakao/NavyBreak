
//este script lo tienes que agregar a la seccion de publicaciones, y se tiene qu ecrear un botton de reto con el id  'chall'
		<script>

		$("#chall").click(function(){

			var duel='yes';
			var challenger=id_user;
			console.log(duel+'  '+challenger);
			$(this).unbind();
			$(this).html('CHALLENGE SENT');
			

		});

		$.ajax({

			type:"POST",
			url:"../programs/php/chall.php",
			data:"duel"+"challenger",
			success:function(duel,challenger){
       								console.log("success");
       							}


		});


		</script>

