<div class="container text-center">
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div>
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{asset('assets/img/logo.png')}}" alt="Logo MercadoClone"
                         style="max-width:75px;max-height:51px">
                    <h3><strong>MercadoClone</strong></h3>
                </div>
                <div class="pt-2">
                    <p>
                        Sitio web diseñado para imitar la funcionalidad de MercadoLibre. Realizado con fines de
                        aprendizaje y educación,
                        todos los derechos reservados a sus respectivos autores.
                    </p>
                </div>
                <div>
                    <ul class="list-unstyled">
                        <li>
                            <span class="email d-flex align-items-baseline justify-content-center">
                                Email:
                                <p class="email-address">Mocho@gmail.com</p>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3 pt-2">
            <div>
                <div>
                    <h3><strong>Enlaces</strong></h3>
                </div>
                <div>
                    <div>
                        <ul class="list-unstyled">
                            <li class="nav-item">
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Publicaciones
                                    Populares</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Publicaciones
                                    Recientes</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Ayuda</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Contactanos</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3 pt-2">
            <div>
                <div>
                    <h3><strong>Cuenta</strong></h3>
                </div>
                <div>
                    <ul class="list-unstyled">
                        @auth
                            <li>
                                <a href="/userinfo" class="nav-link"><i class="fa fa-angle-right"></i> Detalles de
                                    cuenta</a>
                            </li>
                            <li class="item-list-a">
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Compras</a>
                            </li>
                            <li class="item-list-a">
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Preguntas Realizadas</a>
                            </li>
                            <li class="item-list-a">
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Ventas</a>
                            </li>
                            <li class="item-list-a">
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Preguntas Recibidas</a>
                            </li>
                            <li class="item-list-a">
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Favoritos</a>
                            </li>
                            <li class="item-list-a">
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Vender</a>
                            </li>
                            <li class="item-list-a">
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Cerrar Sesión</a>
                            </li>
                        @else
                            <li class="item-list-a">
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Iniciar Sesión</a>
                            </li>
                            <li class="item-list-a">
                                <a href="#" class="nav-link"><i class="fa fa-angle-right"></i> Registrarse</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container text-center">
    <div>
        <p class="text-muted">
            &copy; Copyright 1999-2020 MercadoLibre Venezuela S.R.L. RIF: J-30684267-5. Todos los derechos reservados.
        </p>
    </div>
</div>
