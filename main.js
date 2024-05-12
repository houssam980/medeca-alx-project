document.addEventListener('DOMContentLoaded', function() {
    // Initialize Chart.js
    const ctx = document.getElementById('chart1').getContext('2d');
    const userChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['CBC', 'BMP', 'CMP', 'Lipid', 'Thyroid', 'Coagulation', 'Hormone', 'Vitamin', 'Infectious', 'Drugs'],
            datasets: [{
                label: 'Chart Values',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 2, 207, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(201, 203, 207, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Form submit event
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Get form values
        const fullName = document.getElementById('full-name').value;
        const cbcValue = parseFloat(document.getElementById('cbc').value);
        const bmpValue = parseFloat(document.getElementById('bmp').value);
        const cmpValue = parseFloat(document.getElementById('cmp').value);
        const lipidValue = parseFloat(document.getElementById('lipid').value);
        const thyroidValue = parseFloat(document.getElementById('thyroid').value);
        const coagulationValue = parseFloat(document.getElementById('coagulation').value);
        const hormoneValue = parseFloat(document.getElementById('hormone').value);
        const vitaminValue = parseFloat(document.getElementById('vitamin').value);
        const infectiousValue = parseFloat(document.getElementById('infectious').value);
        const drugsValue = parseFloat(document.getElementById('drugs').value);

        // Prepare data to send
        const data = new FormData();
        data.append('fullName', fullName);
        data.append('cbc', cbcValue);
        data.append('bmp', bmpValue);
        data.append('cmp', cmpValue);
        data.append('lipid', lipidValue);
        data.append('thyroid', thyroidValue);
        data.append('coagulation', coagulationValue);
        data.append('hormone', hormoneValue);
        data.append('vitamin', vitaminValue);
        data.append('infectious', infectiousValue);
        data.append('drugs', drugsValue);

        // Send data to doctorsdash.php
        fetch('doctorsdash.php', {
            method: 'POST',
            body: data
        })
        .then(response => {
            // Handle response
            console.log(response);
        })
        .catch(error => {
            // Handle error
            console.error('Error:', error);
        });
    });
});
