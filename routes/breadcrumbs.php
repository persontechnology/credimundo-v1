<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('dashboard'));
});

// usuarios
Breadcrumbs::for('usuarios.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Usuarios', route('usuarios.index'));
});
Breadcrumbs::for('usuarios.create', function (BreadcrumbTrail $trail) {
    $trail->parent('usuarios.index');
    $trail->push('Nuevo', route('usuarios.create'));
});

Breadcrumbs::for('usuarios.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('usuarios.index');
    $trail->push('Editar', route('usuarios.edit', $user));
});

// tipo de cuentas
Breadcrumbs::for('tipo-cuentas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tipo de cuenta', route('tipo-cuentas.index'));
});
Breadcrumbs::for('tipo-cuentas.create', function (BreadcrumbTrail $trail) {
    $trail->parent('tipo-cuentas.index');
    $trail->push('Nuevo', route('tipo-cuentas.create'));
});

Breadcrumbs::for('tipo-cuentas.edit', function (BreadcrumbTrail $trail, $tc) {
    $trail->parent('tipo-cuentas.index');
    $trail->push('Editar', route('tipo-cuentas.edit', $tc));
});


// tipo de cuentas
Breadcrumbs::for('tipo-transacciones.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tipo de transacción', route('tipo-transacciones.index'));
});
Breadcrumbs::for('tipo-transacciones.create', function (BreadcrumbTrail $trail) {
    $trail->parent('tipo-transacciones.index');
    $trail->push('Nuevo', route('tipo-transacciones.create'));
});

Breadcrumbs::for('tipo-transacciones.edit', function (BreadcrumbTrail $trail, $tt) {
    $trail->parent('tipo-transacciones.index');
    $trail->push('Editar', route('tipo-transacciones.edit', $tt));
});


// cuenatas de usuario
Breadcrumbs::for('cuentas-usuario.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Cuentas de usuarios', route('cuentas-usuario.index'));
});
Breadcrumbs::for('cuentas-usuario.create', function (BreadcrumbTrail $trail) {
    $trail->parent('cuentas-usuario.index');
    $trail->push('Nuevo', route('cuentas-usuario.create'));
});

Breadcrumbs::for('cuentas-usuario.edit', function (BreadcrumbTrail $trail, $cu) {
    $trail->parent('cuentas-usuario.index');
    $trail->push('Editar', route('cuentas-usuario.edit', $cu));
});

// transacciones
Breadcrumbs::for('transacciones.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Transacciones', route('transacciones.index'));
});
Breadcrumbs::for('transacciones.create', function (BreadcrumbTrail $trail) {
    $trail->parent('transacciones.index');
    $trail->push('Nuevo', route('transacciones.create'));
});
Breadcrumbs::for('transacciones.show', function (BreadcrumbTrail $trail,$t) {
    $trail->parent('transacciones.index');
    $trail->push('Detalle', route('transacciones.show',$t));
});
// tipo de creditos
Breadcrumbs::for('tipo-creditos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tipo créditos', route('tipo-creditos.index'));
});
Breadcrumbs::for('tipo-creditos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('tipo-creditos.index');
    $trail->push('Nuevo', route('tipo-creditos.create'));
});
Breadcrumbs::for('tipo-creditos.edit', function (BreadcrumbTrail $trail,$tc) {
    $trail->parent('tipo-creditos.index');
    $trail->push('Editar', route('tipo-creditos.edit',$tc));
});

// creditos
Breadcrumbs::for('creditos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Créditos', route('creditos.index'));
});
Breadcrumbs::for('creditos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('creditos.index');
    $trail->push('Nuevo', route('creditos.create'));
});
Breadcrumbs::for('creditos.show', function (BreadcrumbTrail $trail,$c) {
    $trail->parent('creditos.index');
    $trail->push('Ver', route('creditos.show',$c));
});
Breadcrumbs::for('creditos.garantes', function (BreadcrumbTrail $trail,$c) {
    $trail->parent('creditos.show',$c);
    $trail->push('Garantes', route('creditos.garantes',$c));
});
Breadcrumbs::for('creditos.edit', function (BreadcrumbTrail $trail,$c) {
    $trail->parent('creditos.index');
    $trail->push('Editar', route('creditos.edit',$c));
});
