<style media="screen">
    .tete{
        text-align: center;
      margin-top:0%;
    font-weight: normal;
    }
  .ruban{
    background: lightgrey;
    text-align: center;
  }
  .ruban tr td{
    width: 220px;
  }
  .logo img{
        margin-top: -85px;
        margin-left: 20px;
        width: 65px;
        height: 65px;
    }
  .signature{
    margin-top: 20px;
    margin-left: 450px;
  }
    .liste{
        border-collapse: collapse;
        font-size:15px;
    }
    .liste tr td{
        border: 1px solid;
    height:20px;
    vertical-align:middle;
    }
  .titre{
    margin-top: 20px;
  }
    .titre h4{
        margin-top:-14px;
    }
</style>

<page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm" footer="page;">
    <div class="tete">
    <h5 style="margin-top:-14px;">REPOBLIKAN’I MADAGASIKARA</h5>
    <h5 style="margin-top:-14px;">Fitiavana – Tanindrazana – Fandrosoana</h5>
    <h5 style="margin-top:-14px;">------------oOo------------</h5>
    <h5 style="margin-top:-14px;">MINISTERE DE L’ENSEIGNEMENT SUPERIEUR ET DE LA RECHERCHE SCIENTIFIQUE</h5>
    <h5 style="margin-top:-14px;">------------oOo------------</h5>
    <h5 style="margin-top:-14px;color:blue;"><span style="color:red;">I</span>NSTITUT
      <span style="color:red;">S</span>UPERIEUR DE <span style="color:red;">T</span>ECHNOLOGIE <span style="color:red;">D</span>’ANTSIRANANA</h5>
    <table class="ruban">
      <tr>
        <td>B.P. 509 Antsiranana - 201</td>
        <td>istd@ist-antsiranana.mg</td>
        <td>www.ist-antsiranana.mg</td>
      </tr>
    </table>
  </div>
  <div class="logo">
    <img src="logo_ist.png">
  </div>
    <div class='titre'>
  <h4>Concours d'entrée en formation de niveau {{ ucfirst($niveau) }}</h4>
    <h4>Session du {{ mySql_date_concours($concours_date[0], $concours_date[1]) }}</h4>
  <h4>Centre {{ $centre->lieu }}</h4>
  @isset( $salle )
    <h4>Salle: {{ $salle->reference }}</h4>
  @endisset
  @isset( $jury )
    <h4>Jury: {{ $jury->nom }}</h4>
  @endisset
  <h4>Date:_____________ Epreuve:____________________________ Heure:_______________</h4>
    </div>
    <div class='tableau'>
        <table class='liste'>
            <tr style="font-weight: bold;background:lightgrey;">
                <td>Numéro d'inscriptions</td>
                <td>Nom et prénom</td>
        <td>Parcours</td>
                <td>Salle</td>
            </tr>

        @foreach( $candidats as $candidat )
          <tr>
            <td>{{ $candidat->numInscription }}</td>
            <td>{{ $candidat->nomComplet }}</td>
            <td>{{ $candidat->salle->reference }}</td>
            <td></td>
          </tr>
        @endforeach
        @if( count($candidats) <= 25 )
          @for($i = 1; $i < 25 - count($candidats) ; $i++ )
          <tr>
            <td></td>
            <td style='width:250px;'></td>
            <td></td>
            <td></td>
          </tr>
          @endfor
        @endif
        </table>
    </div>
</page>