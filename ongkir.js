$(document).ready(function () {
    // Initialize NiceSelect
    $('select').niceSelect();

    // Load provinces on page load
    $.ajax({
        url: 'proxy.php', // URL to your PHP proxy script
        type: 'GET',
        dataType: 'json',
        data: { action: 'provinces' },
        success: function (data) {
            console.log("Provinces data:", data); // Log the response data
            if (data && data.rajaongkir && data.rajaongkir.results) {
                var provinces = data.rajaongkir.results;
                var dropdown = $('#provinceDropdown');
                $.each(provinces, function (index, province) {
                    dropdown.append(
                        $('<option></option>').val(province.province_id).text(province.province)
                    );
                });
                dropdown.niceSelect('update'); // Refresh NiceSelect
            } else {
                console.error('Failed to load data.');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data:', textStatus, errorThrown);
        }
    });

    // Fetch cities when a province is selected
    $('#provinceDropdown').change(function () {
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                url: 'proxy.php', // URL to your PHP proxy script
                type: 'GET',
                dataType: 'json',
                data: { action: 'cities', province: provinceId },
                success: function (data) {
                    console.log("Cities data:", data); // Log the response data
                    if (data && data.rajaongkir && data.rajaongkir.results) {
                        var cities = data.rajaongkir.results;
                        var cityDropdown = $('#cityDropdown');
                        cityDropdown.empty();
                        cityDropdown.append('<option value="">Pilih Kota</option>');
                        $.each(cities, function (index, city) {
                            console.log("Adding city:", city.city_name); // Log each city
                            cityDropdown.append(
                                $('<option></option>').val(city.city_id).text(city.city_name)
                            );
                        });
                        cityDropdown.niceSelect('update'); // Refresh NiceSelect
                    } else {
                        console.error('Failed to load cities.');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching cities:', textStatus, errorThrown);
                }
            });
        } else {
            $('#cityDropdown').empty();
            $('#cityDropdown').append('<option value="">Select a City</option>');
            $('#cityDropdown').niceSelect('update'); // Refresh NiceSelect
        }
    });
});
