var apptView = new View(),
apptModel = new Model(),
apptController = null;

function Controller(){
    this.updateAppointmentsDisplay = function(){
        var title=apptModel.getTitle();
        apptView.displayAppointments(Model.getAppts(),title);
    }
    this.init = function(){
        apptView.setAddApptClickCallback(function(){
            console.log("clicked");

            var title=apptView.getTitle(),
            timeFrom="timeFrom",
            timeTo="timeTo",
            date="date",
            loc="loc",
            not="not";
           
            apptModel.addAppt(title,timeFrom,timeTo,date,loc,not);
            apptView.displayAppointments(apptModel.getAppts(),title);
        });
    }

}
apptController=new Controller();
window.addEventListener("load", apptController.init);