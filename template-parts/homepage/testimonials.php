<?php
/**
 * Template part for displaying the Testimonials Section on Homepage
 *
 * Replicates the clean multi-column review masonry section matching design:
 * - Same continuous white background as YouTube banner above it
 * - Top: Centered rating pill (5 orange stars + "Rated 4.9 out of 5"), headline, and subtitle
 * - 4-Column Masonry of review cards with dark avatar circles, star ratings, and review copy
 * - Featured dark photo testimonial slot card
 * - Bottom floating "VIEW MORE +" dark pill button with soft gradient fade
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="testimonials" class="homepage-section testimonials-section" aria-labelledby="testimonials-heading">
    <div class="site-container testimonials-container">
        
        <!-- Section Header -->
        <div class="testimonials-header">
            
            <!-- Top Rating Pill -->
            <div class="testimonials-rating-pill" aria-label="<?php esc_attr_e( 'Rated 4.9 out of 5 stars', 'drive' ); ?>">
                <div class="stars-row" aria-hidden="true">
                    <span class="star-icon">★</span>
                    <span class="star-icon">★</span>
                    <span class="star-icon">★</span>
                    <span class="star-icon">★</span>
                    <span class="star-icon">★</span>
                </div>
                <span class="rating-text"><?php esc_html_e( 'Rated 4.9 out of 5 by learners', 'drive' ); ?></span>
            </div>

            <!-- Main Heading -->
            <h2 id="testimonials-heading" class="testimonials-title">
                <?php esc_html_e( 'What learners say about practicing with us', 'drive' ); ?>
            </h2>

            <!-- Subtitle -->
            <p class="testimonials-subtitle">
                <?php esc_html_e( 'Real reviews from learners preparing for their permit test.', 'drive' ); ?>
            </p>

        </div><!-- .testimonials-header -->


        <!-- Reviews Masonry Columns Wrapper -->
        <div class="testimonials-grid-wrapper" id="testimonials-grid-wrapper">
            
            <div class="testimonials-masonry-grid">
                
                <!-- Column 1 -->
                <div class="testimonials-col">
                    
                    <!-- Card 1 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar">AB</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Alex B.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'Passed on my first try! The state-specific questions were almost identical to what I saw on the actual DMV exam. Clean, fast, and no fluff.', 'drive' ); ?>
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar">CD</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Chloe D.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'The explanations for tricky questions helped me understand the rules instead of just memorizing answers.', 'drive' ); ?>
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar">EF</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Ethan F.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'Studying road signs with the interactive quizzes made test prep so much faster than reading the handbook.', 'drive' ); ?>
                        </p>
                    </div>

                </div><!-- .testimonials-col 1 -->


                <!-- Column 2 -->
                <div class="testimonials-col">
                    
                    <!-- Card 1 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar">GH</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Grace H.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'Short review, two lines at most. Super simple to use and completely free to practice!', 'drive' ); ?>
                        </p>
                    </div>

                    <!-- Featured Photo Slot Card -->
                    <div class="review-card photo-testimonial-card">
                        <div class="photo-slot-inner">
                            <div class="photo-slot-icon" aria-hidden="true">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#00D4C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="photo-slot-title"><?php esc_html_e( 'Photo testimonial slot', 'drive' ); ?></div>
                            <div class="photo-slot-subtitle"><?php esc_html_e( 'Real learner photo, with consent', 'drive' ); ?></div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="review-card is-bottom-faded">
                        <div class="review-header">
                            <div class="reviewer-avatar">IJ</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Isaac J.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'Took 4 mock tests the night before and felt super confident during the real test.', 'drive' ); ?>
                        </p>
                    </div>

                </div><!-- .testimonials-col 2 -->


                <!-- Column 3 -->
                <div class="testimonials-col">
                    
                    <!-- Card 1 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar">KL</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Kevin L.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'Aced my permit test today on the first try! Thank you!', 'drive' ); ?>
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar">MN</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Maya N.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'Review about how clear the explanations were and how the practice tests helped them feel ready.', 'drive' ); ?>
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar">OP</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Omar P.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'Review mentioning the cheat sheet and how it helped with last-minute revision right before the test.', 'drive' ); ?>
                        </p>
                    </div>

                </div><!-- .testimonials-col 3 -->


                <!-- Column 4 -->
                <div class="testimonials-col">
                    
                    <!-- Card 1 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar">QR</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Quinn R.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'Longer review: how they used topic practice, reviewed the questions they got wrong, and how the mock tests compared with the real test day.', 'drive' ); ?>
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar">ST</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Sophia T.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'Review about learning road signs with visuals and quizzes instead of only reading the handbook.', 'drive' ); ?>
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar">AB</div>
                            <div class="reviewer-meta">
                                <div class="reviewer-name"><?php esc_html_e( 'Aiden B.', 'drive' ); ?></div>
                                <div class="review-stars" aria-label="5 stars">★★★★★</div>
                            </div>
                        </div>
                        <p class="review-body">
                            <?php esc_html_e( 'Short review, two lines at most. Highly recommended to everyone!', 'drive' ); ?>
                        </p>
                    </div>

                </div><!-- .testimonials-col 4 -->

            </div><!-- .testimonials-masonry-grid -->

            <!-- Bottom Fade Overlay & View More Button -->
            <div class="testimonials-bottom-action">
                <button type="button" class="btn-testimonials-view-more" id="btn-view-more-testimonials">
                    <span class="btn-label"><?php esc_html_e( 'VIEW MORE', 'drive' ); ?></span>
                    <span class="plus-icon" aria-hidden="true">+</span>
                </button>
            </div>

        </div><!-- .testimonials-grid-wrapper -->

    </div><!-- .site-container -->
</section><!-- #testimonials -->
