<?php

/** @var yii\web\View $this */

$this->title = 'UTELVT - Biblioteca Virtual';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <img src="<?= Yii::getAlias('@web/images/logo.png') ?>" alt="UTELVT Logo" class="mb-3" style="height:100px; border-radius:50%; box-shadow:0 2px 12px #0002;">
        <h1 class="display-4" style="font-weight:700; letter-spacing:2px; color:#0d6efd;">Bienvenido a UTELVT</h1>
        <h3 class="text-success">Biblioteca Virtual</h3>
        <p class="lead">Gestiona libros, préstamos y mucho más en un entorno moderno y accesible.</p>
        <p>
            <a class="btn btn-lg btn-primary" href="/libros/index" style="margin-right:10px;">Explorar Libros</a>
            <a class="btn btn-lg btn-outline-secondary" href="/site/about">Acerca de</a>
        </p>
    </div>

    <div class="body-content">
        <div class="row text-center">
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="<?= Yii::getAlias('@web/images/libros.png') ?>" class="card-img-top" alt="Libros" style="height:180px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">Catálogo de Libros</h5>
                        <p class="card-text">Encuentra y consulta todo el material bibliográfico disponible en UTELVT.</p>
                        <a class="btn btn-primary" href="/libros/index">Ver Libros</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="<?= Yii::getAlias('@web/images/prestamos.png') ?>" class="card-img-top" alt="Préstamos" style="height:180px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">Préstamos</h5>
                        <p class="card-text">Solicita y gestiona el préstamo de libros de forma fácil y rápida.</p>
                        <a class="btn btn-primary" href="/prestamos/index">Ver Préstamos</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="<?= Yii::getAlias('@web/images/categorias.jpg') ?>" class="card-img-top" alt="Categorías" style="height:180px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">Categorías</h5>
                        <p class="card-text">Explora los libros organizados por categorías y encuentra tu próxima lectura.</p>
                        <a class="btn btn-primary" href="/categorias/index">Ver Categorías</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>