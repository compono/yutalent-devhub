window.wuAfterInit = function(wu) {
	wu.Canvas.setSize(400);

	$('#add_invoice').click(function(){
		$('#invoices_list').hide();
		$('#invoice_form').show();
	});
}

var current_item = 1;

$(document).ready(function(){
	$(".datepicker").datepicker({
		dateFormat : 'yy-mm-dd'
	});

	$('#add_invoice_item').click(function(){
		$('#invoice_add_table').append(
			'<tr>'+
				'<td><input type="text" class="invoice_desc" name="invoice[item]['+current_item+'][desc]" value=""></td>'+
				'<td><input type="text" class="invoice_qty" name="invoice[item]['+current_item+'][qty]" value="1.00"></td>'+
				'<td><input type="text" class="invoice_price" name="invoice[item]['+current_item+'][price]" value="0.00"></td>'+
				'<td><span class="item_total">0.00</span></td>'+
				'<td><a href="#" class="delete_line">Delete</a></td>'+
			'</tr>'
		);

		current_item++;
	});

	$(document).on('click', '.delete_line', function(){
		$(this).closest('tr').remove();
	})

	$(document).on('change', '.invoice_qty, .invoice_price', function() {
		calculate_total($(this).closest('tr'));
	});

	$('#cancel_invoice').click(function(){
		$('#invoice_form').hide();
		$('#invoices_list').show();
	});

	$('#save_invoice').click(function(){
		$('#invoice_status').val('AUTHORISED');
		submit_invoice();
	});

	$('#save_as_draft').click(function(){
		$('#invoice_status').val('DRAFT');
		submit_invoice();
	});

	$('.download_invoice').click(function(e){
		e.preventDefault();

		//saving keys to cookies, so we will not show them in the address bar
		setCookie('xero_consumer_key', $('#xero_consumer_key').val(), 1);
		setCookie('xero_consumer_secret', $('#xero_consumer_secret').val(), 1);

		var win = window.open($(this).attr('href'), '_blank');
  		win.focus();
	});
});

function submit_invoice() {
	$.ajax({
		type : "POST",
		url : document.URL,
		data : $('#invoice_form form').serialize(),
		dataType : 'json',
		success : function(data){
			if (data.success) {
				alert('Successfully saved');
				window.location.reload();
			} else {
				alert(data.error);
			}
		}
	});
}

function calculate_total(tr) {
	var qty = toFixed($(tr).find('.invoice_qty').val(), 2);
	var price = toFixed($(tr).find('.invoice_price').val(), 2);
	var total = toFixed((qty * price), 2);

	$(tr).find('.invoice_qty').val(qty);
	$(tr).find('.invoice_price').val(price);
	$(tr).find('.item_total').html(total);
}

function toFixed(value, precision) {
	var precision = precision || 0,
	neg = value < 0,
	power = Math.pow(10, precision),
	value = Math.round(value * power),
	integral = String((neg ? Math.ceil : Math.floor)(value / power)),
	fraction = String((neg ? -value : value) % power),
	padding = new Array(Math.max(precision - fraction.length, 0) + 1).join('0');

	return precision ? integral + '.' +  padding + fraction : integral;
}