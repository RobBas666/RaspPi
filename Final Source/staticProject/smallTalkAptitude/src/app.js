var credits = [];

var optimal = [];

//Patterns to be constructed
var givenPatterns = [
						["purple", "orange", "green", "orange", "green", "orange", "green"],					//Question 1
						["blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue"],				//Question 2
						["yellow", "purple", "blue", "purple", "blue", "purple", "blue", "purple", "blue"],		//Question 3
						["red", "orange", "green", "orange", "orange", "green", "orange"],						//Question 4
						["green", "green", "red", "green", "green", "blue"]										//Question 5
					];
					
//Patterns being constructed
var initBuildPatterns = [
							["purple"],																//Question 1
							[],																		//Question 2
							[],																		//Question 3
							["yellow", "orange", "purple", "orange", "orange", "purple", "orange"],	//Question 4
							["red", "red", "green", "blue", "blue", "yellow"]						//Question 5
						];
	

var buildPatterns = [];

initialiseBuildPatterns();

var marked = [];

var currentQuestion = 0;

var fromColorVar = null
var toColorVar = null;

function init(){
	
	//Initialize credits array
	for(var i = 0; i < givenPatterns.length; i++){
		credits.push(100);
	}

	doQuestion();
}

function initialiseBuildPatterns(){
    for (i = 0; i < initBuildPatterns.length; i++) {
        buildPatterns.push([]);
        for (j = 0; j < initBuildPatterns[i].length; j++){
            buildPatterns[i].push(initBuildPatterns[i][j]);        
        }
    }
}

function doQuestion(){
	nextQuestion();
	update();
}

function nextQuestion(){
	document.getElementById("currentQuestion").innerHTML = "Question " + (currentQuestion+1);
	clearAllStacks();
	newMarkedArray();
	drawGivenArray();
}

function newMarkedArray(){
	marked = [];
	
	//Initialize marked array
	for(var i = 0; i < buildPatterns[currentQuestion].length; i++){
		marked.push(0);
	}
}

function clearAllStacks(){
	for(var i = 0; i < 10; i++){
		document.getElementById("B"+i).style.border = "0px";
		document.getElementById("B"+i).style.height = "45px";
		document.getElementById("B"+i).className = "blockStack " + "blank";
		document.getElementById("G"+i).className = "blockStack " + "blank";
	}
}

function update(){	//Called each time an action is performed
	updateCredits();
	
	for(var i = 0; i < buildPatterns[currentQuestion].length; i++){
		document.getElementById("B"+i).className = "blockStack " + buildPatterns[currentQuestion][i];
	}
	
	if(checkAnswer()){
		currentQuestion++;
		if(currentQuestion < givenPatterns.length){
			doQuestion();
		}
		else{
			var resultsWindow = document.getElementById("results");
			var divs = [];
			
			resultsWindow.style.visibility = "visible";
			document.getElementById("cover").style.visibility = "visible";
			
			for(var i = 0; i < givenPatterns.length; i++){
				divs[i] = document.createElement("DIV");
				divs[i].innerHTML = "Question " + (i+1) + ":" + credits[i];
				resultsWindow.appendChild(divs[i]);
			}
		}
	}
}

function checkAnswer(){	
	if (buildPatterns[currentQuestion].length == givenPatterns[currentQuestion].length){		
		
		for(var i = 0; i < buildPatterns[currentQuestion].length; i++){
			if(buildPatterns[currentQuestion][i] != givenPatterns[currentQuestion][i]){
				return false;
			}
		}
		
		
		return true;
	}
	else return false;	
}

function drawGivenArray(){	//Only called for new questions
	for(var i = 0; i < givenPatterns[currentQuestion].length; i++){
		document.getElementById("G"+i).className = "blockStack " + givenPatterns[currentQuestion][i];
	}
}

function updateCredits(){
	var creditDisplay = document.getElementById("credits");
	
	creditDisplay.innerHTML = "Total credits: " + credits[currentQuestion];
}

