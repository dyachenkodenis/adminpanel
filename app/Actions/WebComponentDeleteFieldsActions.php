<?php
namespace App\Actions;

class WebComponentDeleteFieldsActions{
    public function handle($request, $webComp)
    {
        $arr = json_decode($webComp->jsonvalue);

        $collection = collect($arr);

        $keyToDelete = $request['id'];

        $filteredCollection = $collection->filter(function ($item) use ($keyToDelete) {
            return !property_exists($item, $keyToDelete);
        });


        $webComp->update([
            'jsonvalue' => json_encode($filteredCollection->all()),
        ]);
    }
}