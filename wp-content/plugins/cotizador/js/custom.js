$ = jQuery;
$().ready(function() {

	jQuery.validator.setDefaults({
		debug: true,
		success: "valid"
	});
	modeloChange('');

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


	$('#submit').on('click', function(event) {
		$('#total').prop( "disabled", false );
		items = $("#fg-form").serializeArray();
		$('#total').prop( "disabled", true );
    var data_array = new Array();
		$(items).each(function(){
			item = $("input[name='"+this.name+"'],select[name='"+this.name+"'] option:selected");
			console.info(item);
			var item_array = {};
			if (typeof item.data('value') !== "undefined") {
				item_array['data-value'] = item.data('value');
			}
			if (typeof item.attr("name") !== "undefined") {
				item_array['name'] = item.attr("name");
			}else{
				item_array['name'] = item.parent().attr("name");
			}
			item_array['value'] = item.val();
			data_array.push(item_array);
		});
		console.log(custom_js);
		jQuery.ajax({
			type : "post",
			dataType : "json",
			url : custom_js.ajax_url,
			data : {action: "crea_cotizacion_tesla", data : data_array},
			success: function(response) {
				console.log(response);
				if (Number.isInteger(response)) {

				}
			}
		});
	});

	$("#fg-form").validate();
});
