var MAN = {

    "fname": new Array(),

    "name": new Array(),
    "sname": new Array(),
    "byear": new Array(),

    /*
        По типу места рождения у каждого список ид-ров этих мест
    */

    "bplace": {
        "id": "",
        "t1": [],
        "t2": [],
        "t3": [],
    },


    "photo": 0,

    // Примечания - необязательный параметр
    "prim": [],

    // Поисковые данные:

    "fond": "",
    "opis": "",
    "delo": "",
    "list": "",

    "finders": {
        "fond": "",
        "opis": "",
        "delo": "",
        "list": "",
    }
};

// "bplace_list" 	: {
// 	},

var bplace1 = {
    1: "Костомукша",
    2: "Карелия",
}

var bplace = {
    "Костомукша": 1,
    "Петрозаводск": 2,
}

var fname = new Array("Скваж");

var name = {};

let log_string = {

    0: "Нет",
    1: "Да",
};

// Навания всех динамических элементов формы.
let form_fields = [];


function ShowFIO(type) {

    var array_value = MAN[type];

    var oblast = type + "_box";
    console.log("Вывод в области: ", oblast);
    // document.getElementById("new_" + type).innerHTML = "";

    document.getElementById(oblast).innerHTML = "";

    if (type === "prim") {

        for (var obj in array_value) {

            console.log(obj, array_value[obj]);
            console.log(obj);
            let name_id = "new_" + type + "_" + obj;
            let str_fio = '<textarea name="' + name_id + '" id="' + name_id + '">';
            str_fio += array_value[obj];
            str_fio += "</textarea>";
            str_fio += '<input class="form_btn_del" type="button" value="X" onclick="DelFIO(' + "'" + type + "'" + ', ' + obj + ')">';
            document.getElementById(oblast).innerHTML += "<div>" + str_fio + "</div>";
            document.getElementById("fields").value += name_id + ";";
        }

        InitFields();
        UpdateFields();
        return (1);
    }

    for (var obj in array_value) {

        console.log(obj, array_value[obj]);
        console.log(obj);
        let name_id = "new_" + type + "_" + obj;
        // let str_fio	= '<input class="form_text_line" type="text" name="new_'+ type + '_' + obj +'" id="new_'+ type + '_' + obj +'" value="' + array_value[obj] + '">';
        // str_fio		+= '<input class="form_btn_del" type="button" value="X" onclick="DelFIO('+"'" + type + "'" +', ' + obj + ')">';
        let str_fio = '<input class="form_text_line" type="text" name="' + name_id + '" id="' + name_id + '" value="' + array_value[obj] + '" + oninput="UpdateFIO(this.id);">';
        str_fio += '<input class="form_btn_del" type="button" value="X" onclick="DelFIO(' + "'" + type + "'" + ', ' + obj + ')">';
        document.getElementById(oblast).innerHTML += "<div>" + str_fio + "</div>";

        //document.getElementById("fields").value		+= name_id + ";";
    }

    InitFields();
    UpdateFields();

}


function InitVars(type) {
    console.log("Функция инициализации всех переменных и структур данных.");
    console.log("Место рождения bplace.");
    console.log("Поисковые данные: последние в таблице беженцев");

}

function UpdateFieldsArr(field, arr, Num) {

    console.log("Func. " + arguments.callee.name + " start: ");

    console.log(field, arr, Num);

    let value = "";

    for (let i = 0; i < arr.length - 1; i++) {


        if (field == "bplace") {

            let tmp = "new_" + field + "_" + Num + "_" + arr[i];
            value += tmp + ";";
            continue;
        }

        let tmp = "new_" + field + "_" + i;

        value += tmp + ";";
    }

    console.log(value);
    return (value);
}


/**
 * Проверяет, присутствует ли в массиве значение
 * @var value  - значение
 * @var array - массив, в котором осуществляется поиск
 *
 * @return bool - возвращает false или true
 */
function in_array(value, array) {
    for (var i = 0; i < array.length; i++) {
        if (value == array[i]) return true;
    }
    return false;
}

