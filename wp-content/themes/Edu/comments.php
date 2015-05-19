<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            printf( _nx( 'One thought on “%2$s”', '%1$s thoughts on “%2$s”', get_comments_number(), 'comments title', 'smooththemes' ),
                number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>
        <ol class="comment-list">
            <?php wp_list_comments('callback=st_comments'); ?>
        </ol><!-- .comment-list -->
        <?php
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'smooththemes' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '← Older Comments', 'smooththemes' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments →', 'smooththemes' ) ); ?></div>
            </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
            <p class="no-comments"><?php _e( 'Comments are closed.' , 'smooththemes' ); ?></p>
        <?php endif; ?>
    <?php endif; // have_comments() ?>
    <?php
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';
    if ($comment_author == '')  $comment_author = '';
    if ($comment_author_email == '') $comment_author_email = '';
    if ($comment_author_url == '') $comment_author_url = '';
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $args = array(
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'smooththemes' ) . '</label> <textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
        'fields' => apply_filters( 'comment_form_default_fields', array(
            'author' => '<div class="form-line comment-form-author input-group">' . '<label class="input-group-addon" for="author">' . __( 'Name','smooththemes' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label> <input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $comment_author) . '" size="30"' . $aria_req . ' /></div>',
            'email' => '<div class="form-line comment-form-email input-group"><label class="input-group-addon" for="email">' . __( 'Email','smooththemes' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label> <input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
            'url' => '<div class="form-line comment-form-url input-group"><label class="input-group-addon" for="url">' . __( 'Website','smooththemes' ) . '</label>' . '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr($comment_author_url ) . '" size="30" /></div>' ) ) );
    comment_form($args); ?>
</div><!-- #comments -->