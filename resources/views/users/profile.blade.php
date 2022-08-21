@extends('layouts.app')

@section('title', 'Utilisateurs')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Compte'])
    <!-- /.row -->
    @include('partials.message')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="white-box">
                <h3 class="box-title m-b-0">Information de profile</h3>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('users.update', ['user' => $user->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Nom</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control"  name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail{{$user->id}}">Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
                                    <input type="email" class="form-control" id="exampleInputEmail{{$user->id}}" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputLogin{{$user->id}}">Login</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="exampleInputLogin{{$user->id}}" name="login" value="{{ $user->login }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Changer Mot de passe</label> <button onclick="document.getElementById('passChange').style.visibility='visible'" class="btn" type="button">Changer</button>
                                <div id="passChange" style="visibility: hidden;">
                                    <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                    <input type="password" placeholder="******" name="password"  class="form-control">
                                </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label>Type d'utilisateur</label>
                                @admin
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <select name="type" class="form-control" data-placeholder="Choisir le type" tabindex="1">
                                        <option value="os" @if( $user->type == 'os') selected @endif>Opérateur de saisie</option>
                                        <option value="controlleur" @if( $user->type == 'controlleur') selected @endif>Contrôlleur</option>
                                        <option value="admin" @if( $user->type == 'admin') selected @endif>Administrateur</option>
                                    </select>
                                </div>
                                @else
                                    <div>{{ $user->type }}</div>
                                @endadmin
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Mettre à jour</button>
                            <!-- <button class="btn btn-inverse waves-effect waves-light">Annuler</button> -->
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
@endsection