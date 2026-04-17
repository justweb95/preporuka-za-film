function q(question, correctAnswer, options) {
  return {
    question,
    correctAnswer,
    options,
  };
}

export const MOVIE_DATA = [
  {
    id: 'munje',
    title: 'Munje!',
    year: 2001,
    country: 'Srbija',
    director: 'Radivoje Andric',
    genre: 'Komedija',
    lead: 'Sergej Trifunovic',
    quote: 'Hocemo jos!',
    poster:
      'https://media.themoviedb.org/t/p/w300_and_h450_face/yP8U8NTstM1qC94fDwPPjt9DRDp.jpg',
    questions: [
      q('Ko je režirao film "Munje!"?', 'Radivoje Andrić', [
        'Radivoje Andrić',
        'Srđan Golubović',
        'Dragan Bjelogrlić',
        'Emir Kusturica',
      ]),
      q('Koje godine je izašao film "Munje!"?', '2001', [
        '2001',
        '1998',
        '2004',
        '2000',
      ]),
      q('Koji žanr najbolje opisuje film "Munje!"?', 'Komedija', [
        'Komedija',
        'Triler',
        'Drama',
        'Akcija',
      ]),
      q('Kako se zove lik koga glumi Sergej Trifunović?', 'Pop', [
        'Pop',
        'Mare',
        'Gojko',
        'Pandur',
      ]),
      q('Kako se zove lik koga glumi Boris Milivojević?', 'Mare', [
        'Mare',
        'Pop',
        'Sisa',
        'Deda Mraz',
      ]),

      q('Koji nadimak ima Gojko u filmu?', 'Sisa', [
        'Sisa',
        'Bato',
        'Care',
        'Šef',
      ]),
      q('Ko glumi Gojka Sisu?', 'Nikola Đuričko', [
        'Nikola Đuričko',
        'Boris Milivojević',
        'Sergej Trifunović',
        'Nebojša Glogovac',
      ]),
      q('Kako se zove policajac u filmu?', 'Pandur', [
        'Pandur',
        'Stražar',
        'Milicioner',
        'Čuvar',
      ]),
      q('Ko glumi policajca u filmu?', 'Nebojša Glogovac', [
        'Nebojša Glogovac',
        'Nikola Kojo',
        'Dragan Bjelogrlić',
        'Zoran Cvijanović',
      ]),
      q('Kako se zove lik koji pljačka apoteku?', 'Deda Mraz', [
        'Deda Mraz',
        'Lopov',
        'Kradljivac',
        'Razbojnik',
      ]),

      q('Ko glumi Deda Mraza?', 'Zoran Cvijanović', [
        'Zoran Cvijanović',
        'Nebojša Glogovac',
        'Dragan Nikolić',
        'Gorica Popović',
      ]),
      q('Kako se zove devojka u koju je Mare zaljubljen?', 'Kata', [
        'Kata',
        'Lola',
        'Maja',
        'Ana',
      ]),
      q('Ko glumi Katu?', 'Maja Mandžuka', [
        'Maja Mandžuka',
        'Milica Vujović',
        'Jelena Đokić',
        'Ana Sofrenović',
      ]),
      q('Nastavi Gojkov citat: "Što ti je dobra..."', 'majčica, šećeru', [
        'majčica, šećeru',
        'devojka, brate',
        'riba, care',
        'žena, druže',
      ]),
      q('Nastavi Gojkov citat: "Za početak snimićemo jedan..."', 'kompakt CD', [
        'kompakt CD',
        'album',
        'demo',
        'singl',
      ]),

      q(
        'Nastavi citat pandura: "Dolče i Gabana, a? Pa i njega ćemo da..."',
        'hapsimo, da znaš',
        ['hapsimo, da znaš', 'uhvatimo', 'privedemo', 'teramo'],
      ),
      q(
        'Kada pandur pita "Odakle tebi ovoliko opijata?", šta mu Deda Mraz odgovara?',
        'Nije naše, našli smo',
        ['Nije naše, našli smo', 'Kupili smo', 'Nije moje', 'Ne znam'],
      ),
      q(
        'Na odgovor "Našli smo", pandur odgovara:',
        'Našao si? Kako ga ja nisam našao?!',
        [
          'Našao si? Kako ga ja nisam našao?!',
          'Ma daj!',
          'Ne verujem ti!',
          'Sigurno!',
        ],
      ),
      q(
        'Nastavi Gojkov citat: "Najebaćeš! I ti ćeš najebati!..."',
        'Najebaćete!',
        ['Najebaćete!', 'Svi ćete!', 'Gotovi ste!', 'Propali ste!'],
      ),

      q('Što Gojko kaže Popu: "Što ulaziš u frku kad si..."', 'slabiji?', [
        'slabiji?',
        'mali?',
        'mlađi?',
        'gluplji?',
      ]),
      q(
        'Kada Gojko raskida sa Katom, kaže joj: "Među nama više nema..."',
        'fluida',
        ['fluida', 'ljubavi', 'osećanja', 'veze'],
      ),
      q('Koji muzički žanr Mare i Pop snimaju?', 'Drum and bass', [
        'Drum and bass',
        'Hip hop',
        'Rock',
        'Techno',
      ]),
      q('Šta je Gojko po zanimanju?', 'Vlasnik kluba i studija', [
        'Vlasnik kluba i studija',
        'Muzičar',
        'DJ',
        'Menadžer',
      ]),
      q(
        'Kako se zove fudbalska zvezda koja se pojavljuje u filmu?',
        'Dule Savić',
        [
          'Dule Savić',
          'Dejan Stanković',
          'Siniša Mihajlović',
          'Dragan Stojković',
        ],
      ),

      q(
        'Koliko ljudi je pogledalo film "Munje!" u bioskopima?',
        'Preko 500.000',
        ['Preko 500.000', 'Oko 300.000', 'Oko 100.000', 'Milion'],
      ),
      q('U kom gradu se dešava radnja filma?', 'Beograd', [
        'Beograd',
        'Novi Sad',
        'Niš',
        'Kragujevac',
      ]),
      q('U kom periodu se dešava radnja?', 'Devedesete (1990s)', [
        'Devedesete (1990s)',
        'Osamdesete',
        'Dvehiljadite',
        'Sedamdesete',
      ]),
      q(
        'Kako se zove nastavak filma "Munje!" iz 2023. godine?',
        'Munje: Opet!',
        ['Munje: Opet!', 'Munje 2', 'Nove Munje', 'Munje Ponovo'],
      ),
      q('Ko je scenarista filma "Munje!"?', 'Srđa Anđelić', [
        'Srđa Anđelić',
        'Radivoje Andrić',
        'Dušan Kovačević',
        'Srđan Dragojević',
      ]),
    ],
  },
  {
    id: 'kengur',
    title: 'Kad porastem bicu Kengur',
    year: 2004,
    country: 'Srbija',
    director: 'Radivoje Andric',
    genre: 'Komedija',
    lead: 'Nebojša Glogovac',
    quote: 'Beogradske price jedne noci.',
    poster:
      'https://media.themoviedb.org/t/p/w300_and_h450_face/cjaZaKLGKeZ7xY7FaSvOfuhWOWw.jpg',
    questions: [
      // ===== OSNOVNE INFO =====
      q(
        'Koje godine je premijerno prikazan film "Kad porastem biću Kengur"?',
        '2004',
        ['2004', '2001', '2006', '1999'],
      ),

      q('Ko je režirao film "Kad porastem biću Kengur"?', 'Radivoje Andrić', [
        'Radivoje Andrić',
        'Srđan Dragojević',
        'Janko Baljak',
        'Zdravko Šotra',
      ]),

      q('Koji je žanr filma "Kad porastem biću Kengur"?', 'Komedija', [
        'Komedija',
        'Triler',
        'Drama',
        'Horor',
      ]),

      q(
        'U kojoj beogradskoj opštini se odvija cela radnja filma?',
        'Voždovac',
        ['Voždovac', 'Zemun', 'Čukarica', 'Palilula'],
      ),

      q(
        'Koji je podnaslov / tagline filma "Kad porastem biću Kengur"?',
        'Beogradske priče jedne noći',
        [
          'Beogradske priče jedne noći',
          'Jedna noć u Beogradu',
          'Grad koji nikad ne spava',
          'Svi smo mi Beograđani',
        ],
      ),

      // ===== LIKOVI I GLUMCI =====
      q('Kako se zove lik kojeg igra Nebojša Glogovac?', 'Živac', [
        'Živac',
        'Baron',
        'Sumpor',
        'Avaks',
      ]),

      q('Kako se zove lik kojeg igra Sergej Trifunović?', 'Braca', [
        'Braca',
        'Šomi',
        'Hibrid',
        'Duje',
      ]),

      q('Koji glumac igra lika zvanog Sumpor?', 'Gordan Kičić', [
        'Gordan Kičić',
        'Nikola Đuričko',
        'Dragan Bjelogrlić',
        'Boris Isaković',
      ]),

      q('Koji glumac igra lika zvanog Kengur?', 'Nikola Đuričko', [
        'Nikola Đuričko',
        'Gordan Kičić',
        'Dragan Bjelogrlić',
        'Filip Đurić',
      ]),

      q(
        'Kako se zove manekenka koju Braca pokušava da "smuva" tokom noći?',
        'Iris',
        ['Iris', 'Ines', 'Jelena', 'Svetlana'],
      ),

      q('Koji glumac igra lika zvanog Baron?', 'Petar Kralj', [
        'Petar Kralj',
        'Bata Živojinović',
        'Miki Manojlović',
        'Svetozar Cvetković',
      ]),

      // ===== NADIMCI =====
      q(
        'Koji nadimak NIJE lik iz filma "Kad porastem biću Kengur"?',
        'Diesel',
        ['Diesel', 'Avaks', 'Hibrid', 'Sumpor'],
      ),

      q(
        'Braca i Sumpor su drugari. Kako se zove još jedan lik iz njihovog društva?',
        'Avaks',
        ['Avaks', 'Žuća', 'Cane', 'Gvozden'],
      ),

      q(
        'Koji dvojac sa krova zgrade šaraju i raspravljaju o daljini?',
        'Avaks i Hibrid',
        ['Avaks i Hibrid', 'Braca i Sumpor', 'Šomi i Duje', 'Baron i Cile'],
      ),

      // ===== CITATI - NASTAVI REČENICU =====
      q(
        'Nastavi repliku — Braca: "Hej, ona sija!" Šta odgovara Sumpor?',
        'Pa vodi je u mrak da ti sija!',
        [
          'Pa vodi je u mrak da ti sija!',
          'Braco, pusti to!',
          'Sanja, brate, sanja.',
          'Nije za tebe, čoveče.',
        ],
      ),

      q(
        'Nastavi repliku — Radnik u bioskopu: "Rakiju ne pijem…" Šta kaže dalje?',
        "Al' vinjak derem!",
        [
          "Al' vinjak derem!",
          "Al' pivo volim.",
          'Na poslu ne pijem ništa.',
          'Što te briga šta pijem.',
        ],
      ),

      q(
        'Nastavi repliku — "Hoće nekad nešto da se desiiiii?" Šta je odgovor?',
        'Idi po pivo, možda ti se usput desi.',
        [
          'Idi po pivo, možda ti se usput desi.',
          'Čekaj, doći će.',
          'Ne znam, brate.',
          'Samo strpljenje.',
        ],
      ),

      q(
        'Nastavi repliku — "Zašto se ovo zove radio kad nikad ne radi?" Šta je odgovor?',
        'Pa RADIO, to je prošlo vreme.',
        [
          'Pa RADIO, to je prošlo vreme.',
          'Pokvaren je, šta da radim.',
          'Nemam pojma, brate.',
          'Treba ga popraviti.',
        ],
      ),

      q(
        'Nastavi repliku — Baron: "I šta mislite, šta vozi Batistuta?" Cile: "Ne znam, Ferrari…?" Baron: …',
        'Yugo! Crni 65A kabrio.',
        [
          'Yugo! Crni 65A kabrio.',
          'BMW!',
          'Golf! Stari model.',
          'Mercedees! Bele boje.',
        ],
      ),

      q(
        'Nastavi repliku — "Semenke svih zemalja…" kako se završava?',
        'Ujedinite se!',
        ['Ujedinite se!', 'Prodajem se!', 'Podelite se!', 'Skupite se!'],
      ),

      q(
        'Nastavi repliku — Avaks: "Brate, uvek bacim dalje od tebe!" Šta odgovara Hibrid?',
        'Nije poenta u daljini, nego u šaranju.',
        [
          'Nije poenta u daljini, nego u šaranju.',
          'Ma nije to tačno, brate.',
          'Dobro, ali nije to sport.',
          'Jesi li normalan?',
        ],
      ),

      q(
        'Iris pita Bracu: "Je l\' ti to neki sat ili…?" Šta Braca odgovara?',
        'Merač za pritisak.',
        [
          'Merač za pritisak.',
          'Kompas, baba.',
          'Buđenik stari.',
          'Ne, to je termometar.',
        ],
      ),

      q(
        'Nastavi repliku — "A da ja vas pitam, šta je sa petsto miliona neprijavljenih Kineza… A?" Šta sledi?',
        'Ćutimo.',
        ['Ćutimo.', 'Ne znamo.', 'Nema ih ovde.', 'Pitajte policiju.'],
      ),

      // ===== SCENE I DETALJI =====
      q(
        'Šta radnik u bioskopu kaže Braci kada ga upozori da film počinje u sedam po novinama?',
        'Ti onda gledaj film u novinama.',
        [
          'Ti onda gledaj film u novinama.',
          'Novine greše, ne ja.',
          'Kasno je, ne mogu da ti pomognem.',
          'Pravila su pravila, brate.',
        ],
      ),

      q(
        'Šta Braca kaže Irisu da mu pozli jer mu ona previše prija?',
        'Možda mi pozli, imaš merač za pritisak.',
        [
          'Možda mi pozli, imaš merač za pritisak.',
          'Zovi hitnu pomoć.',
          'Daj mi vode, molim te.',
          'Treba mi svež vazduh.',
        ],
      ),

      q(
        'Šta Šomi kaže Duji o svećama i Bogu?',
        '"Brate, ne pravi Bog razliku među svećama?"',
        [
          '"Brate, ne pravi Bog razliku među svećama?"',
          '"Sve sveće iste gore, brate."',
          '"Bogu nije stalo do sveća."',
          '"Svaka sveća ima svoju cenu."',
        ],
      ),

      q(
        'Šta lik kaže u vezi sa sebe i ribice: "Nemam ribicu al\' zato…"?',
        '"Imam normalan pritisak."',
        [
          '"Imam normalan pritisak."',
          '"Imam dobre drugare."',
          '"Imam mir u duši."',
          '"Nemam briga."',
        ],
      ),

      q(
        'Šta Saša kaže policajcu kad ga pita šta su tačno radili?',
        '"Mi smo sedeli ovde i duvanili smo… cigarete."',
        [
          '"Mi smo sedeli ovde i duvanili smo… cigarete."',
          '"Gledali smo u zvezde."',
          '"Ćaskali smo, ništa posebno."',
          '"Pili smo kafu."',
        ],
      ),

      q(
        'Šta lik kaže za Bracu: "Braco, kad bi postojala merna jedinica za jadnost…"?',
        '"…nosila bi tvoje ime."',
        [
          '"…nosila bi tvoje ime."',
          '"…ti bi bio šampion."',
          '"…ti bi bio rekorder."',
          '"…nazivala bi se Braca."',
        ],
      ),

      q(
        'Ko je rekao: "Braco gde si brate?" i zašto je Nebojša "malo pe*erski"?',
        'Jer je to ime — drugari ga zovu Šone',
        [
          'Jer je to ime — drugari ga zovu Šone',
          'Jer se tužakao.',
          'Jer ne pije pivo.',
          'Jer sluša stranu muziku.',
        ],
      ),
    ],
  },
  {
    id: 'juzni-vetar',
    title: 'Južni vetar',
    year: 2018,
    country: 'Srbija',
    director: 'Miloš Avramović',
    genre: 'Akcija',
    lead: 'Miloš Biković',
    quote: 'Brza voznja i kriminal pod pritiskom.',
    poster:
      'https://media.themoviedb.org/t/p/w300_and_h450_face/d9qNGhCAmtnJCy73TPGcG3iG1n7.jpg',
    questions: [
      q('Ko je režirao film "Južni vetar"?', 'Miloš Avramović', [
        'Miloš Avramović',
        'Radivoje Andrić',
        'Dragan Bjelogrlić',
        'Emir Kusturica',
      ]),
      q('Koje godine je izašao film "Južni vetar"?', '2018', [
        '2018',
        '2016',
        '2020',
        '2019',
      ]),
      q('Koji žanr najbolje opisuje film "Južni vetar"?', 'Akcija/Krimi', [
        'Akcija/Krimi',
        'Komedija',
        'Drama',
        'Horor',
      ]),
      q('Ko glumi glavnog lika Petra Maraša?', 'Miloš Biković', [
        'Miloš Biković',
        'Sergej Trifunović',
        'Vuk Kostić',
        'Miodrag Radonjić',
      ]),
      q('Kako se zove Marašov najbolji prijatelj?', 'Baća', [
        'Baća',
        'Stupar',
        'Kifla',
        'Drka',
      ]),

      q('Ko glumi Baću?', 'Miodrag Radonjić', [
        'Miodrag Radonjić',
        'Miloš Biković',
        'Vuk Kostić',
        'Ljubomir Bandović',
      ]),
      q('Čime se bavi Petar Maraš u filmu?', 'Krađom automobila', [
        'Krađom automobila',
        'Trgovinom drogom',
        'Reketom',
        'Krijumčarenjem',
      ]),
      q('Kako se zove šef mafije u filmu?', 'Dragoslav "Car"', [
        'Dragoslav "Car"',
        'Golub',
        'Crveni',
        'Stupar',
      ]),
      q('Ko glumi "Cara" u filmu?', 'Dragan Bjelogrlić', [
        'Dragan Bjelogrlić',
        'Miki Manojlović',
        'Bogdan Diklić',
        'Nebojša Glogovac',
      ]),
      q('Ko glumi opasnog narko-bosa Goluba?', 'Nebojša Glogovac', [
        'Nebojša Glogovac',
        'Dragan Bjelogrlić',
        'Srđan Todorović',
        'Bogdan Diklić',
      ]),

      q('Kako se zove Marašova devojka?', 'Sofija', [
        'Sofija',
        'Anđela',
        'Kata',
        'Maja',
      ]),
      q('Ko glumi Sofiju?', 'Jovana Stojiljković', [
        'Jovana Stojiljković',
        'Milica Vujović',
        'Maja Mandžuka',
        'Jasna Đuričić',
      ]),
      q('Nastavi kultni Marašov citat: "Maraš rek\'o..."', 'NE MOŽE', [
        'NE MOŽE',
        'MOŽE',
        'HOĆEMO',
        'IDU GAS',
      ]),
      q(
        'Nastavi Baćin legendarni citat: "Koliko ćeš mi..."',
        'Srpčića roditi?',
        ['Srpčića roditi?', 'godine imati?', 'ljubavi dati?', 'para doneti?'],
      ),
      q('Nastavi Marašov citat: "Ko ne dođe, računamo -..."', 'nije došao', [
        'nije došao',
        'nema ga',
        'otpao je',
        'gotov je',
      ]),

      q(
        'Ko izgovara citat: "Ti nisi dovoljno alav da bih mogao da se oslonim na tebe"?',
        'Crveni',
        ['Crveni', 'Car', 'Golub', 'Stupar'],
      ),
      q('Ko glumi "Crvenog"?', 'Aleksandar Berček', [
        'Aleksandar Berček',
        'Hristo Shopov',
        'Bogdan Diklić',
        'Srđan Todorović',
      ]),
      q(
        'Šta Stupar kaže: "Šta misliš, ako prodate Stupara da ste sigurni?..."',
        'E, pa niko nije siguran!',
        ['E, pa niko nije siguran!', 'Možda', 'Naravno', 'Siguran sam'],
      ),
      q('Ko glumi Stupara?', 'Miloš Timotijević', [
        'Miloš Timotijević',
        'Vuk Kostić',
        'Ljubomir Bandović',
        'Srđan Todorović',
      ]),
      q(
        'Kada Golub kaže "Ovo je moj grad", Car mu odgovara:',
        'Pa malo je i moj',
        ['Pa malo je i moj', 'Nije tvoj', 'Moj je', 'Delimo ga'],
      ),

      q(
        'Kako se zove nastavak filma iz 2021. godine?',
        'Južni vetar 2: Ubrzanje',
        [
          'Južni vetar 2: Ubrzanje',
          'Južni vetar: Povratak',
          'Južni vetar Nastavak',
          'Južni vetar Opet',
        ],
      ),
      q('Koje godine je izašla TV serija "Južni vetar"?', '2020', [
        '2020',
        '2019',
        '2021',
        '2018',
      ]),
      q(
        'Ko je napisao scenario za film?',
        'Miloš Avramović i Petar Mihajlović',
        [
          'Miloš Avramović i Petar Mihajlović',
          'Srđa Anđelić',
          'Dušan Kovačević',
          'Radivoje Andrić',
        ],
      ),
      q(
        'Šta Maraš i Baća razgovaraju: "Šta će mi princeza?..."',
        'Pa, brate, svakom muškarcu treba princeza',
        [
          'Pa, brate, svakom muškarcu treba princeza',
          'Ne treba mi',
          'Volim je',
          'Oženićemo se',
        ],
      ),

      q(
        'Koliko ljudi je pogledalo film u bioskopima u Srbiji?',
        'Preko 200.000',
        ['Preko 200.000', 'Oko 50.000', 'Milion', 'Preko 500.000'],
      ),
      q('Ko je producent filma "Južni vetar"?', 'Miloš Avramović', [
        'Miloš Avramović',
        'Dragan Bjelogrlić',
        'Zoran Cvijanović',
        'Srđan Dragojević',
      ]),
      q(
        'Gde je film premijerno prikazan 2018. godine?',
        'Filmski susreti u Nišu',
        ['Filmski susreti u Nišu', 'FEST', 'Pula', 'Kantrida'],
      ),
      q(
        'Koliko nagrada je film osvojio na Filmskim susretima u Nišu?',
        'Četiri (4)',
        ['Četiri (4)', 'Tri (3)', 'Pet (5)', 'Dve (2)'],
      ),
      q('Ko glumi Cara u TV seriji (od 5. epizode)?', 'Miki Manojlović', [
        'Miki Manojlović',
        'Dragan Bjelogrlić',
        'Bogdan Diklić',
        'Nebojša Glogovac',
      ]),
    ],
  },
  {
    id: 'citulja-za-eskobara',
    title: 'Čitulja za Eskobara',
    year: 2008,
    country: 'Srbija',
    director: 'Milorad Milinković',
    genre: 'Akcija',
    lead: 'Vojin Ćetković',
    quote:
      '"Читуља за Ескобара" на духовит начин кроз врло комичну ситуацију описује српски криминални миље, подземље чији су чланови махом тешки примитивци, једва школовани људи са оружјем у руци и псовкама на уснама, међусобно повезани злочинима, но нека пријатељства датирају још од школских клупа. Ганди је криминалац, од детињства предодређен за негативца. Он упознаје Лелу, загонетну девојку, у коју се заљубљује. Истог дана када Ганди убија криминалца кога зову Српски Ескобар, два наркофила и нерадника, Деки и Баки, дају читуљу правом Ескобару. Полиција почиње истрагу, ситуација се компликује и обрће у невероватном смеру.',
    poster:
      'https://media.themoviedb.org/t/p/w300_and_h450_face/xNfmU24e7Ldbnl6qq1Zj0qKY7Ur.jpg',
    questions: [
      // ===== OSNOVNE INFO =====
      q(
        'Koje godine je premijerno prikazan film "Čitulja za Eskobara"?',
        '2008',
        ['2008', '2005', '2010', '2003'],
      ),

      q(
        'Ko je režirao i napisao scenario za film "Čitulja za Eskobara"?',
        'Milorad Milinković',
        [
          'Milorad Milinković',
          'Radivoje Andrić',
          'Srđan Dragojević',
          'Predrag Antonijević',
        ],
      ),

      q('Koji je tačan žanr filma "Čitulja za Eskobara"?', 'Komedija / Krimi', [
        'Komedija / Krimi',
        'Akcija / Triler',
        'Drama / Romansa',
        'Horor / Misterija',
      ]),

      q('Koliko traje film "Čitulja za Eskobara"?', '90 minuta', [
        '90 minuta',
        '75 minuta',
        '110 minuta',
        '120 minuta',
      ]),

      q(
        'Koja producentska kuća je proizvela film "Čitulja za Eskobara"?',
        'Pink Films International',
        [
          'Pink Films International',
          'Cobra Film',
          'Art & Popcorn',
          'Sistematik Film',
        ],
      ),

      // ===== LIKOVI I GLUMCI =====
      q('Kako se zove glavni lik kojeg igra Vojin Ćetković?', 'Gandi', [
        'Gandi',
        'Kiле',
        'Deki',
        'Anđeo',
      ]),

      q('Ko igra lika zvanog Anđeo u filmu?', 'Zijah Sokolović', [
        'Zijah Sokolović',
        'Rene Bitorajac',
        'Nenad Jezdić',
        'Boris Komnenić',
      ]),

      q('Koji glumac igra inspektora Savića?', 'Mladen Nelević', [
        'Mladen Nelević',
        'Rene Bitorajac',
        'Dejan Tončić',
        'Boris Komnenić',
      ]),

      q('Koji glumac igra lika Miletu u filmu?', 'Rene Bitorajac', [
        'Rene Bitorajac',
        'Boris Milivојević',
        'Marko Živić',
        'Nenad Jezdić',
      ]),

      q('Koji glumac igra lika Kileta?', 'Marko Živić', [
        'Marko Živić',
        'Miloš Samolov',
        'Boris Milivojević',
        'Dejan Tončić',
      ]),

      q('Ko igra lika Dekija?', 'Boris Milivojević', [
        'Boris Milivojević',
        'Miloš Samolov',
        'Marko Živić',
        'Mladen Nelević',
      ]),

      q('Ko igra lika Bakija?', 'Miloš Samolov', [
        'Miloš Samolov',
        'Boris Milivojević',
        'Gordan Kičić',
        'Dejan Tončić',
      ]),

      q(
        'Koja glumica igra Lelu, zagonetnu devojku u koju se Gandi zaljubljuje?',
        'Tamara Garbajs',
        [
          'Tamara Garbajs',
          'Tamara Krcunović',
          'Katarina Marković',
          'Ljubinka Klarić',
        ],
      ),

      q(
        'Kako se zvao Lelin prijatelj iz škole koji se vratio iz Amsterdama?',
        'Borko',
        ['Borko', 'Đole', 'Cile', 'Tomo'],
      ),

      // ===== RADNJA I DETALJI =====
      q(
        'Ko su dvojica narkomana koji su dali čitulju pravom Pablu Eskobaru?',
        'Deki i Baki',
        ['Deki i Baki', 'Gandi i Kile', 'Sreten i Mileta', 'Anđeo i Inspektor'],
      ),

      q('Koji nadimak nosi kriminalac kojeg Gandi ubija?', 'Srpski Eskobar', [
        'Srpski Eskobar',
        'Balkanski Pablo',
        'Narko Bos',
        'Beogradski Don',
      ]),

      q(
        'Šta je Borko uradio u Amsterdamu zbog čega niko iz Srbije nije znao?',
        'Promenio pol',
        [
          'Promenio pol',
          'Oženio se',
          'Prešao na drugu veru',
          'Promenio ime i prezime',
        ],
      ),

      q(
        'Ko vodi istragu i hvali se da nikad nije "okazao"?',
        'Inspektor Savić',
        ['Inspektor Savić', 'Mileta', 'Anđeo', 'Ministar'],
      ),

      q(
        'Gde je objavljena čitulja za Eskobara pre samog ubistva?',
        'U novinama',
        ['U novinama', 'Na televiziji', 'Na radiju', 'Na internetu'],
      ),

      // ===== CITATI - NASTAVI REČENICU =====
      q(
        'Nastavi: Inspektor Savić kaže — "Hapsite ih za pogrešno parkiranje, za pljuvanje na pločniku, za to što su ružni i odvratni…" Šta dodaje?',
        '"Za to što te opreko gledaju."',
        [
          '"Za to što te opreko gledaju."',
          '"Za to što ne plaćaju porez."',
          '"Za to što vise po uglovima."',
          '"Za to što su primitivci."',
        ],
      ),

      q(
        'Nastavi: Gandi čita čitulju glasno u novinarskom uredu — "Danas u četiri i deset izgubili smo našeg voljenog Gorana Ticu koji je…"',
        '"Jedna bedna pička!"',
        [
          '"Jedna bedna pička!"',
          '"Nestao bez traga."',
          '"Izuzetno cenjen čovek."',
          '"Poginuo na dužnosti."',
        ],
      ),

      q(
        'Nastavi: Mileta kaže inspektoru — "Stoka se ubija između sebe, nama samo…"',
        '"Ulakšavuje posao."',
        [
          '"Ulakšavuje posao."',
          '"Daje više para."',
          '"Treba da kažemo hvala."',
          '"Ne daje mira."',
        ],
      ),

      q(
        'Nastavi dijalog — Inspektor: "Šta oni misle, da je ovo neka Kolumbija?" Mileta: …',
        '"Valjda, nego kolega misli…"',
        [
          '"Valjda, nego kolega misli…"',
          '"Nije, gospod inspektore."',
          '"Jesu, brate, jesu."',
          '"Ne mislim da je to tačno."',
        ],
      ),

      q(
        'Nastavi: Deki kaže Bakiju — "Brate, ajde da mu damo čitulju, a?" Šta Baki odgovara?',
        '"Što?"',
        [
          '"Što?"',
          '"Odlična ideja!"',
          '"Sad? Jesi normalan?"',
          '"Neka, neka, samo nevolja."',
        ],
      ),

      q(
        'Nastavi: Kile kaže Gandiju — "Od kad smo roknuli onog, znaš? Moraju da nas…"',
        '"Poštuju."',
        ['"Poštuju."', '"Znaju."', '"Se plaše."', '"Vide."'],
      ),

      q(
        'Nastavi: Gandi citira Anđela — "Vidiš, kad se pravednik spase, to nije ništa naročito. A čuda milosrđa su…"',
        '"Van mog dometa."',
        [
          '"Van mog dometa."',
          '"Samo za odabrane."',
          '"Retka i skupa."',
          '"Božja tajna."',
        ],
      ),

      q(
        'Nastavi: Gandi kaže Leli — "Nisam ti ja brat. Vraca su ti oni tvoji, one Ološe…"',
        '"Ja znam ti devojka."',
        [
          '"Ja znam ti devojka."',
          '"Ja sam tvoj ortak."',
          '"Kaži mi istinu."',
          '"Ostavi me na miru."',
        ],
      ),

      q(
        'Nastavi: Lela u pismu piše Gandiju — "Volet ću te zauvek. Do groba."',
        '"Pa i dalje."',
        [
          '"Pa i dalje."',
          '"I to je sve."',
          '"I ne tražim ništa zauzvrat."',
          '"Zaboravi me."',
        ],
      ),

      q(
        'Nastavi: Gandi kaže za Gandija iz istorije — "Ubili su ga." A Lela odgovara?',
        '"Pa normalno, kad je ležao, budala je."',
        [
          '"Pa normalno, kad je ležao, budala je."',
          '"Jadnik jedan."',
          '"Zato i jesu zli."',
          '"Bio je heroj."',
        ],
      ),

      q(
        'Nastavi: Deki govori o ratu — "Znaš koji rat, čekaj?" Tast odgovara da biše napreduju prema Vukovaru. Deki mu kaže: "Dragi tast, taj rat je…"',
        '"Prošao još dok vi niste otišli u penziju."',
        [
          '"Prošao još dok vi niste otišli u penziju."',
          '"Završen odavno, brate."',
          '"Bio pre mog vremena."',
          '"Pobedili smo, ne brini."',
        ],
      ),
    ],
  },
  {
    id: 'shutter-island',
    title: 'Shutter Island',
    year: 2010,
    country: 'SAD',
    director: 'Martin Scorsese',
    genre: 'Triler',
    lead: 'Leonardo DiCaprio',
    quote: 'Istina je skrivena iza slojeva secanja.',
    poster: 'https://image.tmdb.org/t/p/w300/4GDy0PHYX3VRXUtwK5ysFbg3kEx.jpg',
    questions: [
      // ===== OSNOVNE INFO =====
      q('Koje godine je snimljen film "Shutter Island"?', '2010', [
        '2010',
        '2008',
        '2012',
        '2006',
      ]),

      q('Ko je režiser filma "Shutter Island"?', 'Martin Scorsese', [
        'Martin Scorsese',
        'Christopher Nolan',
        'David Fincher',
        'Denis Villeneuve',
      ]),

      q(
        'Na osnovu čijeg romana je snimljen "Shutter Island"?',
        'Dennis Lehane',
        ['Dennis Lehane', 'Stephen King', 'Michael Crichton', 'Gillian Flynn'],
      ),

      q(
        'Ko je napisao scenario za film "Shutter Island"?',
        'Laeta Kalogridis',
        [
          'Laeta Kalogridis',
          'Aaron Sorkin',
          'David Fincher',
          'Martin Scorsese',
        ],
      ),

      q(
        'Koje je godina u kojoj je smeštena radnja filma "Shutter Island"?',
        '1954',
        ['1954', '1961', '1947', '1968'],
      ),

      q(
        'Kako se zove psihijatrijska bolnica u kojoj se odvija radnja?',
        'Ashecliffe',
        ['Ashecliffe', 'Blackwood', 'Ravenwood', 'Cliffhaven'],
      ),

      // ===== LIKOVI I GLUMCI =====
      q(
        'Ko tumači glavnu ulogu detektiva Teddyja Danielsa?',
        'Leonardo DiCaprio',
        ['Leonardo DiCaprio', 'Matt Damon', 'Christian Bale', 'Tom Hanks'],
      ),

      q('Ko igra Teddyjevog partnera Chucka Aulea?', 'Mark Ruffalo', [
        'Mark Ruffalo',
        'Matt Damon',
        'Ryan Gosling',
        'Josh Brolin',
      ]),

      q('Koji glumac igra doktora Johna Cawleyja?', 'Ben Kingsley', [
        'Ben Kingsley',
        'Anthony Hopkins',
        'Max von Sydow',
        'Michael Caine',
      ]),

      q(
        'Ko igra dr. Jeremiah Naehringa, Cawleyjevog kolegu?',
        'Max von Sydow',
        ['Max von Sydow', 'Ben Kingsley', 'Anthony Hopkins', 'Tom Wilkinson'],
      ),

      q(
        'Koja glumica igra Teddyjevu preminulu suprugu Dolores?',
        'Michelle Williams',
        [
          'Michelle Williams',
          'Cate Blanchett',
          'Kate Winslet',
          'Julianne Moore',
        ],
      ),

      q('Ko igra nestalu pacijentkinju Rachel Solando?', 'Emily Mortimer', [
        'Emily Mortimer',
        'Patricia Clarkson',
        'Naomi Watts',
        'Rachel Weisz',
      ]),

      // ===== RADNJA I DETALJI =====
      q(
        'Koji je Teddyjev zvanični rang kada dolazi na ostrvo?',
        'Federalni maršal SAD',
        [
          'Federalni maršal SAD',
          'FBI agent',
          'Detektiv policije',
          'CIA oficir',
        ],
      ),

      q(
        'Zašto je Rachel Solando bila zatvorena u Ashecliffe?',
        'Utopila svoje troje dece',
        [
          'Utopila svoje troje dece',
          'Ubila muža',
          'Zapalila porodičnu kuću',
          'Otrovala sugrađane',
        ],
      ),

      q(
        'Kakav vremenski fenomen pogodi ostrvo tokom Teddyjeve istrage?',
        'Uragan',
        ['Uragan', 'Blizzard', 'Poplava', 'Tornado'],
      ),

      q(
        'Koji koncentracioni logor je Teddy oslobodio tokom Drugog svetskog rata?',
        'Dachau',
        ['Dachau', 'Auschwitz', 'Buchenwald', 'Treblinka'],
      ),

      q(
        'Šta Teddy pronalazi u praznoj sobi Racheline — ključan trag?',
        'Poruku sa šifrom i brojevima',
        [
          'Poruku sa šifrom i brojevima',
          'Dnevnik sa imenima',
          'Fotografiju dece',
          'Mapu ostrva',
        ],
      ),

      q(
        'Koga Teddy traži na ostrvu pod izgovorom istrage — tajni motiv?',
        'Andrewa Laeddisa, čoveka koji je ubio njegovu ženu',
        [
          'Andrewa Laeddisa, čoveka koji je ubio njegovu ženu',
          'Nacističkog naučnika koji radi eksperimente',
          'Svog nestlog brata koji je zatvoren',
          'Ubicu koji je pobegao sa zatvora',
        ],
      ),

      q(
        'Šta Teddy otkrije u pećini na litici tokom noći?',
        'Ženu koja tvrdi da je pravi doktor Ashecliffea',
        [
          'Ženu koja tvrdi da je pravi doktor Ashecliffea',
          'Tajni bunker sa dokumentima',
          'Pravu Rachelu Solando sakrivenu od bolnice',
          'Chucka vezanog u mraku',
        ],
      ),

      q(
        'Šta su cigare koje Teddyju daju u belom odelu kada se smoči — brend?',
        'Lucky Strike',
        ['Lucky Strike', 'Camel', 'Marlboro', 'Chesterfield'],
      ),

      // ===== TWIST I KRAJ =====
      q(
        'Koje je Teddyjevo pravo ime otkriveno pri kraju filma?',
        'Andrew Laeddis',
        ['Andrew Laeddis', 'Edward Daniels', 'Thomas Cawley', 'James Aule'],
      ),

      q(
        'Šta je zapravo "Teddy Daniels" u stvarnosti?',
        'Anagram od "Andrew Laeddis"',
        [
          'Anagram od "Andrew Laeddis"',
          'Lažno ime iz programa zaštite svedoka',
          'Pseudonim koji je Sam izabrao',
          'Ime koje mu je data od vlade',
        ],
      ),

      q(
        'Šta je Teddy zapravo uradio sa svojom suprugom Dolores?',
        'Ubio je da bi je spasao od ponovnog utapanja dece',
        [
          'Ubio je da bi je spasao od ponovnog utapanja dece',
          'Nije imao veze sa njenom smrću',
          'Slučajno je ubio u nesreći',
          'Predao je vlastima zbog ubojstava',
        ],
      ),

      q('Koliko je dece Dolores — tj. Andrewjeva supruga — utopila?', 'Troje', [
        'Troje',
        'Dvoje',
        'Četvoro',
        'Jedno',
      ]),

      q(
        'Šta Chuck Aule zapravo jeste u stvarnosti?',
        'Andrewjev psihijatar, dr. Sheehan',
        [
          'Andrewjev psihijatar, dr. Sheehan',
          'Stvarni federalni maršal koji ga čuva',
          'Andrewjev preminuli brat',
          'Agent FBI koji ga istražuje',
        ],
      ),

      q(
        'Šta se dešava na samom kraju filma — Andrewjeva poslednja odluka?',
        'Bira lobotomiju umesto da živi sa istinom',
        [
          'Bira lobotomiju umesto da živi sa istinom',
          'Pobegne sa ostrva brodom',
          'Prihvata svoju dijagnozu i kreće na terapiju',
          'Ubija doktora Cawleyja',
        ],
      ),

      q(
        'Šta Andrew kaže Sheehan pre nego što ga odvedu na lobotomiju — poslednja rečenica filma?',
        '"Šta je gore, živeti kao čudovište ili umreti kao dobar čovek?"',
        [
          '"Šta je gore, živeti kao čudovište ili umreti kao dobar čovek?"',
          '"Nisam lud, nikad nisam ni bio."',
          '"Pomozi mi da pobegnem odavde."',
          '"Ovo je sve igra, znaš li ti to?"',
        ],
      ),

      // ===== DETALJI ZA POZNAVAОCE =====
      q(
        'Šta broj "67" simbolizuje u šifrovanim porukama?',
        'Andrew (Teddy) je pacijent broj 67',
        [
          'Andrew (Teddy) je pacijent broj 67',
          'Godina Andrewjevog rođenja',
          'Broj koji Dolores piše pre smrti',
          'Kod za tajno odeljenje Ward C',
        ],
      ),

      q(
        'Koji je naziv tajnog psihijatrijskog odeljenja na ostrvu gde se navodno vrše eksperimenti?',
        'Ward C',
        ['Ward C', 'Ward X', 'Sektor B', 'Blok 4'],
      ),

      q(
        'Koja muzika Mozarta se provlači kao lajtmotiv tokom Teddyjevih halucinacija o Dolores?',
        'Lacrymosa iz Requiema',
        [
          'Lacrymosa iz Requiema',
          'Symphony No. 40',
          'Eine Kleine Nachtmusik',
          'Piano Concerto No. 21',
        ],
      ),
    ],
  },
  {
    id: 'inception',
    title: 'Inception',
    year: 2010,
    country: 'SAD',
    director: 'Christopher Nolan',
    genre: 'Sci-fi',
    lead: 'Leonardo DiCaprio',
    quote: 'Snovi unutar snova.',
    poster: 'https://image.tmdb.org/t/p/w300/9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg',
    questions: [
      // ===== OSNOVNE INFO =====
      q('Ko je napisao i režirao film "Inception"?', 'Christopher Nolan', [
        'Christopher Nolan',
        'Martin Scorsese',
        'James Cameron',
        'Ridley Scott',
      ]),

      q(
        'Koliko je Oscar nagrada film "Inception" osvojio na dodjeli 2011. godine?',
        '4',
        ['4', '2', '6', '8'],
      ),

      q(
        'Koliko je novca film "Inception" zaradio globalno u bioskopu?',
        'Više od 828 miliona dolara',
        [
          'Više od 828 miliona dolara',
          'Oko 400 miliona dolara',
          'Više od 1 milijarde dolara',
          'Oko 600 miliona dolara',
        ],
      ),

      q(
        'Ko je producent filma "Inception" zajedno sa Nolanom?',
        'Emma Thomas',
        [
          'Emma Thomas',
          'Kathleen Kennedy',
          'Jerry Bruckheimer',
          'Charles Roven',
        ],
      ),

      q('Ko je komponovao muziku za film "Inception"?', 'Hans Zimmer', [
        'Hans Zimmer',
        'John Williams',
        'Howard Shore',
        'James Newton Howard',
      ]),

      // ===== LIKOVI I GLUMCI =====
      q(
        'Kako se zove Dom Cobbov partner s kojim radi na početku filma?',
        'Arthur',
        ['Arthur', 'Eames', 'Yusuf', 'Nash'],
      ),

      q('Ko igra lika Arthura?', 'Joseph Gordon-Levitt', [
        'Joseph Gordon-Levitt',
        'Tom Hardy',
        'Cillian Murphy',
        'Dileep Rao',
      ]),

      q('Ko igra lika Eamesa, falsifikatora identiteta?', 'Tom Hardy', [
        'Tom Hardy',
        'Joseph Gordon-Levitt',
        'Michael Fassbender',
        'Cillian Murphy',
      ]),

      q(
        'Ko igra Saita, poslovnog magnata koji angažuje Cobba?',
        'Ken Watanabe',
        ['Ken Watanabe', 'Tony Leung', 'John Cho', 'Daniel Wu'],
      ),

      q('Ko igra Ariadne, studenticu-arhitekticu?', 'Elliot Page', [
        'Elliot Page',
        'Emma Stone',
        'Natalie Portman',
        'Anne Hathaway',
      ]),

      q('Ko igra Mal, Cobbovu preminulu suprugu?', 'Marion Cotillard', [
        'Marion Cotillard',
        'Cate Blanchett',
        'Eva Green',
        'Penélope Cruz',
      ]),

      q('Ko igra Roberta Fischera, metu incepcije?', 'Cillian Murphy', [
        'Cillian Murphy',
        'Tom Hardy',
        'Josh Brolin',
        'Ben Foster',
      ]),

      q('Ko igra Miles Cobba, Domovog tasta i mentora?', 'Michael Caine', [
        'Michael Caine',
        'Anthony Hopkins',
        'Jeremy Irons',
        'Max von Sydow',
      ]),

      q('Ko igra Yusufa, hemičara koji pravi sedativ?', 'Dileep Rao', [
        'Dileep Rao',
        'Dev Patel',
        'Naveen Andrews',
        'Riz Ahmed',
      ]),

      // ===== RADNJA I KONCEPTI =====
      q(
        'Šta je "ekstrakcija" u kontekstu filma?',
        'Krađa informacija iz nečijeg sna',
        [
          'Krađa informacija iz nečijeg sna',
          'Implantacija ideje u nečiji um',
          'Buđenje osobe iz kome',
          'Manipulacija pamćenjem',
        ],
      ),

      q(
        'Šta je "incepcija" u kontekstu filma?',
        'Implantacija ideje u nečiji um a da osoba misli da je sama do nje došla',
        [
          'Implantacija ideje u nečiji um a da osoba misli da je sama do nje došla',
          'Krađa informacija iz sna',
          'Stvaranje lažnih sećanja',
          'Ulazak u više slojeva sna odjednom',
        ],
      ),

      q(
        'Šta je "totem" u filmu?',
        'Lični predmet koji pomaže razlikovati san od stvarnosti',
        [
          'Lični predmet koji pomaže razlikovati san od stvarnosti',
          'Uređaj za ulazak u snove',
          'Šifrovana mapa snova',
          'Sedativ koji produžava san',
        ],
      ),

      q('Koji je Cobbov totem?', 'Zvrk', [
        'Zvrk',
        'Karte za igranje',
        'Crvena kocka',
        'Šahovski konj',
      ]),

      q('Koji je totem Arthura?', 'Crvena kocka', [
        'Crvena kocka',
        'Zvrk',
        'Šahovski konj',
        'Nalivpero',
      ]),

      q('Koji je totem Ariadne?', 'Šuplji šahovski konj', [
        'Šuplji šahovski konj',
        'Zvrk',
        'Novčić',
        'Sat',
      ]),

      q(
        'Šta je "kick" (udarac) u terminologiji filma?',
        'Osećaj pada koji budi sanjača na viši nivo sna ili u stvarnost',
        [
          'Osećaj pada koji budi sanjača na viši nivo sna ili u stvarnost',
          'Napad na mete u snu',
          'Zvuk koji pauzira san',
          'Injekcija sedativa',
        ],
      ),

      q(
        'Koliko slojeva snova ekipa ulazi tokom misije na Fischera?',
        'Tri (plus Limbo)',
        ['Tri (plus Limbo)', 'Dva', 'Četiri', 'Pet'],
      ),

      q(
        'Šta je "Limbo" u filmu?',
        'Nestruktuirano podsvesno — neograničen san bez arhitekture',
        [
          'Nestruktuirano podsvesno — neograničen san bez arhitekture',
          'Treći sloj sna',
          'Halucinacija izazvana sedativom',
          'Poslednji stadijum incepcije',
        ],
      ),

      // ===== IDEJA I KRAJ =====
      q(
        'Koja ideja se implantira u Fischera tokom incepcije?',
        'Da razloži očevo poslovno carstvo',
        [
          'Da razloži očevo poslovno carstvo',
          'Da se odrekne nasledstva',
          'Da surađuje sa Saitom',
          'Da napusti poslovni svet',
        ],
      ),

      q(
        'Zašto Cobb ne može sam da dizajnira snove tokom misije?',
        'Projekcija Mal sabotira snove — ugrožava misiju',
        [
          'Projekcija Mal sabotira snove — ugrožava misiju',
          'Nije arhitektonski obrazovan',
          'Previše poznaje Fischera',
          'Vlasti ga prate kroz snove',
        ],
      ),

      q(
        'Kako se Mal zaista ubila — šta je bio njen razlog?',
        'Verovala je da je stvarnost samo san iz kog se mora probuditi',
        [
          'Verovala je da je stvarnost samo san iz kog se mora probuditi',
          'Bila je mentalno bolesna bez veze sa incepcijom',
          'Cobb ju je slučajno nagovorio na skok',
          'Htela je da kazni Cobba zbog krađe',
        ],
      ),

      q(
        'Ko je stvarno "inceptovao" Mal — ko joj je ubacio prvu ideju?',
        'Dom Cobb',
        ['Dom Cobb', 'Miles, njen otac', 'Arthur', 'Saito'],
      ),

      q(
        'Šta Fischer pronalazi u sefu na trećem nivou sna?',
        'Vetrenjaču i poruku oca koja pokreće ideju da bude svoj',
        [
          'Vetrenjaču i poruku oca koja pokreće ideju da bude svoj',
          'Testament sa imovinom',
          'Dokaze o Saitovim prevarama',
          'Fotografije iz detinjstva',
        ],
      ),

      q(
        'Kako film završava — šta se dešava sa zvrkutom?',
        'Zvrk se vrti ali počinje da se ljulja — kraj je namerno dvosmislen',
        [
          'Zvrk se vrti ali počinje da se ljulja — kraj je namerno dvosmislen',
          'Zvrk pada — Cobb je u stvarnosti',
          'Zvrk ne prestaje da se vrti — Cobb je u snu',
          'Cobb baca zvrk pre nego što se zaustavlja',
        ],
      ),

      q(
        'Koja pesma je korišćena kao "kick" signal u drugom sloju sna?',
        '"Non, Je Ne Regrette Rien" — Edith Piaf',
        [
          '"Non, Je Ne Regrette Rien" — Edith Piaf',
          '"La Vie En Rose" — Edith Piaf',
          '"My Way" — Frank Sinatra',
          '"Time" — Hans Zimmer',
        ],
      ),
    ],
  },
  {
    id: 'interstellar',
    title: 'Interstellar',
    year: 2014,
    country: 'SAD',
    director: 'Christopher Nolan',
    genre: 'Sci-fi',
    lead: 'Matthew McConaughey',
    quote: 'Potraga za novim domom kroz prostor i vreme.',
    poster: 'https://image.tmdb.org/t/p/w300/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg',
    questions: [
      // ===== OSNOVNE INFO =====
      q(
        'Kako se preziva glavni lik Joseph kojeg glumi Matthew McConaughey?',
        'Cooper',
        ['Cooper', 'Chandler', 'Carter', 'Coles'],
      ),

      q(
        'Koji katastrofalni fenomen uništava useve i hrani na Zemlji u filmu?',
        'Glad i bolest bilja (blight)',
        [
          'Glad i bolest bilja (blight)',
          'Nuklearni rat',
          'Udar asteroida',
          'Invazija vanzemaljaca',
        ],
      ),

      q(
        'Po kojoj poznatoj "zakonu" je Cooperova ćerka dobila ime?',
        'Murphyjevom zakonu',
        [
          'Murphyjevom zakonu',
          'Newtonovom zakonu',
          'Einsteinovom zakonu',
          'Mooreovom zakonu',
        ],
      ),

      q(
        'Koji par glumaca igra prof. Johna Branda i njegovu ćerku Ameliju?',
        'Michael Caine i Anne Hathaway',
        [
          'Michael Caine i Anne Hathaway',
          'Morgan Freeman i Halle Berry',
          'Patrick Stewart i Claire Danes',
          'Clint Eastwood i Kirsten Dunst',
        ],
      ),

      q(
        'Pored koje planete je otkriven crv-tunel (wormhole) u filmu?',
        'Saturn',
        ['Saturn', 'Jupiter', 'Neptun', 'Merkur'],
      ),

      q(
        'Kako se zvala NASA-ina misija kojom su 12 astronauta poslati kroz crv-tunel?',
        'Lazarusove misije',
        [
          'Lazarusove misije',
          'Fenikson program',
          'Aténski projekat',
          'Orionov program',
        ],
      ),

      q(
        'Kako se zove NASA-ina svemirska stanica kojom Cooper putuje kroz crv-tunel?',
        'Endurance',
        ['Endurance', 'Endeavour', 'Explorer', 'Enterprise'],
      ),

      q(
        'Koji je naziv crne rupe oko koje orbitiraju planete u filmu?',
        'Gargantua',
        ['Gargantua', 'Andromeda', 'Nebula', 'Corneria'],
      ),

      q(
        'Ko igra legendarneg astronauta dr. Manna — cameo uloga?',
        'Matt Damon',
        ['Matt Damon', 'Brad Pitt', 'Tom Hardy', 'Ben Affleck'],
      ),

      q(
        'Zašto je Millerova planeta neupotrebljiva kao kolonija?',
        'Potpuno je prekrivena vodom',
        [
          'Potpuno je prekrivena vodom',
          'Ima metansku atmosferu',
          'Gasni je džin bez površine',
          'Ekstremno je vulkanska',
        ],
      ),

      q(
        'Koliko zemaljskih godina je prošlo na Endurance stanici dok je Cooper bio 1 sat na Millerovoj planeti?',
        '7 godina',
        ['7 godina', '23 godine', '50 godina', '10 godina'],
      ),

      q(
        'Šta dr. Mann radi sa podacima o svojoj planeti?',
        'Falsifikuje ih da bi neko došao i spasio ga',
        [
          'Falsifikuje ih da bi neko došao i spasio ga',
          'Slučajno greši u merenjima',
          'Šalje tačne podatke ali nestane signal',
          'Uništi ih pre nego što Cooper stigne',
        ],
      ),

      q(
        'Kako se zove četvorodimenzionalna struktura u kojoj Coopera spasava napredna civilizacija?',
        'Tesarakt (Tesseract)',
        ['Tesarakt (Tesseract)', 'Dajsonova sfera', 'Hiperkocka', 'Piramidion'],
      ),

      q(
        'Na koji način Cooper komunicira sa ćerkom Murphy kroz vreme?',
        'Morzea kodom kroz sat na njenoj ruci',
        [
          'Morzea kodom kroz sat na njenoj ruci',
          'Hologramskim porukama',
          'Psihičkom vezom',
          'Svetlosnim signalima',
        ],
      ),

      q(
        'Da li se Cooper na kraju filma vraća na Zemlju?',
        'Ne — odlazi ka Edmundovoj planeti',
        [
          'Ne — odlazi ka Edmundovoj planeti',
          'Da, dolazi na Zemlju i zagrli Murphy',
          'Da, ali umire pri sletanju',
          'Ne — ostaje u tesaraktu zauvek',
        ],
      ),
    ],
  },
  {
    id: 'the-dark-knight',
    title: 'The Dark Knight',
    year: 2008,
    country: 'SAD',
    director: 'Christopher Nolan',
    genre: 'Akcija',
    lead: 'Christian Bale',
    quote: 'Borba za Gotham.',
    poster: 'https://image.tmdb.org/t/p/w300/qJ2tW6WMUDux911r6m7haRef0WH.jpg',
    questions: [
      // ===== OSNOVNE INFO =====
      q('Ko glumi Džokera u "The Dark Knight"?', 'Heath Ledger', [
        'Heath Ledger',
        'Jack Nicholson',
        'Joaquin Phoenix',
        'Jared Leto',
      ]),

      q('Ko glumi okružnog tužioca Harveyja Denta?', 'Aaron Eckhart', [
        'Aaron Eckhart',
        'Josh Brolin',
        'Billy Crudup',
        'Guy Pearce',
      ]),

      q('Ko glumi Alfreda, Bruceovog vernog batlera?', 'Michael Caine', [
        'Michael Caine',
        'Jeremy Irons',
        'Anthony Hopkins',
        'Ian McKellen',
      ]),

      q(
        'Ko glumi Luciusa Foxa, Wayneovog tehničkog eksperta?',
        'Morgan Freeman',
        [
          'Morgan Freeman',
          'Denzel Washington',
          'Samuel L. Jackson',
          'Chiwetel Ejiofor',
        ],
      ),

      q(
        'Ko glumi Rachel Dawes, Bruceovog prijatelja iz detinjstva?',
        'Maggie Gyllenhaal',
        [
          'Maggie Gyllenhaal',
          'Katie Holmes',
          'Natalie Portman',
          'Scarlett Johansson',
        ],
      ),

      q('Ko glumi inspektora Gordona?', 'Gary Oldman', [
        'Gary Oldman',
        'Bryan Cranston',
        'Kevin Spacey',
        'Ed Harris',
      ]),

      q(
        'Koju nagradu je Heath Ledger posthumno dobio za ulogu Džokera?',
        'Oscar za najboljeg sporednog glumca',
        [
          'Oscar za najboljeg sporednog glumca',
          'Zlatni globus za glavnu ulogu',
          'SAG Award za najboljeg glumca',
          'BAFTA za najboljeg glumca',
        ],
      ),

      q('Kako se zove Batmanov borbeni automobil u filmu?', 'Tumbler', [
        'Tumbler',
        'Batmobile',
        'Darkwing',
        'Nightcrawler',
      ]),

      q(
        'Kome je Harvey Dent pripisao rečenicu: "Ili umireš kao heroj, ili živiš dovoljno dugo da postaneš zlikovac"?',
        'Harvey Dent je izgovara za sebe',
        [
          'Harvey Dent je izgovara za sebe',
          'Batman je govori Džokeru',
          'Alfred govori Bruceu',
          'Gordon govori Batmanu',
        ],
      ),

      q(
        'Šta Džoker radi olovkom pred mafijasom na sastanku?',
        '"Čara" je — zabija u glavu mafijaškog pomoćnika',
        [
          '"Čara" je — zabija u glavu mafijaškog pomoćnika',
          'Baca je u zrak i hvata',
          'Piše pretnje na tabli',
          'Lomi je na pola kao znak mira',
        ],
      ),

      q(
        'Šta Harvey Dent postaje nakon tragedije u kojoj strada Rachel?',
        'Two-Face (Dvolični)',
        ['Two-Face (Dvolični)', 'Scarecrow', 'Mr. Freeze', 'Penguin'],
      ),

      q(
        'Gde Batman zarobljava Džokera na kraju filma?',
        'Hvata ga u padu sa zgrade i drži o konopcu',
        [
          'Hvata ga u padu sa zgrade i drži o konopcu',
          'U gothamskom metrou',
          'Na krovu policijske stanice',
          'U Batmanovoj pećini',
        ],
      ),

      q(
        'Koji je rezultat eksperimenta sa dva broda — građani vs. zatvorenici — koje Džoker primorava da se unište?',
        'Niko nije aktivirao eksploziv — oba broda prežive',
        [
          'Niko nije aktivirao eksploziv — oba broda prežive',
          'Građani unište zatvorički brod',
          'Zatvorenici unište građanski brod',
          'Batman sprečava pre detonacije',
        ],
      ),

      q(
        'Kome je film još posvećen pored Heatha Ledgera?',
        'Conway Wickliffe — kaskader koji poginuo tokom snimanja',
        [
          'Conway Wickliffe — kaskader koji poginuo tokom snimanja',
          'Bob Kane — kreator Batmana',
          'Jonathan Nolan — scenarista',
          'Gary Oldman — glumac',
        ],
      ),

      q(
        'Šta Batman govori Gordonu na samom kraju filma — zašto preuzima krivicu za Dentove ubojstvo?',
        'Da bi Gotham zadržao Denta kao heroja i simbol nade',
        [
          'Da bi Gotham zadržao Denta kao heroja i simbol nade',
          'Jer se zaista oseća krivim za Rachelin smrt',
          'Da bi Džoker bio oslobođen i uhvaćen ponovo',
          'Jer Gordon od njega traži da to učini',
        ],
      ),
    ],
  },
  {
    id: 'silence-of-the-lambs',
    title: 'The Silence of the Lambs',
    year: 1991,
    country: 'SAD',
    director: 'Jonathan Demme',
    genre: 'Triler',
    lead: 'Jodie Foster',
    quote: 'Jede li jagnjad i dalje vrišti, Clarice?',
    poster: 'https://image.tmdb.org/t/p/w300/uS9m8OBk1A8eM9I042bx8XXpqAq.jpg',
    questions: [
      q('Ko glumi Hannibala Lectera?', 'Anthony Hopkins', [
        'Anthony Hopkins',
        'Gary Oldman',
        'Brian Cox',
        'Jeremy Irons',
      ]),

      q('Ko glumi Clarice Starling?', 'Jodie Foster', [
        'Jodie Foster',
        'Sigourney Weaver',
        'Meryl Streep',
        'Susan Sarandon',
      ]),

      q('Ko je režiser filma "The Silence of the Lambs"?', 'Jonathan Demme', [
        'Jonathan Demme',
        'David Fincher',
        'Ridley Scott',
        'Oliver Stone',
      ]),

      q(
        'Koliko Oscara je film osvojio — i kojih?',
        '5 — Slika, Režija, Scenario, Glumac, Glumica',
        [
          '5 — Slika, Režija, Scenario, Glumac, Glumica',
          '3 — Slika, Glumac, Glumica',
          '4 — bez Scenarija',
          '2 — samo glumci',
        ],
      ),

      q(
        'Kako se zove serijski ubica kojeg FBI traži — ne Hannibal?',
        'Buffalo Bill (James Gumb)',
        [
          'Buffalo Bill (James Gumb)',
          'Red Dragon',
          'The Tooth Fairy',
          'Hannibal Jr.',
        ],
      ),

      q(
        'Šta Buffalo Bill radi sa žrtvama — zbog čega je opasan?',
        'Skida im kožu da bi sebi napravio "ženski" kostim',
        [
          'Skida im kožu da bi sebi napravio "ženski" kostim',
          'Jede ih kao Hannibal',
          'Čuva ih žive u laboratoriji',
          'Mumificira ih',
        ],
      ),

      q(
        'Nastavi Hannibalov kultni citat — "Jeo sam mu džigericu sa bob pasuljem i..."',
        '"...finim chianti vinom."',
        [
          '"...finim chianti vinom."',
          '"...slatkim crvenim vinom."',
          '"...malo limunovog soka."',
          '"...ljutim sosom."',
        ],
      ),

      q(
        'Kako se zove psihijatrijska ustanova u kojoj je zatvoren Hannibal?',
        'Baltimore State Hospital for the Criminally Insane',
        [
          'Baltimore State Hospital for the Criminally Insane',
          'Arkham Asylum',
          'Shutter Island',
          'Ashecliffe Hospital',
        ],
      ),

      q('Kako se zove šef Claricein iz FBI?', 'Jack Crawford', [
        'Jack Crawford',
        'Gordon Williams',
        'Frank Doyle',
        'James Colton',
      ]),

      q(
        'Ko glumi dr. Fredericka Chiltona — ravnatelja bolnice?',
        'Anthony Heald',
        ['Anthony Heald', 'Scott Glenn', 'Ted Levine', 'Roger Corman'],
      ),

      q(
        'Šta je Hannibalu zabranjeno u ćeliji zbog opasnosti?',
        'Ne sme dobiti olovke ni oštre predmete',
        [
          'Ne sme dobiti olovke ni oštre predmete',
          'Ne sme gledati TV',
          'Ne sme imati posete',
          'Mora biti u pravoj tami',
        ],
      ),

      q(
        'Kako Hannibal uspeva da pobegne iz zatvora?',
        'Savlada i preobuce se u policajca koristeci mu lice kao masku',
        [
          'Savlada i preobuce se u policajca koristeci mu lice kao masku',
          'Podmiti čuvara',
          'Iskopa tunel ispod ćelije',
          'Clarice mu pomogne',
        ],
      ),

      q(
        'Šta Clarice čuje u svom detinjstvu — odakle potiče naslov filma?',
        'Vrištanje jagnjadi pre klanja na farmi',
        [
          'Vrištanje jagnjadi pre klanja na farmi',
          'Plač majke',
          'Tišinu u kojoj je ubijen otac',
          'Zavijanje vukova',
        ],
      ),

      q(
        'Kako Hannibal završava film — poslednja scena?',
        'Kaže da ide na večeru sa starim prijateljem (dr. Chilton) i nestaje',
        [
          'Kaže da ide na večeru sa starim prijateljem (dr. Chilton) i nestaje',
          'Biva ponovo uhvaćen',
          'Predaje se Clarice dobrovoljno',
          'Ubijen je pri bekstvu',
        ],
      ),

      q(
        'Koliko je minuta Anthony Hopkins bio na ekranu — a dobio Oscar?',
        'Svega 16 minuta',
        ['Svega 16 minuta', '45 minuta', '30 minuta', '60 minuta'],
      ),
    ],
  },
  {
    id: 'parasite',
    title: 'Parasite',
    year: 2019,
    country: 'Južna Koreja',
    director: 'Bong Joon-ho',
    genre: 'Triler',
    lead: 'Song Kang-ho',
    quote: 'Nema plana koji ne može poći po zlu.',
    poster: 'https://image.tmdb.org/t/p/w300/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg',
    questions: [
      q('Iz koje države potiče film "Parasite"?', 'Južna Koreja', [
        'Južna Koreja',
        'Japan',
        'Kina',
        'Tajvan',
      ]),

      q('Ko je režiser i scenarista filma "Parasite"?', 'Bong Joon-ho', [
        'Bong Joon-ho',
        'Park Chan-wook',
        'Lee Chang-dong',
        'Kim Jee-woon',
      ]),

      q(
        'Koje istorijske nagrade je "Parasite" osvojio na Oscar ceremoniji 2020.?',
        'Najbolji film, Režija, Originalni scenario, Strani film — 4 Oscara',
        [
          'Najbolji film, Režija, Originalni scenario, Strani film — 4 Oscara',
          'Samo Strani film',
          '2 Oscara — Režija i Scenario',
          '3 Oscara bez Najboljeg filma',
        ],
      ),

      q(
        'Kao koji film je "Parasite" ušao u istoriju Oskara?',
        'Prvi neengleski film koji je pobedio kao Najbolji film',
        [
          'Prvi neengleski film koji je pobedio kao Najbolji film',
          'Najskuplji azijski film ikad',
          "Prva korejska Palme d'Or",
          'Jedini horor koji je dobio Oscara',
        ],
      ),

      q('Kako se preziva siromašna porodica iz filma?', 'Kim', [
        'Kim',
        'Park',
        'Lee',
        'Choi',
      ]),

      q('Kako se preziva bogata porodica kojoj Kim porodica radi?', 'Park', [
        'Park',
        'Kim',
        'Han',
        'Yoon',
      ]),

      q(
        'Kao šta se Ki-woo infiltrira u bogatu porodicu?',
        'Kao privatni tutor za engleski jezik',
        [
          'Kao privatni tutor za engleski jezik',
          'Kao kuvar',
          'Kao vozač',
          'Kao lekar',
        ],
      ),

      q(
        'Šta Ki-woo dobija od prijatelja kao "lucky charm" — predmet koji postaje simbol filma?',
        'Kamen (suseok)',
        ['Kamen (suseok)', 'Ključ od kuće', 'Sliku', 'Prsten'],
      ),

      q(
        'Na šta je bogata porodica Park alergična — ključni detalj u radnji?',
        'Breskve',
        ['Breskve', 'Orasi', 'Kikiriki', 'Šljive'],
      ),

      q(
        'Šta se krije ispod bogataške kuće — šokantno otkriće?',
        'Tajni bunker u kome živi bivši muž domaćice',
        [
          'Tajni bunker u kome živi bivši muž domaćice',
          'Trezor sa novcem',
          'Tajni laboratorij',
          'Protivatomsko sklonište',
        ],
      ),

      q(
        'Ko živi tajno u bunkeru ispod Parkove vile?',
        "Moon-gwang'gov muž Oh Geun-sae",
        [
          "Moon-gwang'gov muž Oh Geun-sae",
          'Bivši vlasnik kuće',
          'Zbjegli kriminalac',
          'Ki-taekkov stari drugar',
        ],
      ),

      q(
        'Šta se dešava na dečjoj zabavi u finalu — čime kulminira film?',
        'Masovni obračun sa višestrukim smrtnim ishodom',
        [
          'Masovni obračun sa višestrukim smrtnim ishodom',
          'Porodica Kim bude otkrivena i uhapšena',
          'Kuća izgori do temelja',
          'Ki-woo pobegne sa novcem',
        ],
      ),

      q(
        'Šta Ki-taek uradi Parku na kraju — šokantna scena?',
        'Ubije ga nožem pred svima',
        [
          'Ubije ga nožem pred svima',
          'Opljačka ga i pobegne',
          'Uzme ga kao taoca',
          'Razotkrije ga pred policijom',
        ],
      ),

      q(
        'Gde Ki-taek završi na kraju filma?',
        'Sakriva se u bunkeru ispod Parkove kuće',
        [
          'Sakriva se u bunkeru ispod Parkove kuće',
          'Beži u inostranstvo',
          'Predaje se policiji',
          'Živi kod Ki-wooa',
        ],
      ),

      q(
        'Koja je tema filma prema samom reditelju Bongu?',
        'Klasna nejednakost i ekonomska polarizacija društva',
        [
          'Klasna nejednakost i ekonomska polarizacija društva',
          'Obiteljska dinamika i tajne',
          'Korupcija u vladi',
          'Digitalizacija i gubitak identiteta',
        ],
      ),
    ],
  },
  {
    id: 'the-matrix',
    title: 'The Matrix',
    year: 1999,
    country: 'SAD',
    director: 'Lana i Lilly Wachowski',
    genre: 'Sci-fi',
    lead: 'Keanu Reeves',
    quote: 'Uzmi crvenu pilulu i vidi koliko duboko ide zečja rupa.',
    poster: 'https://image.tmdb.org/t/p/w300/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg',
    questions: [
      q(
        'Ko su reditelji filma "The Matrix"?',
        'Wachowski sestre (Lana i Lilly)',
        [
          'Wachowski sestre (Lana i Lilly)',
          'James Cameron i Ridley Scott',
          'Spielberg i Nolan',
          'Joel i Ethan Coen',
        ],
      ),

      q('Koje je pravo ime glavnog lika Nea?', 'Thomas Anderson', [
        'Thomas Anderson',
        'John Miller',
        'David Smith',
        'Ryan Cross',
      ]),

      q('Ko glumi Morpheusa?', 'Laurence Fishburne', [
        'Laurence Fishburne',
        'Morgan Freeman',
        'Samuel L. Jackson',
        'Denzel Washington',
      ]),

      q('Ko glumi Trinity?', 'Carrie-Anne Moss', [
        'Carrie-Anne Moss',
        'Milla Jovovich',
        'Linda Hamilton',
        'Sigourney Weaver',
      ]),

      q('Ko glumi agenta Smitha?', 'Hugo Weaving', [
        'Hugo Weaving',
        'Gary Oldman',
        'Ralph Fiennes',
        'Jason Isaacs',
      ]),

      q(
        'Koju pilulu Neo bira — i šta ona simbolizuje?',
        'Crvenu — prihvata istinu o Matriksu',
        [
          'Crvenu — prihvata istinu o Matriksu',
          'Plavu — vraća se u neznanje',
          'Zelenu — postaje agent',
          'Bijelu — ulazi dublje u simulaciju',
        ],
      ),

      q(
        'Šta je zapravo Matrix po Morpheusu?',
        '"Zatvor uma" — simulacija stvarnosti za kontrolu čovečanstva',
        [
          '"Zatvor uma" — simulacija stvarnosti za kontrolu čovečanstva',
          'Virtuelna realnost za zabavu',
          'Eksperiment veštačke inteligencije',
          'Alternativna dimenzija',
        ],
      ),

      q('Kako se zove Morpheusov brod na kome živi posada?', 'Nebuchadnezzar', [
        'Nebuchadnezzar',
        'Zion',
        'Prometheus',
        'Exodus',
      ]),

      q('Kako se zove jedini slobodan grad ljudi u stvarnom svetu?', 'Zion', [
        'Zion',
        'Haven',
        'Elysium',
        'Freetown',
      ]),

      q('Ko je izdajica u posadi koji sarađuje sa agentima?', 'Cypher', [
        'Cypher',
        'Tank',
        'Apoc',
        'Switch',
      ]),

      q(
        'Šta Cypher traži od agenata zauzvrat za izdaju?',
        'Da bude vraćen u Matrix sa lažnim sećanjima kao bogat čovek',
        [
          'Da bude vraćen u Matrix sa lažnim sećanjima kao bogat čovek',
          'Novac i slobodu',
          'Izlaz iz Matriksa',
          'Moć agenta',
        ],
      ),

      q(
        'Nastavi kultnu repliku Morpheusa — "Nažalost, niko ne može biti rečeno šta je Matrix..."',
        '"...moraš ga sam videti."',
        [
          '"...moraš ga sam videti."',
          '"...to je izvan reči."',
          '"...to prevazilazi ljudski um."',
          '"...dok ne biraš da vidiš."',
        ],
      ),

      q('Ko glumi "The Oracle" — proročicu?', 'Gloria Foster', [
        'Gloria Foster',
        'Whoopi Goldberg',
        'Pam Grier',
        'Angela Bassett',
      ]),

      q('Koji glumac je odbio ulogu Nea?', 'Will Smith', [
        'Will Smith',
        'Tom Cruise',
        'Nicolas Cage',
        'Johnny Depp',
      ]),

      q(
        'Šta Neo radi na samom kraju filma — kakva je njegova poruka?',
        'Obećava da će pokazati svetu da je oslobođenje moguće',
        [
          'Obećava da će pokazati svetu da je oslobođenje moguće',
          'Uništava Matrix zauvek',
          'Predaje se agentima dobrovoljno',
          'Umire i biva vaskrsen',
        ],
      ),
    ],
  },
  {
    id: 'fight-club',
    title: 'Fight Club',
    year: 1999,
    country: 'SAD',
    director: 'David Fincher',
    genre: 'Triler',
    lead: 'Brad Pitt',
    quote: 'Prvo pravilo Fight Cluba — ne govoriš o Fight Clubu.',
    poster: 'https://image.tmdb.org/t/p/w300/pB8BM7pdSp6B6Ih7QZ4DrQ3PmJK.jpg',
    questions: [
      q(
        'Ko je napisao roman na kom je baziran film "Fight Club"?',
        'Chuck Palahniuk',
        [
          'Chuck Palahniuk',
          'Bret Easton Ellis',
          'Cormac McCarthy',
          'Don DeLillo',
        ],
      ),

      q('Ko je režirao film "Fight Club"?', 'David Fincher', [
        'David Fincher',
        'Christopher Nolan',
        'Darren Aronofsky',
        'Paul Thomas Anderson',
      ]),

      q('Ko glumi Tylerja Durdena?', 'Brad Pitt', [
        'Brad Pitt',
        'Tom Cruise',
        'Johnny Depp',
        'Matt Damon',
      ]),

      q('Ko glumi naratora — lika bez navedenog imena?', 'Edward Norton', [
        'Edward Norton',
        'Christian Bale',
        'Jude Law',
        'Kevin Spacey',
      ]),

      q('Ko glumi Marlu Singer?', 'Helena Bonham Carter', [
        'Helena Bonham Carter',
        'Cate Blanchett',
        'Julianne Moore',
        'Winona Ryder',
      ]),

      q(
        'Nastavi kultnu repliku — "Prvo pravilo Fight Cluba je:"',
        '"Ne govoriš o Fight Clubu."',
        [
          '"Ne govoriš o Fight Clubu."',
          '"Nema pravila u Fight Clubu."',
          '"Pobednik ne pita za pravila."',
          '"Uvek se borite do kraja."',
        ],
      ),

      q(
        'Koje je Tylerovo zanimanje kojim zarađuje — pomalo morbidno?',
        'Pravi i prodaje sapun od masti iz liposukcije',
        [
          'Pravi i prodaje sapun od masti iz liposukcije',
          'Radnik u mrtvačnici',
          'Kemičar eksploziva',
          'Konobar',
        ],
      ),

      q(
        'Šta Tyler ubacuje u filmove pre distribucije u bioskopu — tajni posao?',
        'Kadrove pornografskog sadržaja',
        [
          'Kadrove pornografskog sadržaja',
          'Subliminalne poruke',
          'Reklame firme',
          'Kadrove nasilja',
        ],
      ),

      q(
        'Kako se zove tajna vojna organizacija koja izrasta iz Fight Cluba?',
        'Project Mayhem',
        ['Project Mayhem', 'Fight Force', 'Dark Order', 'The Circle'],
      ),

      q(
        'Šta je Tylerjev krajnji plan sa Project Mayhemom?',
        'Uništiti zgrade kreditnih kompanija i izbrisati finansijske dugove',
        [
          'Uništiti zgrade kreditnih kompanija i izbrisati finansijske dugove',
          'Ubiti predsednika',
          'Preuzeti kontrolu nad medijima',
          'Dignutu u vazduh policijsku stanicu',
        ],
      ),

      q(
        'Koji je pravi twist na kraju filma?',
        'Tyler Durden i Narator su ista osoba — disocijativni poremećaj identiteta',
        [
          'Tyler Durden i Narator su ista osoba — disocijativni poremećaj identiteta',
          'Marla je izmišljeni lik',
          'Sve se dešava u snu',
          'Narator je već mrtav na početku',
        ],
      ),

      q(
        'Koji poznati pjevač glumi Boba — čoveka sa velikim grudima u grupama podrške?',
        'Meat Loaf',
        ['Meat Loaf', 'Jim Morrison', 'David Bowie', 'Axl Rose'],
      ),

      q(
        'Koga Tyler kaže da su "Fight Club" generacija?',
        '"Srednja deca istorije" — bez svrhe i rata koji ih definiše',
        [
          '"Srednja deca istorije" — bez svrhe i rata koji ih definiše',
          '"Izgubljena generacija bez identiteta"',
          '"Deca reklama i televizije"',
          '"Robovi sistema"',
        ],
      ),

      q(
        'Šta Narrator radi u sceni na kraju — kako zaustavi Project Mayhem?',
        'Upuca sebe u usta da eliminiše Tylerovu projekciju',
        [
          'Upuca sebe u usta da eliminiše Tylerovu projekciju',
          'Pozove policiju i preda se',
          'Deaktivira bombe sam',
          'Ubije Marlu',
        ],
      ),

      q(
        'Koji glumac je odbio ulogu Tylerja Durdena pre Brada Pitta?',
        'Sean Penn',
        ['Sean Penn', 'Tom Hanks', 'Nicolas Cage', 'Russell Crowe'],
      ),
    ],
  },
  {
    id: 'avatar',
    title: 'Avatar',
    year: 2009,
    country: 'SAD',
    director: 'James Cameron',
    genre: 'Sci-fi',
    lead: 'Sam Worthington',
    quote: 'Dobrodošli na Pandoru.',
    poster: 'https://image.tmdb.org/t/p/w300/jRXYjXNq0Cs2TcJjLkki24MLp7u.jpg',
    questions: [
      q('Ko je režirao film "Avatar"?', 'James Cameron', [
        'James Cameron',
        'Steven Spielberg',
        'Ridley Scott',
        'Peter Jackson',
      ]),

      q(
        'Kako se zove mesec na kome se odvija radnja filma "Avatar"?',
        'Pandora',
        ['Pandora', 'Titan', 'Europa', 'Triton'],
      ),

      q(
        'Kako se zove korporacija koja eksploatiše Pandoru u potrazi za mineralom?',
        'RDA (Resources Development Administration)',
        [
          'RDA (Resources Development Administration)',
          'Weyland Corp',
          'OmniCorp',
          'InGen',
        ],
      ),

      q(
        'Kako se zove mineral koji korporacija traži na Pandori?',
        'Unobtanium',
        ['Unobtanium', 'Vibranium', 'Dilithium', 'Adamantium'],
      ),

      q('Kako se zove urođenički narod Pandore?', "Na'vi", [
        "Na'vi",
        'Avatari',
        'Pandorci',
        'Omatikaya',
      ]),

      q(
        'Ko glumi Jake Sullyja, bivšeg marinea koji upravlja avatarom?',
        'Sam Worthington',
        ['Sam Worthington', 'Chris Pratt', 'Tom Hardy', 'Joel Edgerton'],
      ),

      q("Ko glumi Neytiri, Na'vi princezu?", 'Zoe Saldana', [
        'Zoe Saldana',
        "Lupita Nyong'o",
        'Naomi Scott',
        'Thandiwe Newton',
      ]),

      q(
        'Ko glumi dr. Grace Augustine, botaničarku i voditeljku avatar programa?',
        'Sigourney Weaver',
        [
          'Sigourney Weaver',
          'Cate Blanchett',
          'Julianne Moore',
          'Helen Mirren',
        ],
      ),

      q(
        "Kako se zove vojni pukovnik koji predvodi napad na Na'vi?",
        'Quaritch',
        ['Quaritch', 'Selfridge', 'Wainwright', 'Hardwick'],
      ),

      q(
        "Kako se zove sveto drvo Na'vi naroda koje vojska uništava?",
        'Hometree',
        ['Hometree', 'Drvo života', 'Eywa', 'Drvo duša (Tree of Souls)'],
      ),

      q(
        'Koji je film "Avatar" oborio rekord po zaradi?',
        'Titanic — do tada najveća zarada u istoriji',
        [
          'Titanic — do tada najveća zarada u istoriji',
          'Star Wars',
          'Avengers: Endgame',
          'Jurassic Park',
        ],
      ),

      q("Kako se zove Jakova klana Na'vi zajednica?", 'Omatikaya', [
        'Omatikaya',
        "Na'vi Prime",
        'Metkayina',
        'Anurai',
      ]),

      q(
        'Šta Jake mora da uradi da bi bio prihvaćen kao ratnik klana?',
        'Ukroti i pojaha letećeg Toruka',
        [
          'Ukroti i pojaha letećeg Toruka',
          'Ubije Quaritcha sam',
          'Prođe ritualni lov bez oružja',
          "Nauči Na'vi jezik",
        ],
      ),

      q(
        'Šta je "Eywa" u kontekstu filma?',
        'Duhovna boginja / neuronska mreža Pandore',
        [
          'Duhovna boginja / neuronska mreža Pandore',
          'Ime planete pre Pandore',
          'Titula šefa klana',
          'Naziv avatara',
        ],
      ),

      q(
        'Koliko je Avatar zaradio globalno — kao najprofitabilniji film svih vremena?',
        'Više od 2.9 milijardi dolara',
        [
          'Više od 2.9 milijardi dolara',
          'Oko 1.5 milijardi',
          'Više od 3.5 milijardi',
          'Tačno 2 milijarde',
        ],
      ),
    ],
  },
];
