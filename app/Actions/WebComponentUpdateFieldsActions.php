<?php

namespace App\Actions;

class WebComponentUpdateFieldsActions{

    public function handle($request, $webComp)
    {
        $arr = json_decode($webComp->jsonvalue);

        $collection = collect($arr);

        $keyToUpdate = $request['field_id'];

        $newValue = (object) [
            'key' => $request['key'],
            'type' => $request['type'],
            'lang' => $request['lang'],
            'value' => $request['value'],
        ];

        $updatedCollection = $collection->map(function ($item) use ($keyToUpdate, $newValue) {
            if (property_exists($item, $keyToUpdate)) {
                $item->$keyToUpdate = $newValue;
            }
            return $item;
        });

        $webComp->update([
            'jsonvalue' => json_encode($updatedCollection->all()),
        ]);

       
    }
}