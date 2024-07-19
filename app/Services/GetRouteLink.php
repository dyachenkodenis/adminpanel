<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;


class GetRouteLink
{
    public static function get_route()
    {
        $routeCollection = Route::getRoutes();
        if (isset($routeCollection) && $routeCollection) {
            foreach ($routeCollection as $route) :
?>
                <option value="<?php echo ($route->uri() ?? ""); ?>"><?php echo ($route->uri() ?? ""); ?></option>
<?php
            endforeach;
        }
    }
}
