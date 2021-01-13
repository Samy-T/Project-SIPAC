<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eftimie Murgu</title>
    <link rel="icon" href="images/Stema-EM.png" type="image/x-icon">
    <link rel="stylesheet" href="css/Site_Style.css" type="text/css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
    <script type='text/javascript' src='js/jquery.ba-hashchange.min.js'></script>
    <script type='text/javascript' src='js/dynamicpage.js'></script>
    <script type='text/javascript' src='js/dynamicpage_login.js'></script>
</head>

<body>

<!--Authentication-->
<div id="MenuBar">
    <div class="Login">
        <ul>
            <?php
            if($_SESSION["type_user"] == 1)
                echo "<li>Admin</li>";
            ?>
            <a href="login/login.php"><li><?php echo htmlspecialchars($_SESSION["username"]); ?></li></a>
            <li>  |  </li>
            <a href="login/logout.php"><li>Logout</li></a>
        </ul>
    </div>

    <!--Meniul principal-->
    <div id="Menu">
        <!--Menu Buttons-->
        <div style="text-align: center;">
            <a href="index.php"><button class="dropbtn" onclick="">Acasă</button></a>

            <div class="dropdown">
                <a href="pages/obiective_turistice.php"><button class="dropbtn">Obiective turistice</button></a>
                <div class="dropdown-content">
                    <a href="pages/mori_apă.php">Morile de apă</a>
                    <a href="pages/zi_liliac.php">Valea Liliacului</a>
                    <a href="pages/muzeu.php">Muzeul satului</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="pages/informații.php"><button class="dropbtn">Informații</button></a>
                <div class="dropdown-content">
                    <div class="subdropdown">
                        <a href = "#" >Personalități</a>
                        <div class="dropdown-subcontent">
                            <a href="pages/Eftimie_Murgu.php">Eftimie Murgu</a>
                            <a href="pages/Dr_Ion_Sârbu.php">Dr. Ion Sârbu</a>
                        </div>
                    </div>
                    <a href="pages/dezastru_natural.php">Dezastru natural</a>
                    <div class="subdropdown">
                        <a href="#" >Obiceiuri și tradiții</a>
                        <div class="dropdown-subcontent">
                            <a href="pages/smâlțul_oilor.php">Smâlțul oilor</a>
                            <a href="pages/lunea_cornilor.php">Lunea Cornilor</a>
                            <a href="pages/ruga_bănățeană.php">Ruga bănățeană</a>
                        </div>
                    </div>
                    <a href="pages/Primăria_Eftimie_Murgu.php">Primăria Eftimie Murgu</a>
                    <div class="subdropdown">
                        <button class="subdropbtn">Informații pentru turiști</button>
                        <div class="dropdown-subcontent">
                            <a href="pages/cazare.php">Cazare</a>
                            <a href="pages/restaurant.php">Restaurant</a>
                            <a href="pages/localizare.php">Localizare pe hartă</a>
                            <a href="pages/meteo.php">Prognoza meteo</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <a href="pages/galerie_foto.php"><button class="dropbtn">Galerie foto</button></a>
                <div class="dropdown-content">
                    <a href="gallery/gallery/Mori_de_apă.php">Morile de apă</a>
                    <a href="gallery/gallery/Muzeul_satului.php">Muzeul satului</a>
                    <a href="gallery/gallery/Valea_Rudăriei.php">Valea Rudăriei</a>
                    <a href="gallery/gallery/Lunea_cornilor.php">Lunea cornilor</a>
                    <a href="gallery/gallery/Dezastru_natural.php">Dezastru natural</a>
                </div>
            </div>
            <a href="pages/contact.php"><button class="dropbtn">Contact</button></a>
        </div>
    </div>
</div>



