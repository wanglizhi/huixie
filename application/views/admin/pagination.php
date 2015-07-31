<div class="row-fluid">
	<div class="span12" style="margin-top:10px;">
		<div class="dataTables_paginate paging_bootstrap pagination">
			<ul>
				<?php 
					$current_page = $page_info['current_page'];
					$total_pages = $page_info['total_pages'];
				?>
				<?php if($total_pages>1) :?>
				<?php if($current_page>1):?>
					<li class="prev">
						<a style="margin: 0px;" href="javascript:void(0)" onclick="<?php echo $js_page_method."(".($current_page-1).")"?>">← <span class=\"hidden-480\">Prev</span></a>
					</li>
				<?php endif;?>
				<?php
					$max_page = min($total_pages,$current_page+MAX_PAGES/2);
					$min_page = max(1,$max_page-MAX_PAGES);
				?>
				<?php for($i = $min_page;$i<=$max_page;$i++):?>
					<?php if($i==$current_page):?>
						<li class="active">
							<a disabled="disabled" style="margin: 0px;" href="javascript:void(0)" onclick="<?php echo $js_page_method."(".$i.")"?>"><?=$i?></a>
						</li>
					<?else: ?>
						<li>
							<a style="margin: 0px;" href="javascript:void(0)" onclick="<?php echo $js_page_method."(".$i.")"?>"><?=$i?></a>
						</li>
					<?endif;?>
				<?php endfor;?>
				<? if($current_page+1<=$total_pages):?>
					<li class="next"><a style="margin: 0px;" href="javascript:void(0)" onclick="<?php echo $js_page_method."(".($current_page+1).")"?>"><span class="hidden-480">Next</span> → </a></li>
				<? endif;?>
				<? endif;?>
			</ul>
		</div>
	</div>
</div>