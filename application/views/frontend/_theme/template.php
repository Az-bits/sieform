<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{pagetitle}</title>
    <link rel="icon" type="image/png" href="{theme_url}img/sieof.png">
    <link href="{theme_url}css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="{theme_url}css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="{theme_url}slider-revolution/css/settings.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{theme_url}slider-revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="{theme_url}slider-revolution/css/navigation.css">
    <link href="{theme_url}css/vendors.min.css" type="text/css" rel="stylesheet">
    <link href="{theme_url}css/style.min.css" type="text/css" rel="stylesheet" id="style">
    <link href="{theme_url}css/components.min.css" type="text/css" rel="stylesheet" id="components">

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <link href="{theme_url}css/color-switch.css" type="text/css" rel="stylesheet" id="switch-css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/backend/css/global.styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/css/global.styles.css') ?>">

    <link rel="stylesheet" type="text/css" href="{theme_url}css/components-blue.css">
    <link rel="stylesheet" type="text/css" href="{theme_url}css/style-blue.css">

    <script src="{theme_url}js/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/backend/material-dashboard/assets/js/plugins/jquery.autocomplete.min.js">
    </script>
    <script src="<?= base_url() ?>assets/backend/material-dashboard/assets/js/plugins/bootstrap-notify.js"></script>

</head>

<body>

    <div class="loader-backdrop">
        <!-- Loader -->
        <div class="loader">
            <div class="ball-1"></div>
            <div class="ball-2"></div>
        </div>
    </div>

    <!-- Notificacion -->

    {header}

    {content}

    {footer}

    <!-- Subscribe Modal -->

    <!-- Cart Modal -->
    <div class="modal fade" id="cart-modal" data-open-onload="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Items in your Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-cart">
                        <ul class="cart-list">
                            <li class="item">
                                <div class="item-img">
                                    <a href="product-detail.html">
                                        <img src="{theme_url}images/shop/product-small-5.jpg" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="item-meta">
                                    <h5 class="item-name">
                                        <a href="product-detail.html">HB Pencil Set of 10</a>
                                    </h5>
                                    <div class="item-qty">Qty : 2</div>
                                    <div class="item-size">Size : Large</div>
                                </div>
                                <div class="item-del">
                                    <a href="#"><i class="fa fa-trash"></i></a>
                                </div>
                            </li>
                            <li class="item">
                                <div class="item-img">
                                    <a href="product-detail.html">
                                        <img src="{theme_url}images/shop/product-small-2.jpg" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="item-meta">
                                    <h5 class="item-name">
                                        <a href="product-detail.html">Black School Bag</a>
                                    </h5>
                                    <span class="item-qty">Qty : 1</span>
                                    <div class="item-size">Size : Small</div>
                                </div>
                                <div class="item-del">
                                    <a href="#"><i class="fa fa-trash"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="cart.html" class="btn btn-light">View Cart</a>
                    <a href="checkout.html" class="btn btn-primary">Checkout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Language Modal -->
    <div class="modal fade" id="lang-modal" data-open-onload="false" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Which part of the world are you from?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-lang">
                        <a href="#"><span class="flag-icon flag-icon-hk"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-in"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-jp"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-ca"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-us"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-bl"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-dk"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-gn"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-hu"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-tr"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-np"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-vn"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-kw"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-mg"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-pw"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-sc"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-ch"></span></a>
                        <a href="#"><span class="flag-icon flag-icon-ua"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->

    <div id="back"><i class="fa fa-angle-up"></i></div>
    <div data-base-url="<?= base_url() ?>" id="baseUrl"></div>
    <!-- <div id="switch">
		<a id="open-switch"><i class="fa fa-cog fa-spin"></i></a>
		<ul>
			<li id="combo1"></li>
			<li id="combo2"></li>
			<li id="combo3"></li>
			<li id="combo4"></li>
			<li id="combo5"></li>
			<li id="combo6"></li>
		</ul>
	</div> -->

    <!-- jQuery Version 3.2.1 (Required) -->

    <!-- Popper JS (Required) -->
    <script src="{theme_url}js/popper.min.js" type="text/javascript"></script>

    <!--Bootstrap Framework Version 4.0.0 (Required) -->
    <script src="{theme_url}js/bootstrap.min.js" type="text/javascript"></script>

    <!--Slider Revolution version 5.0-->
    <script type="text/javascript" src="{theme_url}slider-revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="{theme_url}slider-revolution/js/jquery.themepunch.revolution.min.js"></script>

    <!-- Include only when working on Local system. Not required on server -->
    <script type="text/javascript" src="{theme_url}slider-revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script type="text/javascript" src="{theme_url}slider-revolution/js/extensions/revolution.extension.video.min.js">
    </script>
    <script type="text/javascript" src="{theme_url}slider-revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="{theme_url}slider-revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="{theme_url}slider-revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="<?= base_url() ?>assets/backend/material-dashboard/assets/js/plugins/sweetalert2.js"></script>

    <script src="{theme_url}js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="{theme_url}js/main.js" type=text/javascript></script>
    <script src="{theme_url}js/color-switch.js" type="text/javascript" id="switch-js"></script>

    <?php if ($data['page']) : ?>
        <script src="<?= base_url('assets/frontend/js/{page}/index.js') ?>" type="module"></script>
    <?php endif ?>





</body>

</html>