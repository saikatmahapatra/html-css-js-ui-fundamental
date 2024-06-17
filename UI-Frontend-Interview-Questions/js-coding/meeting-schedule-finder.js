"use strict";

/*
We are writing a tool to help users manage their calendars. Given an unordered list of times of day when someone is busy, write a function that tells us whether they're available during a specified period of time.

Each time is expressed as an integer using 24-hour notation, such as 1200 (12:00), 1530 (15:30), or 800 (8:00).

Sample input:

meetings = [
  [1230, 1300], // 12:30 PM to 1:00 PM
  [845, 900],   //  8:45 AM to 9:00 AM
  [1300, 1500]  //  1:00 PM to 3:00 PM
]

Expected output:

isAvailable(meetings, 915, 1215)   => true
isAvailable(meetings, 900, 1230)   => true
isAvailable(meetings, 850, 1240)   => false
isAvailable(meetings, 1200, 1300)  => false
isAvailable(meetings, 700, 1600)   => false
isAvailable(meetings, 800, 845)    => true
isAvailable(meetings, 1500, 1800)  => true
isAvailable(meetings, 845, 859)    => false
isAvailable(meetings, 846, 900)    => false
isAvailable(meetings, 846, 859)    => false
isAvailable(meetings, 845, 900)    => false
isAvailable(meetings, 2359, 2400)  => true
isAvailable(meetings, 930, 1600)   => false
isAvailable(meetings, 800, 850)    => false
isAvailable(meetings, 1400, 1600)  => false
isAvailable(meetings, 1300, 1501)  => false
*/
const meetings = [
  [1230, 1300],
  [845, 900],
  [1300, 1500]
];


function isAvailable(busyMeetingTime, startTime, endTime){
  //let busyTime = busyMeetingTime.flat(Infinity);
  //busyTime.sort();
  //console.log(busyTime);
  busyMeetingTime.sort();
  let busyTime = busyMeetingTime;
  //console.log(busyTime);
  let availableTimeSlot = [];
  var res = false;
  
  busyTime.forEach(function(busyTime, index){
    //console.log('busy time', busyTime);
    var avlTime = [];
    
    for(var i = 0 ; i<busyTime.length ; i++){      
      //find start time 
      if(startTime >= busyTime[i] && startTime >= busyTime[i]) {
        if(!availableTimeSlot.includes(startTime)){
          availableTimeSlot.push(startTime);
        }      
      }

      //find end time 
      if(endTime <= busyTime[i] && endTime <= busyTime[i]) {
        if(!availableTimeSlot.includes(endTime)){
          availableTimeSlot.push(endTime);
        }      
      }
    }
    
  })
    
  console.log(availableTimeSlot);
  if(availableTimeSlot.length==2){
    res =  true;
  } else{
    res = false;
  }
  
  console.log(res);
  return res;
}
isAvailable(meetings, 850, 1240);

//##################################################################################
// This is working, All Test cases are passing
//##################################################################################
var meetings = [[1230, 1300], [845, 900], [1300, 1500]];
function isAvailable(busyTime, startTime, endTime){
	let isAvailable = true;
	busyTime.forEach(function(meetingTime){
		meetingStartTime = 	meetingTime[0]; // meeting start time 
		meetingEndTime = meetingTime[1]; // meeting end time		
		if((startTime > meetingStartTime && startTime < meetingEndTime) || (endTime > meetingStartTime && endTime < meetingEndTime) || (startTime <= meetingStartTime && endTime >=meetingEndTime)) {
			isAvailable = false;
		}		
	});	
	console.log("From : "+startTime+ " To : "+endTime+" >>>> " + isAvailable);
	return isAvailable;
};
