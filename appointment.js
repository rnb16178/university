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
var locationUser = {};
var notes = {};
var editID;
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
    locationUser = JSON.parse(localStorage.getItem("location"));
    notes = JSON.parse(localStorage.getItem("notes"));

}
var openMenu = document.getElementById("openMenu");
var button = document.getElementById("addAppt");
var daySchedule = document.getElementById("daySchedule");
var closeButton = document.getElementsByClassName("close")[0];
var closeButton1 = document.getElementsByClassName("closeBtn")[0];
var openDaySched = document.getElementById("openDaySched");
var homeButton = document.getElementById("homeButton");
var tableDay = document.getElementById("tableDay");
var weekSchedule = document.getElementById("weekSchedule");
var openWeekSched = document.getElementById("openWeekSched");
var openMonthSched = document.getElementById("openMonthSched");
var monthSced = document.getElementById("monthSchedule");
var tableweek = document.getElementById("tableweek");
var monthTitle = document.getElementById("monthTitle");

list.style.display = "none";
tableDay.style.display = "none"
daySchedule.style.display = "none";
weekSchedule.style.display = "none";
monthSced.style.display = "none";
tableweek.style.display = "none";
monthTitle.style.display = "none";
editMenu.style.display = "none";


homeButton.onclick = function () {
    list.style.display = "none";
    tableDay.style.display = "none"
    daySchedule.style.display = "none";
    weekSchedule.style.display = "none";
    monthSced.style.display = "none";
    tableweek.style.display = "none";
}

openDaySched.onclick = function () {
    daySchedule.style.display = "block";
    list.style.display = "none";
    tableDay.style.display = "none"
    weekSchedule.style.display = "none";
    monthSced.style.display = "none";
    tableweek.style.display = "none";
}
openMenu.onclick = function () {
    addApptMenu.style.display = "block";
}
openWeekSched.onclick = function () {
    list.style.display = "none";
    tableDay.style.display = "none"
    daySchedule.style.display = "none";
    monthSced.style.display = "none";
    weekSchedule.style.display = "block";
    tableweek.style.display = "none";
}

openMonthSched.onclick = function () {
    monthSced.style.display = "block";
    list.style.display = "none";
    tableDay.style.display = "none"
    daySchedule.style.display = "none";
    weekSchedule.style.display = "none";
    tableweek.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == addApptMenu || event.target == closeButton) {
        addApptMenu.style.display = "none";
        document.getElementById("title").className = " ";
        document.getElementById("contact").className = " ";
        document.getElementById("sdate").className = "";
        document.getElementById("edate").className = "";  // this adds the error class
        document.getElementById("startHrs").className = "";
        document.getElementById("startMins").className = "";
        document.getElementById("startIsAm").className = "";
        document.getElementById("endHrs").className = "";
        document.getElementById("endMins").className = "";
        document.getElementById("endIsAm").className = "";
    } if (event.target == editMenu || event.target == closeButton1) {
        editMenu.style.display = "none";
    }
}

function displayMonth() {
    var monthToDisplay = document.getElementById("monthSelect").value;
    var yearToDisplay = document.getElementById("yearSelect").value;
    var header = document.getElementById("monthTitle");
    monthTitle.style.display = "block";
    header.innerHTML = ("<h1>" + monthToDisplay + " " + yearToDisplay + "</h1>");
    var monthID = 0;
    var days = 28;
    if (monthToDisplay === "January") {
        monthID = 0;
        days = 31;
    } else if (monthToDisplay === "February") {
        monthID = 1;
        days = 28
    } else if (monthToDisplay === "March") {
        monthID = 2;
        days = 31;
    } else if (monthToDisplay === "April") {
        monthID = 3;
        days = 30;
    } else if (monthToDisplay === "May") {
        monthID = 4;
        days = 31;
    } else if (monthToDisplay === "June") {
        monthID = 5;
        days = 30;
    } else if (monthToDisplay === "July") {
        monthID = 6;
        days = 31;
    } else if (monthToDisplay === "August") {
        monthID = 7;
        days = 31;
    } else if (monthToDisplay === "september") {
        monthID = 8;
        days = 30;
    } else if (monthToDisplay === "October") {
        monthID = 9;
        days = 31;
    } else if (monthToDisplay === "November") {
        monthID = 10;
        days = 30;
    } else if (monthToDisplay === "December") {
        monthID = 11;
        days = 31;
    }
    document.getElementById("monthTable").innerHTML = "";
    for (var j = 0; j < days; j += 7) {
        var table = document.createElement("div");
        table.className = "weekdays";
        var row = document.createElement("ul");

        for (var i = (1 + j); i <= 7 + j; i++) {
            if (i <= days) {
                row.innerHTML += "<li>" + i + "</li>";
            }
        }
        table.appendChild(row);
        document.getElementById("monthTable").append(table);
        var table = document.createElement("div");
        table.className = "days";
        var row = document.createElement("ul");
        for (var i = 1 + j; i <= 7 + j; i++) {
            if (i <= days) {
                var foundAppt = false;
                var out = "<li>";
                for (var k = 0; k < savedIDs; k++) {
                    if (new Date(startDate[k]).getMonth() === monthID && parseInt(new Date(startDate[k]).getFullYear()) === parseInt(yearToDisplay) && new Date(startDate[k]).getDate() === (i)) {
                        out += '<button onclick="openEdit(' + k + ')">' + title[k] + "</button><br>";
                        foundAppt = true
                    }
                }
                if (!foundAppt) {
                    out += "No Meeting";
                }
                out += "</li>";
                row.innerHTML += out;
            }
        }
        table.appendChild(row);
        document.getElementById("monthTable").append(table);
    }
}

