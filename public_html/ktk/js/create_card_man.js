// var CARD_MAN = {
//     "fname" : [],
// };

// function onKeyUpFIO(field, value){
//     var field_count = CARD_MAN[field].length;
//     // CARD_MAN[field][field_count] = value;
// }

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



function addField(field) {

    console.log(field);
    console.log(MAN);

    // // получаем кнопку по id
    // var buttonAdd = document.querySelector('#new_'+field);
    //
    // // вешаем на кнопку событие
    // buttonAdd.addEventListener("click", adder);
    //
    // // получаем контейнер по id куда новые элементы добавлять бедуи
    // var wrap = document.querySelector('#wrap');


    var field_count = MAN[field].length;

    field_count = (MAN[field].length > 0) ? (field_count - 1) : 0;

    var field_id = "#new_" + field;
    var field_value = document.querySelector(field_id).value;
    document.querySelector(field_id).value = "";
    console.log(field_count, field_id, field_value);

    // выбираем область вывода для динамического вывода полей формы
    var field_box = document.querySelector("#new_" + field + "_box");

    console.log(field_box);

    // Каждая строчка с текстом и кногпкой удаления будет в своей области
    var newDivItemField = document.createElement("div");

    // просто вывод в консоль ее
    console.log(newDivItemField);

    // Значение созданного поля в текст поле
    var newDivItemFieldValue = document.createElement("input");
    // укажем строго что это текстовое поле
    newDivItemFieldValue.id = "new_" + field; // + "[]";
    newDivItemFieldValue.name = "new_" + field + "[]";
    newDivItemFieldValue.type = "text";

    // Запишем в него значение
    newDivItemFieldValue.value = field_value;

    // Создаем кнопку удаления для каждого доп текст. поля
    var newDivItemFieldButton = document.createElement('input');
    // указываем строго что это КНОПКА
    newDivItemFieldButton.type = "button";
    newDivItemFieldButton.value = 'X';
    // newDivItemFieldButton.onclick = delField(); //alert('X');

    // на кнопку вешаем обработчик события нажатия - удаление значение из бокса из сд МАН
    newDivItemFieldButton.addEventListener('click', delField);

    // Помещаем в динам область вывода строки текстовое поле и кнопку его удаления.
    newDivItemField.appendChild(newDivItemFieldValue);

    newDivItemField.appendChild(newDivItemFieldButton);
    field_box.appendChild(newDivItemField);
    // field_box.innerHTML = newDivItemField;

    // MAN[field][field_count] = field_value;
    // MAN[field].push(field_value);
    // MAN[field].pop(field_value);

    return;
}

function delField() {
    // this здесь - это кнопка по которой нажали для удаления
    // удаляем прослушку с этой кнопки
    console.log(this);
    //
    this.removeEventListener("click", delField);
    // получаем родителя у нажатой кнопки
    var el = this.parentNode;
    // у этого родителя его родителю передаем в метод удаления вложенного элемента и
    // в качестве кого удалить передаем его самого и удаляем из родителя
    el.parentNode.removeChild(el);
}



function check_form_create() {

    alert("Проверка формы!");

    var errors = [];
    var Forma = document.forms.new_ref; // querySelector("#new_ref");

    var fields = {

        "new_fname": "Фамилия",
        "new_name": "Имя",
        "new_sname": "Отчество",
        "new_byear": "Год рождения",

        "new_prim": "Примечание",
        "new_photo": "Фотография",

        // "fond": "Фонд",
        // "opis": "Опись",
        // "delo": "Дело",
        // "list": "Лист"
    };

    var new_form = {
        "new_fname": [],
        "new_name": [],
        "new_sname": [],
        "new_byear": []
            // "new_prim": []
    };
    console.log(typeof(new_form));
    console.log(Forma.elements);

    for (var field in new_form) {
        console.log(">", field, Forma[field].value.length, Forma[field].value);
        var tmp = [];
        for (let index = 0; index < Forma[field].length; index++) {

            if ((field == "new_byear") && (Forma[field][index].value.length == 0)) {
                console.log(index, field, Forma[field][index].value.length, Forma[field][index].value);
                errors.push("Поле " + fields[field] + " имеет не корректное значение >" + Forma[field][index].value);
                console.log(field, "Ошибка");
                continue;
            }


            if ((field != "new_sname") && (field != "new_byear") && (Forma[field][index].value.length < 3)) {
                errors.push("Поле " + fields[field] + " имеет не корректное значение >>" + Forma[field][index].value);
                console.log(field, "Ошибка");
                continue;
            }
            // new_form[field][index] = Forma[field][index].value;
            tmp.push(Forma[field][index].value);
        }

        new_form[field] = tmp.reverse();
        console.log(field, Forma[field].length, new_form[field]);
    }

    // if (Forma.new_byear.value.length < 1) {
    //     errors.push("Поле " + fields["new_byear"] + " !имеет не корректное значение " + Forma.new_byear.value);
    // }
    var bplace_fields = {
        "punkt": "Населенный пункт",
        "volost": "Волость",
        "uezd": "Уезд",
    };

    var bplace_flag = 0;
    for (var field in bplace_fields) {
        console.log(field, Forma[field], Forma[field].value);
        if ((Forma[field].value.length) > 4) {
            bplace_flag = +1;
            new_form[field] = Forma[field].value;
        }
    }
    console.log("bplace_flag", bplace_flag);

    if (bplace_flag == 0) {
        errors.push("Место рождения должно иметь минимум одно значение от 4х символов.");
    }


    var finder_fields = {
        "new_fond": "Фонд",
        "new_opis": "Опись",
        "new_delo": "Дело",
        "new_list": "Лист"
    };

    var finder_flag = 0;
    for (var field in finder_fields) {
        console.log(field, Forma[field], Forma[field].value);
        if ((Forma[field].value.length) < 1) {
            finder_flag = +1;
            errors.push("Поле " + finder_fields[field] + " имеет не корректное значение " + Forma[field].value);
            continue;
        }
        new_form[field] = Forma[field].value;
    }


    // console.log(Forma.elements.new_fname.length);
    // for (let index = 0; index < Forma.elements.new_fname.length; index++) {
    //     new_form["new_fname"][index] = Forma.elements.new_fname[index].value;
    // }
    console.log(new_form);
    // var new_fname = document.querySelector("#new_fname").value;
    // var new_name = document.querySelector("#new_name").value;
    // var new_sname = document.querySelector("#new_sname").value;

    // // let errors = [];

    // console.log(new_fname, new_name, new_sname);

    // let recived_fields = document.querySelector('#fields').value;

    // console.log(recived_fields);
    if (errors.length > 0) {

        console.log(errors);
        document.querySelector("#log").innerHTML = "<h4>Ошибки:<h4><br>" + errors.join("<br>");
        return (false);
    }
    document.querySelector("#log").innerHTML = "<h4>Ошибки:<h4><br>Не обнаружены.";
    Forma.submit();
    return (true);
}