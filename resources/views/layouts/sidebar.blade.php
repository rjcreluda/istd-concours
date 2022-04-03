<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li> <a href="/" class="waves-effect"><i class="ti-home mr-1"></i> <span class="hide-menu"> Accueil </span></a></li>
            @admin
                <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-settings mr-2" data-icon="v"></i> <span class="hide-menu">Le concours<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('concours.index') }}">Liste</a></li>
                        <li><a href="{{ route('parcours.index') }}">Parcours</a></li>
                        <li><a href="{{ route('salles.index') }}">Salles</a></li>
                        <li><a href="{{ route('settings.index') }}">Notes et Deliberation</a></li>
                    </ul>
                </li>

                <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-folder mr-2" data-icon="v"></i> <span class="hide-menu">Resultats<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="{{ route('resultats.brute') }}">Brute</a></li>
                        <li> <a href="{{ route('resultats.deliberation') }}">Deliberation</a></li>
                        {{-- <li> <a href="/resultats_final">Final</a></li> --}}
                    </ul>
                </li>
            @endif

            <li><a href="javascript:void(0);" class="waves-effect"><i data-icon=")" class="ti-user mr-2"></i> <span class="hide-menu">Candidats<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('candidats.create') }}">Ajouter nouveau</a></li>
                    @foreach($ecoles as $ecole)
                    <li><a href="{{ route('candidats.ecole', ['ecole' => $ecole->id])}}">{{ $ecole->code }}</a></li>
                    @endforeach
                    <li><a href="{{ route('candidats.attribution') }}">Attribution</a></li>
                </ul>
            </li>

            <li class="m-l-5 font-weight-bold">EGI</li>
            <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span class="hide-menu">Notes EGI<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    @foreach($parcours_egi as $p)
                    <li><a href="{{ route('notes.transcription', ['parcour' => $p->id])}}">{{ $p->code }}</a></li>
                    @endforeach
                </ul>
            </li>

            <li class="m-l-5 font-weight-bold">EGMCS</li>
            <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span class="hide-menu">Notes EGMCS<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    @foreach($parcours_egmcs as $p)
                    <li><a href="{{ route('notes.transcription', ['parcour' => $p->id])}}">{{ $p->code }}</a></li>
                    @endforeach
                </ul>
            </li>

            <li class="m-l-5 font-weight-bold">EGCN</li>
            <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span class="hide-menu">Notes EGCN<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    @foreach($parcours_egcn as $p)
                    <li><a href="{{ route('notes.transcription', ['parcour' => $p->id])}}">{{ $p->code }}</a></li>
                    @endforeach
                </ul>
            </li>

            <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-settings mr-2" data-icon="v"></i> <span class="hide-menu">Paramètres<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    @admin
                        <li> <a href="{{ route('users.index') }}">Utilisateurs</a></li>
                    @else
                        <li><a href="{{ route('users.show', ['user' => auth()->user()->id]) }}">Mon compte</a></li>
                    @endif
                </ul>
            </li>

        </ul>
    </div>
</div>
