<?php


// https://gist.github.com/mannieschumpert/8334811
// Change Gravity Forms submit input to a button element
add_filter( 'gform_submit_button', 'form_submit_button', 10, 5 );
function form_submit_button ( $button, $form ){
    $button = str_replace( "input", "button", $button );
    $button = str_replace( "/", "", $button );
    $button .= "{$form['button']['text']}</button>";
    return $button;
}
// It's not perfect - it leaves some inapplicable attributes in the element
// but I can live with that to avoid a whole bunch more str_replace
// and it leaves the important onclick and tab index intact