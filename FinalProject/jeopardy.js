var correct = 0;
var total = 0;
var scoreTotal = 0;

function getQuestion() {
    //add code here that will use AJAX to get a question from getQuestion.php
    document.getElementById("txtResponse").value = "";
    fetch("getQuestion.php")
        .then(response => response.json())
        .then(json => {
            var perc = ((correct / total) * 100).toFixed(2);
            Category = json.category
            Clue = json.question
            value = json.value
            answer = json.answer;
            hint = answer.split('');
            currentIndex = 0;
            hintText = "";  
            $("#lblCategory").text(Category);
            $("#lblClue").text(Clue);
            $("#lblValue").text(answer);
            $("#lblScore").html("Points: " + scoreTotal + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accuracy:" + "&nbsp;&nbsp;" + correct + "/" + total + " " + perc + "%");
        })
    return true;
}
function CheckAnswer() {
    //verify if the user's answer is correct. This gets called when the user submits their answer
    const answerGiven = document.getElementById("txtResponse").value;
    const threshold = 3;
    if (answerGiven == answer) {
        alert("Your answer is correct");
        correct += 1;
        total += 1;
        scoreTotal += parseFloat(value);
        getQuestion();
    }
    else {
        const distance = damerauLevenshteinDistance(answer.split(''), answerGiven.split(''), threshold);
        if (distance <= threshold) {
            alert("close enough, correct answer is " + answer)
            correct += 1;
            total += 1;
            scoreTotal += parseFloat(value);
            getQuestion();
        } else {
            alert("sorry the correct answer is " + answer);
            total += 1;
            getQuestion();
        }
    }
}
function ResetScore() {
    var perc = ((correct / total) * 100).toFixed(2);
    total = 0;
    correct = 0;
    scoreTotal = 0;
    $("#lblCategory").text(Category);
    $("#lblClue").text(Clue);
    $("#lblValue").text(answer);
    $("#lblScore").html("Points: " + scoreTotal + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accuracy:" + "&nbsp;&nbsp;" + correct + "/" + total + " " + perc + "%");
}

function damerauLevenshteinDistance(source, target, threshold = Infinity) {
    /// <summary>
    /// Computes the Damerau-Levenshtein Distance between two strings, represented as arrays of
    /// integers, where each integer represents the code point of a character in the source string.
    /// Includes an optional threshhold which can be used to indicate the maximum allowable distance.
    /// </summary>
    /// <param name="source">An array of the code points of the first string</param>
    /// <param name="target">An array of the code points of the second string</param>
    /// <param name="threshold">Maximum allowable distance</param>
    /// <returns>Int.MaxValue if threshhold exceeded; otherwise the Damerau-Leveshteim distance between the strings</returns>
    const length1 = source.length;
    const length2 = target.length;

    // Return trivial case - difference in string lengths exceeds threshold
    if (Math.abs(length1 - length2) > threshold) { return Number.MAX_VALUE; }

    // Ensure source is the shorter string
    if (length1 > length2) {
        [source, target] = [target, source];
    }

    const maxi = source.length;
    const maxj = target.length;

    let dCurrent = new Array(maxi + 1).fill(0);
    let dMinus1 = new Array(maxi + 1).fill(0);
    let dMinus2 = new Array(maxi + 1).fill(0);
    let dSwap;

    for (let i = 0; i <= maxi; i++) {
        dCurrent[i] = i;
    }

    let jm1 = 0;
    let im1 = 0;
    let im2 = -1;

    for (let j = 1; j <= maxj; j++) {
        // Rotate
        dSwap = dMinus2;
        dMinus2 = dMinus1;
        dMinus1 = dCurrent;
        dCurrent = dSwap;

        // Initialize
        let minDistance = Number.MAX_VALUE;
        dCurrent[0] = j;

        im1 = 0;
        im2 = -1;

        for (let i = 1; i <= maxi; i++) {
            const cost = source[im1] === target[jm1] ? 0 : 1;

            const del = dCurrent[im1] + 1; // Deletion
            const ins = dMinus1[i] + 1;   // Insertion
            const sub = dMinus1[im1] + cost; // Substitution

            // Minimum of deletion, insertion, substitution
            let min = Math.min(del, ins, sub);

            // Damerau condition (transposition)
            if (
                i > 1 &&
                j > 1 &&
                source[im2] === target[jm1] &&
                source[im1] === target[j - 2]
            ) {
                min = Math.min(min, dMinus2[im2] + cost);
            }

            dCurrent[i] = min;

            if (min < minDistance) {
                minDistance = min;
            }

            im1++;
            im2++;
        }

        jm1++;
        if (minDistance > threshold) {
            return Number.MAX_VALUE;
        }
    }

    const result = dCurrent[maxi];
    return result > threshold ? Number.MAX_VALUE : result;
}                
function ShowHint() {
    if (currentIndex < hint.length) {
        hintText += hint[currentIndex];
        currentIndex++;
        document.getElementById("txtResponse").value = hintText;          
    }
}