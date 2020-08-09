<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Vendas</li>
            <li>
                <a href="{{ route('sales.create') }}" class="{{ (request()->is('sales.create')) ? 'mm-active' : '' }} ">
                    <i class="metismenu-icon pe-7s-plus"></i>
                    Nova venda
                </a>
            </li>
            <li>
                <a href="{{ route('sales.index') }}" class="{{ (request()->is('sales.create')) ? 'mm-active' : '' }} ">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Lista de vendas
                </a>
            </li>
            <li class="app-sidebar__heading">Dashboards</li>
            <li>
                <a href="{{ route('dashboard') }}" class="{{ (request()->is('dashboard*')) ? 'mm-active' : '' }} ">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Resumo
                </a>
            </li>
            <li class="app-sidebar__heading">Menus</li>
            <li>
                <a class="{{ (request()->is('products*')) ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Produtos
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('products.index') }}">
                            <i class="metismenu-icon"></i>
                            Novo produto
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}">
                            <i class="metismenu-icon"></i>
                            Listar produtos
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="#" class="{{ (request()->is('categories*')) ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-photo-gallery"></i>
                    Categoria
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('categories.index') }}">
                            <i class="metismenu-icon">
                            </i>Nova categoria
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}">
                            <i class="metismenu-icon">
                            </i>Listar categorias
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="{{ (request()->is('customers*')) ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-users"></i>
                    Cliente
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('customers.index') }}">
                            <i class="metismenu-icon">
                            </i>Novo cliente
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customers.index') }}">
                            <i class="metismenu-icon">
                            </i>Listar clientes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customers.birthdays') }}">
                            <i class="metismenu-icon">
                            </i>Aniversáriantes
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
