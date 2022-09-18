
function SendAjaxData(myObj){


// let data = JSON.stringify(MAN)
// let data = JSON.stringify(document.getElementById("bplace_live_search").value);
// let data = document.getElementById("favorite_team").value;
let data = document.getElementById("bplace_live_search").value;
// let data    = {

//     "req"   : document.getElementById("favorite_team").value
// };

console.log("To server:\n", data);
 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById("txtHint").innerHTML = this.responseText;
                // console.log(JSON.parse(this.responseText));
                console.log(this.responseText);
                document.getElementById("team_list").innerHTML = this.responseText;
                document.getElementById("bplace_live_search_result").innerHTML = this.responseText;



                response   = JSON.parse(this.responseText);
                // document.getElementById("team_list").innerHTML = this.responseText;
                // document.getElementById("team_list").innerHTML = this.responseText;
                document.getElementById("bplace_live_search_result").innerHTML = response["lines"];
                bplace = response["bplace"];
                console.log("bplace: ", bplace);


            }
        };
        // xmlhttp.open("POST", "./ajax/kb_ajax.php", true);
        // xmlhttp.send(data);

        // xmlhttp.open("POST", "./ajax/Live_search/", true);
        xmlhttp.open("POST", "../ajax/Live_search/?req="+data,true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xmlhttp.send(JSON.stringify(data));
        // xmlhttp.send(data);
        xmlhttp.send();

}

function Live_Search(myObj){
    console.log(myObj.length," =>  ", myObj);
    if (myObj.length<3) {
        document.getElementById("bplace_live_search_result").innerHTML  = "";
    }

    if (myObj.length>=3) {
        console.log("OK");
        SendAjaxData(myObj)
    }
}

function MyLiveSearch(myObj){
    console.log(myObj.length," =>  ", myObj);

    if (myObj.length<3) {
        document.getElementById("bplace_live_search_result").innerHTML  = "";
    }

    if (myObj.length>=3) {
        console.log("OK");
        SendAjaxData(myObj)
    }
}


function Add_bplace(type, place){

/*
    1 проверить отсутствие вводного значения в массива типа
    2 1 истина то добавляем, если есть уже элмент просто выход из функции с алертом(место уже выбрано)
*/

    console.log("function Add_bplace("+type+", "+place+")");

    // MAN["bplace"][type][MAN["bplace"][type].length]    = place;
    MAN["bplace"][type].push(parseInt(place));
    console.log(MAN["bplace"]);
    document.getElementById("bplace_live_search").value   = bplace[place]["name"];


}

function toAjaxServer(url, method, data){

console.log("To server:\n", data);
 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {

                console.log(this.responseText);
                console.log("stop function.");

                // delay(100);
                return(this.responseText);

            }
        };


        xmlhttp.open(method, url,true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xmlhttp.send(JSON.stringify(data));
        xmlhttp.send(data);
        xmlhttp.send();

}

function Create_bplace(value){

    /*
        распознать тип по названию
            если есть уезд то тип 3.
            если есть слово волость - 2.
            все остальное - тип 1.
        Добавить ajax запросом в бд системы
            domen/ajax/create_bplace/?type=1/2/3&value=Само значение нового места.
    */

    console.log("Func. " +arguments.callee.name + " start: ");

    // Какое значение места нужно создать
    // value       = document.getElementById("t").value;

    // Вычисление позици, что они точно есть !=-1
    t2          = (value.indexOf("волость")!=-1);
    t3          = (value.indexOf("уезд")!=-1);

    // значение по умолчанию т.к. их намного больше и чаще встречаются с.д.г.   и т.д.
    type_value  = 1;

    if (t2) type_value  = 2;
    if (t3) type_value  = 3;

    url     = "../ajax/create_bplace/";
    method  = "POST";
    data    = "type="+type_value+"&name="+value;

   if (response    = toAjaxServer(url, method, data)) alert(JSON.parseInt(response)["status"]);
   // console.log(JSON.parseInt(response)["status"]);

    return(0);

   console.log("QWERTY");
}


