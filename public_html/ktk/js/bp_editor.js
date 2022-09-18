function resetFormFiltrBPeditor() {
    console.log(document.querySelector("#find_punkt").value);
    document.querySelector("#find_punkt").value = "";
    document.querySelector("#find_volost").value = "";
    document.querySelector("#find_uezd").value = "";

    var new_bp_forma = document.forms.new_ref;
    console.log(new_bp_forma);
}

var filtr_btn = document.getElementById("filtr_send");
// var filtr_btn = document.querySelector("#filtr_send");

filtr_btn.addEventListener("click", getBplacesByFiltr);


function getBplacesByFiltr() {

    alert("QWERTY");
    // req = "bp_type=" + bp_type + "&bp_value=" + search;
    var filtr = {
        //"find_punkt" : document.querySelector("").value,
    };

    var punkt_value = document.querySelector("#find_punkt").value;
    if ((punkt_value != "") && (punkt_value.length > 1)) {
        filtr["find_punkt"] = punkt_value;
    }

    var volost_value = document.querySelector("#find_volost").value;
    if ((volost_value != "") && (volost_value.length > 1)) {
        filtr["find_volost"] = volost_value;
    }

    var uezd_value = document.querySelector("#find_uezd").value;
    if ((uezd_value != "") && (uezd_value.length > 1)) {
        filtr["find_uezd"] = uezd_value;
    }

    // var form_filtr = document.querySelector("#filtr");
    var form_filtr = document.getElementById("filtr");

    // Bind the FormData object and the form element
    const FD = new FormData(form_filtr);

    console.log("To server:\n", filtr, FD);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("txtHint").innerHTML = this.responseText;
            // console.log(JSON.parse(this.responseText));
            if (this.responseText.length > 0) {

                console.log(this.responseText);
                // document.querySelector("#t"+bp_type+"_result").display = "block";
                // console.log("t" + bp_type + "_result");
                if (this.responseText.length > 57) {
                    // document.querySelector("#t" + bp_type + "_result").innerHTML = this.responseText;

                    // showLiveSearchBox("t" + bp_type + "_result");
                }
            }
            // alert("#live_search_r"+bp_type);
            // document.querySelector("#live_search_r"+bp_type).innerHTML = this.responseText;

        }
    };

    xmlhttp.open("POST", "../../api/bplaces/filtr/", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("X_REQUESTED_WITH", "xmlhttprequest");
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xmlhttp.send(FD);
}


window.addEventListener("load", function() {

    function sendData() {

        const XHR = new XMLHttpRequest();

        XHR.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById("txtHint").innerHTML = this.responseText;
                // console.log(JSON.parse(this.responseText));
                if (this.responseText.length > 0) {

                    console.log(this.responseText);
                    // document.querySelector("#t"+bp_type+"_result").display = "block";
                    // console.log("t" + bp_type + "_result");
                    if (this.responseText.length > 0) {
                        document.querySelector("#content").innerHTML = this.responseText;

                        // showLiveSearchBox("t" + bp_type + "_result");
                    }
                }
                // alert("#live_search_r"+bp_type);
                // document.querySelector("#live_search_r"+bp_type).innerHTML = this.responseText;

            }
        }

        // Bind the FormData object and the form element
        const FD = new FormData(form);

        // Define what happens on successful data submission
        XHR.addEventListener("load", function(event) {
            // alert(event.target.responseText);
        });

        // Define what happens in case of error
        XHR.addEventListener("error", function(event) {
            alert('Oops! Something went wrong.');
        });

        // Set up our request
        XHR.open("POST", "../../api/bplaces/filtr/", true);

        // The data sent is what the user provided in the form
        XHR.send(FD);
    }

    // Access the form element...
    const form = document.getElementById("filtr");

    // ...and take over its submit event.
    form.addEventListener("submit", function(event) {
        event.preventDefault();

        sendData();
    });

    // const btn = document.querySelector();
});




// const btn = document.querySelector('#delete_bplace');

function sendData(data) {
    const XHR = new XMLHttpRequest(),
        FD = new FormData();

    // Push our data into our FormData object
    for (name in data) {
        FD.append(name, data[name]);
    }

    // Define what happens on successful data submission
    XHR.addEventListener('load', function(event) {
        alert('Yeah! Data sent and response loaded.');
    });

    // Define what happens in case of error
    XHR.addEventListener(' error', function(event) {
        alert('Oops! Something went wrong.');
    });

    // Set up our request
    XHR.open("POST", "../../api/bplaces/delete/", true);

    // Send our FormData object; HTTP headers are set automatically
    XHR.send(FD);
}

// btn.addEventListener('click', function() {
//     sendData({ test: 'ok' });
// })

function sendAjaxData(action, idi) {


    var fields = ["punkt", "volost", "uezd"];

    var urls = {
        "save": "../../api/bplaces/edit/",
        "delete": "../../api/bplaces/delete/",
    };

    console.log("sendAjaxData");
    console.log(action, idi);

    // const form = document.getElementById("filtr");
    // console.log(form);

    var form_line = document.getElementById("bp-form-" + idi);
    console.log(form_line);

    // Создаем объёкт формы
    var FD = new FormData(form_line);

    FD["id"] = idi;

    // Перебор полей в форме места рождения + занесение их в объект формы
    for (var field in fields) {
        console.log(">", field, fields[field], form_line[field].value.length, form_line[field].value);
        // FD.append(fields[field], form_line[fields[field]].value);
        FD[fields[field]] = form_line[fields[field]].value;
    }
    console.log(FD);
    console.log(urls[action]);

    const XHR = new XMLHttpRequest();

    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("txtHint").innerHTML = this.responseText;
            // console.log(JSON.parse(this.responseText));
            if (this.responseText.length > 0) {

                var Response = JSON.parse(this.responseText);

                console.log(this.responseText);
                console.log(Response);
                // document.querySelector("#t"+bp_type+"_result").display = "block";
                // console.log("t" + bp_type + "_result");
                if (this.responseText.length > 0) {

                    if (action == "delete") {

                        // if (this.responseText["status"]) {
                        alert("Операция успешно выполнена.");
                        console.log("Операция успешно выполнена.");
                        document.querySelector("#bp-form-" + idi).style.display = "none";
                        return;
                        // }

                        alert("Ошибка при выполеннии операции.");
                        console.log("Ошибка при выполеннии операции.");
                        // exit();

                    }
                    if (action == "save") {
                        // document.querySelector("#content").innerHTML = this.responseText;
                        if (!Response["status"]) alert(Response["err"]);
                        if (Response["status"]) alert(Response["msg"]);
                        // console.log(this.responseText.keys);
                        // if (!Response["status"]) console.log(this.responseText["err"]);
                        // if (this.responseText["status"]) console.log(this.responseText["msg"]);
                        // // alert("Операция успешно выполнена.");
                    }

                    // showLiveSearchBox("t" + bp_type + "_result");
                }
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
    XHR.open("POST", urls[action], true);

    // The data sent is what the user provided in the form
    XHR.send(FD);

}