function UpdateFields() {

    console.log("Func. " + arguments.callee.name + " start: ");

    let fields = [
        "fname",
        "name",
        "sname",
        "byear",
        "bplace",
        "photo",
        // "prim",
        // "fond",
        // "opis",
        // "delo",
        // "list",
    ];

    let value = "";

    console.log(typeof(MAN));
    let arr_keys = Object.keys(MAN);
    console.log("arr_keys", arr_keys);


    for (var i = 0; i < arr_keys.length; i++) {

        let field = arr_keys[i];
        let arr = MAN[field];

        // if (field"bplace"){
        // if (in_array(field, ["bplace", "fond", "opis", "delo", "list", "finders"])){
        // if (in_array(field, ["fond", "opis", "delo", "list", "finders"])){
        // 	continue;
        // }

        // if (field=="bplace"){
        // 	// for (let ii=0; ii = (MAN["bplace"].length - 1); ii++) {
        // 	// 	value	+= UpdateFieldsArr(field, MAN["bplace"][ii], ii);
        // 	// }
        // 	continue;
        // }


        if (field == "photo") {

            console.log("field==photo");
            let tmp = "new_" + field;

            value += tmp + ";";
            continue;

        }

        if (field == "bplace") {

            arr_keys_2 = Object.keys(MAN[field]);

            console.log("field==bplace");

            console.log(i, field, arr_keys_2.length, arr_keys_2);

            for (let key of arr_keys_2) {

                let tmp = MAN[field];
                // let key	= arr_keys_2[k];
                // console.log("kk=>", key, tmp[key].length , tmp[key]);
                // console.log("kk=>", tmp[1]);
                // console.log("k=", k, toString(k));
                // let tmp	= MAN[field][String(k)];
                // console.log("k=>", tmp[key].length);
                // console.log("k=>", tmp[key]);

                // value	+= UpdateFieldsArr(field, arr[Num], Num);

                // for (var bp = 0; bp < MAN[field][k].length; bp++) {
                for (var bp = 0; bp < tmp[key].length; bp++) {

                    let tmp = "new_" + field + "_" + key + "_" + MAN[field][key][bp];
                    value += tmp + ";";
                }

            }

            continue;
        }


        for (let ii = 0; ii < arr.length; ii++) {


            if (field == "photo") {
                continue;
            }
            let tmp = "new_" + field + "_" + ii;

            value += tmp + ";";
        }

        console.log(i, field, MAN[field].length, MAN[field]);
        console.log(value);

        // console.log(field, MAN[field],-1);
        // value	+= UpdateFieldsArr(field, MAN[field],-1);
    }

    console.log("value=");
    console.log(value);
    document.querySelector("#fields").value = value;

    return (value);
}

function UpdateFinders(name) {

    console.log("Func. " + arguments.callee.name + " start: ");

    let field = document.querySelector("#" + name);
    let field_value = field.value;

    console.log(name, ":", );
    console.log(field_value);
    if (field_value.length < 1) {
        document.querySelector("#" + name).value = MAN["finders"][name];
        return (0);
    }

    MAN["finders"][name] = field_value;
    return (0);
}

function UpdateFIO(id) {

    console.log("Func. " + arguments.callee.name + " start: ");

    let field = document.querySelector("#" + id);
    let field_value = field.value;
    let tmp = id.split("_");
    let type = tmp[1];
    let field_index = tmp[2];
    console.log(id, ":\n	", type, "	", field_index);
    console.log(field_value);
    // if (field_value!==""){
    // 		MAN[type][field_index]		= field_value;
    // }
    if (field_value.length < 4) {
        document.querySelector("#" + id).value = MAN[type][field_index];
        return (0);
    }
    MAN[type][field_index] = field_value;
}

