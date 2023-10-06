<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Menu Principal</span>
                </li>
                
                <li class="nav-item">
                    <a href="{{route('accueil')}}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>

                @if (Session::get('role_name') === 'Super Admin')
                <li class="submenu {{set_active(['liste/utilisateurs'])}} {{ (request()->is('view/user/edit/*')) ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-shield-alt"></i>
                        <span>Utilisateurs</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('all.users') }}" class="{{set_active(['liste/utilisateurs'])}} {{ (request()->is('view/user/edit/*')) ? 'active' : '' }}">Liste des utilisateurs</a></li>
                        <li><a href="{{ route('add.user') }}">Ajouter un utilisateur</a></li>
                    </ul>
                </li>
                @endif

               
                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i>
                        <span>Productions</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('all.productions') }}">Productions</a></li>
                        <li><a href="{{ route('add.production') }}">Ajouter production</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i>
                        <span> Sinistres AT & RD</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('all.sinistres.at.rd') }}">Sinistres AT & RD</a></li>
                        <li><a href="{{ route('add.sinistre.at.rd') }}">Ajoutr sinistre AT & RD</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i>
                        <span> Sinistres DIM</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('all.sinistres.dim') }}">Sinistres DIM</a></li>
                        <li><a href="{{ route('add.sinistre.dim') }}">Ajouter sinistre DIM</a></li>
                    </ul>
                </li>
                @if (Session::get('role_name') === 'Super Admin')
                <li class="menu-title">
                    <span>Gestion</span>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-cog"></i>
                        <span>Compagnies</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('all.compagnies') }}">Compagnies</a></li>
                        <li><a href="{{ route('add.compagnie') }}">Ajouter compagnie</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-cog"></i>
                        <span>Productions</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('all.branches') }}">Branchs</a></li>
                        <li><a href="{{ route('all.act_gestions') }}">Actes de gestion</a></li>
                        <li><a href="{{ route('all.charge_comptes') }}">Chargés ce compte</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-cog"></i>
                        <span>Sinistres DIM</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('all.branches.sinistres.dim') }}">Branchs</a></li>
                        <li><a href="{{ route('all.acte.gestion.sinistres.dim') }}">Actes de gestion</a></li>
                        <li><a href="{{ route('all.charge.compte.sinistres.dim') }}">Chargés ce compte</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-cog"></i>
                        <span>Sinistres AT&RD</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('all.branches.sinistres') }}">Branchs</a></li>
                        <li><a href="{{ route('all.acte.gestion.sinistres') }}">Actes de gestion</a></li>
                        <li><a href="{{ route('all.charge.compte.sinistres') }}">Chargés ce compte</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>