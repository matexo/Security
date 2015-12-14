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