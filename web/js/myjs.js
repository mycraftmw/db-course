function modifybar() {
    if (document.cookie == "yes") {
        document.getElementById("outlg").style.display = "none";
        document.getElementById("outrg").style.display = "none";
    } else {
        document.getElementById("inrg").style.display = "none";
        document.getElementById("inlg").style.display = "none";
    }
}

function login() {
    var div1 = document.getElementById("div1");
    var div2 = document.getElementById("div2");
    if (div1.style.display == 'block') div1.style.display = 'none';
    else div1.style.display = 'block';
    if (div2.style.display == 'block') div2.style.display = 'none';
    else div2.style.display = 'block';
}

function showAndHidden2() {
    var div3 = document.getElementById("div3");
    var div4 = document.getElementById("div4");
    if (div3.style.visibility == 'visible') div3.style.visibility = 'hidden';
    else div3.style.visibility = 'visible';
    if (div4.style.visibility == 'visible') div4.style.visibility = 'hidden';
    else div4.style.visibility = 'visible';
}  
