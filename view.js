function View(){
    var addApptElement = document.getElementById("addAppt");

    this.displayAppointments=function(appt,title){
        var div1="<div class='appointment'>";
      var title = "<h2>"+title+"</h2>";
      var date = "<p>Date - time from to</p>"
      var loc = "<p>Location</p>"
      var div2="</div>";
      var cont =div1+title+date+loc+div2;
    
      $("body").append(cont);
    }
    this.getTitle= function(){
        var title = document.getElementById("title").nodeValue;
        return title;
    }

    this.setAddApptClickCallback = function (callback){
        addApptElement.addEventListener("click",callback);
    }

}