function validateForm(event) {
    event.preventDefault();

    const instructions = document.getElementById("instructions");
    const startDate = document.getElementById("startDate");
    const endDate = document.getElementById("endDate");
    const classSelect = document.getElementById("class");

    let isValid = true;

    // Clear previous error messages
    document.getElementById("instructionsError").textContent = "";
    document.getElementById("startDateError").textContent = "";
    document.getElementById("endDateError").textContent = "";
    document.getElementById("selectError").textContent = "";

    // Validate Instructions
    if (!instructions.value.trim()) {
        document.getElementById("instructionsError").textContent = "* Required.";
        isValid = false;
    }

    // Validate Start Date
    if (!startDate.value.trim()) {
        document.getElementById("startDateError").textContent = "* Required.";
        isValid = false;
    }

    // Validate End Date
    if (!endDate.value.trim()) {
        document.getElementById("endDateError").textContent = "* Required.";
        isValid = false;
    }

    // Validate Class Selection
    if (!classSelect.value) {
        document.getElementById("selectError").textContent = "* Required.";
        isValid = false;
    }
    if (isValid) {
        // Show confirmation message
        document.getElementById("confirmationPopup").style.display = "block";
        document.getElementById("backdrop").style.display = "block";
    }
}

document.getElementById("confirmButton").addEventListener("click", function () {
    // User confirmed submission, show success message and reset form
    showSuccessMessage();
    document.getElementById("assignmentForm").reset();
});

document.getElementById("cancelButton").addEventListener("click", function () {
    // User cancelled, hide confirmation popup
    hideConfirmation();
});

function showSuccessMessage() {
    document.getElementById("confirmationPopup").style.display = "none";
    document.getElementById("successPopup").style.display = "block";
}

function hideConfirmation() {
    document.getElementById("confirmationPopup").style.display = "none";
    document.getElementById("backdrop").style.display = "none";
}

document.getElementById("okButton").addEventListener("click", function () {
    // Hide success message
    document.getElementById("successPopup").style.display = "none";
    document.getElementById("backdrop").style.display = "none";
});
// to prevent selectiin date eariler than today 
var today = new Date().toISOString().split('T')[0];
startDate.setAttribute('min', today);
endDate.setAttribute('min', today);
