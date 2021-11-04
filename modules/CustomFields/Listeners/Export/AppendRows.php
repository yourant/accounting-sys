<?php

namespace Modules\CustomFields\Listeners\Export;

use Modules\CustomFields\Traits\CustomFields;

class AppendRows
{
    use CustomFields;

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $fields = $this->getExportableFields($event);

        if ($fields->isEmpty()) {
            return;
        }

        foreach ($event->rows as $row) {
            foreach ($fields as $field) {
                $field_code = $field->code;

                $row->$field_code = $this->getFieldValueByModel($field, $row);
            }
        }
    }
}
