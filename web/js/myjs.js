function modifybar() {
    document.getElementById("inname").style.display = "";
    document.getElementById("inmsg").style.display = "";
    document.getElementById("outlg").style.display = "none";
    document.getElementById("outrg").style.display = "none";


    // var data = eval('(' + document.cookie + ')');
    // if (data.status == 'y') {
    //     document.getElementById("outlg").style.display = "none";
    //     document.getElementById("outrg").style.display = "none";
    //     document.getElementById("inname").innerText = data.name;
    //     document.getElementById("inname").style.display = "";
    // } else {
    //     document.getElementById("inname").style.display = "none";
    //     document.getElementById("outlg").style.display = "";
    //     document.getElementById("outrg").style.display = "";
    // }
    // return;
}

function register() {
    $.ajax({
        type: 'POST',
        url: 'controllor/register',
        data: {
            uname: "daxin",
            sno: "00000001",
            spassword: "00000001",
            upassword: "00000001",
            usexy: '1',
            uphone: "12312341234",
            uemail: "daxin@buaa.edu.cn"
        },
        success: function (data) {
            alert(data);
            var res = eval('(' + data + ')');
        }
    });
    return;
}

function fillinfo() {
    if (document.cookie == '') {
        return;
    }
    document.getElementById('avator').src = document.cookie;
    // var data = eval('(' + document.cookie + ')');
    // document.getElementById('uiname').innerText = data.uname;
    // document.getElementById('uisno').innerText = data.sno;
    // document.getElementById('uisex').innerText = data.usexy;
    // document.getElementById('uicredit').innerText = data.ucredit;
    // document.getElementById('uiphone').innerText = data.uphone;
    // document.getElementById('uiemail').innerText = data.uemail;
    return;
}

function login() {
    $.ajax({
        type: 'POST',
        url: 'controllor/login',
        data: {
            uname: document.getElementById('lusername').value,
            upassword: document.getElementById('luserpw').value
        },
        success: function (data) {
            alert(data);
            var res = eval('(' + data + ')');
            if (res.status != 'y') {
                alert('登录失败！');
            } else {
                alert('登录成功！');
                document.cookie = data;
                modifybar();
                location.reload();
            }
        }
    });
    return;
}

function changepw() {
    var data = eval('(' + document.cookie + ')');
    var uiom = document.getElementById('uiopw').value;
    var uinm = document.getElementById('uinpw').value;
    var uicnm = document.getElementById('uicnpw').value;
    if (data.password != uiom) {
        alert("旧密码错误！");
        return;
    }
    if (uinm != uicnm) {
        alert("新密码输入不一致");
        return;
    }
    $.ajax({
        type: 'POST',
        url: 'controllor/edit_a_inf',
        data: {
            username: data.name,
            phone: data.phone,
            email: data.email
        },
        success: function (data) {
            alert(data);
        }
    });
    return;
}

function search() {
    alert('没写完');
    var sd = { id: document.getElementById('searchbar').value };
    $.ajax({
        type: 'POST',
        url: 'test',
        data: sd,
        success: function (data) {

        }
    });
    return;
}

function fillMarket() {
    var k = [];
    var itemTitle = 'WOW';
    var itemDescription = "32";
    var itemLabel = 'taga';
    var imgUrl = 'img/item/images.jpg';
    var itemOwner = 'javascript:void(0)';
    $.ajax({
        type: 'POST',
        url: 'controllor/show_g_list',
        success: function (data) {
            // alert(data);
            // var obj = eval('(' + data + ')');
            // for (var key in obj) {
            //     alert(key + ' ' + obj[key]);
            // }
        }
    });
    k.push(buildItem(itemTitle, itemDescription, itemLabel, imgUrl, itemOwner));
    k.push(buildItem(itemTitle, itemDescription, itemLabel, imgUrl, itemOwner));
    Grid.addItems(k);
    return;
}

function buildItem(title, description, label, imgUrl, owner) {
    var kuang = document.getElementById('og-grid');
    var li = document.createElement('li');
    var a = document.createElement('a');
    var img = document.createElement('img');
    var div = document.createElement('div');
    var h3 = document.createElement('h3');
    var span = document.createElement('span');
    li.className = 'mix ' + label;
    li.setAttribute('style', 'display: inline-block;');
    li.appendChild(a);
    a.setAttribute('href', owner);
    a.setAttribute('data-largesrc', imgUrl);
    a.setAttribute('data-title', title);
    a.setAttribute('data-description', description);
    a.innerHTML = "<img src='" + imgUrl + "' width='100%'><div class ='hover-mask'><h3>" + title + "</h3><span><i class='fa fa-apple fa- 2x'></i></span></div>";
    kuang.appendChild(li);
    return li;
}

function uploadItem() {
    var ui = document.getElementById('itemlist');
    var li = document.createElement('li');
    li.innerText = document.getElementById('upitemdes').value;
    ui.appendChild(li);
    return;
}

function uploadavator() {
    var pa = document.getElementById('upavator').value;
    pa = pa.split('\\');
    pa = pa[pa.length - 1];
    document.cookie = 'img/' + pa;
    document.getElementById('avator').src = 'img/' + pa; 
    return;
}