function AdditionFIO(type) {

    console.log("function AdditionFIO(" + type + ") start: ");

    let new_value = document.getElementById("new_" + type).value;
    console.log(new_value);

    if ((new_value.length < 4) && (type !== "byear") && (type !== "photo")) {
        alert("Ошибка ввода. Пустое значение поля.");
        return (0);
    }


    if (type == "photo") {

        MAN["photo"] = log_string[new_value]; //new_value;
        document.getElementById("new_photo").value = MAN["photo"].value;

        let str_photo = '<input class="form_text_line" type="text" name="new_photo" id="new_photo" value="' + MAN["photo"] + '" onchange="UpdateFIO(this.id);">';
        // str_fio		+= '<input class="form_btn_del" type="button" value="X" onclick="DelFIO('+"'" + type + "'" +', ' + obj + ')">';
        document.getElementById("photo_box").innerHTML = str_photo;

        document.getElementById("fields").value += "new_photo;";
        console.log(MAN["photo"]);

        UpdateFields();

        return (1);
    }
    // if (type=="prim"){


    // 	// MAN["photo"]	= log_string[new_value]; //new_value;
    // 	document.getElementById("new_prim").value	= MAN["photo"].value;

    // 	let str_photo	= '<textarea class="form_text_line" type="text" name="new_photo" id="new_photo" value="' + MAN["photo"] + '">';
    // 	// str_fio		+= '<input class="form_btn_del" type="button" value="X" onclick="DelFIO('+"'" + type + "'" +', ' + obj + ')">';

    // 	document.getElementById("photo_box").innerHTML	= str_photo;
    // 	console.log(MAN["photo"]);
    // 	return(1);
    // }

    // fname[(fname.len)-1] = (document.getElementById("new_" + type).value);


    // индекс для создаваемого элемента в массиве значений - атрибута беженца(Ф,И,О, дР, мр, примечания)
    var new_index = MAN[type].length;

    // добавление глвлшл элемента в массив атрибута
    MAN[type][new_index] = (document.getElementById("new_" + type).value);

    document.getElementById("new_" + type).value = "";

    // document.getElementById("fields").value		+= (document.getElementById("new_" + type).name) + ";";
    // console.log(fname);
    // document.getElementById("result").innerHTML = fname;


    ShowFIO(type);
    UpdateFields();
}



function SendAjaxData2(stroka) {

    // let req    = JSON.stringify("req"   : stroka);
    req = stroka;

    console.log("To server:\n", req);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("txtHint").innerHTML = this.responseText;
            // console.log(JSON.parse(this.responseText));
            console.log(this.responseText);
            response = JSON.parse(this.responseText);
            // document.getElementById("team_list").innerHTML = this.responseText;
            // document.getElementById("team_list").innerHTML = this.responseText;
            document.getElementById("tl").innerHTML = response["r_options"];
            bplace = response["r_bplace"];
            r_bplace = response["bplace"];
            console.log("bplace: ", bplace);
            document.getElementById("tl").addEventListener("onchange", function() { convert_id_name(); });
            document.getElementById("tl").addEventListener("onselect", function() { convert_id_name(); });
        }
    };
    // xmlhttp.open("POST", "./ajax/kb_ajax.php", true);
    // xmlhttp.send(data);

    // xmlhttp.open("POST", "./ajax/Live_search/", true);
    xmlhttp.open("GET", "/api/live_search/" + stroka, true);
    //xmlhttp.open("POST", "../api/live_search", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //xmlhttp.send("req="+stroka);
    xmlhttp.send(stroka);

}

function Live_Search2(type_bplace, myObj) {

    console.log(myObj.length, " =>  ", myObj);
    document.getElementById("t").style.display = "inline-block";
    if (myObj.length < 3) {
        document.getElementById("t").innerHTML = "";
    }

    if ((myObj.length >= 3) || (document.getElementById("t").onfocus)) {
        console.log("OK");
        SendAjaxData2(type_bplace + myObj);
    }
}




function DelFIO(type, index) {
    console.log("Удаление");
    console.log(">>>>>", type);
    console.log("Удаление<<<");
    // fname.push(document.getElementById("new_" + type).value);

    // delete type[index];
    // delete MAN[type][index];
    let tmp = MAN[type].splice(index, 1);
    console.log(MAN[type]);
    // console.log(type, index);
    // let html_obj	= document.getElementById('new_'+ type + '_' + index);
    // html_obj.remove();


    var oblast = type + "_box";
    console.log("Удаление в области: ", oblast);
    document.getElementById(type + "_box").innerHTML = ""; //fname;

    UpdateFields();
    ShowFIO(type);
}


function AddNewElement(field) {

    var new_element = document.createElement('input');
    new_element.setAttribute('type', 'text');
    new_element.setAttribute('name', field + '[]');

    document.getElementById(field + "_box").appendChild(new_element);
}

