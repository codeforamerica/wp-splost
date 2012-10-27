var YEARS = ["year2012", "year2013", "year2014", "year2015", "year2016", "year2017", "year2018", "year2019"]
var URL = 'https://docs.google.com/spreadsheet/pub?key=0Aj3c4mZCQQaMdGE2TVphOWlXMUMyclRXa2Z1c0g5MGc&output=html';


function loadSpreadsheet() {
  
  Tabletop.init( { key: URL, callback: showInfo, simpleSheet: true } )
}


function getProjectTotal(project) {
  var tot = "total"
  var projectTotal = project[tot]
  return projectTotal
}

function getCurrentYear() {
  return new Date().getFullYear()  
}

function getCurrentMonth() {
  var month = new Date().getMonth() + 1
  return month
}

// function getCurrentMonth() {
//   var monthNames = [ "January", "February", "March", "April", "May", "June",
//     "July", "August", "September", "October", "November", "December" ];
//   return monthNames[d.getMonth()]  
// }

function getCatTotal(projects) {
	var catTotal = 0
  projects.forEach(function (element) {
    var projectTotal = element["total"]
	  catTotal += parseInt(projectTotal)
  })
  return catTotal
}

function completedProjects(projects) {
  var completed = 0
  projects.forEach(function (project) {
    if (!hasActiveFuture(project)) completed = completed + 1
  })
  return completed      
}

function isActive(element) {
  var currentYear = "year" + getCurrentYear()
  var dollars = element[currentYear]
  if (dollars > 0) return true
  return false
}

function amountSpent(projects) {
  var spent = 0
  projects.forEach(function (project) {
    var currentYear = "year" + getCurrentYear()
    var funds = parseInt(project[currentYear]) 
    if (funds > 0) spent = spent + funds
    getPreviousYears().forEach(function (year) {
      var funds = parseInt(project[year])
      if (funds > 0) spent = spent + funds 
    })
  })
  return spent
} 

 function getType(projects, projectFilter) {
    var filteredProjects = []
    projects.forEach(function (element) {
      var type = "type"
      var projectType = element[type]
      if (projectType === projectFilter) filteredProjects.push(element)
  })
  return filteredProjects
  }

   function getMonthlyType(projects, projectFilter) {
    var filteredProjects = []
    projects.forEach(function (element) {
      var type = "focusarea"
      var projectType = element[type]
      if (projectType === projectFilter) filteredProjects.push(element)
  })
  return filteredProjects
  }
  
  function getProject(projects, projectFilter){
	  var oneProject = []
	  projects.forEach(function (element) {
		  var proj = "project"
		  var projName = element[proj]
		  if (projName === projectFilter) oneProject.push(element)
  })
  return oneProject
  }
	
	// function getProjectTotal(element) {
	// 		var tot = "total"
	// 		var projectTotal = element[tot]
	// 		if (projectTotal > 0)	return projectTotal
	// 	}
	
  // why no workie 
  
  // function getTotal(projects){
  // 	  var totalFunds = projectz
  // 	  projects.forEach(function (element) {
  // 		  var tot = "total"
  // 		  var projTot = element[tot]
  // 		  if (projTot > 0) return projTot
  // 	  })
  // }
  
  // function getTotal(element){
  // 	  var totalFunds = element[total]
  // 	  if (totalFunds > 0) return accounting.formatMoney(totalFunds)  
  // 	
  // }

 
 function getMoney(value) {
   if (value === "") return false
   return accounting.formatMoney(parseInt(value))  
 }
 
  function turnCurrency(projects) {
    projects.forEach(function (project) {
      var totalMoney = getMoney(project.total)
      if (totalMoney) project.total = totalMoney
      YEARS.forEach(function (year){
        var totalYear = getMoney(project[year])
        if (totalYear) project[year] = totalYear
      })
    })
    return projects
  }

  function turnReportCurrency(projects) {
    projects.forEach(function (project) {
      var totalBudget = getMoney(project.budget)
      if (totalBudget) project.budget = totalBudget
      projects.forEach(function (project){
        var totalPTD = getMoney(project.ptdactual)
        if (totalPTD) project.ptdactual = totalPTD
      })
    })
    return projects
  }


  function turnMonthlyCurrency(projects) {
  projects.forEach(function (project) {
    var actualMoney = getMoney(project.actual)
    var budgetedMoney = getMoney(project.budgeted)
    if (actualMoney) project.actual = actualMoney
    if (budgetedMoney) project.budgeted = budgetedMoney

    // YEARS.forEach(function (year){
    //   var totalYear = getMoney(project[year])
    //   if (totalYear) project[year] = totalYear
    // })
  })
  return projects
}
  
 function comboArrays(projectsA, projectsB) {
	 var arrayA = projectsA
	 var arrayB = projes
	 var comboArray = arrayA.concat(arrayB)
	 return comboArray
 } 

 
function isComplete(element) {
  var currentYear = "year" + getCurrentYear()
  var dollars = element[currentYear]
  if (dollars > 0) return "active"
  else 
  return "not active"
}

function getPreviousYears() {
  var currentYear = "year" + getCurrentYear()
  return YEARS.slice(0, YEARS.indexOf(currentYear))
}

function getFutureYears() {
  var currentYear = "year" + getCurrentYear()
  return YEARS.slice(YEARS.indexOf(currentYear))
}

function hasActiveFuture(element) {
  var activeFuture = false
  getFutureYears().forEach(function (year){
    if (element[year] > 0) activeFuture = true            
  })   
  return activeFuture
}

function getActiveProjects(projects) {
  var activeProjects = []
  projects.forEach(function getActive(element) {
    if (isActive(element)) activeProjects.push(element)
  })
  return activeProjects
}

// Mappin' with Leaflet.js

function displayAddress(map, project) {
	var markerLocation = new L.LatLng(project.lat, project.long);
	setCenter(map, markerLocation)
	var marker = new L.Marker(markerLocation);
	map.addLayer(marker);
	marker.bindPopup(project.project).openPopup();
}

function loadMap() {
  var	map = new L.Map('map', {
    touchZoom: true,
    scrollWheelZoom: false,
    dragging: true});
	var cloudmade = new L.TileLayer('http://tile.stamen.com/toner/{z}/{x}/{y}.png', {
	    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>, Tiles from <a href="http://tiles.stamen.com" target="_blank">Stamen</a>',
	    maxZoom: 18
	});
 map.addLayer(cloudmade);
 return map
}

function setCenter(map, markerLocation) {
	map.setView(markerLocation, 13)
}	
