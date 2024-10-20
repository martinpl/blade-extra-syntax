<?php

namespace MartinPL\BladeExtraSyntax;

class PackageServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        BladeExtraSyntax::directiveAsAttribute('if');
        BladeExtraSyntax::directiveAsAttribute('isset');
        BladeExtraSyntax::directiveAsAttribute('foreach');
    }
}