function openWeek() {
    var dayOfWeek = ["Sun", "Mon", "Tues", "Wed", "Thurs", "Fri", "Sat"];
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    document.getElementById("monthTable").innerHTML = "";
    var initDate = dateSelected = document.getElementById("dateWeek").value;
    if (dateSelected == "") {
        alert("Please select a date");
    } else {
        tableweek.style.display = "block";
        new Date(dateSelected)
        var tomorrow = new Date(dateSelected);
        tomorrow.setDate(tomorrow.getDate() + 1);
        for (var i = 1; i <= 7; i++) {
            var tomorrow = new Date(dateSelected);
            document.getElementById("day" + i).innerHTML = dayOfWeek[tomorrow.getDay()] + " " + tomorrow.getDate() + " " + months[tomorrow.getMonth()];
            tomorrow.setDate(tomorrow.getDate() + 1);
            dateSelected = tomorrow;
        }
        dateSelected = initDate;
        for (var curDay = 1; curDay <= 7; curDay++) {
            for (var i = 0; i < savedIDs; i++) {
                if (new Date(dateSelected).getTime() === new Date(startDate[i]).getTime()) {
                    var time = startTimeHrs[i];
                    if (startTimeMins[i] == "30") {
                        time = startTimeHrs[i] + "" + startTimeMins[i] + startTimeIsAm[i];
                    } else {
                        time = startTimeHrs[i] + "" + startTimeIsAm[i];
                    }
                    var length = (endTimeHrs[i] - startTimeHrs[i]) * 2;
                    if (startTimeMins[i] == 30 && endTimeMins[i] == 0) {
                        length--;
                    } else if (startTimeMins[i] == 00 && endTimeMins[i] == 30) {
                        length++;
                    }
                    for (var j = 0; j < length; j++) {
                        var meeting = document.getElementById("d" + curDay + "-" + (time));
                        meeting.innerHTML = "<button>" + title[i] + "</button>";
                        meeting.className = "appointment";
                    }
                    meeting.innerHTML = '<button onclick="openEdit(' + i + ')">' + title[i] + "</button><br>";
                    meeting.className = "appointment";
                }
            }
            var tomorrow = new Date(dateSelected);
            tomorrow.setDate(tomorrow.getDate() + 1);
            dateSelected = tomorrow;
        }
    }
}



function openDay() {
    var dateSelected = document.getElementById("date").value;
    if (dateSelected == "") {
        alert("please select a date");
    } else {
        tableDay.style.display = "block";
        for (var i = 1; i < 13; i++) {
            const myNode = document.getElementById(i + "AM");
            myNode.innerHTML = '<th>' + i + ":00 am " + '</th>';
            const myNode1 = document.getElementById(i + "30AM");
            myNode1.innerHTML = '<th>' + i + ":30 am" + '</th>';
            const myNode2 = document.getElementById(i + "PM");
            myNode2.innerHTML = '<th>' + i + ":00 pm" + '</th>';
            const myNode3 = document.getElementById(i + "30PM");
            myNode3.innerHTML = '<th>' + i + ":30 pm" + '</th>';
        }
        for (var i = 0; i < savedIDs; i++) {

            if (dateSelected === startDate[i]) {
                var time = startTimeHrs[i];
                if (startTimeMins[i] == "30") {
                    time = startTimeHrs[i] + "" + startTimeMins[i] + startTimeIsAm[i];
                } else {
                    time = startTimeHrs[i] + "" + startTimeIsAm[i];
                }
                var length = (endTimeHrs[i] - startTimeHrs[i]) * 2;
                var meeting = document.createElement("td");
                if (startTimeMins[i] == 30 && endTimeMins[i] == 0) {
                    length--;
                } else if (startTimeMins[i] == 00 && endTimeMins[i] == 30) {
                    length++;
                }
                meeting.innerHTML = '<button onclick="openEdit(' + i + ')">' + title[i] + "</button><br>";
                meeting.rowSpan = length;
                meeting.className = "appointment"
                document.getElementById(time).appendChild(meeting)
            }
        }
    }
}

