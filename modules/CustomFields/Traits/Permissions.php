<?php

namespace Modules\CustomFields\Traits;

use App\Models\Module\Module;

trait Permissions
{
    public function canCompose()
    {
        return app()->runningInConsole() || !env('APP_INSTALLED') || !Module::alias('custom-fields')->enabled();
    }
}
