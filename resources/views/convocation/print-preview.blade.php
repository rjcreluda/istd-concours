@foreach( $candidats as $candidat )
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
    .photo{
      width: 150px;
      height: 150px;
      margin-top: -80px;
      margin-left: 526px;
      border: 2px solid;
      text-align: center;
      vertical-align: middle;
    }
    .convocation *{
      font-size: 15px;
      line-height: 1.2;
    }
    .convocation table tr td{
      height: 20px;
      border: 1px solid;
      padding-left: 20px;
      padding-right: 20px;
      vertical-align: middle;
    }
    .convocation table{
      border-collapse: collapse;
    }
    .signature{
      margin-top: 25px;
      margin-left: 450px;
    }
    .incomplete{
      width: 400px;
    }
</style>
<page backtop="10mm" backleft="10mm" backright="10mm" backbottom="10mm">
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
  <div class="convocation">
    <h4 style="margin-top:40px;text-align:center;font-size:20px;">CONVOCATION</h4>
    <div class="photo">
      Photo 4x4
    </div>
    <div><br/>A {{ ucfirst( $candidat->civilite ) }}
      <strong>{{ strtoupper($candidat->nom)}} {{ ucwords($candidat->prenom) }}</strong>
      <br/><br/>
      Vous êtes régulièrement inscrit(e) au concours d'entrée en première année à l'IST-D,
      session du <strong>{{ mySql_date_concours( $date_concours['date1'], $date_concours['date2']) }}</strong> dans :
      <ul>
      <li>Direction <strong>{{ $ecole->nom }}, {{ $ecole->code }},</strong></li>
         <li>Parcours <strong>{{ $parcours->nom }}, {{ $parcours->code }}.</strong></li>
       </ul>
      Votre numéro d'inscription vous sera communiqué ultérieurement.
      Les jours du concours, vous êtes prié(e) de se munir de
      la présente convocation et d'une <strong>pièce d'identité</strong> au centre d'examen <strong>{{ $candidat->centre->lieu }}</strong>
    </div>
    <strong style="text-decoration:underline;margin-top:15px;">Calendrier des épreuves</strong>
    <br/>
    <br/>
    @if( $ecole->code == 'EGMCS' )
      @include('convocation.calegmcs', [ 'date' => $date_concours])
    @else
      @include('convocation.calegi', [ 'date' => $date_concours])
    @endif
    <br/>
    <div style='font-size:9px;'>Pour tous renseignement complémentaires contacter <strong style='font-size:9px;'>034 11 859 05</strong> ou <strong style='font-size:9px;'>032 05 630 11</strong>.</div>
    <br/>
    @if( !$candidat->dossier_ok )
      <div style='font-size:9px;' class="incomplete">
        <div style='font-size:9px;'><strong style='font-size:9px;'>NB : </strong>Merci de nous fournier les complement de dossier avant la date du concours</div>
      </div>
    @endif
  </div>
  <div class="signature">
    Fait a Antsiranana, le {{ $date_actuel }}<br>
<!--    La Directrice Générale <br>
    <span style="margin-top:100px;">Lova RAHARIMIHAJA ZAKARIASY</span>-->
  </div>
</page>
@endforeach