function DelElement(field, index) {

    var new_element = document.createElement('input');
    new_element.setAttribute('type', 'text');
    new_element.setAttribute('name', 'tableInput[]');

    document.getElementById(field + "_box").appendChild(new_element);
}




// function check_form_field(field_name, value){

// 	let errors	= [];

// 	if (type_of(value)=="object"){

// 		(value.length==0){
// 			errors.push("Поле " + field_name + " пустое.");
// 		}

// 		// проверка на пустые знчения внутри массива
// 		// проверка на наличие повторяющихся значений в нутри массива
// 	}

// 	// если строка
// 			// если день рождения то от одного символа до 6

// 			// если наличие фотографий то да или нет всего два значения

// 	return errors;
// }


function check_form() {

    alert("Проверка формы!");

    let errors = [];

    console.log((MAN));

    let recived_fields = document.querySelector('#fields').value;

    console.log(recived_fields);


    /*

        получить все названия полей
        получить все их значения
        вывести
        Заполнить структуру значениями:
            если имя ключа сожержит в поступившем поле, то добавить значение этого поля в этот ключ


        Проверить структуру
            обязательные поля
            не пустые значения
            и все остальное по алгоритму от 11 марта

        Прмиечание на каждой итерации проверке все возможные ошибки, предупреждения, сообщения помещать в отедльную структуру
        "result" {

            "errors"
            "warnings"
            "msgs"
        }
    */

    // let fields	= {
    // 	"new_fname"		: 0,
    // 	"new_iname"		: 0,
    // 	"new_oname"		: 0,
    // 	"new_byear"		: 0,
    // 	"new_bplace"	: 0,
    // 	"new_photo"		: 0,
    // 	"new_prim"		: 0,

    // 	"fond"		: 0,
    // 	"opis"		: 0,
    // 	"delo"		: 0,
    // 	"list"		: 0,
    // };

    let fields = {
        "fname": "Фамилия",
        "name": "Имя",
        "sname": "Отчетсво",
        "byear": "Год рождения",
        "bplace": "Место рождения",
        "photo": "Наличие фотографий",
        "prim": "примечание",

        // "fond"		: "Фонд",
        // "opis"		: "Опись",
        // "delo"		: "Дело",
        // "list"		: "Лист(ы)",
    };

    // let fields_values	= {
    // 	"new_fname"		: [],
    // 	"new_iname"		: [],
    // 	"new_oname"		: [],
    // 	"new_byear"		: [],
    // 	"new_bplace"	: [],
    // 	"new_photo"		: [],
    // 	"new_prim"		: [],

    // };

    let finders = {

        "fond": 0,
        "opis": 0,
        "delo": 0,
        "list": 0,
    }

    // for(r_f in recived_fields){

    // 	rf	= recived_fields[r_f];

    // 	for(){

    // 	}
    // }

    let r_fields = ["fname", "name", "sname", "byear", "bplace", "photo"];

    for (var i = 0; i < r_fields.length; i++) {

        field_arr = MAN[r_fields[i]];
        len_field_arr = MAN[r_fields[i]].length;

        if ((r_fields[i] != "sname") && (r_fields[i] != "bplace") && (len_field_arr == 0)) {
            errors.push("Поле " + fields[r_fields[i]] + " не заполнено.");
            continue;
        }

        // if ((i<3)&&(len_field_arr<3)){
        // 	errors.push("Поле " + fields[r_fields[i]] + " должно иметь длину более 3х символов.");
        // 	continue;
        // }

        if ((r_fields[i] == "bplace") && (field_arr[1].length == 0) && (field_arr[2].length == 0) && (field_arr[3].length == 0)) {

            errors.push("Поле Место рождения должно иметь хотя бы одно значение любого уровня.");
        }
    }

    // Проверка
    r_fields = ["fond", "opis", "delo", "list"];
    for (var i in r_fields) {

        finder_name = r_fields[i];
        MAN["finders"][finder_name] = document.querySelector(finder_name).value;
        finder_value = MAN["finders"][finder_name];

        if (finder_value.length == 0) {
            errors.push("Поле поисковые данные (" + fields[finder_name] + ") не заполнено.");
            continue;
        }
    }

    console.log("errors:");
    console.log(errors);
    // alert(errors.length);
    // alert(errors.join("\n\r"));

    /*
        let elements		= document.new_ref.elements;

        for (element in elements){

                // console.log(elements[element].name);
                console.log(" :	",document.new_ref.fields[element], );
        }

        // console.log(document.new_ref.elements);
        console.log("FIELDS:");
        console.log(document.new_ref.fields);

            if ( document.new_ref.chek_man_form.checked == false)
            {
                    alert ( "Пожалуйста, отметь согласие с Соглашением." );
                    valid = false;
            }
            */

    // При наличии ошибок выводим их
    if (errors.length > 0) {
        alert(errors.join("\n\r"));
        return (false);
    }

    return (true);

    // Если нет ошибок отправляем форму на сервер.
    // return(true);

}

