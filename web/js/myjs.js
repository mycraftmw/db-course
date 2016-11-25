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
    var udata = eval('(' + document.cookie + ')');
    document.getElementById('uiname').innerText = udata.uname;
    document.getElementById('uisno').innerText = udata.sno;
    document.getElementById('uisex').innerText = udata.usexy;
    document.getElementById('uicredit').innerText = udata.ucredit;
    document.getElementById('uiphone').innerText = udata.uphone;
    document.getElementById('uiemail').innerText = udata.uemail;
    document.getElementById('uiper').innerText = udata.uroot;
    document.getElementById('avator').src = udata.uaddress;

    if (udata.uroot == '管理员') {
        document.getElementById('bltit').innerText = '待审核物品';
        document.getElementById('blbtn').style.display = 'none';
        $.ajax({
            type: 'POST',
            url: 'controllor/show_g_check_list',
            data: {},
            success: function (rdata) {
                alert(rdata);
                var rval = eval('(' + rdata + ')');
                var ui = document.getElementById('itemlist');
                if (rval.status == 'y') {
                    for (var key in rval) {
                        if (key != 'status' && rval.hasOwnProperty(key)) {
                            var element = rval[key];
                            var li = document.createElement('li');
                            var img = document.createElement('img');
                            var p = document.createElement('p');
                            var lb = document.createElement('label');
                            var btn = document.createElement('button');
                            var btn2 = document.createElement('button');
                            var br = document.createElement('br');
                            img.src = element.gaddress;
                            lb.innerText = element.gstate;
                            p.innerText = element.gname;
                            btn.setAttribute('class', 'btn btn-success');
                            btn.setAttribute('onclick', 'check(' + element.gno + ',true);');
                            btn.innerText = '通过';
                            btn2.setAttribute('class', 'btn btn-danger');
                            btn2.setAttribute('onclick', 'check(' + element.gno + ',false);');
                            btn2.innerText = '不通过';
                            li.appendChild(img);
                            li.appendChild(p);
                            li.appendChild(lb);
                            li.appendChild(br);
                            li.appendChild(btn);
                            li.appendChild(btn2);
                            ui.appendChild(li);
                        }
                    }
                }
            }
        });

        return;
    }
    $.ajax({
        type: 'POST',
        url: 'controllor/show_g_u_list',
        data: {
            uname: udata.uname
        },
        success: function (rdata) {
            alert(rdata);
            var rval = eval('(' + rdata + ')');
            var ui = document.getElementById('itemlist');
            if (rval.status == 'y') {
                for (var key in rval) {
                    if (key != 'status' && rval.hasOwnProperty(key)) {
                        var element = rval[key];
                        var li = document.createElement('li');
                        var img = document.createElement('img');
                        var p = document.createElement('p');
                        var lb = document.createElement('label');
                        var btn = document.createElement('button');
                        var br = document.createElement('br');
                        img.src = element.gaddress;
                        lb.innerText = element.gstate;
                        p.innerText = element.gname;
                        btn.setAttribute('class', 'btn btn-danger');
                        btn.setAttribute('onclick', 'udelitem(' + element.gno + ');');
                        btn.innerText = '删除';
                        li.appendChild(img);
                        li.appendChild(p);
                        li.appendChild(lb);
                        li.appendChild(br);
                        li.appendChild(btn);
                        ui.appendChild(li);
                    }
                }
            }
        }
    });
    return;
}

function check(no, ckbool) {
    $.ajax({
        type: 'POST',
        url: 'controllor/check_g',
        data: {
            gno: no,
            gcheck: ckbool == true ? '审核通过' : '审核失败'
        },
        success: function (rdata) {
            alert(rdata);
            var rval = eval('(' + rdata + ')');
            if (rval.status == 'y') {
                alert('操作成功');
            } else {
                alert('操作失败');
            }
            location.reload();
        }
    });
}

function udelitem(no) {
    $.ajax({
        type: 'POST',
        url: 'controllor/delete_g',
        data: {
            gno: no
        },
        success: function (rdata) {
            alert(rdata);
            var rval = eval('(' + rdata + ')');
            if (rval.status = 'y') {
                alert('操作成功');
            } else {
                alert('操作失败');
            }
            location.reload();
        }
    });
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
            alert(data);
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
    alert(document.getElementById('searchbar').value);
    $.ajax({
        type: 'POST',
        url: 'controllor/show_g_search',
        data: {
            words: document.getElementById('searchbar').value
        },
        success: function (rdata) {
            alert(rdata)
            var rval = eval('(' + rdata + ')');

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
    var udata = eval('(' + document.cookie + ')');
    alert(1);
    $.ajax({
        type: 'POST',
        url: 'controllor/add_g',
        data: {
            gname: document.getElementById('upitemtit').value,
            uname: udata.uname,
            gtype: document.getElementById('select_type').value,
            ginstruction: document.getElementById('upitemdes').value,
            gparameter: '',
            gtime: 0,
            gprice: 0
        },
        success: function (rdata) {
            alert(rdata);
            var rval = eval('(' + rdata + ')');
            if (rval.status == 'y') {
                alert("上传成功");
            } else {
                alert("上传失败");
            }
            location.reload();
        }
    });
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