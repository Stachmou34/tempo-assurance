/* tempo-blog-data.js — Blog data for Tempo-Assurance.
   Edit article bodies here (body = inner HTML of .prose).
   ---------------------------------------------------------------- */

var CHECK = '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12.5l5 5L20 6"/></svg>';
var BOLT  = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--field)" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M13 3L5 13h6l-1 8 8-10h-6z"/></svg>';

var BLOG_CATS = ['Tous', 'Guides', 'R\u00e9glementation', 'Conseils', 'Pratique'];

var BLOG_POSTS = [
  {
    id: 'p1',
    cat: 'Guides',
    featured: true,
    title: 'Acheter d\u2019occasion\u00a0: roulez assur\u00e9 d\u00e8s l\u2019achat',
    excerpt: 'Vous venez de signer l\u2019acte de vente, mais la carte grise n\u2019est pas encore \u00e0 votre nom. Voici comment \u00eatre couvert pour rentrer chez vous en toute l\u00e9galit\u00e9.',
    read: '6 min', date: '28 mai 2026', author: 'L\u00e9a Marchand',
    body: `
<p class="lead">Vous venez de tomber d\u2019accord sur le prix, la poign\u00e9e de main est \u00e9chang\u00e9e \u2014 mais aux yeux de la loi, vous ne pouvez pas d\u00e9marrer tant que le v\u00e9hicule n\u2019est pas assur\u00e9 \u00e0 votre nom. Voici comment franchir ce dernier m\u00e8tre sans risque.</p>
<p>Lors d\u2019un achat entre particuliers, l\u2019assurance du vendeur ne vous couvre pas. D\u00e8s que la cession est sign\u00e9e, c\u2019est \u00e0 l\u2019acheteur de pr\u00e9senter une attestation valable pour prendre le volant \u2014 y compris pour les quelques kilom\u00e8tres qui s\u00e9parent le lieu de la vente de votre domicile.</p>
<h2>Pourquoi l\u2019assurance du vendeur ne suffit pas</h2>
<p>Contrairement \u00e0 une id\u00e9e r\u00e9pandue, le contrat du vendeur ne se \u00ab\u00a0transfère\u00a0\u00bb pas automatiquement. Il est r\u00e9sili\u00e9 ou suspendu \u00e0 la vente, et m\u00eame s\u2019il courait encore, il ne d\u00e9signe pas le nouveau conducteur. Rouler sans couverture propre, c\u2019est s\u2019exposer \u00e0 une amende, une immobilisation du v\u00e9hicule et une responsabilit\u00e9 totale en cas d\u2019accident.</p>
<blockquote><p>\u00ab\u00a0Le jour de l\u2019achat, la priorit\u00e9 n\u2019est pas la carte grise\u00a0: c\u2019est l\u2019attestation qui vous autorise \u00e0 rouler.\u00a0\u00bb</p></blockquote>
<h2>La solution\u00a0: une assurance temporaire</h2>
<p>Une formule courte dur\u00e9e vous couvre de 1 \u00e0 90 jours, le temps d\u2019effectuer le changement de titulaire et, si besoin, de comparer les offres annuelles \u00e0 t\u00eate repos\u00e9e. Vous souscrivez en ligne, en quelques minutes, et recevez votre attestation imm\u00e9diatement par e-mail.</p>
<ul>
<li><span class="gk">${CHECK}</span> Permis de conduire et carte grise (m\u00eame barr\u00e9e) suffisent \u00e0 souscrire.</li>
<li><span class="gk">${CHECK}</span> La garantie d\u00e9marre \u00e0 l\u2019heure que vous choisissez, d\u00e8s le paiement.</li>
<li><span class="gk">${CHECK}</span> Aucune reconduction\u00a0: le contrat s\u2019arr\u00eate seul au terme retenu.</li>
</ul>
<div class="tip"><div class="tl">${BOLT} Le conseil Tempo</div><p>Pr\u00e9parez la photo de votre permis et de la carte grise avant de lancer le devis\u00a0: vous bouclez la souscription sur place, depuis votre t\u00e9l\u00e9phone, sans faire attendre le vendeur.</p></div>
<h2>Et apr\u00e8s ces quelques jours\u00a0?</h2>
<p>Une fois la carte grise \u00e0 votre nom, vous choisissez sereinement votre assurance d\u00e9finitive. Si vous roulez peu, sachez que la formule temporaire peut se renouveler ponctuellement \u2014 utile pour un second v\u00e9hicule ou un usage saisonnier.</p>`
  },
  {
    id: 'p2',
    cat: 'R\u00e9glementation',
    title: 'Permis \u00e9tranger\u00a0: ce que dit la loi',
    excerpt: 'Permis europ\u00e9en ou international, la r\u00e8gle change selon votre situation. Le point sur ce qui est exig\u00e9 pour souscrire une assurance.',
    read: '5 min', date: '21 mai 2026', author: 'Karim Benali',
    body: `
<p class="lead">Vous avez un permis d\u00e9livr\u00e9 hors de France et souhaitez souscrire une assurance temporaire\u00a0? La r\u00e8gle change selon le pays d\u2019\u00e9mission. Voici les trois cas que vous pouvez rencontrer.</p>
<h2>Permis europ\u00e9en\u00a0: reconnaissance imm\u00e9diate</h2>
<p>Tout permis d\u00e9livr\u00e9 dans un \u00c9tat membre de l\u2019Union europ\u00e9enne ou de l\u2019Espace \u00e9conomique europ\u00e9en est reconnu de plein droit en France. Aucune traduction ni d\u00e9marche pr\u00e9alable n\u2019est n\u00e9cessaire. Il vous suffit de le pr\u00e9senter lors de la souscription.</p>
<h2>Permis hors UE\u00a0: selon les accords bilatéraux</h2>
<p>Pour les permis \u00e9mis hors de l\u2019EEE, la France a conclu des accords bilatéraux avec une quarantaine de pays (Maroc, Tunisie, Québec, Sénégal\u2026). Si votre pays figure dans cette liste, votre permis est directement valable. Dans le cas contraire, un permis international (convention de Vienne 1968) est requis.</p>
<ul>
<li><span class="gk">${CHECK}</span> Permis UE/EEE\u00a0: présentez-le directement, sans démarche supplémentaire.</li>
<li><span class="gk">${CHECK}</span> Permis d\u2019un pays lié par accord bilatéral\u00a0: valable en l\u2019état\u00a0; vérifiez la liste officielle de la Sécurité routière.</li>
<li><span class="gk">${CHECK}</span> Autres pays\u00a0: fournissez le permis international accompagné du permis original.</li>
</ul>
<div class="tip"><div class="tl">${BOLT} Le conseil Tempo</div><p>En cas de doute sur la reconnaissance de votre permis, contactez-nous avant de lancer le devis. Nous validons votre situation en quelques minutes pour éviter un refus de dossier.</p></div>`
  },
  {
    id: 'p3',
    cat: 'Conseils',
    title: 'Pr\u00eater sa voiture\u00a0: 5 r\u00e9flexes assurance',
    excerpt: 'Un pr\u00eat de volant qui tourne mal peut co\u00fbter cher. Cinq pr\u00e9cautions simples avant de confier vos cl\u00e9s.',
    read: '4 min', date: '14 mai 2026', author: 'L\u00e9a Marchand',
    body: `
<p class="lead">Un pr\u00eat de volant sans pr\u00e9caution peut virer au cauchemar assurantiel. Quelques minutes de v\u00e9rification avant de confier vos cl\u00e9s suffisent \u00e0 \u00e9viter les mauvaises surprises.</p>
<h2>La garantie conducteur d\u00e9sign\u00e9 n\u2019est pas universelle</h2>
<p>La plupart des contrats d\u2019assurance auto couvrent le conducteur habituel et, parfois, tout conducteur \u2014 mais la clause \u00ab\u00a0tous conducteurs\u00a0\u00bb est souvent payante ou soumise \u00e0 conditions. V\u00e9rifiez votre contrat avant de pr\u00eater\u00a0: si votre police ne couvre que vous, un accident de votre emprunteur engage votre franchise, votre bonus et potentiellement votre contrat.</p>
<ul>
<li><span class="gk">${CHECK}</span> V\u00e9rifiez la clause de votre contrat\u00a0: \u00ab\u00a0tous conducteurs\u00a0\u00bb ou \u00ab\u00a0conducteur d\u00e9sign\u00e9\u00a0\u00bb.</li>
<li><span class="gk">${CHECK}</span> Assurez-vous que le permis de l\u2019emprunteur est valide (cat\u00e9gorie, suspension \u00e9ventuelle).</li>
<li><span class="gk">${CHECK}</span> Signalez le pr\u00eat \u00e0 votre assureur si votre contrat l\u2019exige.</li>
<li><span class="gk">${CHECK}</span> Pour un pr\u00eat long (plus de quelques jours), envisagez une assurance temporaire au nom de l\u2019emprunteur.</li>
<li><span class="gk">${CHECK}</span> Gardez une trace \u00e9crite du pr\u00eat (SMS ou message) en cas de litige.</li>
</ul>
<div class="tip"><div class="tl">${BOLT} Le conseil Tempo</div><p>Pour un pr\u00eat de plus d\u2019une journ\u00e9e ou \u00e0 un jeune conducteur, une assurance temporaire souscrite au nom de l\u2019emprunteur prot\u00e8ge votre bonus et simplifie la gestion d\u2019un \u00e9ventuel sinistre.</p></div>`
  },
  {
    id: 'p4',
    cat: 'Guides',
    title: 'Assurance fronti\u00e8re\u00a0: circuler en Europe',
    excerpt: 'Quels pays sont couverts, quels documents pr\u00e9senter \u00e0 la douane, et comment \u00e9viter le refus d\u2019entr\u00e9e.',
    read: '7 min', date: '6 mai 2026', author: 'Sofia Nguyen',
    body: `
<p class="lead">Passer une fronti\u00e8re sans assurance adapt\u00e9e, c\u2019est s\u2019exposer \u00e0 un refus d\u2019entr\u00e9e, une immobilisation du v\u00e9hicule ou une amende lourde. Voici ce que couvre l\u2019assurance fronti\u00e8re Tempo et comment pr\u00e9parer votre trajet.</p>
<h2>Pays et zones couverts</h2>
<p>L\u2019assurance fronti\u00e8re couvre la responsabilit\u00e9 civile au sens de la carte verte, valable dans les pays signataires de la convention internationale. Cela inclut l\u2019ensemble des pays de l\u2019UE ainsi que plusieurs \u00c9tats limitrophes (Suisse, Maroc, Tunisie, Turquie\u2026). V\u00e9rifiez votre attestation\u00a0: chaque contrat liste explicitement les pays couverts.</p>
<blockquote><p>\u00ab\u00a0La carte verte est la seule preuve d\u2019assurance reconnue internationalement aux fronti\u00e8res.\u00a0\u00bb</p></blockquote>
<h2>Les documents \u00e0 emporter</h2>
<ul>
<li><span class="gk">${CHECK}</span> Emportez la carte verte originale (ou la version d\u00e9mat\u00e9rialis\u00e9e selon les pays).</li>
<li><span class="gk">${CHECK}</span> V\u00e9rifiez que les pays travers\u00e9s figurent dans la liste de couverture de votre attestation.</li>
<li><span class="gk">${CHECK}</span> Conservez le contrat et les coordonn\u00e9es du service sinistres \u00e0 port\u00e9e de main.</li>
</ul>
<div class="tip"><div class="tl">${BOLT} Le conseil Tempo</div><p>Souscrivez votre assurance fronti\u00e8re la veille du d\u00e9part depuis votre t\u00e9l\u00e9phone. Vous recevez votre carte verte par e-mail et pouvez la pr\u00e9senter directement depuis votre \u00e9cran \u00e0 la douane.</p></div>`
  },
  {
    id: 'p5',
    cat: 'R\u00e9glementation',
    title: 'Carte grise barr\u00e9e\u00a0: combien de temps\u00a0?',
    excerpt: 'Le certificat de cession a une dur\u00e9e de validit\u00e9 pr\u00e9cise. Ce que vous risquez si vous la d\u00e9passez.',
    read: '3 min', date: '29 avr. 2026', author: 'Karim Benali',
    body: `
<p class="lead">Une fois la mention \u00ab\u00a0vendu le\u2026\u00a0\u00bb port\u00e9e sur la carte grise, un compte \u00e0 rebours commence. Le d\u00e9lai l\u00e9gal est court, et rouler avec une carte grise barr\u00e9e au-del\u00e0 de cette p\u00e9riode vous expose \u00e0 des sanctions que peu de conducteurs anticipent.</p>
<h2>Le d\u00e9lai l\u00e9gal\u00a0: 30 jours pour immatriculer</h2>
<p>Depuis la r\u00e9forme de 2017, l\u2019acheteur dispose de 30 jours pour effectuer la demande de changement de titulaire en ligne via l\u2019ANTS. Pendant cette p\u00e9riode, il peut circuler avec le certificat de cession (Cerfa 15776) et la carte grise barr\u00e9e. Au-del\u00e0, le v\u00e9hicule ne peut plus circuler sous cette couverture.</p>
<blockquote><p>\u00ab\u00a0Circuler avec une carte grise barr\u00e9e apr\u00e8s 30 jours\u00a0: une contravention de 4\u1d49 classe et un risque d\u2019immobilisation.\u00a0\u00bb</p></blockquote>
<ul>
<li><span class="gk">${CHECK}</span> Conservez le Cerfa 15776 sign\u00e9 \u2014 il fait foi jusqu\u2019\u00e0 r\u00e9ception de la nouvelle carte grise.</li>
<li><span class="gk">${CHECK}</span> D\u00e9posez la demande sur l\u2019ANTS dans les 30 jours suivant la cession.</li>
<li><span class="gk">${CHECK}</span> Un certificat provisoire d\u2019immatriculation (CPI) vous est d\u00e9livr\u00e9 en attente de la carte grise d\u00e9finitive.</li>
</ul>
<div class="tip"><div class="tl">${BOLT} Le conseil Tempo</div><p>Votre assurance temporaire Tempo couvre le v\u00e9hicule m\u00eame avec la carte grise barr\u00e9e, dans la limite de la p\u00e9riode l\u00e9gale des 30 jours. Lancez les d\u00e9marches ANTS d\u00e8s le lendemain de l\u2019achat.</p></div>`
  },
  {
    id: 'p6',
    cat: 'Conseils',
    title: 'Camping-car\u00a0: assurer \u00e0 la semaine',
    excerpt: 'Location entre particuliers ou road-trip ponctuel\u00a0: la courte dur\u00e9e s\u2019adapte aux v\u00e9hicules VASP.',
    read: '5 min', date: '22 avr. 2026', author: 'Sofia Nguyen',
    body: `
<p class="lead">Vous louez un camping-car pour les vacances ou vous sortez le v\u00f4tre pour quelques semaines seulement\u00a0? L\u2019assurance temporaire s\u2019adapte parfaitement aux v\u00e9hicules VASP \u2014 voici comment l\u2019utiliser correctement.</p>
<h2>Un v\u00e9hicule VASP, une cat\u00e9gorie \u00e0 part</h2>
<p>Les camping-cars (v\u00e9hicules am\u00e9nag\u00e9s \u00e0 usage sp\u00e9cial) rel\u00e8vent d\u2019une cat\u00e9gorie d\u2019immatriculation sp\u00e9cifique. Leur garantie temporaire prend en compte la valeur d\u2019usage plus \u00e9lev\u00e9e et les risques propres \u00e0 ce type de v\u00e9hicule. Le tarif est en cons\u00e9quence l\u00e9g\u00e8rement sup\u00e9rieur \u00e0 celui d\u2019un v\u00e9hicule l\u00e9ger standard.</p>
<ul>
<li><span class="gk">${CHECK}</span> V\u00e9rifiez que la carte grise indique bien \u00ab\u00a0VASP camping-car\u00a0\u00bb dans la mention J.1.</li>
<li><span class="gk">${CHECK}</span> La couverture RC s\u2019applique partout en Europe (selon la liste pays de votre attestation).</li>
<li><span class="gk">${CHECK}</span> Pour une location entre particuliers, assurez le v\u00e9hicule au nom du conducteur effectif.</li>
<li><span class="gk">${CHECK}</span> Dur\u00e9e flexible de 1 \u00e0 90 jours\u00a0: ajustez exactement \u00e0 la dur\u00e9e de votre s\u00e9jour.</li>
</ul>
<div class="tip"><div class="tl">${BOLT} Le conseil Tempo</div><p>Si vous utilisez votre camping-car moins de 90 jours par an, cumuler plusieurs formules temporaires peut revenir moins cher qu\u2019un contrat annuel. Faites le calcul avant de renouveler votre assurance classique.</p></div>`
  },
  {
    id: 'p7',
    cat: 'Pratique',
    title: 'Sortie de fourri\u00e8re\u00a0: repartir en r\u00e8gle',
    excerpt: 'Pas d\u2019assurance, pas de restitution. La marche \u00e0 suivre pour repartir avec une attestation valable.',
    read: '4 min', date: '15 avr. 2026', author: 'L\u00e9a Marchand',
    body: `
<p class="lead">Votre v\u00e9hicule a \u00e9t\u00e9 mis en fourri\u00e8re et vous n\u2019avez pas d\u2019attestation d\u2019assurance en cours de validit\u00e9. Sans ce document, la restitution vous sera refus\u00e9e. Voici la marche \u00e0 suivre pour repartir rapidement en r\u00e8gle.</p>
<h2>Pourquoi l\u2019attestation est bloquante</h2>
<p>Le gestionnaire de la fourri\u00e8re est tenu de v\u00e9rifier que le v\u00e9hicule sera assur\u00e9 au moment de sa restitution. Il vous demandera une attestation originale ou une copie de la carte verte. Un simple devis ou un num\u00e9ro de police ne suffit pas\u00a0: il faut le document d\u00e9finitif.</p>
<ul>
<li><span class="gk">${CHECK}</span> Souscrivez en ligne depuis votre t\u00e9l\u00e9phone, m\u00eame depuis la fourri\u00e8re.</li>
<li><span class="gk">${CHECK}</span> L\u2019attestation est envoy\u00e9e par e-mail en quelques minutes apr\u00e8s le paiement.</li>
<li><span class="gk">${CHECK}</span> Imprimez-la ou pr\u00e9sentez-la directement depuis votre \u00e9cran selon les exigences du gestionnaire.</li>
<li><span class="gk">${CHECK}</span> Choisissez une dur\u00e9e de 7 \u00e0 10 jours minimum pour avoir le temps de r\u00e9gulariser votre situation.</li>
</ul>
<div class="tip"><div class="tl">${BOLT} Le conseil Tempo</div><p>Avant de vous d\u00e9placer en fourri\u00e8re, appelez-les pour confirmer les documents exig\u00e9s. Certaines fourri\u00e8res acceptent la version num\u00e9rique de l\u2019attestation\u00a0; d\u2019autres r\u00e9clament une version imprim\u00e9e.</p></div>`
  },
  {
    id: 'p8',
    cat: 'Guides',
    title: 'Import\u00a0: plaques WW, transit et assurance',
    excerpt: 'De l\u2019achat \u00e0 l\u2019\u00e9tranger \u00e0 l\u2019immatriculation d\u00e9finitive, comment rester couvert \u00e0 chaque \u00e9tape.',
    read: '6 min', date: '8 avr. 2026', author: 'Karim Benali',
    body: `
<p class="lead">Vous avez achet\u00e9 un v\u00e9hicule \u00e0 l\u2019\u00e9tranger, il arrive sous plaque WW ou en transit douanier, et vous ne savez pas comment l\u2019assurer jusqu\u2019\u00e0 son immatriculation d\u00e9finitive. Voici les \u00e9tapes cl\u00e9s.</p>
<h2>Les plaques WW\u00a0: un r\u00e9gime d\u2019exception temporaire</h2>
<p>Les plaques WW permettent de faire circuler un v\u00e9hicule non immatricul\u00e9 pour des raisons administratives pr\u00e9cises\u00a0: essai, pr\u00e9sentation aux mines, convoyage depuis le port\u2026 Elles ne remplacent pas l\u2019assurance \u2014 elles signalent simplement un statut administratif particulier du v\u00e9hicule.</p>
<blockquote><p>\u00ab\u00a0La plaque WW indique la situation du v\u00e9hicule\u00a0; l\u2019attestation d\u2019assurance prouve que la RC est couverte. Les deux sont n\u00e9cessaires.\u00a0\u00bb</p></blockquote>
<ul>
<li><span class="gk">${CHECK}</span> Pr\u00e9parez la facture d\u2019achat ou le titre de propri\u00e9t\u00e9 du pays d\u2019origine.</li>
<li><span class="gk">${CHECK}</span> Souscrivez l\u2019assurance avant le premier mouvement du v\u00e9hicule sur route.</li>
<li><span class="gk">${CHECK}</span> Choisissez une dur\u00e9e couvrant le d\u00e9lai des formalit\u00e9s douani\u00e8res et de l\u2019homologation.</li>
<li><span class="gk">${CHECK}</span> \u00c0 r\u00e9ception de la carte grise d\u00e9finitive, basculez vers un contrat annuel.</li>
</ul>
<div class="tip"><div class="tl">${BOLT} Le conseil Tempo</div><p>Pour les imports complexes (v\u00e9hicules anciens, origine hors UE, homologation longue), prenez une couverture de 30 \u00e0 90 jours. Vous pourrez souscrire un nouveau contrat temporaire si les d\u00e9lais s\u2019\u00e9tendent.</p></div>`
  },
  {
    id: 'p9',
    cat: 'Conseils',
    title: 'Jeune conducteur\u00a0: rouler sans se ruiner',
    excerpt: 'Quelques jours au volant par mois\u00a0? La formule temporaire peut \u00eatre plus juste qu\u2019un contrat \u00e0 l\u2019ann\u00e9e.',
    read: '4 min', date: '1 avr. 2026', author: 'Sofia Nguyen',
    body: `
<p class="lead">Vous venez d\u2019obtenir votre permis ou vous roulez quelques jours par mois seulement. Avant de signer un contrat annuel souvent tr\u00e8s on\u00e9reux, il vaut la peine d\u2019examiner si l\u2019assurance temporaire ne serait pas, dans votre cas, plus avantageuse.</p>
<h2>Pourquoi les jeunes paient plus cher</h2>
<p>Les assureurs appliquent aux conducteurs de moins de 25 ans ou sans historique de sinistres une surprime pouvant aller de 50\u00a0% \u00e0 100\u00a0% du tarif de base. Cela repr\u00e9sente plusieurs centaines d\u2019euros par an pour un v\u00e9hicule qui reste peut-\u00eatre au garage la majorit\u00e9 du temps.</p>
<h2>La formule temporaire\u00a0: quand \u00e7a vaut le coup</h2>
<p>Si vous utilisez une voiture moins de 90 jours par an, cumuler des formules courte dur\u00e9e peut co\u00fbter moins cher qu\u2019un contrat 12 mois avec surprime jeune conducteur \u2014 et vous ne payez que les jours o\u00f9 vous roulez vraiment.</p>
<ul>
<li><span class="gk">${CHECK}</span> Vous partez en vacances 2 semaines\u00a0? Souscrivez pour 15 jours, pas pour un an.</li>
<li><span class="gk">${CHECK}</span> Vous empruntez ponctuellement le v\u00e9hicule familial\u00a0? Une assurance \u00e0 votre nom vous prot\u00e8ge, vous.</li>
<li><span class="gk">${CHECK}</span> Vous d\u00e9butez en conduite accompagn\u00e9e\u00a0? Utilisez la formule temporaire pendant la phase d\u2019apprentissage.</li>
</ul>
<div class="tip"><div class="tl">${BOLT} Le conseil Tempo</div><p>Conservez l\u2019historique de vos souscriptions temporaires\u00a0: certains assureurs les prennent en compte pour calculer votre profil de risque et r\u00e9duire votre surprime lors du passage \u00e0 un contrat annuel.</p></div>`
  }
];
