<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"
    integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/magnific-popup.min.js"></script>
<script src="assets/js/parallax.min.js"></script>
<script src="assets/js/rangeSlider.min.js"></script>
<script src="assets/js/nice-select.min.js"></script>
<script src="assets/js/meanmenu.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/sticky-sidebar.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/form-validator.min.js"></script>
<script src="assets/js/contact-form-script.js"></script>
<script src="assets/js/ajaxchimp.min.js"></script>
<script src="assets/js/main.js"></script>

<script>
    $('#size-options a').click(function () {
        $('#size-options a').removeClass('active');
        $(this).addClass('active');
    });
</script>
<script>
    var user_id = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>;
    function loadCart() {
        $.ajax({
            url: 'layouts/cart.php?id=' + user_id,
            type: 'GET',
            success: function (response) {
                $("#cart-sidebar").html(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
    }

    $(document).ready(function () {
        loadCart();
        $('#remove_cart').click(function () {
            $.ajax({
                url: 'process.php?act=remove_cart',
                type: 'POST',
                data: {
                    id: $(this).attr('data-id')
                },
                success: function (response) {
                    loadCart();
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });
        });


    })
</script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
    let notificationQueue = [];

    function fetchNotifications() {
        $.ajax({
            url: 'fetch_purchases.php',
            method: 'GET',
            success: function (response) {
                console.log('Response from server:', response); // Log the response to check the structure

                let data;
                try {
                    // Try to parse the response if it's a JSON string
                    if (typeof response === 'string') {
                        data = JSON.parse(response);
                    } else {
                        data = response;
                    }

                    // Ensure the response is an array
                    if (Array.isArray(data)) {
                        notificationQueue = data; // Store the data in the notification queue
                    } else {
                        console.error('Response is not an array:', data);
                    }
                } catch (e) {
                    console.error('Error processing the response:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to fetch purchases:', error);
            }
        });
    }

    function showNotification() {
        if (notificationQueue.length > 0) {
            let purchase = notificationQueue.shift(); // Get the first element and remove it from the queue
            alertify.notify(`${purchase.customer_name} Baru Saja Membeli ${purchase.product_name}`, 'success', 5);
        }
    }

    // Fetch notifications every 30 seconds
    setInterval(fetchNotifications, 30000);

    // Show one notification every 10 seconds
    setInterval(showNotification, 10000);
</script>