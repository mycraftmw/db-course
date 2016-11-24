function modifybar() {
    if (document.cookie == '') {
        document.getElementById("inname").style.display = "none";
        document.getElementById('inmsg').style.display = 'none';
        document.getElementById("outlg").style.display = "";
        document.getElementById("outrg").style.display = "";
        if (window.location.href == 'http://localhost/db/user' ||
            window.location.href == 'http://localhost/db/message') {
            alert('您还没登录呢！');
            location.replace('index');
        }
    } else {
        var data = eval('(' + document.cookie + ')');
        if (data.status == 'y') {
            document.getElementById("outlg").style.display = "none";
            document.getElementById("outrg").style.display = "none";
            document.getElementById("inname").innerText = data.uname;
            document.getElementById("inname").style.display = "";
            document.getElementById('inmsg').style.display = '';
        } else {
            alert(1);
            document.getElementById("inname").style.display = "none";
            document.getElementById('inmsg').style.display = 'none';
            document.getElementById("outlg").style.display = "";
            document.getElementById("outrg").style.display = "";
        }
    }
}

function register() {
    $.ajax({
        type: 'POST',
        url: 'controllor/register',
        data: {
            uname: document.getElementById('username').value,
            sno: document.getElementById('sno').value,
            spassword: document.getElementById('password').value,
            upassword: document.getElementById('password').value,
            usexy: document.getElementById('select_sex').value,
            uphone: document.getElementById('uphone').value,
            uemail: document.getElementById('uemail').value
        },
        success: function (data) {
            var res = eval('(' + data + ')');
            if (res.status == 'y') {
                alert("注册成功！");
                location.replace('index');
                return;
            } else {
                alert("注册失败！");
                return;
            }
        }
    });
}

function fillinfo() {
    if (document.cookie == '') {
        return;
    }
    var data = eval('(' + document.cookie + ')');
    document.getElementById('uiname').innerText = data.uname;
    document.getElementById('uisno').innerText = data.sno;
    document.getElementById('uisex').innerText = data.usexy;
    document.getElementById('uicredit').innerText = data.ucredit;
    document.getElementById('uiphone').innerText = data.uphone;
    document.getElementById('uiemail').innerText = data.uemail;
    document.getElementById('avator').src = data.uaddress;
    return;
}

function login() {
    document.cookie = '';
    $.ajax({
        type: 'POST',
        url: 'controllor/login',
        data: {
            uname: document.getElementById('lusername').value,
            upassword: document.getElementById('luserpw').value
        },
        success: function (data) {
            var res = eval('(' + data + ')');
            if (res.status != 'y') {
                alert('登录失败！');
                return;
            } else {
                alert('登录成功！');
                document.cookie = data;
                modifybar();
                location.replace('index');
                return;
            }
        }
    });
}

function logout() {
    var r = confirm("确定要退出么？");
    if (r == true) {
        document.cookie = '';
        location.replace('index');
        alert("注销成功");
    }
}

function changepw() {
    var olddata = eval('(' + document.cookie + ')');
    var uiom = document.getElementById('uiopw').value;
    var uinm = document.getElementById('uinpw').value;
    var uicnm = document.getElementById('uicnpw').value;
    if (olddata.upassword != uiom) {
        alert("旧密码错误！");
        return;
    }
    if (uinm != uicnm) {
        alert("新密码输入不一致");
        return;
    }
    $.ajax({
        type: 'POST',
        url: 'controllor/edit_u_inf',
        data: {
            uname: olddata.uname,
            uphone: olddata.uphone,
            uemail: olddata.uemail,
            upassword: uicnm
        },
        success: function (reval) {
            var res = eval('(' + reval + ')');
            if (res.status == 'y') {
                alert('修改成功');
                olddata.upassword = uicnm;
                document.cookie = JSON.stringify(olddata);
                location.reload();
                return;
            } else {
                alert('修改失败');
                return;
            }
        }
    });
}

function search() {
    alert('没写完');
    var sd = { id: document.getElementById('searchbar').value };
    $.ajax({
        type: 'POST',
        url: 'test',
        data: sd,
        success: function (data) {
            var res = eval('(' + reval + ')');
        }
    });
    return;
}

function fillMarket() {
    
    $.ajax({
        type: 'POST',
        url: 'controllor/show_g_list',
        success: function (data) {
            alert(data);
            var res = eval('(' + data + ')');
            var k = [];
            for (var key in res) {
                if (key != 'status' && res.hasOwnProperty(key)) {
                    var element = res[key];
                    var itemTitle = element.gname;
                    var itemDescription = "23";
                    var itemLabel = element.gtype;
                    var imgUrl = element.gaddress;
                    
                    k.push(buildItem(itemTitle, itemDescription, itemLabel, imgUrl));
                }
            }
            Grid.addItems(k);
        }
    });
    
    return;
}

function buildItem(title, description, label, imgUrl) {
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
    a.setAttribute('href', "javascipt:;");
    a.setAttribute('data-largesrc', imgUrl);
    a.setAttribute('data-title', title);
    a.setAttribute('data-description', description);
    a.innerHTML = "<img src='" + imgUrl + "' width='100%'><div class ='hover-mask'><h3>" + title + "</h3><span><i class='fa fa-plus fa- 2x'></i></span></div>";
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