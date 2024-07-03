<header class="header-1"> <!-- Header = Topbar + Navigation Bar -->
    <div class="topbar-wrapper">
        <div class="container"> <!-- Dark Blue Topbar -->
            <div class="topbar">
                <div>
                </div>
                <div>
                    <ul class="topbar-widgets"> <!-- Topbar Widgets - Cart, Language Select & Login Signup -->
                        <li>
                            <span data-toggle="modal" id="btn-login" class="d-flex">
                                <i class="material-icons">login</i> Ingresar
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg"> <!-- Navigation Bar -->
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img style="width: 100px;" src="assets/backend/material-dashboard/assets/img/sieof.png" alt=""> <!-- Replace with your Logo -->
            </a>

            <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#main-navigation" aria-expanded="false">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-bars"></i> <!-- Mobile Navigation Toggler Icon -->
                </span>
            </button>

            <div class="navbar-collapse collapse" id="main-navigation"> <!-- Main Menu -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/publicaciones') ?>">Publicaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/formularios') ?>">Formularios</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>