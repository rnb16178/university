
var savedIDs = Number(localStorage.getItem("numAppts"));
var id = 0;
var title = {};
var contact = {};
var startDate = {};
var endDate = {};
var startTimeHrs = {};
var startTimeMins = {};
var startTimeIsAm = {};
var endTimeHrs = {};
var endTimeMins = {};
var endTimeIsAm = {};
var notes = {};
if (savedIDs > 0) {
    id += savedIDs;
    title = JSON.parse(localStorage.getItem("title"));
    contact = JSON.parse(localStorage.getItem("contact"));
    startDate = JSON.parse(localStorage.getItem("sdate"));
    startTimeHrs = JSON.parse(localStorage.getItem("startHrs"));
    startTimeMins = JSON.parse(localStorage.getItem("startMins"));
    startTimeIsAm = JSON.parse(localStorage.getItem("startIsAm"));
    endDate = JSON.parse(localStorage.getItem("edate"));
    endTimeHrs = JSON.parse(localStorage.getItem("endHrs"));
    endTimeMins = JSON.parse(localStorage.getItem("endMins"));
    endTimeIsAm = JSON.parse(localStorage.getItem("endIsAm"));
    notes = JSON.parse(localStorage.getItem("notes"));
    for (var i = 0; i < savedIDs; i++) {
        display(i, title[i], contact[i], startDate[i], startTimeHrs[i], startTimeMins[i], startTimeIsAm[i], endDate[i], endTimeHrs[i], endTimeMins[i], endTimeIsAm[i], notes[i]);
    }
}
var openMenu = document.getElementById("openMenu");
var button = document.getElementById("addAppt");
var openList = document.getElementById("openList");
var closeButton = document.getElementsByClassName("close")[0];
var closeButton1 = document.getElementsByClassName("closeBtn")[0];
var list = document.getElementById("list");
list.style.display = "none";
openList.onclick = function () {
    list.style.display = "block";
}
openMenu.onclick = function () {
    addApptMenu.style.display = "block";
}
window.onclick = function (event) {
    if (event.target == addApptMenu || event.target == closeButton) {
        addApptMenu.style.display = "none";
    } if (event.target == editMenu || event.target == closeButton1) {
        editMenu.style.display = "none";
    }
}

function displayDay(i,time,ampm){
    var row=((endTimeHrs[i]-startTimeHrs[i])*2)
    if(endTimeMins[i]==30&&startTimeMins[i]!=30){
        row++;
        console.log("dec")
    }else if(endTimeMins[i]!='30'&&startTimeMins[i]==='30'){
        row--;
        console.log("inc")

    }
    if(startTimeIsAm[i]=="am"&&endTimeIsPm[i]){
        
    }
    console.log("end"+endTimeMins[i])
    console.log("start"+startTimeMins[i]);
    console.log("row"+row);
    if (startTimeMins[i] == "0") {
        var meeting = document.createElement("td");
        meeting.innerText = title[i];
        meeting.rowSpan=row;
        meeting.className="appointment"
        document.getElementById(time+""+ampm).appendChild(meeting)
    } else if (startTimeMins[i] == "30") {
        var meeting = document.createElement("td");
        meeting.innerText = title[i];
        meeting.rowSpan=row
        meeting.className="appointment"
        console.log(time+"30"+ampm);
        document.getElementById(time+"30"+ampm).appendChild(meeting)
    }

}

function openDay() {
    console.log(endTimeHrs[0]-startTimeHrs[0]);
    var dateSelected = document.getElementById("date").value;
    for (var i = 0; i < id; i++) {
            var LookingAtDate = startDate[i];
        if (LookingAtDate == dateSelected) {
            if (startTimeIsAm[i] == "AM") {
                displayDay(i,startTimeHrs[i],"am");
            } else if (startTimeIsAm[i] == "PM") {
                displayDay(i,startTimeHrs[i],"pm");

               
                
            }
        }
        
    }
}
function saveToLocalStorage() {
    localStorage.numAppts = Number(id + 1);
    localStorage.setItem("title", JSON.stringify(title));
    localStorage.setItem("contact", JSON.stringify(contact));
    localStorage.setItem("sdate", JSON.stringify(startDate));
    localStorage.setItem("startHrs", JSON.stringify(startTimeHrs));
    localStorage.setItem("startMins", JSON.stringify(startTimeMins));
    localStorage.setItem("startIsAm", JSON.stringify(startTimeIsAm));
    localStorage.setItem("edate", JSON.stringify(endDate));
    localStorage.setItem("endHrs", JSON.stringify(endTimeHrs));
    localStorage.setItem("endMins", JSON.stringify(endTimeMins));
    localStorage.setItem("endIsAm", JSON.stringify(endTimeIsAm));
    localStorage.setItem("notes", JSON.stringify(notes));
}