function Del_bplace(type, value){

    console.log("Func. " +arguments.callee.name + " start: ");
    console.log(type, value);

    console.log("function Del_bplace(type, value) start: ");
    let elem_id = "new_bplace_" + type + "_" + value;
    console.log(MAN["bplace"]);
    // console.log(MAN["bplace"][type].indexOf(value));

    // Вычисление индекса с предварительным реобразованием вх параметра- ид-ра места.
    // let index_elem  = MAN["bplace"][type].indexOf(String(value));
    let index_elem  = MAN["bplace"][type].indexOf(value);

    // Удаление одного элемента с позиции индекса найденного элемента
    MAN["bplace"][type].splice(index_elem, 1);

    console.log(MAN["bplace"]);
    Show_bplace(type);
    console.log("function Del_bplace(type, value) stop.");
}


function InitFields(){

    let fields  = [
        "fname",
        "iname",
        "sname",
        "byear",
        "place",
        "photo",
        "prim",
    ];

    let value = "";

    for(let f in fields){

        let field   = fields[f];

        for(let i in MAN[field]){
            
        }
    }
}

function Show_bplace(type){

    console.log("Func. " +arguments.callee.name + " start: ");
    console.log(" ф. ПРОРИСОВКА МЕСТ РОЖДЕНИЙ по их типу:");

    let elem_box    = document.getElementById("bplace_box_" + type);
    let elem_arr    = MAN["bplace"][type];
    // Очистка содержимого блока
    elem_box.innerHTML  = "";

    for(elem in elem_arr){
        elem_value  = r_bplace[elem_arr[elem]].name;
        name_id     = "bplace_" + type + "_" + elem;
        str_element = '<input type="text" id="'+name_id+'" name="'+name_id+'" value="'+elem_value+'" readonly="readonly">';
        str_element += '<input type="button" value="X" onclick="Del_bplace(' + type + ',' + elem_arr[elem] + ')">';
        // str_element += '<input type="button" value="X" onclick="Del_bplace(type,elem_arr[elem])">';
        elem_box.innerHTML  += "<div>" + str_element + "</div>";
    }

    InitFields();

    console.log("конец!");
}


function qwerty(id){

    // alert(id);
    console.log("Выбрано в дата листе:");
    console.log(id);
    console.log(bplace1[id]);
    document.getElementById("t").value  = bplace1[id]["name"];
    // SendAjaxData2(document.getElementById("t").value);
}

function convert_id_name(){

    let id_value        = document.getElementById("t").value;
    let type_value      = bplace[id_value]["type"];
    let name_value      = bplace[id_value]["name"];

    alert(id_value+" ^ "+ type_value + " ^ "+ name_value);
    document.getElementById("tl").innerHTML="";

}


function SendAjaxData2(stroka){

// let req    = JSON.stringify("req"   : stroka);
req     = stroka;

console.log("To server:\n", req);
 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById("txtHint").innerHTML = this.responseText;
                // console.log(JSON.parse(this.responseText));
                console.log(this.responseText);
                response   = JSON.parse(this.responseText);
                // document.getElementById("team_list").innerHTML = this.responseText;
                // document.getElementById("team_list").innerHTML = this.responseText;
                document.getElementById("tl").innerHTML = response["r_options"];
                bplace = response["r_bplace"];
                r_bplace = response["bplace"];
                console.log("bplace: ", bplace);
                document.getElementById("tl").addEventListener("onchange", function() {convert_id_name();});
                document.getElementById("tl").addEventListener("onselect", function() {convert_id_name();});
            }
        };
        // xmlhttp.open("POST", "./ajax/kb_ajax.php", true);
        // xmlhttp.send(data);

        // xmlhttp.open("POST", "./ajax/Live_search/", true);
        xmlhttp.open("GET", "/api/live_search/"+stroka, true);
        //xmlhttp.open("POST", "../api/live_search", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //xmlhttp.send("req="+stroka);
        xmlhttp.send(stroka);

}