function openEdit(i) {
    var editTitle = document.getElementById("titleEdit");
    editTitle.value = title[i];
    var editContact = document.getElementById("contactEdit");
    editContact.value = contact[i];
    var editStartDate = document.getElementById("startDateEdit");
    editStartDate.value = startDate[i];
    var endDateEdit = document.getElementById("endDateEdit");
    endDateEdit.value = endDate[i];
    var startHrsEdit = document.getElementById("startHrsEdit");
    startHrsEdit.value = startTimeHrs[i];
    console.log(startTimeHrs[i]);
    var startMinsEdit = document.getElementById("startMinsEdit");
    startMinsEdit.value = startTimeMins[i];
    var startIsAmEdit = document.getElementById("startIsAmEdit");
    startIsAmEdit.value = startTimeIsAm[i]
    var endHrsEdit = document.getElementById("endHrsEdit");
    endHrsEdit.value = endTimeHrs[i]
    var endMinsEdit = document.getElementById("endMinsEdit");
    endMinsEdit.value = endTimeMins[i];
    var endIsAmEdit = document.getElementById("endIsAmEdit");
    endIsAmEdit.value = endTimeIsAm[i];
    var editNotes = document.getElementById("editNotes");
    editNotes.value = notes[i];
    editMenu.style.display = "block";
    editID = i;
}
var deleteApptButton = document.getElementById("deleteAppt");
deleteApptButton.onclick = function () {
    console.log("deleteButtonPressed"+editID);
    deleteCurrent(editID);

}
var editAppt = document.getElementById("chengeAppt");
editAppt.onclick = function () {
    var valid = false;
    var errorMessage = "";
    var editTitle = document.getElementById("titleEdit").value;
    var editContact = document.getElementById("contactEdit").value;
    var editStartDate = document.getElementById("startDateEdit").value;
    var endDateEdit = document.getElementById("endDateEdit").value;
    var startHrsEdit = document.getElementById("startHrsEdit").value;
    var startMinsEdit = document.getElementById("startMinsEdit").value;
    var startIsAmEdit = document.getElementById("startIsAmEdit").value;
    var endHrsEdit = document.getElementById("endHrsEdit").value;
    var endMinsEdit = document.getElementById("endMinsEdit").value;
    var endIsAmEdit = document.getElementById("endIsAmEdit").value;
    var editLocation = document.getElementById("editLocation").value;
    var editNotes = document.getElementById("editNotes").value;
    if (editTitle === "") {
        errorMessage += "Please enter a Title\r";
    } else if (editContact === "") {
        errorMessage += "Please enter a Contact\r";
    } else if (editStartDate === "") {
        errorMessage += "Please enter a Start Date\r";
    } else if (endDateEdit === "") {
        errorMessage += "Please enter a End Date\r";
    } else if (startMinsEdit === "" || startIsAmEdit === "" || startHrsEdit === "") {
        errorMessage += "Please enter a Start Time\r";
    } else if (endHrsEdit === "" || endMinsEdit === "" || endIsAmEdit === "") {
        errorMessage += "Please enter a End Time\r";
    } else if (editLocation === "") {
        errorMessage += "Please enter a Location\r";
    } else {
        valid = true;
    }
    if (valid) {
        editMenu.style.display = "none";
        console.log(editTitle);
        title[editID] = editTitle;
        contact[editID] = editContact;
        startDate[editID] = editStartDate;
        endDate[editID] = endDateEdit;
        startTimeHrs[editID] = startHrsEdit;
        startTimeMins[editID] = startMinsEdit;
        startTimeIsAm[editID] = startIsAmEdit;
        endTimeHrs[editID] = endHrsEdit;
        endTimeMins[editID] = endMinsEdit;
        endTimeIsAm[editID] = endIsAmEdit;
        locationUser[editID] = editLocation;
        notes[editID] = editNotes;
        saveToLocalStorage();
        location.reload();
    } else {
        alert(errorMessage);
    }
}

