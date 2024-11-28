const issuesData = {
    motorbike: [
        "Engine won't start",
        "Flat tire",
        "Brake issues",
        "Chain problems",
        "Oil leakage"
    ],
    "tuk-tuk": [
        "Engine overheating",
        "Steering issues",
        "Battery problems",
        "Suspension damage",
        "Brake failure"
    ],
    car: [
        "Engine malfunction",
        "Flat tire",
        "Transmission issues",
        "Brake failure",
        "Air conditioning failure"
    ]
};

const vehicleTypeSelect = document.getElementById("vehicleType");
const issuesContainer = document.getElementById("issuesContainer");
const issuesList = document.getElementById("issuesList");

vehicleTypeSelect.addEventListener("change", () => {
    const selectedVehicle = vehicleTypeSelect.value;

    if (selectedVehicle) {
        const issues = issuesData[selectedVehicle];
        displayIssues(issues);
        issuesContainer.style.display = "block";
    } else {
        issuesContainer.style.display = "none";
    }
});

function displayIssues(issues) {
    issuesList.innerHTML = "";
    issues.forEach(issue => {
        const issueWrapper = document.createElement("div");
        issueWrapper.className = "issue-checkbox";

        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.name = "issues";
        checkbox.value = issue;

        const label = document.createElement("label");
        label.textContent = issue;

        issueWrapper.appendChild(checkbox);
        issueWrapper.appendChild(label);
        issuesList.appendChild(issueWrapper);
    });
}

document.getElementById("vehicleForm").addEventListener("submit", (event) => {
    event.preventDefault();
    const selectedVehicle = vehicleTypeSelect.value;
    const selectedIssues = Array.from(document.querySelectorAll("input[name='issues']:checked"))
        .map(input => input.value);
    const additionalInfo = document.getElementById("description").value;

    console.log("Vehicle Type:", selectedVehicle);
    console.log("Selected Issues:", selectedIssues);
    console.log("Additional Information:", additionalInfo);

    alert("Form submitted successfully!");
});
