<?php if (empty($content)): ?>
	<div class="mt-4">
	<?php $language->p('No pages found') ?>
	</div>
<?php endif ?>

<div class="container mt-4"> <!-- Content Container HOME -->
        <div class="row">
            
        <div class="col-md-4">

        <?php include(THEME_DIR_PHP.'sidebar.php'); ?>
        
        <br/>
        
		<?php
			$items = getCategories();

			foreach ($items as $category) {
				// Each category is an Category-Object
				if (count($category->pages())>0) { ?>
					<a href="<?php echo $category->permalink(); ?>" class="list-group-item list-group-item-action">
						<?php echo $category->name(); ?>
						<span class="badge badge-primary badge-pill float-left"><?php echo count($category->pages()); ?></span>
					</a>
		<?php } } ?>

        <br/>
		
		</div>

        <div class="col-md-8">
			<!-- Post -->
			<?php foreach ($content as $page): ?>
            
			<!-- Load Bludit Plugins: Page Begin -->
			<?php Theme::plugins('pageBegin'); ?>
            
			<div class="card mt-2">
				<div class="card-header"><?php echo $page->category(); ?></div>
				<img src="" alt="">
				<div class="card-body">
					<div class="card-title">
					    <!-- <h3 class="text-primary"><?php #echo $page->title(); ?></h3> -->
						<h3><a href="<?php echo $page->permalink(); ?>" class="text-primary"><?php echo $page->title(); ?></a></h3>
					</div>
					<br>
					<!-- <p class="text-info card-subtitle mb-3"><?php #echo $page->date(); ?> - <?php #echo $L->get('Reading time') . ': ' . $page->readingTime(); ?></p> -->
					<div class="card-text">
						<?php //echo (substr(($page->contentBreak()),0, 200)." ... "); ?>
				        <?php
                            if(strlen($page->description())>0 ){
                                echo $page->description();
                            } else {
                                $max = 333;
                                $all = explode(' ', substr($page->content(false), 0, $max));
                                array_pop($all);
                                echo implode(' ', $all);
                                if (strlen($page->content(false)) > $max) {
                                    echo " ... "; } } ?>
					</div>
					<a href="<?php echo $page->permalink(); ?>" class="btn btn-primary float-right"><?php echo $L->get('read-more'); ?></a>
				</div>
			</div>
			<?php Theme::plugins('pageEnd'); ?>
			<?php endforeach ?>
			<br/>
            <div class="container text-center">
            <?php if (Paginator::numberOfPages()>1): ?>
            <nav class="paginator">
            	<ul class="pagination flex-wrap">
            
            		<!-- Previous button -->
            		<?php if (Paginator::showPrev()): ?>
            		<li>
            			<a class="page-link" href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1"><?php echo $L->get('Previous'); ?></a>
            		</li>
            		<?php endif; ?>
            
            		<!-- Home button -->
            		<li>
            			<a class="page-link" href="<?php echo Theme::siteUrl() ?>"><?php echo $L->get('Home'); ?></a>
            		</li>
            
            		<!-- Next button -->
            		<?php if (Paginator::showNext()): ?>
            		<li>
            			<a class="page-link" href="<?php echo Paginator::nextPageUrl() ?>"><?php echo $L->get('Next'); ?></a>
            		</li>
            		<?php endif; ?>
            
            	</ul>
            </nav>
            <?php endif ?>
            </div>

        </div>
        
    </div>
</div> <!-- END Content Container HOME -->

<!-- Pagination -->