function saveToLocalStorage() {
    localStorage.numAppts = Number(id);
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
    localStorage.setItem("location", JSON.stringify(locationUser));
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
    locationUser = {};
    notes = {};
    savedIDs = 0;
    id = 0;
    localStorage.clear();
}

function deleteCurrent(cur) {
    if (savedIDs == 1) {
        deleteAll();
    } else {
        for (var i = cur; i < id; i++) {
            if (i === (id - 1)) {
                delete title[i];
                delete contact[i];
                delete sdate[i];
                delete edate[i];
                delete startTimeHrs[i];
                delete startTimeMins[i];
                delete startTimeIsAm[i];
                delete endTimeMins[i];
                delete endTimeHrs[i];
                delete endTimeIsAm[i];
                delete locationUser[i];
                delete notes[i];
            } else {
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
                locationUser[cur] = locationUser[cur + 1];
                notes[cur] = notes[cur + 1];
            }
        }
        savedIDs--;
        id--;
        localStorage.clear();
        saveToLocalStorage();
    }
    location.reload();
}

function editEntry(i) {
    editMenu.style.display = "block";
    console.log("edit entry" + i);
}
function compareDates(time1, time2) {
    console.log(new Date(time1) > new Date(time2));
    return new Date(time1) > new Date(time2); // true if time1 is later
}
function compareTimes(startDate, endDate, hoursStart, hoursEnd, minsStart, minsEnd, amStart, amEnd) {
    if (minsStart < 10) {
        minsStart = "0" + minsStart;
    }
    if (minsEnd < 10) {
        minsEnd = "0" + minsEnd;
    }
    if (hoursStart < 10) {
        hoursStart = "0" + hoursStart;
    }
    if (hoursEnd < 10) {
        hoursEnd = "0" + hoursEnd;
    }
    if (amStart == "PM") {
        hoursStart = parseInt(hoursStart) + 12;
    }
    if (amEnd == "PM") {
        hoursEnd = parseInt(hoursEnd) + 12;
    }
    return new Date(startDate + "T" + hoursStart + ":" + minsStart + ":00") > new Date(endDate + "T" + hoursEnd + ":" + minsEnd + ":00");
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
    var inputLocation = document.getElementById("location").value;
    var innotes = document.getElementById("note").value;
    if (intitle != "" && contact != "" && sdate != "" && edate != "" && !compareTimes(sdate, edate, inputStartHrs, inputEndHrs, inputStartMins, inputEndMins, inputStartisAm, inputEndisAm) && !compareDates(sdate, edate)) {
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
        locationUser[id] = inputLocation;
        notes[id] = innotes;
        id++;
        saveToLocalStorage();
        location.reload();
    } else {
        var message = "There was an error with: \r"
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (intitle === "") {
            message += "Please enter a Title\r";
            document.getElementById("title").className = "error";  // this adds the error class
        }
        if (incontact === "") {
            message += "Please enter Contact Information \r";
            document.getElementById("contact").className = "error";  // this adds the error class

        } else if (!mailformat.test(contact)) {
            message += "The contact isnt an email or phone number \r";
            document.getElementById("contact").className = "error";  // this adds the error class
        }
        if (sdate === "") {
            message += "Please enter a Start Date \r";
            document.getElementById("sdate").className = "error";
        }
        if (edate === "") {
            message += "Please enter an End Date \r";
            document.getElementById("edate").className = "error";
        }
        if (compareDates(sdate, edate) && sdate != "" && edate != "") {
            message += "The start date is after the end date \r";
            document.getElementById("edate").className = "error";
            document.getElementById("sdate").className = "error";
        } else if (compareTimes(sdate, edate, inputStartHrs, inputEndHrs, inputStartMins, inputEndMins, inputStartisAm, inputEndisAm) && sdate != "" && edate != "") {
            message += "The start time is after the end time";
            document.getElementById("startHrs").className = "error";
            document.getElementById("startMins").className = "error";
            document.getElementById("startIsAm").className = "error";
            document.getElementById("endHrs").className = "error";
            document.getElementById("endMins").className = "error";
            document.getElementById("endIsAm").className = "error";
        }
        if (emailValidate() || phoneValidate()) {
            message += "";
        }
        alert(message);
    }
}
function emailValidate() {

}
function phoneValidate() {

}
function openTopnav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}