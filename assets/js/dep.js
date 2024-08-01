document.addEventListener('DOMContentLoaded', function () {
    var regionSelect = document.getElementById('user_form_regions');
    var departmentSelect = document.getElementById('user_form_departements');

    regionSelect.addEventListener('change', function () {
        var regionId = this.value;

        // console.log('regionId:', regionId);
        // Clear the current department options
        departmentSelect.innerHTML = '<option value="">choisir un département</option>';

        if (regionId) {
            fetch('/Departements?regionId=' + regionId)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    data.forEach(department => {
                        var option = document.createElement('option');
                        option.value = department.id;
                        option.text = department.name;
                        departmentSelect.add(option);
                    });
                });
        }
    });
});