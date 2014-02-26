<div class="content">
	<?php if (count($invoices_arr)) : ?>
		<div id="invoices_list">
			<input type="button" id="add_invoice" value="Add invoice" />
			<table class="invoices" border=1>
				<tr>
					<td>Download</td>
					<td>Date</td>
					<td>Due Date</td>
					<td>Status</td>
					<td>Amount Due</td>
					<td>Amount Paid</td>
				</tr>
				<?php foreach ($invoices_arr->Invoice as $invoice) : ?>
					<?php $currency_code = (string) $invoice->CurrencyCode; ?>
					<tr>
						<td><a href="xdownload_pdf.php?invoice_id=<?php echo (string) $invoice->InvoiceID; ?>" class="download_invoice">Download</a></td>
						<td><?php echo date('j M, Y', strtotime((string) $invoice->Date)); ?></td>
						<td><?php echo date('j M, Y', strtotime((string) $invoice->DueDate)); ?></td>
						<td><?php echo (string) $invoice->Status; ?></td>
						<td><?php echo get_currency_symbol($currency_code) . (string) $invoice->AmountDue; ?></td>
						<td><?php echo get_currency_symbol($currency_code) . (string) $invoice->AmountPaid; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	<?php else : ?>
		<p>No invoices for this client yet.</p>
	<?php endif; ?>
</div>
<div id="invoice_form">
	<h2>Create an invoice</h2>
	<form method="post">
		<input type="hidden" id="invoice_status" name=invoice[status] value="DRAFT" />
		<label for="invoice_to">To</label>
		<input type="text" id="invoice_to" name="invoice[to_name]" disabled="disabled" value="<?php echo $xero_contact_name; ?>">
		<input type="hidden" name="invoice[to_id]" value="<?php echo $xero_contact_id; ?>">
		<label for="issued_date">Date</label>
		<input type="text" id="issued_date" class="datepicker" name="invoice[date]" value="" required>
		<label for="due_date">Due Date</label>
		<input type="text" id="due_date" class="datepicker" name="invoice[due_date]" value="" required>
		<label for="invoice_type">Type</label>
		<select id="invoice_type" name="invoice[type]" required>
			<option value="ACCREC">Sales invoice</option>
			<option value="ACCPAY">Bill</option>
		</select>
		<!-- <label for="invoice_account">Account</label>
		<select id="invoice_account" name="invoice[account]" required> -->
			<?php //foreach ($accounts->Accounts->Account as $account) : ?>
				<!-- <option value="<?php //echo $account->AccountID; ?>"><?php //echo $account->Name; ?></option> -->
			<?php //endforeach; ?>
		<!-- </select> -->
		<table class="invoices" id="invoice_add_table">
			<tr>
				<td>Item Description</td>
				<td>Qty</td>
				<td>Price</td>
				<td>Total</td>
				<td></td>
			</tr>
			<tr>
				<td><input type="text" class="invoice_desc" name="invoice[item][0][desc]" value="" required></td>
				<td><input type="text" class="invoice_qty" name="invoice[item][0][qty]" value="1.00" required></td>
				<td><input type="text" class="invoice_price" name="invoice[item][0][price]" value="0.00" required></td>
				<td><span class="item_total">0.00</span></td>
				<td><a href="#" class="delete_line">Delete</a></td>
			</tr>
		</table>
		<input type="button" id="add_invoice_item" value="Add item" />
		<input type="button" id="cancel_invoice" value="Cancel">
		<!-- <input type="button" id="save_invoice" value="Save invoice"> -->
		<input type="button" id="save_as_draft" value="Save as draft">
	</form>
</div>
