<?php

namespace MartinPL\BladeExtraSyntax;

use Illuminate\Support\Facades\Blade;

class BladeExtraSyntax
{
    public static function directiveAsAttribute($directive)
    {
        Blade::prepareStringsForCompilationUsing(function ($value) use ($directive) {
            return preg_replace_callback('/<([^\s>]+)\s+([^>]*@'.$directive.'\([^)]+\)[^>]*)(?:>(.*?)<\/\1>|\s*\/>)/s', function ($matches) use ($directive) {
                $tag = $matches[1];
                $attributes = $matches[2];
                $content = $matches[3] ?? false;

                preg_match("/@{$directive}\(([^)]+)\)/", $attributes, $conditionMatch);
                $condition = $conditionMatch[1];

                $attributes = preg_replace("/@{$directive}\([^)]+\)/", '', $attributes);
                $attributes = trim($attributes);

                if ($content) {
                    return "@{$directive}($condition)\n<$tag $attributes>$content</$tag>\n@end{$directive}";
                }

                return "@{$directive}($condition)\n<$tag $attributes />\n@end{$directive}";
            }, $value);
        });
    }
}
