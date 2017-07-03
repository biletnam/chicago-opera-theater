<?php
add_filter('the_content', 'shortcode_empty_paragraph_fix');
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function shortcode_empty_paragraph_fix($content)
{
    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr($content, $array);
}

function split_at_bar($string)
{
    return explode('|', $string);
}
