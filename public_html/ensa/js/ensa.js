var ThemsList = [];

function addField(field) {

    console.log(field);
    console.log(ThemsList);

    // // получаем кнопку по id
    // var buttonAdd = document.querySelector('#new_'+field);
    //
    // // вешаем на кнопку событие
    // buttonAdd.addEventListener("click", adder);
    //
    // // получаем контейнер по id куда новые элементы добавлять бедуи
    // var wrap = document.querySelector('#wrap');


    var field_count = ThemsList.length;

    field_count = (ThemsList.length > 0) ? (field_count - 1) : 0;

    //  var field_id = "#new_" + field_count;
    var new_thema = document.querySelector("#myThems").value;
    if (new_thema.length <= 3) {
        alert("Длина темы должна быть от 3х символов.");
        return (1);
    }

    document.querySelector("#myThems").value = "";
    //  console.log(field_count, field_id, new_thema);
    console.log(field_count, new_thema);

    // выбираем область вывода для динамического вывода полей формы
    var field_box = document.querySelector("#thems_list_box");

    console.log(field_box);

    // Каждая строчка с текстом и кногпкой удаления будет в своей области
    var newDivItemField = document.createElement("div");

    // просто вывод в консоль ее
    console.log(newDivItemField);

    // Значение созданного поля в текст поле
    var newDivItemFieldValue = document.createElement("input");
    // укажем строго что это текстовое поле
    // newDivItemFieldValue.id = "new_thems" + field; // + "[]";
    newDivItemFieldValue.type = "text";
    newDivItemFieldValue.name = "new_thems[]";

    // Запишем в него значение
    // newDivItemFieldValue.value = new_thema;
    newDivItemFieldValue.value = field;

    newDivItemFieldValue.className = "cardThem";

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

    // ThemsList[field_count] = field_value;
    // ThemsList.push(field_value);
    // ThemsList.pop(field_value);

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



function addThem(Them) {
    var line = '<div id="thema" name="thema"><input type="buton" value="X" onClick=deleteThem()>';
    line += '<input type="text" value="' + Them + '" class="cardThem" >';
    line += '</div>';
    var TMP = document.querySelector("thems_list_box").innerHTML;
    TMP += line;
    document.querySelector("thems_list_box").innerHTML = TMP;
    console.log(line);
    // return(1);

}

function deleteCardThem(ThemId) {

    // // this здесь - это кнопка по которой нажали для удаления
    // // удаляем прослушку с этой кнопки
    // console.log(this);

    // //
    // this.removeEventListener("click", delField);

    // // получаем родителя у нажатой кнопки
    // var el = this.parentNode;

    // // у этого родителя его родителю передаем в метод удаления вложенного элемента и
    // // в качестве кого удалить передаем его самого и удаляем из родителя
    // el.parentNode.removeChild(el);

    var TMP = document.querySelector("#line_them_id_" + ThemId); //.innerHTML = "";
    console.log(ThemId, TMP);
    document.querySelector("#line_them_id_" + ThemId).innerHTML = "";


}