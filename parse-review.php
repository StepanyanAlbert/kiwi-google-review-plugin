<?php
wp_enqueue_style( 'review-style', plugins_url( '/views/css/style.css', __FILE__ ), [], '' );
wp_enqueue_script( 'review-script', plugins_url( '/views/js/kiwi-cf-faqjs', __FILE__ ), ['jquery'], '', TRUE );
require_once 'google-reviews-api.php';

$google_reviews = new GoogleReviews();
$reviews = $google_reviews->get_reviews( $place_id );
$reviews = $reviews->result->reviews;

?>

<div id="wrap-sh-slider">
    <a class="control_next">></a >
    <a class="control_prev"><</a>
    <div class="sh-slider">
        <ul>
            <?php foreach ( $reviews as $review ) {  ?>
                <li>
                    <div class="review-block">
                        <div class="avatar">
                            <img src="<?php echo $review->profile_photo_url ?>" />
                        </div>
                        <div class="name"><?php echo $review->author_name ?></div>
                        <div class="star-ratings-css">
                            <div class="star-ratings-css-top" style="width: <?php echo $review->rating*22 ?>%">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <div class="star-ratings-css-bottom">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                        <div class="review-text">
                            <p>
                                <span class="dashicons dashicons-format-quote first-quote"></span>
                                <?php echo $review->text ?>
                                <span class="dashicons dashicons-format-quote last-quote"></span>
                            </p>
                        </div>
                        <div class="time-desc">
                            <p><?php echo $review->relative_time_description ?></p>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>