<div class="container">
	<?php if (@$broadcast): ?>
	<div class="abt-title mb-70 text-center">
	    <h2> <i class="fa fa-bullhorn"></i> Pemberitahuan</h2>      
	</div>
    <div class="rs-timeline">
    	<div class="rs-timeline-block">
    		<div class="rs-timeline-content">
    			<h4>  <br><br> <?= $broadcast ?></h4>
    			<span class="rs-date">14 Desember 2022 07:30:00</span>
    		</div>
    	</div>
    </div>
	<?php else: ?>
	<div class="abt-title mb-70 text-center">
	    <h4>Tidak ada pemberitahuan</h4>      
	</div>
    <div class="rs-timeline">
    	<div class="rs-timeline-block">
    		
    	</div>
    </div>
	<?php endif ?>
</div>