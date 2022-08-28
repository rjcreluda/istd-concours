<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="mt-5"> <a href="/" class="waves-effect"><i class="ti-home mr-1"></i> <span class="hide-menu"> Accueil </span></a></li>
            @admin
                <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-settings mr-2" data-icon="v"></i> <span class="hide-menu">Le concours<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('concours.index') }}">Liste</a></li>
                        <li><a href="{{ route('parcours.index') }}">Parcours</a></li>
                        <li><a href="{{ route('salles.index') }}">Salles</a></li>
                        <li><a href="{{ route('jury.index') }}">Jury</a></li>
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
                    @admin
                    <li><a href="{{ route('salles.list') }}">Liste par salle</a></li>
                    <li><a href="{{ route('candidats.attribution') }}">Attribution</a></li>
                    @endif
                </ul>
            </li>
            @admin
            <li>
                <a href="javascript:void(0);" class="waves-effect"><i class="ti-folder mr-2" data-icon="v"></i> <span class="hide-menu">Fiche de presence<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('fiche.centre_exam', ['cycle' => '1er-cycle']) }}">1er cycle</a></li>
                    <li><a href="{{ route('fiche.centre_exam', ['cycle' => '2nd-cycle']) }}">2nd cycle</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('liste_candidat.centre_exam') }}" class="waves-effect"><i class="ti-folder mr-2" data-icon="v"></i> <span class="hide-menu">Liste candidats pour affiche</span></a>
            </li>
            @endif

            @admin_controlleur
            <li><a href="javascript:void(0);" class="waves-effect"><i data-icon=")" class="ti-calendar mr-2"></i> <span class="hide-menu">Convocation<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('convocation.par_jour') }}">Imprimer par jour</a></li>
                    <li><a href="{{ route('convocation.liste_parcours') }}">Imprimer un à un</a></li>
                    <li><a href="{{ route('convocation.par_date') }}">Imprimer par date</a></li>
                </ul>
            </li>

            <li><a href="{{ route('candidats.saisit-du-jour')}}" class="waves-effect"><i data-icon=")" class="ti-calendar mr-2"></i> <span class="hide-menu">Saisie du jour</span></a>
            </li>
            @endif

            @admin
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
            @endif

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
