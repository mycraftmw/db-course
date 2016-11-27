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
    $.ajax({
        url: 'controllor/show_u_inf',
        type: 'POST',
        data: {
            uname: udata.uname
        },
        success: function (rdata) {
            document.cookie = rdata;
        }
    });
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
                            img.width = 300;
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
                        // var btn2 = document.createElement('button');
                        img.src = element.gaddress;
                        img.width = 300;
                        lb.innerText = element.gstate;
                        p.innerText = element.gname;
                        btn.setAttribute('class', 'btn btn-danger');
                        btn.setAttribute('onclick', 'udelitem(' + element.gno + ');');
                        btn.innerText = '删除';
                        // btn2.setAttribute('class', 'btn btn-success');
                        // btn2.setAttribute('onclick', 'openmd(' + element.gno + ')');
                        // btn2.innerText = '交易完成';
                        li.appendChild(img);
                        li.appendChild(p);
                        li.appendChild(lb);
                        li.appendChild(document.createElement('br'));
                        li.appendChild(btn);
                        // li.appendChild(document.createElement('br'));
                        // li.appendChild(btn2);
                        li.appendChild(document.createElement('hr'));
                        ui.appendChild(li);
                    }
                }
            }
        }
    });
    return;
}

function openmd(no) {
    document.getElementById('overbtn').setAttribute('onclick', 'uoveritem(' + no + ');');
    $("#jiaoyi").modal();
}

function uoveritem(no) {
    $.ajax({
        url: 'controllor/update_cha',
        type: 'POST',
        data: {
            gno: no,
            state: document.getElementById('select_jiaoyi').value,
            credit: document.getElementById('upcredit').value
        },
        success: function (rdata) {
            alert(rdata);
            var rval = eval('(' + rdata + ')');
            if (rval.status == 'y') {
                alert("操作成功");
            } else {
                alert("操作失败");
            }
            location.reload();
        }
    });
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
    if (document.getElementById('searchbar').value == "") {
        location.reload();
        return false;
    }
    $.ajax({
        type: 'POST',
        url: 'controllor/show_g_search',
        data: {
            words: document.getElementById('searchbar').value
        },
        success: function (rdata) {
            alert(rdata)
            var rval = eval('(' + rdata + ')');
            $("#og-grid").empty();
            if (rval.status == 'n2') {
                alert("没有相关物品");
                return false;
            }
            var k = [];
            for (var key in rval) {
                if (key != 'status' && rval.hasOwnProperty(key)) {
                    var element = rval[key];
                    k.push(buildItem(element.gname, element.ginstruction, element.gtype, element.gaddress, element.uname, element.gno));
                }
            }
            try {
                Grid.addItems(k);
            } catch (error) {
            }

        }
    });
    return;
}

function fillMarket() {
    $.ajax({
        type: 'POST',
        url: 'controllor/show_g_list',
        success: function (data) {
            var rval = eval('(' + data + ')');
            var k = [];
            for (var key in rval) {
                if (key != 'status' && rval.hasOwnProperty(key)) {
                    var element = rval[key];
                    k.push(buildItem(element.gname, element.ginstruction, element.gtype, element.gaddress, element.uname, element.gno));
                }
            }
            try {
                Grid.addItems(k);
            } catch (error) {
            }
        }
    });

    return;
}

function buildItem(title, description, label, imgUrl, owner, gno) {
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
    document.getElementById('sendbtn').setAttribute('onclick', "sendmsg(\'" + owner + "\',\'" + gno + "\');");
    a.setAttribute('href', 'javascript:$("#msgmsg").modal();');
    a.setAttribute('data-largesrc', imgUrl);
    a.setAttribute('data-title', title);
    a.setAttribute('data-description', description);
    a.innerHTML = "<img src='" + imgUrl + "' width='100%'><div class ='hover-mask'><h3>" + title + "</h3><span><i class='fa fa-plus fa- 2x'></i></span></div>";
    // kuang.appendChild(li);
    $("#og-grid").prepend(li);
    return li;
}

