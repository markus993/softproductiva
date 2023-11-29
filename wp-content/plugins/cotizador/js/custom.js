$ = jQuery;
$().ready(function() {

	modeloChange('');

	$('#adjuntos').MultiFile({
		list: '#file-list'
	});

	$('#modelo').on('change', function() {
		modeloChange(this.value);
	});

	function modeloChange(selected){
		modelos = $("div").find(`[data-parent="modelo"]`);
		modelos.each(function( index ) {
			$fields = $( this ).find('input[type=text], input[type=radio], input[type=checkbox], select, textarea');
			$select = $( this ).find('select');
			if ($( this ).data('show-values') == selected) {
				$( this ).show("slow");
				$fields.prop( "disabled", false );
				$fields.prop( "required", true );
				$container = $( this );
				$select.on('change', function() {
					actualizarValor($container);
				});
			}else{
				$select.unbind( "change" );
				$( this ).hide("slow");
				$fields.prop( "disabled", true );
				$fields.prop( "required", false );
			}
		});
	}

	function actualizarValor($select){
		valor = 0;
		$option = $select.find('option:selected')
		$option.each(function( index ) {
			valor = valor + parseInt($( this ).data('value'));
			console.log( valor );
			total = new Intl.NumberFormat('en-US', { maximumSignificantDigits: 10 }).format(
				valor,
			);
			$('#total').val('USD $'+total);
		});
	}

	$('#fg-form').on('submit', function(event) {
		event.preventDefault();
		if ($("#fg-form")[0].checkValidity()){
			$('#total').prop( "disabled", false );
			let data = new FormData($("#fg-form")[0]);
			$('#total').prop( "disabled", true );
			$.ajax({
				url : custom_js.ajax_url,
				method: 'POST',
				type: 'POST', // For jQuery < 1.9
				data : data,
				processData: false,
				contentType: false,
				success: function(response) {
					var json = $.parseJSON(response);
					if (json.success) {
						$('#confirmacionModal').modal('show');
					}
					console.log(json);
				}
			});
		} else {
			$("#fg-form")[0].reportValidity()
		}
	});

	$('#close').on('click', function() {
		window.location.reload();
	});

	$("#fg-form").validate();
});
