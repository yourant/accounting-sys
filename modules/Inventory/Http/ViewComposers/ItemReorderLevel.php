<?php

namespace Modules\Inventory\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Module\Module;
use App\Models\Common\Item;

class ItemReorderLevel
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $modules = Module::all()->pluck('alias')->toArray();

        if (in_array('inventory', $modules)) {
            $items = Item::get();

            $item_notifications = [];

            foreach ($items as $item) {
                $inventory_items = $item->inventory()->get();

                if (!$inventory_items->count()) {
                    continue;
                }

                foreach ($inventory_items as $inventory_item) {
                    if (empty($inventory_item->reorder_level)) {
                        continue;
                    }

                    if ($inventory_item->opening_stock <= $inventory_item->reorder_level) {
                        $item_notifications[] = [
                            'id' => $item->id,
                            'name' => $item->name,
                            'opening_stock' => $inventory_item->opening_stock,
                            'warehouse' => $inventory_item->warehouse->name,
                        ];

                        $notifications = $view->getData()['notifications'];
                        $notifications++;
                        $view->with('notifications', $notifications);
                    }
                }
            }

            if (!empty($item_notifications)) {
                $view->getFactory()->startPush('notification_invoices_end', view('inventory::partials.reorder_level', compact('item_notifications')));
            }
        }
    }
}