function deleteAll() {
    title = {};
    contact = {};
    sdate = {};
    edate = {};
    startTimeHrs = {};
    startTimeMins = {};
    startTimeIsAm = {};
    endTimeHrs = {};
    endTimeMins = {};
    endTimeIsAm = {};
    notes = {};
    for (var i = 0; i < id; i++) {
        document.getElementById("list").deleteRow(1);
    }
    savedIDs = 0;
    id = 0;
    localStorage.clear();
}

function deleteCurrent(cur) {
    if (savedIDs == 1) {
        deleteAll();
    } else {
        console.log(cur)
        for (var i = cur; i < id; i++) {
            title[cur] = title[cur + 1];
            contact[cur] = contact[cur + 1];
            sdate[cur] = sdate[cur + 1];
            edate[cur] = edate[cur + 1];
            startTimeHrs[cur] = startTimeHrs[cur + 1];
            startTimeMins[cur] = startTimeMins[cur + 1];
            startTimeIsAm[cur] = startTimeIsAm[cur + 1];
            endTimeHrs[cur] = endTimeHrs[cur + 1];
            endTimeMins[cur] = endTimeMins[cur + 1];
            endTimeIsAm[cur] = endTimeIsAm[cur + 1];
            notes[cur] = notes[cur + 1];
        }
        savedIDs--;
        id--;
        document.getElementById("list").deleteRow(cur + 1);
        for (var i = cur; i < savedIDs; i++) {
            console.log(i);
            document.getElementById("list").rows[i + 1].cells[0].innerHTML = i;
            document.getElementById("list").rows[i + 1].cells[9].innerHTML = '<button class="editbtn" onclick="deleteCurrent(' + (i) + ')">delete row</button>';
        }
        saveToLocalStorage();
    }
}

function display(id, title, contact, sdate, startHrs, startMins, startIsAm, edate, endHrs, endMins, endIsAm, notes) {
    var table = document.getElementById("list");
    var row = table.insertRow(id + 1);
    row.insertCell(0).innerHTML = id;
    row.insertCell(1).innerHTML = title;
    row.insertCell(2).innerHTML = contact;
    row.insertCell(3).innerHTML = sdate;
    row.insertCell(4).innerHTML = startHrs + " : " + startMins + " " + startIsAm;
    row.insertCell(5).innerHTML = edate;
    row.insertCell(6).innerHTML = endHrs + " : " + endMins + " " + endIsAm;;
    row.insertCell(7).innerHTML = notes;
    row.insertCell(8).innerHTML = '<button class="editbtn" onclick="editEntry(' + id + ')">edit</button>';
    row.insertCell(9).innerHTML = '<button class="editbtn" onclick="deleteCurrent(' + id + ')">delete row</button>';
}

function editEntry(i) {
    editMenu.style.display = "block";
    console.log("edit entry" + i);
}
function compareTime(time1, time2) {
    return new Date(time1) > new Date(time2); // true if time1 is later
}

function save() {
    var validInput = false;
    var intitle = document.getElementById("title").value;
    var incontact = document.getElementById("contact").value;
    var sdate = document.getElementById("sdate").value;
    var edate = document.getElementById("edate").value;
    var inputStartHrs = document.getElementById("startHrs").value;
    var inputStartMins = document.getElementById("startMins").value;
    var inputStartisAm = document.getElementById("startIsAm").value;
    var inputEndHrs = document.getElementById("endHrs").value;
    var inputEndMins = document.getElementById("endMins").value;
    var inputEndisAm = document.getElementById("endIsAm").value;
    var innotes = document.getElementById("note").value;
    if (intitle != "" && contact != "" && sdate != "" && edate != "" && !compareTime(sdate, edate)) {
        validInput = true;
    }
    if (validInput) {
        addApptMenu.style.display = "none";
        display(id, intitle, incontact, sdate, inputStartHrs, inputStartMins, inputStartisAm, edate, inputEndHrs, inputEndMins, inputEndisAm, innotes);
        title[id] = intitle
        contact[id] = incontact;
        startDate[id] = sdate;
        endDate[id] = edate;
        startTimeHrs[id] = inputStartHrs;
        startTimeMins[id] = inputStartMins;
        startTimeIsAm[id] = inputStartisAm
        endTimeHrs[id] = inputEndHrs;
        endTimeMins[id] = inputEndMins;
        endTimeIsAm[id] = inputEndisAm;
        notes[id] = innotes;
        saveToLocalStorage();
        id++;
    } else {
        var message = "There was an error with: \r"
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (intitle === "") {
            message += "The title was empty \r";
        }
        if (incontact === "") {
            message += "The contact was empty \r";
        } else if (!mailformat.test(contact)) {
            message += "The contact isnt an email or phone number \r";
        }
        if (sdate === "") {
            message += "The start date was empty \r";
        }
        if (edate === "") {
            message += "The end date was empty \r";
        }
        if (etime === "") {
            message += "The end time  was empty \r";
        }
        if (etime === "") {
            message += "The start time was empty \r";
        }
        if (!compareTime(sdate, edate)) {
            message += "The start time was after the end date \r";

        }
        alert(message);
    }
}
function openTopnav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}