function Live_Search2(myObj){

    console.log(myObj.length," =>  ", myObj);
    document.getElementById("t").style.display= "inline-block";
    if (myObj.length<3) {
        document.getElementById("t").innerHTML  = "";
    }

    if ((myObj.length>=3)||(document.getElementById("t").onfocus)) {
        console.log("OK");
        SendAjaxData2(myObj)
    }
}


function hide(id_element){

    document.getElementById(id_element).style.display= "none";
}


function Select_bplace(){

    console.log("Func. " +arguments.callee.name + " start: ");

    let bp_name             = document.getElementById("t").value;

    if (bp_name.length<4) {
        alert("Ошибка! Минимальная длина значения от 3х символов.");
        return(0);
    }



    // если значение новое то нужно добавить его в БД и получить его параметры: ид-р, тип.
    if (!bplace.hasOwnProperty(bp_name)) {

        alert("НОВОЕ ЗНАЧЕНИЕ!");

        // Вычисление позици, что они точно есть !=-1
        t2          = (bp_name.indexOf("волость")!=-1);
        t3          = (bp_name.indexOf("уезд")!=-1);

        // значение по умолчанию т.к. их намного больше и чаще встречаются с.д.г.   и т.д.
        type_value  = 1;

        if (t2) type_value  = 2;
        if (t3) type_value  = 3;

        url     = "../ajax/create_bplace/";
        method  = "POST";
        data    = "type="+type_value+"&name="+bp_name;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                console.log(this.responseText);
                response   = JSON.parse(this.responseText);

                console.log("bplace: ", response);
                console.log(bp_name);

                if (!response["status"]){
                    let err_msg = "Ошибка запроса!" + response["errors"].join("\n");
                    alert(err_msg);
                    return(0);
                }

                // console.log(bplace[bp_name]);
                let type_bp_value       = response["data"]["type"];
                let id_bp_value         = response["data"]["id"];

                let elem_id = "new_bplace_" + type_bp_value + "_" + id_bp_value;
                let elem    = '<input type="text" readonly="readonly" name="' + elem_id + '" id="' + elem_id + '" value="' + bp_name + '">';
                elem        += '<input type="button" " value="X" onclick="Del_bplace(' + type_bp_value + ',' + id_bp_value + ')">';

                document.getElementById("fields").value += elem_id+ ";"; 
                MAN["bplace"][type_bp_value].push(parseInt(id_bp_value));

                bplace[bp_name] = {
                    "type"  : type_bp_value,
                    "id"    : id_bp_value,
                };

                r_bplace[id_bp_value]   = {

                    "type"  : type_bp_value,
                    "name"  : bp_name,
                }

                document.getElementById("bplace_box_"+type_bp_value).innerHTML  += "<div>" + elem + "</div>";

                return(0);
                exit(0);
            }
        };

        xmlhttp.open(method, url, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xmlhttp.send(JSON.stringify(req));
        xmlhttp.send(data);


        return(0);
    }

    console.log(bp_name);
    console.log(bplace[bp_name]);
    let type_bp_value       = bplace[bp_name]["type"];
    let id_bp_value         = bplace[bp_name]["id"];

    let elem_id = "new_bplace_" + type_bp_value + "_" + id_bp_value;
    let elem    = '<input type="text" readonly="readonly" name="' + elem_id + '" id="' + elem_id + '" value="' + bp_name + '">';
    elem        += '<input type="button" " value="X" onclick="Del_bplace(' + type_bp_value + ',' + id_bp_value + ')">';

    document.getElementById("fields").value += elem_id+ ";"; 


    if ((MAN["bplace"][type_bp_value].indexOf(parseInt(id_bp_value)))!=-1) {
        alert("Сообщение! Данное значение уже выбрано/добавлено!");
        return(0);

    }

    MAN["bplace"][type_bp_value].push(parseInt(id_bp_value));


    document.getElementById("bplace_box_"+type_bp_value).innerHTML  += "<div>" + elem + "</div>";
    return(1);

}


function focus_search(value=0){

    Live_Search2(0);
}