function highlight(element){
	var index = parseInt(element.id.charAt(1));
	
	if(element.className != "blockStack blank"){
		if( (marked[index] == 1) && ( (index-1 < 0) || (index+1 >= buildPatterns[currentQuestion].length) || (marked[index+1] == 0)  || (marked[index-1] == 0) )){
			element.style.border = "0px";
			element.style.height = "45px";
			marked[parseInt(element.id.charAt(1))] = 0;
		}
		else	if( (empty(marked)) || (marked[parseInt(element.id.charAt(1))+1] == 1) || (marked[parseInt(element.id.charAt(1))-1] == 1) ){
					element.style.border = "2px solid black";
					element.style.height = "41px";
					marked[parseInt(element.id.charAt(1))] = 1;
				}	
				else alert("Only adjacent squares can be selected");
	}
}

function fromColor(element){
	if(fromColorVar == null){
		fromColorVar = element.className.split(" ")[1];
		element.style.border = "2px solid black";
		element.style.height = "41px";
		element.style.width = "41px";
	}
	else 	if(element.className.split(" ")[1] == fromColorVar){
				fromColorVar = null;
				element.style.border = "0px";
				element.style.height = "45px";
				element.style.width = "45px";
			}
}

function toColor(element){
	if(toColorVar == null){
		toColorVar = element.className.split(" ")[1];
		element.style.border = "2px solid black";
		element.style.height = "41px";
		element.style.width = "41px";
	}
	else 	if(element.className.split(" ")[1] == toColorVar){
				toColorVar = null;
				element.style.border = "0px";
				element.style.height = "45px";
				element.style.width = "45px";
			}
}

function doSwitch(){

	if( (fromColorVar != null) && (toColorVar != null) ){
		for(var i = 0; i < buildPatterns[currentQuestion].length; i++){
			if(buildPatterns[currentQuestion][i] == fromColorVar){
				buildPatterns[currentQuestion][i] = toColorVar;
			}
		}
		fromColorVar = null;
		toColorVar = null;
		clearToolHighlights();
	}
	
	credits[currentQuestion]--;
	update();
}

function clearToolHighlights(){
	var toClear = document.getElementsByClassName("blockPick");
	
	for(var i = 0; i < toClear.length; i++){
		toClear[i].style.border = "0px";
		toClear[i].style.width = "45px";
		toClear[i].style.height = "45px";
	}
}

function empty(array){
	for(var i = 0; i < array.length; i++){
		if(array[i]==1) return false;
	}
	
	return true;
}

function countMarked(array){
	var count = 0;
	
	for(var i = 0; i < array.length; i++){
		if(array[i]==1) count++;
	}
	
	return count;
}

function doRepeat(){
	
	if(countMarked(marked) > givenPatterns[currentQuestion].length-buildPatterns[currentQuestion].length){
		alert("Build stack is full");
	}
	else{
		if(!empty(marked)){
			for(var i = 0; i < marked.length; i++){
				if(marked[i] == 1){
					buildPatterns[currentQuestion].push(buildPatterns[currentQuestion][i]);
					marked.push(0);
				}
			}
			credits[currentQuestion]--;
			update();
		}
		else alert("Select colours to repeat from 'build' field.");
	}
		
}

function addColor(element){
	var square;
	
	if(buildPatterns[currentQuestion].length < givenPatterns[currentQuestion].length){
		buildPatterns[currentQuestion].push(element.className.split(" ")[1]);
		marked.push(0);
		credits[currentQuestion] -= 2;
		update();
	}
	else alert("Build stack is full");
}

function resetQuestion(){
		credits[currentQuestion] = 100;    
		
		for(var i = 0; i < buildPatterns[currentQuestion].length; i++){
			document.getElementById("B"+i).className = "blockStack blank";
			document.getElementById("B"+i).style.border = "0px";
			document.getElementById("B"+i).style.height = "45px";
		}
    
		buildPatterns[currentQuestion] = [];
		
		for (j = 0; j < initBuildPatterns[currentQuestion].length; j++){
			buildPatterns[currentQuestion].push(initBuildPatterns[currentQuestion][j]);        
		}
		
		newMarkedArray();    
		update();
}