let editor;


// initializes the ace edtior when the window is loaded and make the python is the default language

window.onload = function () {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    // Set a default mode for Python 
    editor.session.setMode("ace/mode/python");
}

function changeLanguage() {
    let language = $("#languages").val();
    // Update the editor mode based on the language selected
    if (language == 'python') {
        editor.session.setMode("ace/mode/python");
    } else if (language == 'java') {
        editor.session.setMode("ace/mode/java");
    }
}
/* 
send ajax requrest to php script with passing the selecte lanaguage by the user and the code

*/
function executeCode() {
    $.ajax({
        url: "/complier/app/complierr.php", 
        method: "POST",
        data: {
            language: $("#languages").val(),
            code: editor.getSession().getValue()
        },
        success: function (response) {
            // display the output to the user 
            $(".output").text(response); 
        }
    });
}

