<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Panel - {{ config('app.name') }}</title>
        <link href="/admin_panel/css/table_style.min.css" rel="stylesheet" />
        <link href="/admin_panel/css/styles.css" rel="stylesheet" />
        <script src="/admin_panel/js/all.js"></script>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Admin Panel</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/admin/profile">Профиль</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                         <form method="POST" action="{{ route('logout') }}">
                            @csrf

                       <x-profile.dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                       </x-profile.dropdown-link>
                          </form>
                    </ul>
                </li>
            </ul>


        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!--div class="sb-sidenav-menu-heading">Core</div-->
                            <a class="nav-link" href="/admin">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               Консоль
                            </a>
                              <a class="nav-link" href="/">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-eye"></i></div>
                                Перейти на сайт
                            </a>
                             <div class="sb-sidenav-menu-heading">Настройки</div>
                               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsetting" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                               Настройки
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsetting" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/admin/field"><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Строки переводов</a>
                                    <a class="nav-link" href="/admin/locale"><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Локализация сайта</a>
                                    <a class="nav-link" href="/admin/setting"><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Настройки</a>
                                    <a class="nav-link" href="/admin/widget"><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Виджеты</a>
                                    <a class="nav-link" href="/admin/activity_log"><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Логирование</a>
                                    <a class="nav-link" href="/admin/feedback"><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Заявки</a>
                                </nav>
                            </div>
                             <a class="nav-link" href="/admin/user">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-eye"></i></div>
                                Пользователи
                            </a>
                            <div class="sb-sidenav-menu-heading">Контент</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMenu" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                               Меню сайта
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMenu" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/admin/menu">Список меню</a>
                                </nav>
                            </div>

                          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSections" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                               Список разделов
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseSections" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="/admin/work/post" data-bs-toggle="collapse" data-bs-target="#pagesCollapseNews" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Проекты
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseNews" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionNews">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="/admin/work/post">Записи</a>
                                        </nav>
                                    </div>



                                </nav>
                            </div>

                             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePage" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                               Страницы
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePage" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/admin/page">Список страниц</a>
                                </nav>
                            </div>

                        </div>
                    </div>
                    <!--div class="sb-sidenav-footer">
                        <div class="small">Lorem ipsum dolor sit.</div>
                        Lorem ipsum dolor sit amet.
                    </div-->
                </nav>
            </div>
            <div id="layoutSidenav_content">
                @section('content')

                @show

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; {{ (date('Y') == '2024')? date('Y'):'2024 - '.date('Y') }}</div>
                            <div>
                               <!--a href="#">test link</a-->
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        @section('filemanager_script')

        @show

        <script src="/admin_panel/js/bootstrap.bundle.min.js"></script>
        <script src="/admin_panel/js/scripts.js"></script>

        @section('table_script')

        @show
        
        <script src="/admin_panel/assets_admin/js/simple-datatables.min.js" ></script>
        <script src="/admin_panel/js/datatables-simple-demo.js"></script>
        <script src="/admin_panel/js/bootstrap.min.js"></script>

    </body>
</html>
