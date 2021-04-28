<script type="text/javascript">
    if (typeof rbagPageViewedSave === "undefined") {
        function rbagPageViewedSave() {
            if (typeof rbagElementsAction !== "undefined" && typeof rbagElementsAction === "function") {
                console.log('passed');
                rbagElementsAction(viewPageName);
            } else {
                setTimeout(function () {
                    console.log('delayed');
                    rbagPageViewedSave();
                }, 500)
            }
        }
        rbagPageViewedSave();
    }
</script>
<?php get_footer(); ?>