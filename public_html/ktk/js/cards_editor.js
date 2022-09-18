/*
получить форму по ид - вывести в консоль
получить все ее поля - вывести в консоль
назначить submit кнопке отправку формы на проверку
*/





window.addEventListener("load", function() {

    function updateCard() {

        //   alert("QWERTY");
        var fields = ["fname", "name", "sname", "byear", "punkt", "volost", "uezd", "photo", "prim", "fond", "opis", "delo", "list"];


        var edit = {};
        var punkt_value = document.querySelector("#punkt").value;
        if ((punkt_value != "") && (punkt_value.length > 1)) {
            edit["punkt"] = punkt_value;
        }
        var volost_value = document.querySelector("#volost").value;
        if ((volost_value != "") && (volost_value.length > 1)) {
            edit["volost"] = volost_value;
        }
        var uezd_value = document.querySelector("#uezd").value;
        if ((uezd_value != "") && (uezd_value.length > 1)) {
            edit["uezd"] = uezd_value;
        }

        var form_edit = document.getElementById("form_edit");

        // Bind the FormData object and the form element
        const FD = new FormData(form_edit);

        // Перебор полей в форме места рождения + занесение их в объект формы
        for (var field in fields) {
            console.log(">", field, fields[field], form_edit[field].value.length, form_edit[field].value);
            // FD.append(fields[field], form_edit[fields[field]].value);
            FD[fields[field]] = form_edit[fields[field]].value;
        }

        FD["bplace_id"] = form_edit.bplace_id.value;
        FD["finder_id"] = form_edit.finder_id.value;

        console.log("To server:\n", edit, FD);
        const XHR = new XMLHttpRequest();

        XHR.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById("txtHint").innerHTML = this.responseText;
                // console.log(JSON.parse(this.responseText));
                if (this.responseText.length > 0) {

                    var Response = JSON.parse(this.responseText);

                    console.log(this.responseText);

                    console.log(Response);
                    if (Response["status"]) {
                        document.querySelector("#log").innerHTML = Response["msg"];
                        if (!Response["status"]) alert(Response["errors"]);
                        if (Response["status"]) alert(Response["msg"]);
                        document.querySelector("#bplace_id").value = Response["data"]["bplace_id"];
                        document.querySelector("#finder_id").value = Response["data"]["finder_id"];

                        return;
                    }
                    document.querySelector("#log").innerHTML = Response["errors"];


                    //   // document.querySelector("#t"+bp_type+"_result").display = "block";
                    //   // console.log("t" + bp_type + "_result");
                    //   if (this.responseText.length > 0) {

                    //       if (action == "delete") {

                    //           // if (this.responseText["status"]) {
                    //           alert("Операция успешно выполнена.");
                    //           console.log("Операция успешно выполнена.");
                    //           document.querySelector("#bp-form-" + idi).style.display = "none";
                    //           return;
                    //           // }

                    //           alert("Ошибка при выполеннии операции.");
                    //           console.log("Ошибка при выполеннии операции.");
                    //           // exit();

                    //       }
                    //       if (action == "save") {
                    //           // document.querySelector("#content").innerHTML = this.responseText;
                    //           if (!Response["status"]) alert(Response["err"]);
                    //           if (Response["status"]) alert(Response["msg"]);
                    //           // console.log(this.responseText.keys);
                    //           // if (!Response["status"]) console.log(this.responseText["err"]);
                    //           // if (this.responseText["status"]) console.log(this.responseText["msg"]);
                    //           // // alert("Операция успешно выполнена.");
                    //       }

                    //       // showLiveSearchBox("t" + bp_type + "_result");
                    //   }
                }
                // alert("#live_search_r"+bp_type);
                // document.querySelector("#live_search_r"+bp_type).innerHTML = this.responseText;

            }
        }

        // Bind the FormData object and the form element
        // const FD = new FormData(form);

        // Define what happens on successful data submission
        XHR.addEventListener("load", function(event) {
            // alert(event.target.responseText);
        });

        // Define what happens in case of error
        XHR.addEventListener("error", function(event) {
            alert('Oops! Something went wrong.');
        });

        // Set up our request
        XHR.open("POST", "../../api/cards/edit/", true);

        // The data sent is what the user provided in the form
        XHR.send(FD);
    }

    // Access the form element...
    // ...and take over its submit event.
    //  var edit_btn = document.querySelector("#edit_card");
    //  edit_btn.addEventListener("click", updateCard);

    // form.addEventListener("submit", function(event) {
    //     event.preventDefault();

    //     sendData();
    // });
    // Access the form element...
    const form = document.getElementById("form_edit");

    // ...and take over its submit event.
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        updateCard();
    });
});