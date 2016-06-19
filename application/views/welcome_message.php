<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			/**
			 * Seçilen ile göre ajax çalışıyor...
			 */
			$('.ajaxIller').on('change', function(e){

				//seçilen il
				var il_id = $(this).val();

				//ajax işlemi post ile yapılıyor
				$.post('/ajax/get_ilceler', {il_id : il_id}, function(result){

					//gelen cevapta hata yoksa listeleme yapılıyor..
					if ( result && result.status != 'error' )
					{
						var ilceler = result.data;

						var select = '<select name="" id="" class="">';
						for( var i = 0; i < ilceler.length; i++)
						{
							select += '<option value="'+ ilceler[i].id +'">'+ ilceler[i].ilce +'</option>';
						}
						select += '</select>';

						$('div.ilceler').empty().html(select);

					}
					else
					{
						alert('Hata : ' + result.message );
					}					
				});
				
			});
		});
	</script>
</head>
<body>

<div id="container">
	<h1>Ajax - İller ve İlçeler</h1>
	<?php
	/***
	 * İller listeleniyor....
	 */
		if ( $_iller != false ):
			echo '<select name="iller" id="iller" class="ajaxIller">';
			foreach ($_iller as $item) {
				echo '<option value="'. $item->id .'">'. $item->il .'</option>';
			}
			echo '</select>';
	else:
		echo 'Kayıtlı İl Bulunamadı..!';
	endif;
	?>

	<div class="ilceler"></div>

</div>

</body>
</html>