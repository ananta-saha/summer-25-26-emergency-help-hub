function findServices() {
    var location = document.getElementById("location").value;
    var type = document.getElementById("serviceType").value;
    var result = document.getElementById("serviceResults");

    if (location == "") {
        alert("Please enter location");
        return;
    }

    if (type == "") {
        alert("Please select a service");
        return;
    }

    result.innerHTML =
        "<div class='service-card'>" +
        "<h3>" + type.toUpperCase() + "</h3>" +
        "<p>Location: " + location + "</p>" +
        "<p>Status: <strong>Available</strong></p>" +
        "<p>Distance: 1.5 km</p>" +
        "<button onclick='sendRequest()'>Request Service</button>" +
        "</div>";
}

function sendRequest(serviceType, providerId) {

    window.location.href =
        "../../controller/citizen/emergency-request.php?service="
        + encodeURIComponent(serviceType)
        + "&provider_id="
        + encodeURIComponent(providerId);
}


/* =========================
   REQUEST STATUS
========================= */

let requestData = JSON.parse(localStorage.getItem("emergencyRequest"));
let box = document.getElementById("requestBox");
if (box) {
    if (!requestData) {
        box.innerHTML = `
            <p>You have no active emergency request.</p>
            <div class="buttons">
                <a href="../../controller/citizen/services.php">
                    <button type="button" class="primary-btn">Find Emergency Service</button>
                </a>
            </div>
        `;
    } else {
        box.innerHTML = `
            <div class="service-card">
                <h3>Request Details</h3>
                <p><strong>Service:</strong>${requestData.service}</p>
                <p><strong>Emergency Type:</strong>${requestData.emergencyType}</p>
                <p><strong>People:</strong>${requestData.people}</p>
                <p><strong>Vehicles:</strong>${requestData.vehicles}</p>
                <p><strong>Location:</strong>${requestData.location}</p>
                <p><strong>Status:</strong><span id="status">${requestData.status}</span></p>

                <button onclick="cancelRequest()">Cancel Request</button>
            </div>
        `;
    }
}

function cancelRequest() {
    let confirmCancel = confirm("Are you sure you want to cancel this request?");
    if (confirmCancel) {
        localStorage.removeItem("emergencyRequest");
        alert("Emergency request cancelled.");
        location.reload();
    }
}