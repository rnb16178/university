"use strict";
function Model() {
    var one="one", two="two";
    var numOfAppts=2, title=["one","two"], from=[one,two], to=[one,two], loc=[one,two], notes=[one,two], date=[one,two];
    this.addAppt = function (titlea, timefrom, timeto, dat, location, not) {
        numOfAppts++;
        title[numOfAppts] = titlea;
        from[numOfAppts] = timefrom;
        to[numOfAppts] = timeto;
        loc[numOfAppts] = location;
        date[numOfAppts] = dat
        notes[numOfAppts] = not;
    }

    this.getAppts = function(){
        return numOfAppts;
    }
    this.getTitle=function(){
        console.log(title[numOfAppts-1]);
        return title[numOfAppts-1];
    }
}