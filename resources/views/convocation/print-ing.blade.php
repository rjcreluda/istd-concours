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
    margin-left: 526px;
    border: 2px solid;
    text-align: center;
    vertical-align: middle;
    margin-top: 230px;
    position: absolute;
  }
  .convocation *{
    font-size: 15px;
    line-height: 1.2;
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
    <p style="text-align:right;">Antsiranana, le {{ $date_actuel }}</p>
    <div class="photo">
      Photo 4x4
    </div>
    <div>
    <p><strong>Réf :</strong> {{ $candidat->numInscription }}</p>
    <p>{{ ucfirst( $candidat->civilite ) }} {{ strtoupper($candidat->nom) }} {{ ucwords($candidat->prenom) }}</p>
    <p><strong>Tél : </strong>{{ $candidat->telephone }}</p>
    <p><strong>Centre : </strong>{{ $candidat->centre->lieu }}</p>
    <div style="margin-left:20px;">
      <strong>Objet : </strong> Sélection de dossier <br/>
      <br>
      Nous avons le plaisir de vous informer que votre canidature a été retenue pour passer les épreuves d'admission définitive en première
      année de formation d'ingénieur à l'Institut Supérieur de Technologie d'Antsiranana (IST-D) pour l'année scolaire <?php
      $d=date('Y');
      $d1=$d+1;
      echo " ".$d."-".$d1;
      ?>, <br/><br/>
      <strong>Parcours : </strong> {{ $parcours->nom }}<br><br>
      A ce titre vous devez vous présenter, muni(e) de la présente convocation et d'une pièce d'identité au centre d'exament de <strong>{{ $candidat->centre->lieu }}</strong> le
      <strong>{{ strftime("%d %B %Y", strtotime($date_concours['date1'])) }}</strong> <strong>à 7h30</strong> pour passer les épreuves écrite et orale.
      <br/><br>
      Pour compléter votre dossier, vous devez nous remettre également au plus tard <strong>à la date indiquée</strong>, un rapport détaillé (cinq pages au minimum) de votre parcours professionnel décrivant :
      <ul>
        <li>le ou les postes que vous y avez occupés,</li>
        <li>votre fonction dans la hiérarchie,</li>
        <li>Vos relation avec vos supérieurs et vos collègues,</li>
        <li>les tâches qui vous on été assignées,</li>
        <li>etc.......</li>
      </ul>
    </div>
    </div>
    <br/>
    <div style='font-size:9px;'>Pour tous renseignement complémentaires contacter <strong style='font-size:9px;'>034 11 859 05</strong> ou <strong style='font-size:9px;'>032 05 630 11</strong>.</div>
    <br/>
    @if( !$candidat->dossier_ok )
    <div style='font-size:9px;' class="incomplete">
      <div style='font-size:9px;'><strong style='font-size:9px;'>NB : </strong>Merci de nous fournier les complement de dossier avant la date du concours</div>
    </div>
    @endif
  </div>
</page>

@endforeach