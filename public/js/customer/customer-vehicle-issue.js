const vehicleTypeDropdown = document.getElementById('vehicleType');
const issueListDropdown = document.getElementById('selectIssue');
vehicleTypeDropdown.addEventListener('change', async function () {
    const vehicleId = vehicleTypeDropdown.value;

    const response = await fetch(`/get-vehicle-issues/${vehicleId}`);
    if (response.ok) {
        const issues = await response.json();
        issueListDropdown.innerHTML = '<option value="" disabled selected>Select an issue</option>'
        issues.forEach(issue => {
            const option = document.createElement('option');
            option.value = issue['issue_id'];
            option.innerText = issue['issue_type'];
            issueListDropdown.appendChild(option);
        })
    } else {
        console.error("Error fetching vehicle issues for the vehicle type:", response.status);
    }
});