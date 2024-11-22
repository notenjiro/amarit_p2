




function addClickEventListener(elementId, callback) {
    document.getElementById(elementId).addEventListener('click', callback);
}

// document.getElementById('button_import').style.background = "red";

function init(type){

    
    addClickEventListener('button_export', function() {
        moduleExport(type)
    });
// onclick="moduleFunction('export','branch');"





// document.getElementById("button_import").addEventListener("click", moduleExport(type));



// document.getElementById("export_group_name").addEventListener("click", moduleExport('group_name'));
// $(document).on("click", "#export_branch", function(){
//     moduleFunction('export','branch')
//  });

// $("#export_branch").click();


    //CHANGE EXPORT BUTTON

}



// $("#export_branch").click(function(){
//     moduleFunction('export','branch');
// });

function moduleExport(type){
    window.open("./api/export.php?type="+type);
}


// function moduleFunction(fnc,type){

//     if(fnc == "export" ){ //&& type == "branch"
//         window.open("./api/"+fnc+".php?type="+type);
//     }

//     if(fnc == "import"){ // && type == "branch"

      
//     }
    
// }

function uploadCSV() {
    const input = document.getElementById('csvFileInput');
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(event) {
            const csvData = event.target.result;
            const parsedData = parseCSV(csvData);
            console.log("Parsed Data: ", parsedData);
            // You can now work with the parsed data
        };

        reader.readAsText(file);
    } else {
        alert("Please select a file.");
    }
}

function parseCSV(data) {
    const lines = data.split('\n');
    const result = [];
    const headers = lines[0].split(',');

    for (let i = 1; i < lines.length; i++) {
        const obj = {};
        const currentLine = lines[i].split(',');

        for (let j = 0; j < headers.length; j++) {
            obj[headers[j]] = currentLine[j];
        }

        result.push(obj);
    }

    return result;
}