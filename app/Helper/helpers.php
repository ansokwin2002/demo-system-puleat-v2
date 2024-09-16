<?php

// Set Sidebar item active 

// function setActive(array $route) {
//     if (is_array($route)) {
//         foreach ($route as $r) {
//             if (request()->routeIs($r)) {
//                 return 'active';
//             }
//         }
//     }
// }

function setActive(array $routes) {
    $currentRoute = request()->route()->getName();
    foreach ($routes as $route) {
        if (request()->routeIs($route)) {
            return 'active';
        }
    }
    return '';
}
