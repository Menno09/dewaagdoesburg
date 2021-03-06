<?php
$desc = null;
$itemsA = array();

if($linkType == 'no_link' || !$url){
    $itemsA['logo'] = $img_src;
    $itemsA['title'] = "<h3>{$title}</h3>";
} else {
    $target = ($linkType == 'new_window' ? 'target="_blank"' : null);
    $target .= $nofollow ? ' rel="nofollow"' : null;
    $itemsA['logo'] = "<a {$target} href='{$url}'>$img_src</a>";
    $itemsA['title'] = "<h3><a {$target} href='{$url}'>{$title}</a></h3>";
}
$desc .="<div class='logo-description'>";
$desc .= apply_filters('the_content', $description);
$desc .="</div>";
$itemsA['description'] = $desc;

$html = null;
$html .="<div class='{$grid}'>";
    $html .="<div class='single-logo rt-equal-height {$styleClass}' data-title='{$title}'>";
        $html .="<div class='single-logo-container'>";
        foreach($items as $item){
            $html .= !empty($itemsA[$item]) ? $itemsA[$item] : null;
        }
        $html .="</div>";
    $html .="</div>";
$html .="</div>";
echo wp_kses_post( $html );