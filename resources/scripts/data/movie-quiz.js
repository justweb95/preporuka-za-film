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
  poster: 'https://media.themoviedb.org/t/p/w300_and_h450_face/yP8U8NTstM1qC94fDwPPjt9DRDp.jpg',
  questions: [
    q('Ko je režirao film "Munje!"?', 'Radivoje Andrić', ['Radivoje Andrić', 'Srđan Golubović', 'Dragan Bjelogrlić', 'Emir Kusturica']),
    q('Koje godine je izašao film "Munje!"?', '2001', ['2001', '1998', '2004', '2000']),
    q('Koji žanr najbolje opisuje film "Munje!"?', 'Komedija', ['Komedija', 'Triler', 'Drama', 'Akcija']),
    q('Kako se zove lik koga glumi Sergej Trifunović?', 'Pop', ['Pop', 'Mare', 'Gojko', 'Pandur']),
    q('Kako se zove lik koga glumi Boris Milivojević?', 'Mare', ['Mare', 'Pop', 'Sisa', 'Deda Mraz']),
    
    q('Koji nadimak ima Gojko u filmu?', 'Sisa', ['Sisa', 'Bato', 'Care', 'Šef']),
    q('Ko glumi Gojka Sisu?', 'Nikola Đuričko', ['Nikola Đuričko', 'Boris Milivojević', 'Sergej Trifunović', 'Nebojša Glogovac']),
    q('Kako se zove policajac u filmu?', 'Pandur', ['Pandur', 'Stražar', 'Milicioner', 'Čuvar']),
    q('Ko glumi policajca u filmu?', 'Nebojša Glogovac', ['Nebojša Glogovac', 'Nikola Kojo', 'Dragan Bjelogrlić', 'Zoran Cvijanović']),
    q('Kako se zove lik koji pljačka apoteku?', 'Deda Mraz', ['Deda Mraz', 'Lopov', 'Kradljivac', 'Razbojnik']),
    
    q('Ko glumi Deda Mraza?', 'Zoran Cvijanović', ['Zoran Cvijanović', 'Nebojša Glogovac', 'Dragan Nikolić', 'Gorica Popović']),
    q('Kako se zove devojka u koju je Mare zaljubljen?', 'Kata', ['Kata', 'Lola', 'Maja', 'Ana']),
    q('Ko glumi Katu?', 'Maja Mandžuka', ['Maja Mandžuka', 'Milica Vujović', 'Jelena Đokić', 'Ana Sofrenović']),
    q('Nastavi Gojkov citat: "Što ti je dobra..."', 'majčica, šećeru', ['majčica, šećeru', 'devojka, brate', 'riba, care', 'žena, druže']),
    q('Nastavi Gojkov citat: "Za početak snimićemo jedan..."', 'kompakt CD', ['kompakt CD', 'album', 'demo', 'singl']),
    
    q('Nastavi citat pandura: "Dolče i Gabana, a? Pa i njega ćemo da..."', 'hapsimo, da znaš', ['hapsimo, da znaš', 'uhvatimo', 'privedemo', 'teramo']),
    q('Kada pandur pita "Odakle tebi ovoliko opijata?", šta mu Deda Mraz odgovara?', 'Nije naše, našli smo', ['Nije naše, našli smo', 'Kupili smo', 'Nije moje', 'Ne znam']),
    q('Na odgovor "Našli smo", pandur odgovara:', 'Našao si? Kako ga ja nisam našao?!', ['Našao si? Kako ga ja nisam našao?!', 'Ma daj!', 'Ne verujem ti!', 'Sigurno!']),
    q('Nastavi Gojkov citat: "Najebaćeš! I ti ćeš najebati!..."', 'Najebaćete!', ['Najebaćete!', 'Svi ćete!', 'Gotovi ste!', 'Propali ste!']),
    q('Kada Mare kaže "Ej, ona sija", Pop mu odgovara:', 'Pa vodi je u mrak da ti sija', ['Pa vodi je u mrak da ti sija', 'E pa dobra je', 'Ma pusti je', 'Zaboravi']),
    
    q('Što Gojko kaže Popu: "Što ulaziš u frku kad si..."', 'slabiji?', ['slabiji?', 'mali?', 'mlađi?', 'gluplji?']),
    q('Kada Gojko raskida sa Katom, kaže joj: "Među nama više nema..."', 'fluida', ['fluida', 'ljubavi', 'osećanja', 'veze']),
    q('Koji muzički žanr Mare i Pop snimaju?', 'Drum and bass', ['Drum and bass', 'Hip hop', 'Rock', 'Techno']),
    q('Šta je Gojko po zanimanju?', 'Vlasnik kluba i studija', ['Vlasnik kluba i studija', 'Muzičar', 'DJ', 'Menadžer']),
    q('Kako se zove fudbalska zvezda koja se pojavljuje u filmu?', 'Dule Savić', ['Dule Savić', 'Dejan Stanković', 'Siniša Mihajlović', 'Dragan Stojković']),
    
    q('Koliko ljudi je pogledalo film "Munje!" u bioskopima?', 'Preko 600.000', ['Preko 600.000', 'Oko 300.000', 'Oko 100.000', 'Milion']),
    q('U kom gradu se dešava radnja filma?', 'Beograd', ['Beograd', 'Novi Sad', 'Niš', 'Kragujevac']),
    q('U kom periodu se dešava radnja?', 'Devedesete (1990s)', ['Devedesete (1990s)', 'Osamdesete', 'Dvehiljadite', 'Sedamdesete']),
    q('Kako se zove nastavak filma "Munje!" iz 2023. godine?', 'Munje: Opet!', ['Munje: Opet!', 'Munje 2', 'Nove Munje', 'Munje Ponovo']),
    q('Ko je scenarista filma "Munje!"?', 'Srđa Anđelić', ['Srđa Anđelić', 'Radivoje Andrić', 'Dušan Kovačević', 'Srđan Dragojević'])
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
    poster: 'https://media.themoviedb.org/t/p/w300_and_h450_face/cjaZaKLGKeZ7xY7FaSvOfuhWOWw.jpg',
    questions: [
   // ===== OSNOVNE INFO =====
q('Koje godine je premijerno prikazan film "Kad porastem biću Kengur"?', '2004', ['2004', '2001', '2006', '1999']),

q('Ko je režirao film "Kad porastem biću Kengur"?', 'Radivoje Andrić', ['Radivoje Andrić', 'Srđan Dragojević', 'Janko Baljak', 'Zdravko Šotra']),

q('Koji je žanr filma "Kad porastem biću Kengur"?', 'Komedija', ['Komedija', 'Triler', 'Drama', 'Horor']),

q('U kojoj beogradskoj opštini se odvija cela radnja filma?', 'Voždovac', ['Voždovac', 'Zemun', 'Čukarica', 'Palilula']),

q('Koji je podnaslov / tagline filma "Kad porastem biću Kengur"?', 'Beogradske priče jedne noći', ['Beogradske priče jedne noći', 'Jedna noć u Beogradu', 'Grad koji nikad ne spava', 'Svi smo mi Beograđani']),

// ===== LIKOVI I GLUMCI =====
q('Kako se zove lik kojeg igra Nebojša Glogovac?', 'Živac', ['Živac', 'Baron', 'Sumpor', 'Avaks']),

q('Kako se zove lik kojeg igra Sergej Trifunović?', 'Braca', ['Braca', 'Šomi', 'Hibrid', 'Duje']),

q('Koji glumac igra lika zvanog Sumpor?', 'Gordan Kičić', ['Gordan Kičić', 'Nikola Đuričko', 'Dragan Bjelogrlić', 'Boris Isaković']),

q('Koji glumac igra lika zvanog Kengur?', 'Nikola Đuričko', ['Nikola Đuričko', 'Gordan Kičić', 'Dragan Bjelogrlić', 'Filip Đurić']),

q('Kako se zove manekenka koju Braca pokušava da "smuva" tokom noći?', 'Iris', ['Iris', 'Ines', 'Jelena', 'Svetlana']),

q('Koji glumac igra lika zvanog Baron?', 'Petar Kralj', ['Petar Kralj', 'Bata Živojinović', 'Miki Manojlović', 'Svetozar Cvetković']),

// ===== NADIMCI =====
q('Koji nadimak NIJE lik iz filma "Kad porastem biću Kengur"?', 'Diesel', ['Diesel', 'Avaks', 'Hibrid', 'Sumpor']),

q('Braca i Sumpor su drugari. Kako se zove još jedan lik iz njihovog društva?', 'Avaks', ['Avaks', 'Žuća', 'Cane', 'Gvozden']),

q('Koji dvojac sa krova zgrade šaraju i raspravljaju o daljini?', 'Avaks i Hibrid', ['Avaks i Hibrid', 'Braca i Sumpor', 'Šomi i Duje', 'Baron i Cile']),

// ===== CITATI - NASTAVI REČENICU =====
q('Nastavi repliku — Braca: "Hej, ona sija!" Šta odgovara Sumpor?', 'Pa vodi je u mrak da ti sija!', ['Pa vodi je u mrak da ti sija!', 'Braco, pusti to!', 'Sanja, brate, sanja.', 'Nije za tebe, čoveče.']),

q('Nastavi repliku — Radnik u bioskopu: "Rakiju ne pijem…" Šta kaže dalje?', 'Al\' vinjak derem!', ['Al\' vinjak derem!', 'Al\' pivo volim.', 'Na poslu ne pijem ništa.', 'Što te briga šta pijem.']),

q('Nastavi repliku — "Hoće nekad nešto da se desiiiii?" Šta je odgovor?', 'Idi po pivo, možda ti se usput desi.', ['Idi po pivo, možda ti se usput desi.', 'Čekaj, doći će.', 'Ne znam, brate.', 'Samo strpljenje.']),

q('Nastavi repliku — "Zašto se ovo zove radio kad nikad ne radi?" Šta je odgovor?', 'Pa RADIO, to je prošlo vreme.', ['Pa RADIO, to je prošlo vreme.', 'Pokvaren je, šta da radim.', 'Nemam pojma, brate.', 'Treba ga popraviti.']),

q('Nastavi repliku — Baron: "I šta mislite, šta vozi Batistuta?" Cile: "Ne znam, Ferrari…?" Baron: …', 'Yugo! Crni 65A kabrio.', ['Yugo! Crni 65A kabrio.', 'BMW!', 'Golf! Stari model.', 'Mercedees! Bele boje.']),

q('Nastavi repliku — "Semenke svih zemalja…" kako se završava?', 'Ujedinite se!', ['Ujedinite se!', 'Prodajem se!', 'Podelite se!', 'Skupite se!']),

q('Nastavi repliku — Avaks: "Brate, uvek bacim dalje od tebe!" Šta odgovara Hibrid?', 'Nije poenta u daljini, nego u šaranju.', ['Nije poenta u daljini, nego u šaranju.', 'Ma nije to tačno, brate.', 'Dobro, ali nije to sport.', 'Jesi li normalan?']),

q('Iris pita Bracu: "Je l\' ti to neki sat ili…?" Šta Braca odgovara?', 'Merač za pritisak.', ['Merač za pritisak.', 'Kompas, baba.', 'Buđenik stari.', 'Ne, to je termometar.']),

q('Nastavi repliku — "A da ja vas pitam, šta je sa petsto miliona neprijavljenih Kineza… A?" Šta sledi?', 'Ćutimo.', ['Ćutimo.', 'Ne znamo.', 'Nema ih ovde.', 'Pitajte policiju.']),

// ===== SCENE I DETALJI =====
q('Šta radnik u bioskopu kaže Braci kada ga upozori da film počinje u sedam po novinama?', 'Ti onda gledaj film u novinama.', ['Ti onda gledaj film u novinama.', 'Novine greše, ne ja.', 'Kasno je, ne mogu da ti pomognem.', 'Pravila su pravila, brate.']),

q('Šta Braca kaže Irisu da mu pozli jer mu ona previše prija?', 'Možda mi pozli, imaš merač za pritisak.', ['Možda mi pozli, imaš merač za pritisak.', 'Zovi hitnu pomoć.', 'Daj mi vode, molim te.', 'Treba mi svež vazduh.']),

q('Šta Šomi kaže Duji o svećama i Bogu?', '"Brate, ne pravi Bog razliku među svećama?"', ['"Brate, ne pravi Bog razliku među svećama?"', '"Sve sveće iste gore, brate."', '"Bogu nije stalo do sveća."', '"Svaka sveća ima svoju cenu."']),

q('Šta lik kaže u vezi sa sebe i ribice: "Nemam ribicu al\' zato…"?', '"Imam normalan pritisak."', ['"Imam normalan pritisak."', '"Imam dobre drugare."', '"Imam mir u duši."', '"Nemam briga."']),

q('Šta Saša kaže policajcu kad ga pita šta su tačno radili?', '"Mi smo sedeli ovde i duvanili smo… cigarete."', ['"Mi smo sedeli ovde i duvanili smo… cigarete."', '"Gledali smo u zvezde."', '"Ćaskali smo, ništa posebno."', '"Pili smo kafu."']),

q('Šta lik kaže za Bracu: "Braco, kad bi postojala merna jedinica za jadnost…"?', '"…nosila bi tvoje ime."', ['"…nosila bi tvoje ime."', '"…ti bi bio šampion."', '"…ti bi bio rekorder."', '"…nazivala bi se Braca."']),

q('Ko je rekao: "Braco gde si brate?" i zašto je Nebojša "malo pe*erski"?', 'Jer je to ime — drugari ga zovu Šone', ['Jer je to ime — drugari ga zovu Šone', 'Jer se tužakao.', 'Jer ne pije pivo.', 'Jer sluša stranu muziku.']),
    ],
  },
  {
    id: 'juzni-vetar',
    title: 'Juzni vetar',
    year: 2018,
    country: 'Srbija',
    director: 'Milos Avramovic',
    genre: 'Akcija',
    lead: 'Milos Bikovic',
    quote: 'Brza voznja i kriminal pod pritiskom.',
    poster: 'https://media.themoviedb.org/t/p/w300_and_h450_face/d9qNGhCAmtnJCy73TPGcG3iG1n7.jpg',
    questions: [
      q('Ko je glavni glumac filma "Juzni vetar"?', 'Milos Bikovic', ['Milos Bikovic', 'Sergej Trifunovic', 'Vuk Kostic', 'Miodrag Radonjic']),
      q('Film "Juzni vetar" pripada kom zanru?', 'Akcija', ['Akcija', 'Komedija', 'Dokumentarni', 'Animacija']),
      q('Ko je rezirao film "Juzni vetar"?', 'Milos Avramovic', ['Milos Avramovic', 'Radivoje Andric', 'Dragan Bjelogrlic', 'Predrag Antonijevic']),
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
    quote: '"Читуља за Ескобара" на духовит начин кроз врло комичну ситуацију описује српски криминални миље, подземље чији су чланови махом тешки примитивци, једва школовани људи са оружјем у руци и псовкама на уснама, међусобно повезани злочинима, но нека пријатељства датирају још од школских клупа. Ганди је криминалац, од детињства предодређен за негативца. Он упознаје Лелу, загонетну девојку, у коју се заљубљује. Истог дана када Ганди убија криминалца кога зову Српски Ескобар, два наркофила и нерадника, Деки и Баки, дају читуљу правом Ескобару. Полиција почиње истрагу, ситуација се компликује и обрће у невероватном смеру.',
    poster: 'https://media.themoviedb.org/t/p/w300_and_h450_face/xNfmU24e7Ldbnl6qq1Zj0qKY7Ur.jpg',
    questions: [
      q('Ko je glavni glumac filma "Čitulja za Eskobara"?', 'Vojin Ćetković', ['Vojin Ćetković', 'Sergej Trifunovic', 'Vuk Kostic', 'Miodrag Radonjic']),
      q('Film "Čitulja za Eskobara" pripada kom zanru?', 'Akcija', ['Akcija', 'Komedija', 'Dokumentarni', 'Animacija']),
      q('Ko je rezirao film "Čitulja za Eskobara"?', 'Milorad Milinković', ['Milorad Milinković', 'Radivoje Andric', 'Dragan Bjelogrlic', 'Predrag Antonijevic']),
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
      q('Ko je reziser filma "Shutter Island"?', 'Martin Scorsese', ['Martin Scorsese', 'Christopher Nolan', 'David Fincher', 'Denis Villeneuve']),
      q('Ko tumaci glavnu ulogu u filmu "Shutter Island"?', 'Leonardo DiCaprio', ['Leonardo DiCaprio', 'Matt Damon', 'Christian Bale', 'Tom Hardy']),
      q('Koji zanr najbolje opisuje film "Shutter Island"?', 'Triler', ['Triler', 'Komedija', 'Animacija', 'Romansa']),
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
      q('Ko je rezirao film "Inception"?', 'Christopher Nolan', ['Christopher Nolan', 'Martin Scorsese', 'James Cameron', 'Ridley Scott']),
      q('Film "Inception" je objavljen koje godine?', '2010', ['2010', '2008', '2012', '2014']),
      q('Koji glumac nosi glavnu ulogu u filmu "Inception"?', 'Leonardo DiCaprio', ['Leonardo DiCaprio', 'Matthew McConaughey', 'Cillian Murphy', 'Tom Cruise']),
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
      q('Ko tumaci glavnu ulogu u filmu "Interstellar"?', 'Matthew McConaughey', ['Matthew McConaughey', 'Leonardo DiCaprio', 'Christian Bale', 'Brad Pitt']),
      q('Ko je rezirao film "Interstellar"?', 'Christopher Nolan', ['Christopher Nolan', 'Steven Spielberg', 'Denis Villeneuve', 'James Cameron']),
      q('Koji zanr najbolje opisuje film "Interstellar"?', 'Sci-fi', ['Sci-fi', 'Horor', 'Komedija', 'Vestern']),
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
      q('Ko glumi Betmena u filmu "The Dark Knight"?', 'Christian Bale', ['Christian Bale', 'Ben Affleck', 'Robert Pattinson', 'Michael Keaton']),
      q('Ko je rezirao film "The Dark Knight"?', 'Christopher Nolan', ['Christopher Nolan', 'Tim Burton', 'Zack Snyder', 'Matt Reeves']),
      q('Film "The Dark Knight" pripada kom zanru?', 'Akcija', ['Akcija', 'Dokumentarni', 'Romansa', 'Muzicki']),
    ],
  },
];
