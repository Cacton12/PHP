<html>
<head>
<script>
//Chapter 20 - AJAX (Asychronous JavaScript and XML)
//AJAX makes your web application more responsive and faster, like Windows applications
function checkCountry(country) {
    //use an asynchronous JS call to the proc page to get a list of matching countries
    $suggestionArray = []; //array with results
    console.log(country); //for debugging
    document.getElementById("txtSuggestion").innerHTML = ""; //clear it out
    document.getElementById("lstCountries").innerHTML = "";
    fetch("chap20_GetCountries.php?q=" + country)
        .then(response=>response.json())
        .then(data=> {
            console.log(data);//for debugging
            if (Array.isArray(data)) {
                data.forEach(AddCountry);//call the function for each element of the array
            }
            else {//no results found
                document.getElementById("lstCountries").innerHTML = "<option>" + 
                    data + "</option>";
                document.getElementById("txtSuggestion").innerHTML = data;
                
            }
        })
        .catch(error=>console.log("There was an error with the fetch API"));
}
function AddCountry (data, index) {
    document.getElementById("lstCountries").innerHTML += "<option>" + 
        data + "</option>";
    document.getElementById("txtSuggestion").innerHTML += data + ", ";
}
</script>
</head>
<body>

<p><b>Start typing a country:</b></p>
<form action="">
  <label for="fname">Country:</label>
  <input type="text" id="country" list="lstCountries" name="country" onkeyup="checkCountry(this.value)">
  <datalist id="lstCountries"></datalist>
</form>
<p>Suggestions: <span id="txtSuggestion"></span></p>
</body>
</html>