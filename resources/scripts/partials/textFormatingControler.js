
function cyrillicFormat(text) {
  const cyrillicToLatinMap = {
    'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',
    'ђ': 'đ', 'е': 'e', 'ж': 'ž', 'з': 'z', 'и': 'i',
    'ј': 'j', 'к': 'k', 'л': 'l', 'љ': 'lj', 'м': 'm',
    'н': 'n', 'њ': 'nj', 'о': 'o', 'п': 'p', 'р': 'r',
    'с': 's', 'т': 't', 'ћ': 'ć', 'у': 'u', 'ф': 'f',
    'х': 'h', 'ц': 'c', 'ч': 'č', 'џ': 'dž','ш': 'š',
    // Uppercase letters
    'А': 'A',  'Б': 'B',  'В': 'V',  'Г': 'G',
     'Д': 'D',  'Ђ': 'Đ',  'Е': 'E',  'Ж': 'Ž',
     'З': 'Z',  'И': 'I',  'Ј': 'J',  'К': 'K',
     'Л': 'L',  'Љ':'LJ','М':'M','Н':'N','Њ':'NJ',
     'О':'O','П':'P','Р':'R','С':'S','Т':'T',
     'Ћ':'Ć','У':'U','Ф':'F','Х':'H','Ц':'C',
     'Ч':'Č','Џ':'Dž', 'Ш':'Š'
  }


  return text.split('').map(char => cyrillicToLatinMap[char] || char).join('');
}

function removeDiacritics(text) {
  // Define a regular expression pattern for letters with diacritics
  const diacriticPattern = /[čćžšđ]/g;

  // Replace diacritic letters with their non-diacritic counterparts
  return text.replace(diacriticPattern, (match) => {
    switch (match) {
      case 'č': return 'c';
      case 'ć': return 'c';
      case 'ž': return 'z';
      case 'š': return 's';
      case 'đ': return 'd';
      default: return match; // Fallback in case of unexpected characters
    }
  });
}

export { removeDiacritics, cyrillicFormat };