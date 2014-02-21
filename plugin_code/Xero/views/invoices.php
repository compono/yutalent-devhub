<div class="content">
	<?php if (count($invoices_arr)) : ?>
		<table class="invoices" border=1>
			<tr>
				<td>Name</td>
				<td>Date</td>
				<td>Due Date</td>
				<td>Status</td>
				<td>Line Amount Types</td>
				<td>Sub Total</td>
				<td>Total Tax</td>
				<td>Total</td>
				<td>Updated Date</td>
				<td>Currency Code</td>
				<td>Fully Paid On Date</td>
				<td>Type</td>
				<td>Amount Due</td>
				<td>Amount Paid</td>
			</tr>
			<?php foreach ($invoices_arr->Invoice as $invoice) : ?>
				<tr>
					<td><?php echo (string) $invoice->Contact->Name; ?></td>
					<td><?php echo (string) $invoice->Date; ?></td>
					<td><?php echo (string) $invoice->DueDate; ?></td>
					<td><?php echo (string) $invoice->Status; ?></td>
					<td><?php echo (string) $invoice->LineAmountTypes; ?></td>
					<td><?php echo (string) $invoice->SubTotal; ?></td>
					<td><?php echo (string) $invoice->TotalTax; ?></td>
					<td><?php echo (string) $invoice->Total; ?></td>
					<td><?php echo (string) $invoice->UpdatedDateUTC; ?></td>
					<td><?php echo (string) $invoice->CurrencyCode; ?></td>
					<td><?php echo (string) $invoice->FullyPaidOnDate; ?></td>
					<td><?php echo (string) $invoice->Type; ?></td>
					<td><?php echo (string) $invoice->AmountDue; ?></td>
					<td><?php echo (string) $invoice->AmountPaid; ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php else : ?>
		<p>No invoices for this client yet.</p>
	<?php endif; ?>
</div>
