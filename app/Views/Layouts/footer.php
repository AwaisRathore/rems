
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?= site_url("public/assets/vendor/libs/jquery/jquery.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/popper/popper.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/js/bootstrap.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") ?>"></script>

<script src="<?= site_url("public/assets/vendor/js/menu.js") ?>"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?= site_url("public/assets/vendor/libs/apex-charts/apexcharts.js") ?>"></script>

<!-- Main JS -->
<script src="<?= site_url("public/assets/js/main.js") ?>"></script>

<!-- Page JS -->
<script src="<?= site_url("public/assets/js/dashboards-analytics.js") ?>"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Custom Script -->
<?php $this->renderSection('Script') ?>
<script>
    $(document).ready(function() {
        loadNotification();
        setInterval(function() {
            loadNotification();
        }, 5000);



    });

    var audio = new Audio("<?= site_url('public/assets/audio/notification.wav') ?>");

    function loadNotification() {
        var no = $("#notification").text();
        $.ajax({
            url: "<?= site_url("Notification/refresh_notifications") ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                // Update the UI with the new list of unread notifications
                $(".notification").text(response);
                // console.log(response,no);
                if (parseInt(response) > parseInt(no)) {
                    audio.play();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
</script>
</body>

</html>