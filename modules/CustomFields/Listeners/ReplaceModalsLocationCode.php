<?php

namespace Modules\CustomFields\Listeners;

class ReplaceModalsLocationCode
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return string
     */
    public function handle($event)
    {
        $location_code_mapping = [
            'modals.customers' => 'sales.customers',
            'modals.vendors' => 'purchases.vendors',
            'modals.items' => 'common.items',
            'modals.accounts' => 'banking.accounts',
        ];

        if (array_key_exists($event->code, $location_code_mapping)) {
            return $location_code_mapping[$event->code];
        }
    }
}
