<?php
// only add the page builder if ACF is enabled

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {

?>

<?php if(have_rows('page_builder')) : ?>
    <div class="page__builder">
    <?php while ( have_rows('page_builder') ) : the_row(); ?>

        <?php if( get_row_layout() == 'one_column' ): ?> 
            <div class="page__builder__container one_column <?php the_sub_field('class');?>">

            <?php if(get_sub_field('wysiwyg_editor')) : ?>
                <div class="inner">
                    <div class="wysiwyg_editor"><?php the_sub_field('wysiwyg_editor'); ?></div>
                </div>
            <?php endif; ?>

            </div>

        <?php elseif( get_row_layout() == 'call_to_action' ): ?> 
           <div class="page__builder__container one_column call_to_action" style="background-color: <?php the_sub_field('background_colour');?>; color: <?php the_sub_field('text_colour');?>">

                <?php if(get_sub_field('heading')) : ?>
                <div class="wysiwyg_editor">
                    <div class="inner">
                        <a class="button" href="<?php the_sub_field('call_to_action_url');?>" style="background-color: <?php the_sub_field('text_colour');?>; color: <?php the_sub_field('background_colour');?>"><?php the_sub_field('call_to_action_text');?></a>
                        <h2><?php the_sub_field('heading'); ?></h2><p><?php the_sub_field('text');?></p>
                    </div>
                </div>
            <?php endif; ?>
           </div>

        <?php elseif( get_row_layout() == 'two_column' ): ?>
            <div class="page__builder__container two_column <?php the_sub_field('class');?>" style="background-color: <?php the_sub_field('background_colour');?>; color: <?php the_sub_field('text_colour');?>">

                <?php if(get_sub_field('wysiwyg_editor')) : ?>
                    <div class="wysiwyg_editor"><div class="inner"><?php the_sub_field('wysiwyg_editor'); ?></div></div>
                <?php endif; ?>
                <?php if(get_sub_field('wysiwyg_editor_two')) : ?>
                    <div class="wysiwyg_editor"><div class="inner"><?php the_sub_field('wysiwyg_editor_two'); ?></div></div>
                <?php endif; ?>

           </div>
        
     
        
        <?php elseif( get_row_layout() == 'leaders' ): ?> 
           <div class="page__builder__container one_column leaders">
           
               <?php if( get_sub_field( 'title' ) ) {
                   echo '<h2>' . get_sub_field( 'title' ) . '</h2>';
               } ?>
               <?php 
               if( have_rows( 'leader' ) ) {
                    while ( have_rows( 'leader' ) ) {
                        the_row();
                ?>
                    <div class="leader">
                        <?php 
                        if ( get_sub_field( 'photo' ) ) {
                            $imageID = get_sub_field( 'photo' );
                            echo wp_get_attachment_image( $imageID  );
                        } else {
                            echo '<img src="' . get_stylesheet_directory_uri() .'/assets/img/default-person.png" alt="Default leader image" height=150 width=150>';
                        }
                        ?>
                        <div class="leader__details">
                            <?php echo get_sub_field( 'title' ) ? '<h3>' . get_sub_field( 'title' ) . '</h3>' : ''; ?>
                            <?php echo get_sub_field( 'scouting_name' ) ? '<p><em>' . get_sub_field( 'scouting_name' ) . '</em> &dash; ' : '<p>'; ?>
                            <?php echo get_sub_field( 'name' ) ? get_sub_field( 'name' ) . '</p>' : ''; ?>
                            <?php
                            if( get_sub_field( 'email' ) ) {
                                $finch_email = get_sub_field( 'email' );
                            ?>
                                <a href="mailto:<?php echo antispambot( $finch_email, 1 ); ?>"><?php echo antispambot( $finch_email, 0 ); ?></a>
                            <?php } ?>
                            <?php
                            if( get_sub_field( 'add_phone' ) && get_sub_field('phone_number') ) {
                            ?>
                                <p><a href="tel:<?php the_sub_field('phone_number'); ?>"><?php the_sub_field('phone_number'); ?></a></p>
                            <?php } ?>

                        </div>
                    </div>
                <?php
                    } 
               }
               ?>

           </div>
        
     
        
        <?php elseif( get_row_layout() == 'section_logos' ): ?> 
           <div class="page__builder__container section-logos">
                <?php
                if ( get_sub_field('section_header') ) {
                    the_sub_field('section_header') .'">';
                }
                ?>
           
               <?php 
               if( have_rows( 'section' ) ) {
                   echo '<div class="section-logos__container">';
                    while ( have_rows( 'section' ) ) {
                        the_row();
                ?>
                    <div class="section">
                        <?php
                        if ( get_sub_field('section_link') ) {
                            echo '<a href="'. get_sub_field('section_link') .'">';
                        }
                        if ( get_sub_field('image') ) {
                            $imageArray = get_sub_field( 'image' );
                            $imageAlt = $imageArray['alt'];
                            $imageURL = $imageArray['url'];
                            echo '<img src="'.$imageURL.'" alt="'.$imageAlt.'">';
                        }
                        if ( get_sub_field('section_link') ) {
                            echo '</a>';
                        }
                        if( get_sub_field( 'text' ) ) {
                           echo '<p>' . get_sub_field('text') . '</p>';
                        } 
                        
                        ?>
                    </div>
                <?php
                    } 
                    echo '</div>';
               }
               ?>

           </div>
        
      
        

        
        <?php elseif( get_row_layout() == 'slideshow' ): ?>
            <div class="page__builder__container page-slideshow">
               <div class="page-slideshow__inner">
                    <?php 
                        $images = get_sub_field('images');

                        if( $images ): ?>
                            <div class="page-slideshow__slick">
                                <?php foreach( $images as $image ): ?>
                                    <div class="page-slideshow__item" style="background-image: url('<?php echo $image['sizes']['large']; ?>');">
                                        <?php if($image['caption']) { echo '<p>'.$image['caption'].'</p>'; } ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                    <?php endif; ?>
                    <?php
                    if ( is_front_page() ) {
                        echo '<a href="#find-out-more" class="button-green">';
                        _e( 'Find out more', 'finch');
                        echo '</a>';
                    }
                    ?>
               </div>
            </div>
        
        
        
        <?php elseif( get_row_layout() == 'programme' ): ?>
            <div class="page__builder__container programme <?php the_sub_field('class');?>" style="background-color: <?php the_sub_field('background_colour');?>; color: <?php the_sub_field('text_colour');?>">
                <h2><?php _e( 'Programme', '1finch'); ?></h2>
                <?php
                if( get_sub_field('section') ) {
                    echo '<p>'. get_sub_field('section') .'</p>';
                }
                ?>
                

           </div>

        
        <?php endif; ?>
        
        
    <?php endwhile; // end of if page_content ?>
    </div>

<?php endif; // end of if content_row ?>

<?php } // end "is ACF enabled?" ?>