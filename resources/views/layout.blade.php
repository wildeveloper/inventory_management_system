<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']);
    
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="index3.html" class="brand-link">
                <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">CoreProc</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Wilfredo Cadiang</a>
                    </div>
                </div>


                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ request()->is('/')? 'active':'' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/users" class="nav-link {{ request()->is('users')? 'active':'' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="/brands" class="nav-link {{ request()->is('brands')? 'active':'' }}">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Brands
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/category" class="nav-link {{ request()->is('catefgory')? 'active':'' }}">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/stores" class="nav-link {{ request()->is('stores')? 'active':'' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Stores
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/attributes" class="nav-link {{ request()->is('attributes')? 'active':'' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Attributes
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/products" class="nav-link {{ request()->is('products')? 'active':'' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Products
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/orders" class="nav-link {{ request()->is('orders')? 'active':'' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Orders
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/reports" class="nav-link {{ request()->is('reports')? 'active':'' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Reports
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/company" class="nav-link {{ request()->is('company')? 'active':'' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Company
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/profile" class="nav-link {{ request()->is('profile')? 'active':'' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/setting" class="nav-link {{ request()->is('setting')? 'active':'' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Setting
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/logout" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">

            @yield('content')

            

        </div>


        <aside class="control-sidebar control-sidebar-dark">

            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>


        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>

            <strong>Copyright &copy; 2023 <a href="https://coreproc.com">Coreproc</a>.</strong> All rights
            reserved.
        </footer>
    </div>


    
</body>

</html>
