<?php
function compile_text($text)
{

    $opentags = [
        "[table]" => "<table class='post-table'>",
        "[tablerow]" => "<tr class='post-table-row'>",
        "[tableelem]" => "<td class='post-table-element'>",
        "[h1]" => "<h1>",
        "[h2]" => "<h2>",
        "[h3]" => "<h3>",
        "[p]"  => "<p class='text-just'>",
        "[content]" => "<div class='content'>",
        "[quote]" => "<div class='quote'>",
        "[img url='" => "<img class='post-image w-33' src='",
        "']" => "' alt='",
        "[b]" => "<span class='bold'>",
        "[u]" => "<span class='under'>",
        "[i]" => "<span class='italic'>",
        "[left]" => "<div class='content left'>",
        "[right]" => "<div class='content right'>",
        "[center]" => "<div class='content center'>",
        "[imgcaption]" => "<div class='img-caption'>",
        "[list]" => "<ul class='post-list'>",
        "[*]" => "<li class='post-element'>",
        "[link url='" => "<a href='",
        "'|]" => "'>",
    ];
    $closetags = [
        "[/table]" => "</table>",
        "[/tablerow]" => "</tr>",
        "[/tableelem]" => "</td>",
        "[/h1]" => "</h1>",
        "[/h2]" => "</h2>",
        "[/h3]" => "</h3>",
        "[/p]"  => "</p>",
        "[/content]" => "</div>",
        "[/quote]" => "</div>",
        "[/img]" => "'>",
        "[/b]" => "</span>",
        "[/u]" => "</span>",
        "[/i]" => "</span>",
        "[/left]" => "</div>",
        "[/right]" => "</div>",
        "[/center]" => "</div>",
        "[/imgcaption]" => "</div>",
        "[/list]" => "</ul>",
        "[/*]" => "</li>",
        "[/link]" => "</a>",
    ];
    foreach ($opentags as $key => $value) {
        $text = str_replace($key, $value, $text);
    }
    foreach ($closetags as $key => $value) {
        $text = str_replace($key, $value, $text);
    }
    return $text;
}
function translate_category($category)
{
    $translation = [
        "math" => "Математика",
        "mechanics" => "Механика",
        "electromechanics" => "Электромеханика",
    ];
    return $translation[$category];
}
