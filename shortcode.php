<?php
// Add Shortcode
function wpos_custom_shortcode( $atts ) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'limit' => '5',
			'display-image' => '1',
		),
		$atts,
	);

    global $post;
    $args = array(
        'post_type'=>'portfolio', 
        'post_status'=>'publish', 
        'posts_per_page'=>$atts['limit'],
        'order'=>'ASC'
    );
    $query = new WP_Query($args);

    //start output
    $o = '<div class="wpos-folio row">';
    if($query->have_posts()):
		while($query->have_posts()): $query->the_post();
        $o .= '<div class="col-sm-6">';
        $o .= '<div data-bs-toggle="modal" data-bs-target="#staticBackdrop'. get_the_id() .'">';
        $o .= '<div class="card" style="width: 18rem; margin-bottom:1rem;">';
        if($atts['display-image']){
        $o .= '<img src="'.get_the_post_thumbnail_url(get_the_ID(),'medium').'" class="card-img-top" alt="Featured image">';
        }
        $o .= '<div class="card-body">';
        $o .= '<h5 class="card-title">'.get_the_title().'</h5>';
        $o .= '</div>
               </div>
               </div>';
        $o .= '
        <div class="modal" id="staticBackdrop'. get_the_id() .'">
         <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
           <div class="modal-header">';
            $custom_text = get_field('custom_text');
            $custom_image = get_field('image_upload');
            $o .= '
            <h5 class="modal-title" id="exampleModalLabel">'. $custom_text .'</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
           <img src="'. $custom_image .' " alt="Custom image"/>
           </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div> 
      </div> 
      </div>';
    $o .= '</div>';
        endwhile;
    else: 
        _e('Sorry, nothing to display.', 'portfolio');
    endif;
    //end output
	$o .= '</div>';

	// return output
	return $o;
}