<section id="main-content">
    <div id="container">

        <div class="Title1">
            <h1>Comuna Eftimie Murgu</h1>
        </div>

        <div class="slide">
        </div>

        <div class="Title2">
            <h2>Județul Caraș-Severin</h2>
        </div>

        <div class="Content0">

            <p class="paragraf">
                <span class="alineat"><big><b>Eftimie Murgu</b></big></span>, <i>satul morilor de apă vie și florilor de liliac cu cromatica desprinsă din albastrul cerului</i>, este o comună în județul Caraș-Severin, Banat, România, formată numai din satul de reședință cu același nume.
            </p>

            <p class="paragraf">
                <span class="alineat">Localitatea</span> a fost numită "<u>Rudăria</u>" până în anul 1970, iar acum poartă numele revoluționarului pașoptist <b>Eftimie Murgu</b>, născut în această localitate.
            </p>

            <p class="paragraf">
                <span class="alineat">Din</span> punct de vedere geografic, <b>comuna Eftimie Murgu</b>, este situată în sud-vestul României, la marginea de sud-est a județului Caraș Severin, în depresiunea Almăjului.
            </p>

            <p class="paragraf">
                <span class="alineat">Este situată între:</span>
            </p>

            <ul>
                <li>44º54’16’’ latitudine nordică la Lunca lu’ Brusu;</li>
                <li>44º43’30’’ latitudine sudică la Vrăpcioanea;</li>
                <li>22º2’29’’ longitudine vestică;</li>
                <li>22º12’30’’ longitudine estică.</li>
            </ul>

            <div id="vecini"></div>

            <p class="paragraf">
                <span class="alineat">Localitatea</span> este cunoscută pentru celebrele mori de apă, vechi de sute de ani. <i>Complexul Mulinologic de la Rudăria</i> atrage numeroși turiști din țară și de peste hotare și sunt incluse în <b>Patrimoniul UNESCO</b>.
            </p>

            <div id="suprafață"></div>

            <big><b>Vecini</b></big>
            <hr>
            <p class="paragraf">
                <span class="alineat">Se</span> învecinează la nord cu Prilipeț, la sud cu Munții Almăjului, la vest cu Bănia și la est cu Prigor. Satul mai este de asemenea situat între dealurile Poleanca, Croul Murguleștilor, Țiglărie, Utriște și Iloca (pe partea dreaptă) și pe partea stângă cu dealurile Socoloț, Cotovăț, Prislop, Ronește, Grăocea, Vârtop.
            </p>


            <big><b>Suprafața</b></big>
            <hr>
            <p class="paragraf">
                <span class="alineat">Rudărenii</span> își trăiesc viața în cele 107 ha ale vetrei satului, vatră pe care și-au construit-o de-a lungul anilor.
            </p>

            <p class="paragraf">
                <span class="alineat">Suprafața</span> administrativă este de 9.902 ha, așezată sub cupola timpului și al legendelor, din care 6.103 ha sunt ocupate de păduri, iar aria locuibilă este de 23.602 m<sup>2</sup>, așezată la 335 m altitudine.
            </p>
            <div id="ape"></div>
            <p class="paragraf">
                <span class="alineat">Ocupația</span> de bază a sătenilor este agricultura materializată în cele 1.080 ha de teren arabil, 1.094 ha sunt reprezentate de fânețe, 2.052 ha de pășuni și 306 livezi de pomi fructiferi.
            </p>


            <big><b><div id="ape">Ape</div></b></big>
            <hr>
            <p class="paragraf">
                <span class="alineat">De</span> sub Pregăda izvorăște Rudărica, fir de apă firav, care, unindu-se cu alte izvoare, va coborî către cheile care îi poartă numele. Principalul curs de apă îl constituie pârâul Rudărica, afluent al Nerei.
            </p>

            <p class="paragraf">
                <span class="alineat">Bazinul</span> său este reprezentat de teritoriul comunei, cu o densitate a rețelei hidrografice de 0,81 km/km<sup>2</sup>, fiind cea mai deasă rețea din Banat.
            </p>

            <p class="paragraf">
                <span class="alineat">Cele</span> două izvoare ale Rudăricii își au originea în Munții Svinecea. După unirea celor două izvoare, Rudărica Mare și Rudărica Mică, râul parcurge 10 km printr-o vale splendidă (Valea Rudăricii) și intră în localitatea care până nu demult îi purta numele.
            </p>

            <p class="paragraf">
                <span class="alineat">Albia</span> râului este presărată cu un șirag de mori de apă, începând cu Moara de la Tunel și sfârșind cu Moara din Țarină, mori care până în 1910 însumau un număr de 51, dar potopul din acea primăvară a luat 29 dintre ele, doi oameni plătind și ei cu viața în acea noapte de coșmar.
            </p>

            <p class="paragraf">
                <span class="alineat">Înspre</span> Prisăcina, afluent al Rudăricii, se deschide o potecă străjuită de păduri de carpen și fag. Înainte de a intra în sat, râul străbate faimoasele sale chei, împodobite de o parte și de alta de pădurea de liliac sălbatic pe care primavara îl face să-ți topească simțul olfactiv. Cheile sunt dominate de stânci uriașe și abrupte, două dintre ele având înfațisare omenească, iar localnicii le-au numit <i>"Adam și Eva"</i>.
            </p>

            <p class="paragraf">
                <span class="alineat">În</span> această porțiune de 2 km, valea este vestită prin morile sale de apă vie, mori ce formează <u>cel mai mare complex mulinologic din sud-estul Europei</u>.
            </p>
            <div id="clima"></div>

            <p class="paragraf">
                <span class="alineat">Pe</span> dealul Socoloț, care este situat în partea dreaptă a cheilor, se află rămășițe de ceramică aparținând “curentului” Coțofeni.
            </p>

            <big><b><div id="vecini">Clima</div></b></big>
            <hr>
            <p class="paragraf">
                <span class="alineat">Datorită</span> așezării văii și a comunei la 6º sud de paralela de 45º, temperatura medie anuală este de +10,5 °C. Cea mai caldă lună este iulie cu o medie de 20,2 ºC, iar cea mai răcoroasă lună este luna ianuarie cu o temperatura medie de 1,5 °C. Primavara se înregistrează o medie de 11,3 °C, iar toamna are o medie a temperaturii de 11,9 °C.
            </p>

            <p class="paragraf">
                <span class="alineat">Sunt</span> cunoscute 5 vânturi care împrospătează aerul localitații:
            </p>

            <ul>
                <li>Sebeșanu - vânt rece din nord-vest;</li>
                <li>Bârzășteanu - cu ploi calde din sud;</li>
                <li>Boarea - vânt secetos din vest;</li>
                <li>Căcâcea - din vest;</li>
                <li>Vântu ăl Mare - bate din est.</li>
            </ul>

            <p class="paragraf">
                <span class="alineat">Precipitațiile</span> ating aproximativ 670 mm<sup>3</sup>/an. Climei din sud-estul Banatului îi sunt caracteristice și influențe mediteraneene, însoțite de precipitații bogate, în special primăvara și toamna.
            </p>

            <p class="paragraf">
                <span class="alineat">În</span> timpul iernii sunt destul de dese zilele când precipitațiile cad sub formă lichidă, fapt datorat tot influențelor mediteraneene, influențe care își pun amprenta și asupra faunei și vegetației.
                În aceste locuri, iese în evidență rolul pe care îl joacă relieful în mersul anotimpurilor. Cantitatea de precipitații constituie una dintre verigile cele mai importante ale acestei clime și totodată una dintre verigile principale ale circuitului apei în natură. Sumele anuale ale precipitațiilor căzute pe raza zonei studiate, ajung la valoarea de 700-750 mm<sup>3</sup>, aceasta datorită, în mare măsură, frecvenței mari a maselor de aer umed care se produc în partea posterioară a ciclonilor ce se formează în cadrul frontului polar.
            </p>
            <div id="relief"></div>
            <p class="paragraf">
                <span class="alineat">În</span> semestrul cald, între 1 aprilie și 30 septembrie, cad în medie 450 mm<sup>3</sup> de apă, ce reprezintă 65% din cantitatea anuală de precipitații. În semestrul rece cad între 300-350 mm³, ca urmare a predominării regimului anticiclonic, din prezentarea acestor valori, rezultă că precipitațiile au un caracter continental.În timpul iernii, precipitațiile cad mai ales sub formă lichidă, fapt datorat influențelor mediteraneene, influențe ce se manifestă și în floră și vegetație.
            </p>


            <big><b>Relieful</b></big>
            <hr>
            <p class="paragraf">
                <span class="alineat">Relieful</span> este variat și armonios îmbinat. Zona muntoasă cuprinde o parte a versanților vestici ai munților Almăjului, culminând cu vârful <i>Svinecea Mare (1224 m)</i>, cel mai înalt vârf calcaros din județ.
            </p>

            <center><img src="images/Svinecea Mare.jpg" title="Svinecea Mare" alt="Această imagine nu poate fi afișată!"/></center>

            <p class="paragraf">
                <span class="alineat">Cheile</span> încep de la ultimele case de la ieșirea din Eftimie Murgu, în partea de sud-vest. Ele au luat naștere în urma eroziunii efectuate de râul Rudărica. Pe o lungime de 1,5 km, cheile devin înguste, pereții masivelor cristaline se apropie între ei, abia lăsând loc drumului forestier.
                Versantul stâng este mai sălbatic și mai semeț decât cel drept și datorită fenomenului de eroziune eoliană unele stânci au luat forme mai ciudate <i>(Adam și Eva)</i>.
            </p>

            <center><img src="images/Adam_Eva.jpg" width="760px" height="550px" title="Adam și Eva" alt="Această imagine nu poate fi afișată!"/></center>

            <p class="paragraf">
                <span class="alineat">Versantul</span> drept este mai bogat în vegetație.
                La intrarea în chei, pe versantul drept se ridică masivul <i>Rudina Mare (825 m)</i>, alcătuit din serpentine. Pe masivul de serpentine se găsește o vegetație ierboasă foarte săracă, vârfurile fiind complet golașe. Versantul stâng se continuă cu dealul <i>Socoloț (723 m)</i> și cu versantul vestic abrupt mărginit de <i>Tâlva Gabroțului (992 m)</i>.
            </p>

            <p class="paragraf">
                <span class="alineat">După</span> circa 2 km, cheile își pierd aspectul caracteristic, versanții fiind acoperiți de păduri.
                Masivele <i>Svinecea, Pregăda și Lalca</i> sunt formate din calcare liasice, iar restul reliefului muntos este format din șisturi cristaline.
                În zona depresionară, relieful se termină cu vârful <i>Rudina (870 m)</i> și <i>Tâlva Gabroțului (992 m)</i> sub care coboară vertiginos cu 400-500 m până în <i>Depresiunea Almajului</i> cu terasele și dealurile care compun țarina localității.
            </p>

            <p class="paragraf">
                <span class="alineat">Formarea</span> cheilor în șisturi crisatline apare ca urmare a gradului mare de tectonizare, rețeaua fisurilor accentuând procesul eroziv. Se observă o creștere a versanților din amonte în aval, pe măsura apropierii de contactul tectonic dintre cristalinul autohton și cristalinul getic, cunoscut sub numele de “Linia Rudăria”, accident tectonic de mare amploare, soldat uneori cu mari inundații așa cum au fost cele din primăvara anilor 1910 și 1941 sau cele din toamna lui 1827 și 1955 care au provocat mari pagube materiale.
            </p>

            <p class="paragraf">
                <span class="alineat">La</span> <i>Cracul lui Otiman</i> și la <i>Priod</i> s-a confirmat existența minereurilor ce conțin 38% fier și 17%-20% mangan, simbolizând tălăzuirea minerală a mileniilor copleșite de mari rezerve. Minereul de aici, după bătrânii satului, a fost transportat cu cocia la Anina. La <i>Marinizvor</i> și la <i>Curmulice</i> se găsește azbest crizolit, oblenda și micru, folosite la fabricarea tuburilor de bitum, clingheritei (material preparat dintr-un amestec de azbest, cauciuc și un liant mineral, folosit la fabricarea unor garnituri rezistente la temperaturi și la presiuni înalte) și cartonului azbestat. La <i>Curmulice</i> și la <i>Priod</i> se mai găsește și mozaic alb și roșu.
                Importante zăcăminte de lignit au fost semnalate la Rușnic și Socoloț, iar pe Cotovăț a fost exploatat aur, aflat sub formă de filoane.
                O altă resursă importantă o constituie pădurile de fag, păduri foarte exploatate.
            </p>
        </div>
    </div>
</section>

<footer>
    &copy Copyright 2021 | Toate drepturile rezervate
    <br>
    Web design by Samuel Turculescu
</footer>

</body>
</html>