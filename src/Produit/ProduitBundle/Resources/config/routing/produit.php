<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('produit_index', new Route(
    '/',
    array('_controller' => 'ProduitBundle:produit:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('produit_show', new Route(
    '/{id}/show',
    array('_controller' => 'ProduitBundle:produit:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('produit_new', new Route(
    '/new',
    array('_controller' => 'ProduitBundle:produit:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('produit_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'ProduitBundle:produit:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('produit_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'ProduitBundle:produit:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
