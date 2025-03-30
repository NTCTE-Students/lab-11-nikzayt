<?php
function findHtmlTags($html) {
    $pattern = '/<([a-z]+)(\s+[^>]*)?>/i';
    preg_match_all($pattern, $html, $matches);
    return $matches[1]; // возвращаем имена тегов
}

$html = '<div class="container"><p>Text</p><img src="image.jpg"><br></div>';
$tags = findHtmlTags($html);

echo "Найденные HTML-теги:\n";
print_r($tags);
?>