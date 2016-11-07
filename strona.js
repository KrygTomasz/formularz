var goToFirstSite = function() {
	var name = $('#name').val();
	if(name != ""){
		localStorage.setItem("name", name);
		window.location.href='strona1.html';
	}
	else{
		alert("Enter your name!");
	}
}

var checkCheckedFields = function() {
    $('input').each(function(){
        var elementId = $(this).attr('id');
        if(localStorage.getItem(elementId) == "true") {$(this).attr("checked",true);};
    })

}

var colorCheckedFields = function() {
    checkCheckedFields();
    saveFirstQuestionToLocalStorage();
	$('input').each(function(a,b){ if(a.checked){a.parentNode.className = "labelClass color"}});
	var inputsChecked = $('input:checked');
	var inputsNotChecked = $('input:radio:not(:checked)');
	for (var i = 0; i < inputsChecked.length; i++) {
		inputsChecked[i].parentNode.classList.add("color");
	}
	for (var i = 0; i< inputsNotChecked.length; i++) {
		inputsNotChecked[i].parentNode.classList = ["labelClass"];
	}
}

var saveFirstQuestionToLocalStorage = function() {
    $('input').each(function(){
        var elementId = $(this).attr('id');
        if(document.getElementById(elementId).checked){
            localStorage.setItem(elementId, "true");
        }
        else{
            localStorage.setItem(elementId, "false");
        }
    })
}

var changeColor = function() {
	$(event.target).closest('.labelClass').toggleClass('color');
    saveSecondQuestionToLocalStorage();
}

var saveSecondQuestionToLocalStorage = function() { 
    var radioChecked = $('input:checked');
    localStorage.setItem(radioChecked.attr('name'), radioChecked.attr('id'));
}

var checkForm = function() {
    var ls = localStorage;
    var firstQuestionItems = ["red","blue","green","yellow","white","black"];
    var firstQuestionFilled = false;
    var secondQuestionFilled = false;
    
    $.each(firstQuestionItems, function(index, value) {
        if(JSON.parse(localStorage.getItem(value)) == true){
            firstQuestionFilled = true;
        }
    });
    
    var secondQuestionAnswer = localStorage.getItem("radio");
    if(secondQuestionAnswer != null) {
        secondQuestionFilled = true;
    }
    
    if(firstQuestionFilled == false) {
        alert("Wypełnij pytanie pierwsze!");
    }
    else if(secondQuestionFilled == false) {
        alert("Wypełnij pytanie drugie!");
    }
    
    return [firstQuestionFilled, secondQuestionFilled];
}

var sendForm = function(isQuestionsFilledArray) {
    if(isQuestionsFilledArray[0] == false) {
        window.location.href='strona1.html';
        return false;
    }
    else if(isQuestionsFilledArray[1] == false) {
        window.location.href='strona2.html';
        return false;
    }
    return true;
}

var sendPOST = function() {
    var formArray = checkForm();
    if(sendForm(formArray)){
    
        var jsonTemplate = {
            "user": localStorage.getItem("name"),
            "red": localStorage.getItem("red"),
            "blue": localStorage.getItem("blue"),
            "green": localStorage.getItem("green"),
            "yellow": localStorage.getItem("yellow"),
            "white": localStorage.getItem("white"),
            "black": localStorage.getItem("black"),
            "radio": localStorage.getItem("radio")
        };

        $.post("strona.php",
        jsonTemplate,
        function(data) {
              console.log(data);
        });
        localStorage.clear();
        window.location.href='strona3.html';
    }
};