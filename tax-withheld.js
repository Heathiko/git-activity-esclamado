(function() {


    let entryArea = document.getElementById("entry-area");    
    let outputArea = document.getElementById("output-area");

    let categoryTitles = [
        ['Exemption','0.00','0.00','1.65','8.25','28.05','74.26','165.02','412.54'],
        ['Status     (\'000P)','+0% over','+5% over','+10% over','+15% over','+20% over','+25% over','+30% over','+32% over']
    ];

    let taxOver = [0,0.05,0.10,0.15,0.20,0.25,0.30,0.32];
    let taxValue = [0.00,0.00,1.65,8.25,28.05,74.26,165.02,412.54];
    let zCategory = ['1.Z',0.0,1,0,33,99,231,462,825,1650];
    let smeCategory = ['2.S/ME',50.0,1,165,198,264,396,627,990,1815];

    let newLabelElement = document.createElement("label");
    let newBreakElement = document.createElement("br");

    //----------------create user form ----------------//

    let userFormTable = entryArea.appendChild(document.createElement("table"));
    userFormTable.style.margin = "0 auto";
    userFormTable.setAttribute("border","0");
    userFormTable.setAttribute("cellpadding","0");
    userFormTable.setAttribute("cellspacing","0");
    userFormTable.id = "userFOrmTable";

    let formTableBody = userFormTable.appendChild(document.createElement("tbody"));
    formTableBody.style.fontFamily = "arial";
    formTableBody.parentElement.style.margin="0";
    formTableBody.parentElement.style.float ="left";
    formTableBody.parentElement.style.textAlign ="left";

    let userFormCategories = ["First Name:","Last Name:","Tax Category:","Hours Worked:","Rate per Hour:"];
    let taxcategory = ["Z","Single/Married"];

    

    let FormRow = document.createElement("tr");
    let FormData = document.createElement("td");

    userFormCategories.forEach(category => {
        let newFormRow = formTableBody.appendChild(FormRow.cloneNode(true));
        let newFormLabel = newFormRow.appendChild(newLabelElement.cloneNode(true));
        newFormLabel.innerText = category;
        newFormLabel.style.margin = "20px";
        newFormLabel.style.width ="150px";
        userInputs = newFormRow.appendChild(FormData.cloneNode(true));


        if(category == "Tax Category:"){
            let taxselect = userInputs.appendChild(document.createElement("select")); 
            let defaultOption = taxselect.appendChild(document.createElement("option"));
            defaultOption.innerText = "Single or Married";
            defaultOption.selected = true;
            defaultOption.disabled = true;

            taxcategory.forEach(item=>{
                let taxOption = taxselect.appendChild(document.createElement("option"));
                taxOption.innerText = item;
                taxselect.id = "taxCategory";
                taxOption.style.fontSize="12pt";
                taxOption.style.fontFamily="arial";
                 

            });

        } else {
            let userFormInput = userInputs.appendChild(document.createElement("input"));
            userFormInput.type ="text";
            userFormInput.innterText = "";
            userFormInput.style.width="200px";

            if (category == "First Name:") userFormInput.id = "firstName";
            if (category == "Last Name:") userFormInput.id = "lastName";
            if (category == "Hours Worked:") userFormInput.id = "hoursWorked";
            if (category == "Rate per Hour:") userFormInput.id = "ratePerHour";
          
        }

    }); 

    //-----------------------------------------------------------------------------------//
                                //COMPUTE TAX FUNCTION//
    //-----------------------------------------------------------------------------------//
   function computeTax() {
    outputArea.innerHTML = "";

    let firstName   = document.getElementById("firstName").value.trim();
    let lastName    = document.getElementById("lastName").value.trim();
    let taxCategory = document.getElementById("taxCategory").value;
    let hoursWorked = parseFloat(document.getElementById("hoursWorked").value);
    let ratePerHour = parseFloat(document.getElementById("ratePerHour").value);

    if (!firstName || !lastName || isNaN(hoursWorked) || isNaN(ratePerHour) || taxCategory === "Single or Married") {
        alert("Please complete all fields with valid inputs!");
        return;
    }

    let grossIncome = hoursWorked * ratePerHour;
    let taxBracketCategory = (taxCategory === "Z") ? zCategory : smeCategory;

    // Find bracket
    function findBracket(grossIncome, taxBracketCategory){
        let bracketIndex = 0;
        for(let i = 2; i < taxBracketCategory.length - 1; i++) {
            if(grossIncome >= taxBracketCategory[i] && grossIncome < taxBracketCategory[i+1]) {
                bracketIndex = i - 1; 
                break;
            }
        }
        if(grossIncome >= taxBracketCategory[taxBracketCategory.length - 1]){
            bracketIndex = taxBracketCategory.length - 2;
        }
        return bracketIndex;
    }

    let bracketIndex = findBracket(grossIncome, taxBracketCategory);
    let baseBracket = bracketIndex; 
    let taxableIncome = grossIncome - taxBracketCategory[baseBracket + 1];
    let statusPercentage = taxableIncome * taxOver[baseBracket - 1]; 
    let taxWithheld = taxValue[baseBracket - 1] + statusPercentage;
    let takeHomePay = grossIncome - taxWithheld;

    let resultTable = document.createElement("table");
    resultTable.setAttribute("border", "0");
    resultTable.style.margin = "20px auto";
    resultTable.style.fontFamily = "arial";
    resultTable.style.fontSize = "12pt";

    let tbody = document.createElement("tbody");
    let resultData = [
        ["First Name", firstName],
        ["Last Name", lastName],
        ["Category", taxCategory],
        ["Hours Worked", hoursWorked],
        ["Rate per Hour", ratePerHour],
        ["Gross Pay", grossIncome.toLocaleString('en', {minimumFractionDigits:2, maximumFractionDigits:2})],
        ["Tax Withheld", taxWithheld.toLocaleString('en',{minimumFractionDigits:2})],
        ["Take Home Pay", takeHomePay.toLocaleString('en',{minimumFractionDigits:2})]
    ];

    resultData.forEach(row => {
        let tableRow = document.createElement("tr");
        let labelsCol = document.createElement("td");
        let resCol = document.createElement("td");
        labelsCol.innerText = row[0];
        resCol.innerText = row[1];
        labelsCol.style.fontWeight = "bold";
        tableRow.appendChild(labelsCol);
        tableRow.appendChild(resCol);
        tbody.appendChild(tableRow);
    });

    resultTable.appendChild(tbody);
    outputArea.appendChild(resultTable);
}

    //-----------------------------------------------------------------------------------//
                                        // CLEAR FUNCTION
    //-----------------------------------------------------------------------------------//
    function clearContents() {
        document.getElementById("firstName").value = "";
        document.getElementById("lastName").value = "";
        document.getElementById("taxCategory").selectedIndex = 0;
        document.getElementById("hoursWorked").value = "";
        document.getElementById("ratePerHour").value = "";
        outputArea.innerHTML = "";
    } 

    //-----------------------------------------------------------------------------------//
                                        // EVENT LISTENERS
    //-----------------------------------------------------------------------------------//
    
    document.getElementById("compute").addEventListener("click", computeTax);
    document.getElementById("clear").addEventListener("click", clearContents);

    //-----------------------------------------------------------------------------------//
    function drawReference(){

            let topHeadings = ['Daily',1,2,3,4,5,6,7,8];

            let reference = document.getElementById("reference");
            reference.innerHTML = "<span style='font-size: 25pt; font-weight: bold; display: inline-block; height: 50px;'>Reference Table:</span>";
            let newFragment = document.createDocumentFragment();            
   
            let tableElement = document.createElement("table");
            let tableRowElement = document.createElement("tr");
            let tableHeadElement = document.createElement("th");
            let tableDataElement = document.createElement("td");

            let newTable = newFragment.appendChild(tableElement.cloneNode(true));
            newTable.style.margin = "0 auto";
            newTable.setAttribute("border","1");
            
            let colCounter;
            let rowCounter;

            newTableRow = newTable.appendChild(tableRowElement.cloneNode(true));

            for(colCounter = 0;colCounter < topHeadings.length;colCounter++){
            let newHeadColumn = newTableRow.appendChild(tableHeadElement.cloneNode(true));
            
                if(colCounter == 0){
                    newHeadColumn.setAttribute("colspan","2");
                    newHeadColumn.style.width = "800px";
                }   
                
                newHeadColumn.innerText = topHeadings[colCounter];
                newHeadColumn.style.width = "100px";       
            }

            for(rowCounter = 0;rowCounter < categoryTitles.length; rowCounter++){
             newTableRow = newTable.appendChild(tableRowElement.cloneNode(true));
                for(colCounter = 0;colCounter < categoryTitles[rowCounter].length; colCounter++){ 
                    let newDataColumn = newTableRow.appendChild(tableDataElement.cloneNode(true));
                    //newDataColumn.style.width = "100px";
                    if(colCounter == 0)
                        newDataColumn.setAttribute("colspan","2");
                    else 
                        newDataColumn.style.textAlign = "right";

                        newDataColumn.innerText = categoryTitles[rowCounter][colCounter]; 
                }
            }

            newTableRow = newTable.appendChild(tableRowElement.cloneNode(true));
            let newDataColumn = newTableRow.appendChild(tableDataElement.cloneNode(true)); 
            newDataColumn.setAttribute("colspan","10");
            newDataColumn.innerText = "A. Table for employees without qualified dependent";
            newDataColumn.style.textAlign = "left";

            newTableRow = newTable.appendChild(tableRowElement.cloneNode(true));
            colCounter = 0;
            for(let indexValue of zCategory){
                let newDataColumn = newTableRow.appendChild(tableDataElement.cloneNode(true));
                newDataColumn.innerText = indexValue.toLocaleString('en',{minimumFractionDigits:2,maximumFractionDigits:2});
                if(colCounter != 0)
                    newDataColumn.style.textAlign = "right";

                colCounter++;
            }


            newTableRow = newTable.appendChild(tableRowElement.cloneNode(true));
            colCounter = 0;
            for(let indexValue of smeCategory){
                let newDataColumn = newTableRow.appendChild(tableDataElement.cloneNode(true));
                newDataColumn.innerText = indexValue.toLocaleString('en',{minimumFractionDigits:2,maximumFractionDigits:2});
                if(colCounter != 0)
                    newDataColumn.style.textAlign = "right";
                
                colCounter++;
            }


            newFragment.appendChild(newTable);

            reference.appendChild(newFragment);
            reference.style.fontFamily = "arial";
            reference.style.fontSize = "13pt";
    }




    drawReference(); 
     
})();





