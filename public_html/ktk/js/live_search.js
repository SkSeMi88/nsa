// live_search_r1.onclick = function(event) {
//   if (event.target.nodeName != 'A') return;
//
//   let href = event.target.getAttribute('href');
//   alert(href);
//
//   return false; // prevent url change
// };
//
// live_search_r2.onclick = function(event) {
//   if (event.target.nodeName != 'A') return;
//
//   let href = event.target.getAttribute('href');
//   alert(href);
//
//   return false; // prevent url change
// };
//
// live_search_r3.onclick = function(event) {
//   if (event.target.nodeName != 'A') return;
//
//   let href = event.target.getAttribute('href');
//   alert(href);
//
//   return false; // prevent url change
// };
//

function focus_search(bp_type, myObj) {

    console.log(myObj.length, " =>  ", myObj);
    document.getElementById("t").style.display = "inline-block";
    if (myObj.length < 3) {
        document.getElementById("t").innerHTML = "";
    }

    if ((myObj.length >= 3) || (document.getElementById("t").onfocus)) {
        console.log("OK");
        SendAjaxData2(myObj)
    }
}


function open_live_search_box(box_id) {
    document.querySelector('#box_id').style.display = 'block';
}

function close_live_search_box(box_id) {
    document.querySelector('#box_id').style.display = 'None';
}


function SendAjaxData3(bp_type, search) {


    // let req    = JSON.stringify("req"   : stroka);
    req = "bp_type=" + bp_type + "&bp_value=" + search;

    if (search.length < 3) {
        document.querySelector("#t" + bp_type + "_result").innerHTML = "";
        return;
    }


    console.log("To server:\n", req);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("txtHint").innerHTML = this.responseText;
            // console.log(JSON.parse(this.responseText));
            if (this.responseText.length > 0) {

                console.log(this.responseText);
                // document.querySelector("#t"+bp_type+"_result").display = "block";
                console.log("t" + bp_type + "_result");
                if (this.responseText.length > 57) {
                    document.querySelector("#t" + bp_type + "_result").innerHTML = this.responseText;

                    showLiveSearchBox("t" + bp_type + "_result");
                }
            }
            // alert("#live_search_r"+bp_type);
            // document.querySelector("#live_search_r"+bp_type).innerHTML = this.responseText;

        }
    };

    xmlhttp.open("POST", "../../api/live_search", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("X_REQUESTED_WITH", "xmlhttprequest");
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    //xmlhttp.send("req="+stroka);
    xmlhttp.send(req);
}

function SelectedLiveSearch(bp_type, bp_value) {

    console.log('SelectedLiveSearch', bp_type, bp_value);

    var tmp = bp_value.split("^");
    console.log(tmp);
    var columns = {
        0: "id",
        1: "punkt",
        2: "volost",
        3: "uezd"
    };
    var bplace = {};

    // for (var i = 0; i < columns.length; i++) {
    for (var i in columns) {
        console.log(i, columns[i], tmp[i]);
        bplace[columns[i]] = tmp[i];

        if ((tmp[i].length > 0) && (i > 0)) {
            document.querySelector("#search_t" + i).value = bplace[columns[i]];
        }

        console.log(bplace);
    }

    document.querySelector("#bplace_id").value = bplace["id"];

    hideLiveSearchBox("t" + bp_type);

    MAN["bplace"] = bplace;
    console.log(MAN);
    // var punkt = 
}

function showLiveSearchBox(box_id) {
    console.log(box_id);
    document.querySelector("#" + box_id).style.display = "block";

}

function hideLiveSearchBox(box_id) {
    // document.querySelector("#t"+box_id).style.display = "none";
    console.log("#" + box_id + "_result");
    console.log(document.querySelector("#" + box_id + "_result"));
    document.querySelector("#" + box_id + "_result").style.display = "none";
    // document.querySelector('.live_search_box').style.display = "none";
    console.log(MAN);
}

function hideLiveSearchAllBox() {
    // document.querySelector("#t"+box_id).style.display = "none";
    // console.log("#" + box_id + "_result");
    document.querySelector("#t1_result").style.display = "none";
    document.querySelector("#t2_result").style.display = "none";
    document.querySelector("#t3_result").style.display = "none";
    // document.querySelector('.live_search_box').style.display = "none";
    console.log(MAN);
}

var CleanLiveBox = document.querySelectorAll(".live_search1");
CleanLiveBox.addEventListener("click", hideLiveSearchAllBox(), true);