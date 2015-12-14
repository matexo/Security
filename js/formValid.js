function validateEmail(email)
{
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}
function noNumbers(e)
{
  var keynum;
  var keychar;
  var numcheck;

  if(window.event) // IE
  {
    keynum = e.keyCode;
  }
  else if(e.which) // Netscape/Firefox/Opera
  {
    keynum = e.which;
  }
  keychar = String.fromCharCode(keynum);
  numcheck = /\d/;
  return !numcheck.test(keychar);
}
function onlyLetters(login)
{
  var letterCheck =/^[a-zA-Z]*$/;
  return letterCheck.test(login);
}
function validate(form)
{
  var login = form.login.value;
  var password = form.password.value;
  var reppassword = form.reppassword.value;
  var email = form.email.value;
  var okValid = true;
  var infoValid = "Bledny formularz :\n";

  if (onlyLetters(login) == false)
  {
    okValid = false;
    infoValid += "\n -bledne znaki w loginie -- uzywaj tylko liter";
  }
  if (passPower(password) < 3)
  {
    okValid = false;
    infoValid += "\n -entropia hasla mniejsza niz 3 -- zmien haslo na mocniejsze";
  }
  if (login == "")
  {
    okValid = false;
    infoValid += "\n -brak loginu";
  }
  else if (login.length < 3)
  {
    okValid = false;
    infoValid += "\n -za krotki login";
  }
  if (password == "")
  {
    okValid = false;
    infoValid += "\n -brak hasla";
  }
  else if (password.length < 6)
  {
    okValid = false;
    infoValid += "\n -za krotkie haslo";
  }
  if (reppassword == "")
  {
    okValid = false;
    infoValid += "\n -brak powtorzonego hasla";
  }
  if (email == "")
  {
    okValid = false;
    infoValid += "\n -brak email";
  }
  else if (validateEmail(email) == false)
  {
    okValid = false;
    infoValid += "\n -zly format email";
  }
  if (password != reppassword)
  {
    okValid = false;
    infoValid += "\n -hasla sie nie zgadzaja";
  }


  if (!okValid)
  {
    alert (infoValid);
    return false;
  }
  return okValid;
}

function validateNewPass(form)
{
  var password = form.password.value;
  var reppassword = form.reppassword.value;
  var okValid = true;
  var infoValid = "Bledny formularz :\n";

  if (password == "")
  {
    okValid = false;
    infoValid += "\n -brak hasla";
  }
  else if (password.length < 6)
  {
    okValid = false;
    infoValid += "\n -za krotkie haslo";
  }
  if (reppassword == "")
  {
    okValid = false;
    infoValid += "\n -brak powtorzonego hasla";
  }
  if (password != reppassword)
  {
    okValid = false;
    infoValid += "\n -hasla sie nie zgadzaja";
  }
  if (!okValid)
  {
    alert (infoValid);
    return false;
  }
  return okValid;
}
function validateNewPasswd(form)
{
  var oldPasswd = form.old_pass.value;
  var password = form.new_pass.value;
  var reppassword = form.new_pass_re.value;
  var okValid = true;
  var infoValid = "Bledny formularz :\n";

  if (oldPasswd == "")
  {
    okValid = false;
    infoValid += "\n -brak starego hasla";
  }
  if (password == "")
  {
    okValid = false;
    infoValid += "\n -brak nowego hasla";
  }
  else if (password.length < 6)
  {
    okValid = false;
    infoValid += "\n -za krotkie haslo";
  }
  if (reppassword == "")
  {
    okValid = false;
    infoValid += "\n -brak powtorzonego hasla";
  }
  if (password != reppassword)
  {
    okValid = false;
    infoValid += "\n -hasla sie nie zgadzaja";
  }
  if (!okValid)
  {
    alert (infoValid);
    return false;
  }
  return okValid;
}

function samePasswd(value)
{
  var text = "hasla nie sa takie same";
  var password = form.new_pass.value;
  if (value != password)
    document.getElementById("errorPasswd").innerHTML = text;
  return text;

}
function passPower(password) {
    var lvl = new Array();

    lvl[0] = "Bardzo słabe ";
    lvl[1] = "Słabe";
    lvl[2] = "Średnie";
    lvl[3] = "Mocne";
    lvl[4] = "Bardzo mocne";
    lvl[5] = "Bardzo mocne";

    var score = 0;
    if(password.length > 6) score++;
    if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;
    if (password.match(/d+/)) score++;
    if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) score++;
    if ( entrophy(password) > 3) score++;
    document.getElementById("power").innerHTML = lvl[score];
    document.getElementById("passwordStrength").className = "strength" + score;

    return score;
}

function process(s, evaluator) {
    var h = Object.create(null), k;
    s.split('').forEach(function(c) {
        h[c] && h[c]++ || (h[c] = 1); });
    if (evaluator) for (k in h) evaluator(k, h[k]);
    return h;
}

function entrophy(s) {
    var sum = 0,len = s.length;
    process(s, function(k, f) {
        var p = f/len;
        sum -= p * Math.log(p) / Math.log(2);
    });
    return sum;
}
