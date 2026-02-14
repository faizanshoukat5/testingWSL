<div class="row mt-2">
	<div class="col-md-5">
		<div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
			<?php
			$start = $offset + 1;
			$end = min($offset + $limit, $totalRecords);
			echo "Showing $start to $end of $totalRecords entries";
			?>
		</div>
	</div>
	<div class="col-md-7">
		<ul class="pagination float-right">
			<?php
			// Previous button
			if ($page > 1) {
				echo '<li style="cursor: pointer;" class="paginate_button page-item previous" onclick="viewClientsFilter('.($page - 1).');"><span class="page-link">Previous</span></li>';
			} else {
				echo '<li class="paginate_button page-item previous disabled"><span class="page-link">Previous</span></li>';
			}
			// Maximum number of pages around the current page
			$range = 1;
			// Always display the first and last few pages
			$startRange = max(4, $page - $range); 
			$endRange = min($totalPages - 3, $page + $range);
			// Show first three pages
			$i=1;
			for ($i = 1; $i <= 3; $i++) {
				if ($i > $totalPages) break;
				$active = $i == $page ? 'active' : '';
				echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilter('.$i.');"><span class="page-link">'.$i.'</span></li>';
			}
			// Ellipsis before the middle range
			if ($startRange > 4) {
				echo '<li class="paginate_button page-item disabled"><span class="page-link">...</span></li>';
			}
			// Pages around the current page
			for ($i = $startRange; $i <= $endRange; $i++) {
				if ($i > $totalPages || $i < 4) continue;
				$active = $i == $page ? 'active' : '';
				echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilter('.$i.');"><span class="page-link">'.$i.'</span></li>';
			}
			// Ellipsis after the middle range
			if ($endRange < $totalPages - 3) {
				echo '<li class="paginate_button page-item disabled"><span class="page-link">...</span></li>';
			}
			// Show last three pages
			for ($i = max($totalPages - 2, 4); $i <= $totalPages; $i++) {
				$active = $i == $page ? 'active' : '';
				echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilter('.$i.');"><span class="page-link">'.$i.'</span></li>';
			}
			// Next button
			if ($page < $totalPages) {
				echo '<li style="cursor: pointer;" class="paginate_button page-item next" onclick="viewClientsFilter('.($page + 1).');"><span class="page-link">Next</span></li>';
			} else {
				echo '<li class="paginate_button page-item next disabled"><span class="page-link">Next</span></li>';
			}
			?>
		</ul>
	</div>
</div>