function EditFIO(field, field_value) {
    console.log(field, field_value);

    var count_field = MAN[field].length;
    MAN[field][count_field] = field_value;
    return;
}


function addFIO(field) {

    var field_count = MAN[field].length;
    field_count = (MAN[field].length > 0) ? (field_count - 1) : 0;

    var field_id = "#new_" + field;
    var field_value = document.querySelector("#" + field).value;

    console.log(field_count, field_id, field_value);

    MAN[field][field_count] = field_value;
    MAN[field].push(field_value);
    MAN[field].pop(field_value);

    return;
}


// function check_form_create1() {

//     alert("Проверка формы!");

//     var errors = [];
//     var Forma = document.forms.new_ref; // querySelector("#new_ref");

//     var fields = {

//         "new_fname": "Фамилия",
//         "new_name": "Имя",
//         "new_sname": "Отчество",
//         "new_byear": "Год рождения",



//         "new_pprim": "Примечание",

//         "new_photo": "Фотография",

//         "fond": "Фонд",
//         "opis": "Опись",
//         "delo": "Дело",
//         "list": "Лист"
//     };

//     var new_form = {
//         "new_fname": [],
//         "new_name": [],
//         "new_sname": [],
//         "new_byear": [],
//         "new_prim": []
//     };
//     console.log(typeof(new_form));
//     console.log(Forma.elements);

//     for (var field in new_form) {
//         console.log(field, Forma[field]);
//         var tmp = [];
//         for (let index = 0; index < Forma[field].length; index++) {
//             if ((field != "new_sname") && (Forma[field][index].length < 4)) {
//                 errors.push("Поле " + fields[field] + " имеет не корректное значение " + Forma[field][index].value);
//                 continue;
//             }
//             // new_form[field][index] = Forma[field][index].value;
//             tmp.push(Forma[field][index].value);
//         }

//         new_form[field] = tmp.reverse();
//         console.log(field, Forma[field].length, new_form[field]);
//     }

//     var bplace_fields = {
//         "punkt": "Населенный пункт",
//         "volost": "Волость",
//         "uezd": "Уезд",
//     };

//     var bplace_flag = 0;
//     for (var field in bplace_fields) {
//         if ((Forma[field].length) > 4) {
//             bplace_flag++;
//             new_form[field] = Forma[field].value;
//         }
//     }

//     if (bplace_flag == 0) {
//         errors.push("Место рождения должно иметь минимум одно значение от 4х символов.");
//     }
//     // console.log(Forma.elements.new_fname.length);
//     // for (let index = 0; index < Forma.elements.new_fname.length; index++) {
//     //     new_form["new_fname"][index] = Forma.elements.new_fname[index].value;
//     // }
//     console.log(new_form);
//     // var new_fname = document.querySelector("#new_fname").value;
//     // var new_name = document.querySelector("#new_name").value;
//     // var new_sname = document.querySelector("#new_sname").value;

//     // // let errors = [];

//     // console.log(new_fname, new_name, new_sname);

//     // let recived_fields = document.querySelector('#fields').value;

//     // console.log(recived_fields);
//     if (errors.length > 0) {

//         console.log(errors);
//         document.querySelector("#log").innerHTML = "<h4>Ошибки:<h4><br>" + errors.join("<br>");
//         return (false);
//     }

//     return (true);

//     /*

//     	получить все названия полей
//     	получить все их значения
//     	вывести
//     	Заполнить структуру значениями:
//     		если имя ключа сожержит в поступившем поле, то добавить значение этого поля в этот ключ


