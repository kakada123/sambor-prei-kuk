<header class="navbar-standerd nav-bar-dark">
    <div class="container">
        <div class="row">
            <!-- logo end-->
            <div class="col-lg-12">
                <!--nav top end-->
                <nav class="navigation ts-main-menu navigation-landscape">
                    <div class="nav-header">
                        <a class="nav-brand" href="{{ route('home') }}">
                            <img src="{{ asset('assets/image/logo-white.jpg') }}" alt="">
                        </a>
                        <div class="nav-toggle"></div>
                    </div>
                    <!--nav brand end-->
                    <div class="nav-menus-wrapper clearfix">
                        <!--nav right menu start-->
                        <ul class="right-menu align-to-right mobile">
                            <li>
                                <a href="#">
                                    <i class="fa fa-user-circle-o"></i>
                                </a>
                            </li>
                            <li class="header-search">
                                <div class="nav-search">
                                    <div class="nav-search-button">
                                        <i class="icon icon-search"></i>
                                    </div>
                                    <form>
                                        <span class="nav-search-close-button" tabindex="0">✕</span>
                                        <div class="nav-search-inner">
                                            <input type="search" name="search" placeholder="Type and hit ENTER">
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <!--nav right menu end-->
                        @include('frontend/components/menu/menu')
                    </div>
                </nav>
                <!-- nav end-->
            </div>
        </div>
    </div>
</header>
