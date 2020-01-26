function escape(s) {
  return ('' + s)
      .replace(/\\/g, '\\\\')
      .replace(/&/g, '\\x26')
      .replace(/'/g, '\\x27')
      .replace(/"/g, '\\x22')
      .replace(/</g, '\\x3C')
      .replace(/>/g, '\\x3E');
   }

function unescape(s) {
  // if(DEBUG_ON) alert("BEFORE: " + s);
   s = ('' + s)
      .replace(/x3E/g, '>')
      .replace(/x3C/g, '<')
      .replace(/x22/g, '"')
      .replace(/x27/g, "'")
      .replace(/x26/g, '&');
    // if(DEBUG_ON) alert(s.search("\\x26"));
    // if(DEBUG_ON) alert("AFTER: " + s);
    return s.replace(/\\\\/g, '\\');
}