//     	Проверить структуру
//     		обязательные поля
//     		не пустые значения
//     		и все остальное по алгоритму от 11 марта

//     	Прмиечание на каждой итерации проверке все возможные ошибки, предупреждения, сообщения помещать в отедльную структуру 
//     	"result" {

//     		"errors"
//     		"warnings"
//     		"msgs"
//     	}
//     */

//     // let fields	= {
//     // 	"new_fname"		: 0,
//     // 	"new_iname"		: 0,
//     // 	"new_oname"		: 0,
//     // 	"new_byear"		: 0,
//     // 	"new_bplace"	: 0,
//     // 	"new_photo"		: 0,
//     // 	"new_prim"		: 0,

//     // 	"fond"		: 0,
//     // 	"opis"		: 0,
//     // 	"delo"		: 0,
//     // 	"list"		: 0,
//     // };

//     let fields = {
//         "fname": "Фамилия",
//         "name": "Имя",
//         "sname": "Отчетсво",
//         "byear": "Год рождения",
//         "bplace": "Место рождения",
//         "photo": "Наличие фотографий",
//         "prim": "примечание",

//         // "fond"		: "Фонд",
//         // "opis"		: "Опись",
//         // "delo"		: "Дело",
//         // "list"		: "Лист(ы)",
//     };

//     // let fields_values	= {
//     // 	"new_fname"		: [],
//     // 	"new_iname"		: [],
//     // 	"new_oname"		: [],
//     // 	"new_byear"		: [],
//     // 	"new_bplace"	: [],
//     // 	"new_photo"		: [],
//     // 	"new_prim"		: [],

//     // };

//     let finders = {

//         "fond": 0,
//         "opis": 0,
//         "delo": 0,
//         "list": 0,
//     }

//     // for(r_f in recived_fields){

//     // 	rf	= recived_fields[r_f];

//     // 	for(){

//     // 	}
//     // }

//     let r_fields = ["fname", "name", "sname", "byear", "bplace", "photo"];

//     for (var i = 0; i < r_fields.length; i++) {

//         field_arr = MAN[r_fields[i]];
//         len_field_arr = MAN[r_fields[i]].length;

//         if ((r_fields[i] != "sname") && (r_fields[i] != "bplace") && (len_field_arr == 0)) {
//             errors.push("Поле " + fields[r_fields[i]] + " не заполнено.");
//             continue;
//         }

//         // if ((i<3)&&(len_field_arr<3)){
//         // 	errors.push("Поле " + fields[r_fields[i]] + " должно иметь длину более 3х символов.");
//         // 	continue;
//         // }

//         if ((r_fields[i] == "bplace") && (field_arr[1].length == 0) && (field_arr[2].length == 0) && (field_arr[3].length == 0)) {

//             errors.push("Поле Место рождения должно иметь хотя бы одно значение любого уровня.");
//         }
//     }

//     // Проверка 
//     r_fields = ["fond", "opis", "delo", "list"];
//     for (var i in r_fields) {

//         finder_name = r_fields[i];
//         MAN["finders"][finder_name] = document.querySelector(finder_name).value;
//         finder_value = MAN["finders"][finder_name];

//         if (finder_value.length == 0) {
//             errors.push("Поле поисковые данные (" + fields[finder_name] + ") не заполнено.");
//             continue;
//         }
//     }

//     console.log("errors:");
//     console.log(errors);
//     // alert(errors.length);
//     // alert(errors.join("\n\r"));

//     /*
//     	let elements		= document.new_ref.elements;

//     	for (element in elements){

//     			// console.log(elements[element].name);
//     			console.log(" :	",document.new_ref.fields[element], );
//     	}

//     	// console.log(document.new_ref.elements);
//     	console.log("FIELDS:");
//     	console.log(document.new_ref.fields);

//     		if ( document.new_ref.chek_man_form.checked == false)
//             {
//                     alert ( "Пожалуйста, отметь согласие с Соглашением." );
//                     valid = false;
//             }
//             */

//     // При наличии ошибок выводим их
//     if (errors.length > 0) {
//         alert(errors.join("\n\r"));
//         return (false);
//     }

//     return (true);

//     // Если нет ошибок отправляем форму на сервер.
//     // return(true);

// }