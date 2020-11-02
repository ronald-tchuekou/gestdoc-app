<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color ">
            <div class="mobile-sidebar-header d-md-none">
                <div class="header-logo">
                    <a href="index.html"><img src=" asset('img/logo1.png') " alt="logo" /></a>
                </div>
            </div>
            <div class="sidebar-menu-content">
                <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-dashboard">
                            </i><span>Tableau de bord</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="route('home')" class="nav-link">
                                    <i class="fas fa-angle-right"></i>acceuil</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-gear-loading"></i>
                        <span>Gestion</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item"> <!-- TODO set the id of the  current etablissement. -->
                                <a href="route('gestion.sub-system', ['id' => 1])" class="nav-link">
                                <i class="fas fa-angle-right"></i>Créer sous-système</a>
                            </li>
                            <li class="nav-item">
                                <a href="route('gestion.teaching-type', ['id' => 1])" class="nav-link">
                                <i class="fas fa-angle-right"></i>Créer type d’enseignement</a>
                            </li>
                            <li class="nav-item">
                                <a href="route('gestion.posts')" class="nav-link">
                                <i class="fas fa-angle-right"></i>Créer Poste</a>
                            </li>
                        </ul>
                    </li>
                    
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Planification</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="" class="nav-link sidebar-nav-item"><i
                                            class="fas fa-angle-right"></i>Configuration</a>
                                    <ul class="nav sub-group-menu">
                                        <li class="nav-item">
                                            <a href="route('planification.subject')" class="nav-link"><i
                                                    class="fas fa-angle-right"></i>Matière</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="route('planification.classe')" class="nav-link"><i
                                                    class="fas fa-angle-right"></i>classe</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="route('planification.salle')" class="nav-link"><i
                                                    class="fas fa-angle-right"></i>salle</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link"><i class="fas fa-angle-right"></i>Fonction
                                    </a>
                                    <ul class="nav sub-group-menu">
                                        <li class="nav-item">
                                            <a href="route('planification.department_chief')" class="nav-link"><i
                                                    class="fas fa-angle-right"></i>Chef département</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="route('planification.principal_instructor')" class="nav-link">
                                                <i class="fas fa-angle-right"></i>Enseignant principal</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="route('planification.level2')" class="nav-link"><i
                                                    class="fas fa-angle-right"></i>Niveau d’accès 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="planning.html" class="nav-link"><i class="fas fa-angle-right"></i>Planning
                                    </a>
                                    <ul class="nav sub-group-menu">
                                        <li class="nav-item">
                                            <a href="route('planification.annual_program')" class="nav-link"><i
                                                    class="fas fa-angle-right"></i>Programme annuel</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="route('periods.index')" class="nav-link"><i
                                                    class="fas fa-angle-right"></i>Périodes de cours</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="route('planification.timetable')" class="nav-link"><i
                                                    class="fas fa-angle-right"></i>Emploi de temps</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="route('planification.books_for_program')" class="nav-link"><i
                                                    class="fas fa-angle-right"></i>Livre au programme et fournitures</a>
                                        </li>
--                                         <li class="nav-item">
                                            <a href="Livre-au-programme-et-fournitures.html" class="nav-link"><i
                                                    class="fas fa-angle-right"></i>Programme académique annuel
                                                Tableau</a>
                                        </li> --
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-classmates"></i><span>Administrateur</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="route('administrators.index')" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Tous les
                                        Administrateurs
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="route('administrators.create')" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Créer administrateur</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-multiple-users-silhouette"></i><span>Enseignants</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="route('teachers.index')" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Tout Enseignants</a>
                                </li>
                                <li class="nav-item">
                                    <a href="route('teachers.create')" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Ajouter Enseignant</a>
                                </li>
                                <li class="nav-item">
                                    <a href="route('teachers-payment')" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Paiement</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item d-none">
                            <a href="#" class="nav-link"><i
                                    class="flaticon-bus-side-view"></i><span>Statistique</span></a>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-couple"></i><span>Parents</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="route('parents.index')" class="nav-link"><i
                                            class="fas fa-angle-right"></i>Tous les Parents</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-books"></i><span>Bibliothèque</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="route('books.index')" class="nav-link"><i class="fas fa-angle-right"></i>Tous
                                        Livres</a>
                                </li>
                                <li class="nav-item">
                                    <a href="route('books.create')" class="nav-link"><i class="fas fa-angle-right"></i>Ajouter
                                        nouveau
                                        Livre</a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="route('attendance')" class="nav-link"><i
                                    class="flaticon-checklist"></i><span>presences journalière</span></a>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-shopping-list"></i><span>Examen</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="route('examens.index')" class="nav-link"><i
                                            class="fas fa-angle-right"></i>programme des exames</a>
                                </li>
                                <li class="nav-item">
                                    <a href="route('examens.notes')" class="nav-link"><i class="fas fa-angle-right"></i>Notes
                                        des examens
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="transport.html" class="nav-link"><i
                                    class="flaticon-bus-side-view"></i><span>Transport</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="notice-board.html" class="nav-link"><i class="flaticon-script"></i><span>Tableau
                                    d'affichage</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="account-settings.html" class="nav-link"><i
                                    class="flaticon-settings"></i><span>Paramètres</span></a>
                        </li>
                    </ul>
                </div>
            </div>
