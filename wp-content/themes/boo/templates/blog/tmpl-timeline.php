<?php

$format = get_post_format();

if( 'audio' === $format ) {
	$this->entry_thumbnail();
}
elseif( 'video' === $format ) {
?>
<div class="post-video">
	<?php $this->entry_thumbnail() ?>
    <?php
	
		$time_string = '<time class="published updated" datetime="%1$s">%2$s</time>';
			printf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date( get_option( 'date_time' ) )
			);
    
	?>

</div>
<?php
}
elseif( 'link' !== $format ) {
?>
<figure class="post-image hmedia">
    <?php $this->entry_thumbnail( 'rella-timeline-blog' ) ?>
    
    <?php
	
		$time_string = '<time class="published updated" datetime="%1$s">%2$s</time>';
			printf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date( get_option( 'date_time' ) )
			);
    
	?>
    
</figure>
<?php
}
?>
<div class="post-contents">

    <header>

		<?php $this->entry_title() ?>

        <div class="post-info">
		<?php

			$this->entry_tags( 'span' );

			$time_string = '<span><time class="published updated" datetime="%1$s">%2$s</time></span>';
			printf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date( get_option( 'date_time' ) )
			);

			$this->entry_author();
		?>
        </div>

    </header>

	<?php $this->entry_content() ?>

</div>
