
    <div class="col-md-9">
        
        <section class="panel">
            <div class="panel-body">
                <input type="text" placeholder="Keyword Search" class="form-control" />
            </div>
        </section>

        <div class="row product-list">
            @foreach ($dataProduct as $p)
                <div class="col-md-4">
                    <section class="panel">
                        <div class="pro-img-box">
                            <img src="https://cf.shopee.co.id/file/{{ $this->get_img($p->images) }}" alt="" />
                            <a href="#" class="adtocart">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </div>

                        <div class="panel-body text-center">
                            <h4>
                                <a href="#" class="pro-title">
                                    {{$p->name}}
                                </a>
                            </h4>
                            <p class="price">RP {{ number_format(substr($p->price,0,-5))}}</p>
                        </div>
                    </section>
                </div>
            @endforeach
            <!-- <div class="col-md-4">
                <section class="panel">
                    <div class="pro-img-box">
                        <img src="https://via.placeholder.com/250x220/6495ED/000000" alt="" />
                        <a href="#" class="adtocart">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </div>

                    <div class="panel-body text-center">
                        <h4>
                            <a href="#" class="pro-title">
                                Leopard Shirt Dress
                            </a>
                        </h4>
                        <p class="price">$300.00</p>
                    </div>
                </section>
            </div> -->

        </div>
        <section class="panel">
            <div class="panel-body">
                <div class="pull-right">
                    <ul class="pagination pagination-sm pro-page-list">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-3">
        <section class="panel">
            <header class="panel-heading">
                Category
            </header>
            <div class="panel-body">
                <ul class="nav prod-cat">
                    <li>
                        <a href="#"><i class="fa"></i> Category 1</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa"></i> Category 2</a>
                    </li>
                </ul>
            </div>
        </section>
    </div>