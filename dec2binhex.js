function convert() {
    const decimalValue = document.getElementById("decimalInput").value;

    if (decimalValue === "" || decimalValue === false) {
        alert("Error. Please enter a number.");
        emptyInputs();
    } else {
    const binary = parseInt(decimalValue).toString(2).padStart(8,"0");
    const hexadecimal = parseInt(decimalValue).toString(16).toUpperCase();

    document.getElementById("result").innerHTML = 
    `<p>The <strong>Binary</strong> and <strong>Hexadecimal</strong> Equivalent for ${decimalValue} are:</p>
    ${binary} <br> 0x${hexadecimal}`;
    }

   
}

function emptyInputs(){
    document.getElementById("result").innerText = "";
    document.getElementById("decimalInput").value = "";
}