function sendmsg(endname, gno) {
    if (document.cookie == '') {
        alert('未登陆无法发送消息');
        return false;
    }
    var udata = eval('(' + document.cookie + ')');
    // if ($('#applycha').is(':checked')) {
    //     $.ajax({
    //         url: 'controllor/apply_cha',
    //         type: 'POST',
    //         data: {
    //             gnoplan: gno,
    //             gnoadopt: gno,
    //             chamoney: 0
    //         },
    //         success: function (rdata) {
    //             alert(rdata);
    //         }
    //     });
    // }
    if (document.getElementById('msgs').value == '')
        return false;
    $.ajax({
        url: 'controllor/notify',
        type: 'POST',
        data: {
            unamesend: udata.uname,
            unamereceive: endname,
            mcontent: document.getElementById('msgs').value
        },
        success: function (rdata) {
            alert(rdata);
            var rval = eval('(' + rdata + ')');
            if (rval.status == 'y') {
                alert('发送成功');
            } else {
                alert('发送失败');
            }
            location.reload();
        }
    });
}

function uploadItem() {
    var udata = eval('(' + document.cookie + ')');
    var formData = new FormData();
    formData.append('image', $('#upitemimg')[0].files[0]);
    formData.append('uname', udata.uname);
    formData.append('gname', document.getElementById('upitemtit').value);
    formData.append('gtype', document.getElementById('select_type').value);
    formData.append('ginstruction', document.getElementById('upitemdes').value);
    formData.append('gparameter', '');
    formData.append('gtime', 0);
    formData.append('gprice', 0);

    $.ajax({
        url: 'controllor/add_g',
        type: 'POST',
        cache: false,
        data: formData,
        processData: false,
        contentType: false,
    }).done(function (res) {
        alert(res);
        var rval = eval('(' + res + ')');
        if (rval.status == 'y') {
            alert("上传成功");
        } else {
            alert("上传失败");
        }
        location.reload();
    }).fail(function (res) { });
    return;
}

function uploadavator() {
    var udata = eval('(' + document.cookie + ')');
    var formData = new FormData();
    formData.append('image', $('#upavator')[0].files[0]);
    formData.append('uname', udata.uname);
    $.ajax({
        url: 'controllor/edit_u_img',
        type: 'POST',
        cache: false,
        data: formData,
        processData: false,
        contentType: false,
    }).done(function (res) {
        try {
            var rval = eval('(' + res + ')');
        } catch (error) {
            alert('未选择文件');
            return false;
        }
        udata.uaddress = rval.imgUrl;
        document.cookie = JSON.stringify(udata);
        location.reload();
    }).fail(function (res) { });
}

function fillmsg() {
    if (document.cookie == '') {
        alert('未登陆无法接受消息');
        return false;
    }
    var udata = eval('(' + document.cookie + ')');
    $.ajax({
        url: 'controllor/show_notification',
        type: 'POST',
        data: {
            uname: udata.uname
        },
        success: function (rdata) {
            alert(rdata);
            var rval = eval('(' + rdata + ')');
            if (rval.status == 'y') {
                for (var key in rval) {
                    if (key != 'status' && rval.hasOwnProperty(key)) {
                        var element = rval[key];
                        buildmsg(element.unamesend, element.mtimestamp, element.mcontent);
                    }
                }
            }
        }
    })
}

function buildmsg(name, time, content) {
    var li = document.createElement('li');
    var p1 = document.createElement('p');
    var p2 = document.createElement('p');
    p1.innerText = name + " 于 " + time + " 发来消息：";
    p2.innerText = content;
    li.appendChild(p1);
    li.appendChild(p2);
    li.appendChild(document.createElement('hr'));
    document.getElementById('msglist').appendChild(li);
}