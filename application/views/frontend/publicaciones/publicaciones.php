<div id="url" data-url="<?= base_url(Hasher::make(204)) ?>"></div>
<div id="urlP" data-url="<?= base_url(Hasher::make(205)) ?>"></div>


<section class="page-header">
    <div class="container">
        <h1 class="heading">Publicaciones</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="#">Publicaciones</a></li>
        </ul>
    </div>
</section>
<div class="pt-60 pb-60 bg-light">
    <form>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="form-group">
                        <input id="search" type="text" name="search" class="form-control" placeholder="Buscar publicación...">
                    </div>
                </div>
                <!-- <div class="col-lg-3">
                    <div class="form-group">
                        <select class="form-control">
                            <option>1 year</option>
                            <option>2 years</option>
                            <option>4 years</option>
                            <option>6 years</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <select class="form-control">
                            <option>Ontario</option>
                            <option>London</option>
                            <option>New York</option>
                            <option>Amsterdam</option>
                        </select>
                    </div>
                </div> -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<section class="container mt-60 mb-100">
    <div class="row justify-content-center" id="publicaciones">
    </div>
    <div class="row mt-20">
        <div class="col-lg-12">
            <nav>
                <ul class="pagination justify-content-center">
                    <!-- <li class="page-item">
                        <a class="page-link" id="anterior" href="#">Anterior</a>
                    </li> -->
                    <div class="d-flex" id="paginas">

                    </div>
                    <!-- <li class="page-item" id="proximo">
                        <a class="page-link" href="#">Próximo</a>
                    </li> -->
                </ul>
            </nav>
        </div>
    </div>
</section>